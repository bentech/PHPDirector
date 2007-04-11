<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
include("admin_header.php");

if(isset($_GET["del"])){
mysql_query("DELETE FROM pp_categories WHERE name='$_GET[del]'");
}

if(isset($_POST["add"])){
$add = $_POST["add"]; //Checks if cat allready exists
$result1 = mysql_query("SELECT * FROM pp_categories WHERE name='$add'");
$row1 = mysql_fetch_array($result1);
 if($row1["name"] == $_POST["add"]){
$smarty->assign('error', 'This Category Allready Exists');
}else{//end of check exists
mysql_query("INSERT INTO pp_categories (name) VALUES ('$_POST[add]')");
}
}

$result = mysql_query("SELECT * FROM pp_categories");

while ($row = mysql_fetch_assoc($result)){
	$cat[] = $row;
}

$smarty->assign('cat', $cat);
$smarty->display('categories.tpl');
?>