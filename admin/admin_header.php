<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
session_start();
setcookie("admin", "login", time()+3600);
require('../libs/Smarty.class.php');
require('../libs/SmartyPaginate.class.php');
include("../db.php");
include("../includes/function.inc.php");
require_once ("includes/login_functions.inc.php"); 
$smarty = new Smarty();
$smarty->template_dir = '../templates/Photine/admin';
$smarty->compile_dir = '../templates_c/admin';
$smarty->cache_dir = '../cache';
$smarty->config_dir = '../configs';

$cnf_name = config('name');
$smarty->assign('config_name', $cnf_name);
$smarty->assign('pagetype', $_GET["pt"]);
$smarty->assign('pag', $_GET["pag"]);
include("../lang/".config('lang').".inc.php");
?>
