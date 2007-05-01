<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
|		$author: Ben Swanson
+----------------------------------------------------------------------------+
*/
include("admin_header.php");

if(isset($_GET["del"])){

mysql_query("UPDATE `pp_categories` SET `disable` = '1' WHERE `pp_categories`.`id` ='$_GET[del]'");
}

if(isset($_POST["add"])){
$add = $_POST["add"]; //Checks if cat allready exists
$result1 = mysql_query("SELECT * FROM pp_categories WHERE name='$add'");
$row1 = mysql_fetch_array($result1);

 if($row1["name"] == $_POST["add"]){ //Check if allready exists
 $result2 = mysql_query("SELECT * FROM `pp_categories` WHERE name='$add' AND disable='0'");
$row2 = mysql_fetch_array($result2); 
echo $row2["name"];		

		if($row2["name"] == $_POST["add"]){//if exists check if it jas been disabled
		$smarty->assign('error', 'This Category Allready Exists'); //if not disabled error message
		}else{
		mysql_query("UPDATE `pp_categories` SET `disable` = '0' WHERE `pp_categories`.`name` = \'$add\'"); //if it was disabled undisable it
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

mysql_close($mysql_link);
?>
