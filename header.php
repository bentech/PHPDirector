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
    define('PHPDIRECTOR_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
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

// Begin session. This is especially useful for user data and Smarty pagination
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

if(isset($_POST["comment"])){
header("location: videos.php?id=" . $_GET["id"] . "");
$ip = $_SERVER["REMOTE_ADDR"];
mysql_query("INSERT INTO pp_comments (video_id, ip, comment) VALUES ('$_GET[id]', '$ip', '$_POST[comment]')");
}
$template = config($registry, 'template');
$smarty = new Smarty();
$smarty->template_dir = './templates/'.$template;
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';

include(PHPDIRECTOR_ROOT . 'lang/' . config($registry, 'lang'));

$sort1 = $_GET['sort'];
$page = $_GET['page'];
$pagetype = $_GET["pt"];
$smarty->assign('pagetype', $pagetype);
$smarty->assign('next', $_GET["next"]);
$cnf_name = config($registry, 'name');
$smarty->assign('config_name', $cnf_name);

//NEWS//
$news = config($registry, 'news');
$smarty->assign('news', $news);
//NEWS//

//Firefox?
$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
if (!(strpos($HTTP_USER_AGENT,'Mozilla/5') === false)) {
$smarty->assign('firefox', '1');
} else {
$smarty->assign('firefox', '0');
}
//Firefox? END
?>