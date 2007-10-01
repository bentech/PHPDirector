<?php

/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko and Monte Ohrt (Monte Ohrt)
+----------------------------------------------------------------------------+
*/

session_start();
require_once('../libs/Smarty.class.php');
require_once('../libs/SmartyPaginate.class.php');
include_once("../db.php");
include_once("../includes/function.inc.php");
require_once("functions.php");

$template = config('template');
$cnf_name = config('name');

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
?>