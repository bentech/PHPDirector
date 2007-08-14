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
include("admin_header.php");
if (checkLoggedin()){
if(isset($_GET["del"])){

mysql_query("UPDATE `pp_categories` SET `disable` = '1' WHERE `pp_categories`.`id` ='$_GET[del]'");
}
if(isset($_POST[image])){
mysql_query("UPDATE `pp_categories` SET `image` = '$_POST[image]' WHERE `id` ='$_POST[imageid]'");
}

if(isset($_POST["add"])){
$add = strtolower($_POST["add"]); //Checks if cat allready exists
$result1 = mysql_query("SELECT * FROM pp_categories WHERE name='$add'");
$row1 = mysql_fetch_array($result1);

 if($row1["name"] == $add){ //Check if allready exists
 $result2 = mysql_query("SELECT * FROM `pp_categories` WHERE name='$add' AND disable='1'");
$row2 = mysql_fetch_array($result2);
		if($row2["name"] == $add){//if exists check if it jas been disabled
		mysql_query("UPDATE `pp_categories` SET `disable` = '0' WHERE name = '$add'"); //if it was disabled undisable it
		}else{
		$smarty->assign('error', 'This Category Allready Exists'); //if not disabled error message
	}


}else{//end of check exists
mysql_query("INSERT INTO pp_categories (name) VALUES ('$_POST[add]')"); ///if it doesnt exists create new record
}
}

$result = mysql_query("SELECT * FROM pp_categories WHERE `disable` = '0'");

while ($row = mysql_fetch_assoc($result)){
	$cat[] = $row;
}

$smarty->assign('cat', $cat);
$smarty->display('categories.tpl');

	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>
