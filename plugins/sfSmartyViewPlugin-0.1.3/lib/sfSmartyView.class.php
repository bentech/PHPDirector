<?php

/**
* Smarty View class for symfony
*
* @version $Id$
* @copyright 2006 Georg Gell
*/

$e = error_reporting(0);
error_reporting($e);

/**
 * sfSmartyView
 *
 * @package
 * @author georg
 * @copyright Copyright (c) 2006
 * @version $Id$
 * @access public
 **/
class sfSmartyView extends sfPHPView {
    protected static $smarty = false;
    protected static $smartyHelperLoaded = false;
    protected static $knownFunctions;
    protected static $loadedHelpers;
    protected static $usedHelpers;
    protected static $cache;
    protected static $log;
    protected static $templateSecurity;

    const CACHENAMESPACE = 'Smarty';

    /**
     * sfSmartyView::initialize()
     * This method is used instead of sfPHPView::initialze
     *
     * @param mixed $context
     * @param mixed $moduleName
     * @param mixed $actionName
     * @param mixed $viewName
     * @return
     **/
    public function initialize($context, $moduleName, $actionName, $viewName)
    {
        $this->setExtension(sfConfig::get('app_sfSmartyView_template_extension', '.tpl'));
        parent::initialize($context, $moduleName, $actionName, $viewName);
        if (!self::$smarty) {
            $smartyClassPath = sfConfig::get('app_sfSmartyView_class_path', 'Smarty');
            if (substr($smartyClassPath, -1) != '/') {
                $smartyClassPath .= '/';
            }
            require_once($smartyClassPath . 'Smarty.class.php');
            self::$smarty = new Smarty();
            $smartyDirs = sfConfig::get('app_sfSmartyView_cache_dir' , sfConfig::get('sf_cache_dir') . DIRECTORY_SEPARATOR . 'Smarty');
            if (substr($smartyDirs, -1) != '/') {
                $smartyDirs .= DIRECTORY_SEPARATOR;
            }
            self::$smarty->compile_dir = $smartyDirs . 'templates_c';
            self::$smarty->cache_dir = $smartyDirs . 'cache';
            self::$templateSecurity = sfConfig::get('app_sfSmartyView_template_security', false);
            self::$smarty->security = self::$templateSecurity;
            self::$log = sfConfig::get('sf_logging_enabled')? $this->getContext()->getLogger() : false;
            if (!file_exists(self::$smarty->compile_dir)) {
                if (!mkdir(self::$smarty->compile_dir, 0777, true)) {
                    throw new sfCacheException('Unable to create cache directory "' . self::$smarty->compile_dir . '"');
                }
                if (self::$log) self::$log->info('{sfSmartyView} creating compile directory: ' . self::$smarty->compile_dir);
            }
            if (!file_exists(self::$smarty->cache_dir)) {
                if (!mkdir(self::$smarty->cache_dir, 0777, true)) {
                    throw new sfCacheException('Unable to create cache directory "' . self::$smarty->cache_dir . '"');
                }
                if (self::$log) self::$log->info('{sfSmartyView} creating compile directory: ' . self::$smarty->cache_dir);
            }
            self::$smarty->register_compiler_function('use', array($this, 'smartyCompilerfunctionUse'));
            self::$smarty->register_postfilter(array('sfSmartyView', 'smartyPostFilter'));

            self::$cache = new sfSmartyCache(sfConfig::get('sf_cache_dir'));
        }
        if (self::$log) self::$log->info('{sfSmartyView} is used for rendering');
        return true;
    }

    public function getEngine()
    {
        return self::$smarty;
    }

