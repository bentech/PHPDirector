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
ob_start();  //Standard Admin Only
session_start(); 
include("admin_header.php");
if (checkLoggedin()){
	
//Enable Or Disable
if(isset($_GET[enable])){

mysql_query("UPDATE `pp_sources` SET `disable` = '0' WHERE `pp_sources`.`id` ='$_GET[enable]'");
}


if(isset($_GET[disable])){

mysql_query("UPDATE `pp_sources` SET `disable` = '1' WHERE `pp_sources`.`id` ='$_GET[disable]'");
}


//Gets sources info to smarty (source)
$result = mysql_query("SELECT * FROM pp_sources");

while ($row = mysql_fetch_assoc($result)){
	$source[] = $row;
}

$smarty->assign('source', $source);
$smarty->display('sources.tpl');

	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>
