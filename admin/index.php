<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
ob_start(); 
session_start(); 
include("admin_header.php");

if (checkLoggedin()){
$ver_string = @file_get_contents("http://phpdirector.co.uk/version.xml");
$info_start = explode("<info>",$info_string,2);
$info_end = explode("</info>",$info_start[1],2);
$info = addslashes($info_end[0]); //Gets info from phpdirector.co.uk
$ver_start = explode("<version>",$ver_string,2);
$ver_end = explode("</version>",$ver_start[1],2);
$ver1 = addslashes($ver_end[0]);//Gets version from phpdirector.co.uk

$ver = config("version");  //Gets version from sql


//Gets ammont of videos to approve

$result_approve = mysql_query("SELECT * FROM pp_files WHERE approved='0' AND reject='0'");
//end of count

$smarty->assign('approves', mysql_num_rows($result_approve));
$smarty->assign('version', $ver);
$smarty->assign('up2date', $ver1);
$smarty->assign('info', $info);
    $smarty->display('index.tpl');
	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>