    /**
     * sfSmartyView::renderFile()
     * this method is unsed instead of sfPHPView::renderFile()
     *
     * @param mixed $file
     * @return
	 * @access protected
     **/
    protected function renderFile($file)
    {
        self::$smarty->compile_id = $this->getContext()->getModuleName();
        self::$usedHelpers = array();
        $this->setTemplate($file);
        if (self::$log) self::$log->info('{sfSmartyView} renderFile ' . $file);
        $this->loadCoreAndStandardHelpers();
        self::$smarty->clear_all_assign();
        $_escaping = $this->getEscaping();
        if ($_escaping === false) {
            self::$smarty->assign($this->getAttributeHolder()->getAll());
        } elseif ($_escaping == 'both') {
            $sf_data = sfOutputEscaper::escape($this->getEscapingMethod(), $this->getAttributeHolder()->getAll());
            $sf_data['sf_data'] = $sf_data;
            $sf_config = sfOutputEscaper::escape($this->getEscapingMethod(), sfConfig::getAll());
            $sf_data['sf_config'] = $sf_config;
            self::$smarty->assign($sf_data);
        } else {
            $sf_data = sfOutputEscaper::escape($this->getEscapingMethod(), $this->getAttributeHolder()->getAll());
            $sf_config = sfOutputEscaper::escape($this->getEscapingMethod(), sfConfig::getAll());
            $this->getAttributeHolder()->add(array('sf_data' => $sf_data, 'sf_config' => $sf_config));
            self::$smarty->assign($this->getAttributeHolder()->getAll());
        }
        $er = error_reporting();
        if ($er > E_STRICT) {
            error_reporting($er - E_STRICT);
        }
        $result = self::$smarty->fetch("file:$file");
        error_reporting($er);
        return $result;
    }

    /**
     * sfSmartyView::loadCoreAndStandardHelpers()
     *
     * @return
	 * @access protected
     **/
    protected function loadCoreAndStandardHelpers()
    {
        $core_helpers = array('Helper', 'Url', 'Asset', 'Tag', 'Escaping');
        $standard_helpers = sfConfig::get('sf_standard_helpers');
        $helpers = array_unique(array_merge($core_helpers, $standard_helpers));
        foreach ($helpers as $helperName) {
            $this->loadHelper($helperName);
        }
    }

    /**
     * sfSmartyView::loadHelper()
     *
     * @param mixed $helperName
     * @return
	 * @access protected
     **/
    protected function loadHelper($helperName)
    {
        static $dirs;
        self::$usedHelpers[$helperName] = true;
        if (isset(self::$loadedHelpers[$helperName])) {
            return;
        }
        if (!self::$cache->has($helperName, self::CACHENAMESPACE)) {
            if (!is_array($dirs)) {
                $dirs = sfLoader::getHelperDirs(/*$moduleName*/);
                $dirs = array_merge($dirs, explode(PATH_SEPARATOR, ini_get('include_path')));
                $dirs = array_merge($dirs, array(dirname(__FILE__) . '/helper'));
            }
            $fileName = $helperName . 'Helper.php';
            $path = '';
            foreach($dirs as $dir) {
                if (is_readable($dir . '/' . $fileName)) {
                    $path = $dir . '/' . $fileName;
                    self::$cache->set($helperName, self::CACHENAMESPACE, $this->parseFile($path));
                    break;
                }
            }
        }
        include (self::$cache->getFile($helperName, self::CACHENAMESPACE));
        try {
            sfLoader::loadHelpers(array($helperName, 'Smarty' . $helperName));
        }
        catch (sfViewException $e) {
            if (!strpos($e->getMessage(), 'Smarty' . $helperName)) {
                throw $e;
            }
        }
        self::$loadedHelpers[$helperName] = true;
    }

