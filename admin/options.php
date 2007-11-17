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
ob_start(); 
session_start(); 
include("admin_header.php");
if (checkLoggedin()){
if(isset($_POST["options"])){
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[name]' WHERE `name`= 'name' LIMIT 1 ;");
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[news]' WHERE `name`= 'news' LIMIT 1 ;");
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[vids_per_page]' WHERE `name`= 'vids_per_page' LIMIT 1 ;");
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[template]' WHERE `name`= 'template' LIMIT 1 ;");
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[slogan]' WHERE `name`= 'slogan' LIMIT 1 ;");
mysql_query("UPDATE `pp_config` SET `content` = '$_POST[image]' WHERE `name`= 'image' LIMIT 1 ;");
}
$result = mysql_query("SELECT * FROM pp_config");

while ($row = mysql_fetch_assoc($result)){
	$smarty->assign($row[name], $row[content]);
}

$smarty->display('options.tpl');
	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>