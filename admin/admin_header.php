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
require('../libs/Smarty.class.php');
require('../libs/SmartyPaginate.class.php');
include("../db.php");
include("../includes/function.inc.php");
require_once ("functions.php"); 
$smarty = new Smarty();
$smarty->template_dir = '../templates/Photine/admin';
$smarty->compile_dir = '../templates_c/admin';
$smarty->cache_dir = '../cache';
$smarty->config_dir = '../configs';

$cnf_name = config('name');
$smarty->assign('config_name', $cnf_name);
$smarty->assign('pagetype', $_GET["pt"]);
$smarty->assign('pag', $_GET["pag"]);
include("../lang/".config('lang'));
?>