    /**
     * sfSmartyView::parseFile()
     *
     * @param mixed $path
     * @return
     **/
    protected function parseFile($path)
    {
        if (self::$log) self::$log->info('{sfSmartyView} parsing file: ' . $path . ' into the Smarty helper cache');
        $code = '<?php ';
        $lines = file($path);
        foreach($lines as $line) {
            $line = trim($line);
            if (strpos($line, 'function') === 0) {
                preg_match('/function\\s+(\\w+)\\s*\\((.*)\\)\\s*\\{?$/', $line, $matches);
                $name = $matches[1];
                if ($name{0} == '_') {
                    continue;
                }
                $code .= "\nself::\$knownFunctions['$name']=";
                if ($matches[2]) {
                    $code .= var_export(self::parseArguments($matches[2]), true);
                } else {
                    $code .= 'array()';
                }
                $code .= ";\nself::\$smarty->register_compiler_function('$name', array(\$this, '{$name}_CompilerFunction'));";
            }
        }
        return $code;
    }

    /**
     * sfSmartyView::parseArguments()
     *
     * @param mixed $argumentString
     * @param boolean $smarty
     * @return
     **/
    protected static function parseArguments($argumentString, $smarty = false)
    {
        $argumentString .= $smarty?' ' : ',';
        $inDoubleQuotes = false;
        $inSingleQuotes = false;
        $args = array();
        $argumentName = '';
        $defaultValue = '';
        $parsingDefaultValue = false;
        $inArray = 0;
        for ($i = 0; $i < strlen($argumentString); $i++) {
            $letter = $argumentString{$i};
            if (!$smarty && !$inDoubleQuotes && !$inSingleQuotes && ($letter == ' ' || $letter == '	')) {
                continue;
            }
            if (!$parsingDefaultValue) {
                if (preg_match('/\\w/', $letter) || $letter == '$' || $letter == '>') {
                    $argumentName .= $letter;
                } elseif ($letter == '=') {
                    $parsingDefaultValue = true;
                } elseif ((!$smarty && $letter == ',') || ($letter == ' ' || $letter == '	')) {
                    $args[$argumentName] = array();
                    $argumentName = '';
                } elseif ($letter == '&') {
                } else {
                    print_r($args);
                    die("$inDoubleQuotes/$inSingleQuotes/$argumentName/$defaultValue/$parsingDefaultValue/'$letter'\n$argumentString\nI wonder...");
                }
            } else {
                switch ($letter) {
                    case '(':
                        if (!$inSingleQuotes && !$inDoubleQuotes) {
                            $inArray++;
                            if (self::$templateSecurity && strcasecmp(substr($defaultValue, -5), 'array')) {
                                throw new Exception('sfSmartyView: You may not use PHP functions in a template! "' . $defaultValue . '"');
                            }
                        }
                        $defaultValue .= $letter;
                        break;
                    case ')':
                        if (!$inSingleQuotes && !$inDoubleQuotes) {
                            $inArray--;
                        }
                        $defaultValue .= $letter;
                        break;
                    case ',':
                        if ($inSingleQuotes || $inDoubleQuotes || $inArray) {
                            $defaultValue .= $letter;
                        } elseif (!$smarty) {
                            $parsingDefaultValue = false;
                            $args[$argumentName] = array('default' => $defaultValue);
                            $argumentName = '';
                            $defaultValue = '';
                        }
                        break;
                    case '"':
                        if (!$inSingleQuotes) {
                            $inDoubleQuotes ^= true;
                        }
                        $defaultValue .= $letter;
                        break;
                    case "'":
                        if (!$inDoubleQuotes) {
                            $inSingleQuotes ^= true;
                        }
                        $defaultValue .= $letter;
                        break;
                    case ' ':
                    case '	':
                        if (!($inSingleQuotes || $inDoubleQuotes || $inArray)) {
                            $parsingDefaultValue = false;
                            $args[$argumentName] = preg_replace('/\\$(\\w+)/', '$this->_tpl_vars[\'$1\']', $defaultValue);
                            $argumentName = '';
                            $defaultValue = '';
                        } else {
                            $defaultValue .= $letter;
                        }
                        break;
                    default:
                        $defaultValue .= $letter;
                } // switch
            }
        }
        if (isset($args[''])) {
            unset($args['']);
        }
        return $args;
    }

