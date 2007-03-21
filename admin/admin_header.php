<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
	setcookie("admin", "login", time()+3600);
if (isset($_POST['txtUserId']) && ($_POST['txtPassword'])){
    header("location: index.php");
}
define("PHPdirector", 1);
require('../libs/Smarty.class.php');
include("../db.php");
include("../includes/function.inc.php");
$smarty = new Smarty();
$smarty->template_dir = '../templates/Photine/admin';
$smarty->compile_dir = '../templates_c';
$smarty->cache_dir = '../cache';
$smarty->config_dir = '../configs';



if ($_POST['txtUserId'] == $cfg["admin_user"] && $_POST['txtPassword'] == $cfg["admin_pass"]){
	$errorMessage = '';
}else{
	if (isset($_POST['txtUserId']) && ($_POST['txtPassword'])){
        $errorMessage = 'Sorry, wrong username / password';
	}
}
$cnf_name = config('name');
$smarty->assign('config_name', $cnf_name);
include("../lang/".config('lang')."/lang.inc.php");
?>