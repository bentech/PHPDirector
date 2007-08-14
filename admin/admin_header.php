<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko, Monte Ohrt (Monte Ohrt), Theodore Ni
+----------------------------------------------------------------------------+
*/

// Find file root and set as contant
if (!defined('PHPDIRECTOR_ROOT')) {
    define('PHPDIRECTOR_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
}

// Very useful utility function for maximum compatability across servers. Include this in all headers that
// follow this format
function _parsePath($path) {
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
}

// Redirect user to install page if not installed. We will check for the presence
// of the install file. If it is there, PHPDirector has not been installed.
$install_file = _parsePath(PHPDIRECTOR_ROOT . 'install/index.php');
if (file_exists($install_file)) {
    header('Location: ' . $install_file);
    exit;
} define('PHPDIRECTOR_INSTALLED', 1);

// Include necessary files
require_once(_parsePath(PHPDIRECTOR_ROOT . 'includes/Registry.php'));              // registry
require_once(_parsePath(PHPDIRECTOR_ROOT . 'libs/Smarty.class.php'));              // base Smarty engine
require_once(_parsePath(PHPDIRECTOR_ROOT . 'libs/SmartyPaginate.class.php'));      // Smarty pagination add-on
require_once(_parsePath(PHPDIRECTOR_ROOT . 'includes/db.php'));                    // database information and functions
require_once(_parsePath(PHPDIRECTOR_ROOT . 'includes/functions.php'));             // misc. functions
require_once('functions.php');                                                     // admin functions

// Begin our session. We do this after including all our files just in case we have
// an object that we need to unserialize (e.g. Registry)
session_start();

// Retrieve our registry if it already exists. If not, create one, then attach it to the session
// so that it is persistent for the whole session.
if (isset($_SESSION['registry'])) {
    $registry = &$_SESSION['registry'];
} else {
    $registry = &new Registry();
    $_SESSION['registry'] = &$registry;
}

// Create our database connection
require_once(_parsePath(PHPDIRECTOR_ROOT . 'config.php'));
$registry->set('dbhost', $cfg['db_host']);
$registry->set('dbuser', $cfg['db_user']);
$registry->set('dbpass', $cfg['db_pass']);
$registry->set('dbname', $cfg['db_name']);
$registry->set('db', dbConnect($registry));

// If we do not have our configuration variables, create them and store them in the registry. After,
// all our config variables will be stored in an associative array as 'config' in the registry.
if (!$registry->has('config')) {
    loadConfig($registry);
}

$template = config($registry, 'template');
$cnf_name = config($registry, 'name');

/**
 * Smarty admin template directories
 */
define('SMARTY_TEMPLATE_DIR' , '../templates/' . $template . '/admin');
define('SMARTY_COMPILE_DIR'  , '../templates_c/admin');
define('SMARTY_CACHE_DIR'    , '../cache');
define('SMARTY_CONFIG_DIR'   , '../configs');

// Create a new Smarty object and set its basic parameters
$smarty = new Smarty();
    $smarty->template_dir = SMARTY_TEMPLATE_DIR;
    $smarty->compile_dir  = SMARTY_COMPILE_DIR;
    $smarty->cache_dir    = SMARTY_CACHE_DIR;
    $smarty->config_dir   = SMARTY_CONFIG_DIR;

$smarty->assign('config_name', $cnf_name);
$smarty->assign('pagetype', $_GET["pt"]);
$smarty->assign('pag', $_GET["pag"]);
include(PHPDIRECTOR_ROOT . 'lang/' . config($registry, 'lang'));

?>