    /**
     * sfSmartyView::smartyCompilerfunctionUse()
     * this provides the use tag in smarty: {use helper="path"}
     *
     * @param mixed $content
     * @param Smarty $smarty
     * @return
     **/
    public function smartyCompilerfunctionUse($content, Smarty $smarty)
    {
        if (!preg_match('/helper="([^"]+)"/', $content, $matches)) {
            throw new Exception('sfSmartyView: Cannot compile template. Use: {use helper="helpername"}');
        }
        $this->loadHelper($matches[1]);
        return '';
    }

    /**
     * sfSmartyView::smartyPostFilter()
     *
     * @param mixed $content
     * @param Smarty $smarty
     * @return
     **/
    public static function smartyPostFilter($content, Smarty $smarty)
    {
        $helpers = '';
        foreach(self::$loadedHelpers as $helper => $dummy) {
            $helpers .= "use_helper('$helper');";
        }
        if ($helpers) {
            $helpers = "<?php $helpers ?>";
        }
        return $helpers . $content;
    }

    /**
     * sfSmartyView::__call()
     * generic compiler function for all new tags
     *
     * @param mixed $functionName
     * @param mixed $argsArray
     * @return
     **/
    public function __call($functionName, $argsArray)
    {
        if (!trim($argsArray[0])) {
            $args = array();
        } else {
            $args = $this->parseArguments($argsArray[0], true);
        }
        $functionName = str_replace('_CompilerFunction', '', $functionName);
        $argsOrder = $allArgs = self::$knownFunctions[$functionName];
        $helperWithVarArgs = count($allArgs) == 0;
        $cacheArgs = array();
        foreach($args as $name => $value) {
            $name = '$' . trim($name);
            $value = trim($value);
            if (!isset($allArgs[$name]) && !$helperWithVarArgs) {
                throw new Exception('sfSmartyView: Cannot compile template. Unknown field found: "' . substr($name, 1) . '" near tag ' . $functionName);
            }
            $cacheArgs[$name] = $value;
            unset($allArgs[$name]);
        }
        foreach($allArgs as $name => $default) {
            if (!isset($default['default'])) {
                throw new Exception('sfSmartyView: Cannot compile template. Required field "' . substr($name, 1) . '" not found near tag ' . $functionName);
            }
            $cacheArgs[$name] = $default['default'];
        }
        $code = '';
        if (!$helperWithVarArgs) {
            foreach($argsOrder as $name => $value) {
                $code .= $code?',':'';
                if (is_bool($value)) {
                    $code .= $cacheArgs[$name]?'true':'false';
                } else {
                    $code .= $cacheArgs[$name];
                }
            }
        } else {
            foreach($cacheArgs as $name => $value) {
                $code .= $code?',':'';
                if (is_bool($value)) {
                    $code .= $value?'true':'false';
                } else {
                    $code .= $value;
                }
            }
        }
        $code = "echo $functionName($code);\n";
        return $code;
    }

    /**
     * sfSmartyView::registerBlock()
     * this is an access function to the internal smarty instance
     * to register a block function
     *
     * @param mixed $tag
     * @param mixed $function
     * @return
     **/
    public static function registerBlock($tag, $function)
    {
        self::$smarty->register_block($tag, $function);
    }

    /**
     * sfSmartyView::registerFunction()
     * this is an access function to the internal smarty instance
     * to register a function
     *
     * @param mixed $tag
     * @param mixed $function
     * @return
     **/
    public static function registerFunction($tag, $function)
    {
        self::$smarty->register_function($tag, $function);
    }

    /**
     * sfSmartyView::registerModifier()
     * this is an access function to the internal smarty instance
     * to register a modifier
     *
     * @param mixed $tag
     * @param mixed $function
     * @return
     **/
    public static function registerModifier($tag, $function)
    {
        self::$smarty->register_modifier($tag, $function);
    }
}

class sfSmartyCache extends sfFileCache {
    public function getFile($id, $namespace = null)
    {
        return implode('', $this->getFileName($id, $namespace));
    }
}

?>