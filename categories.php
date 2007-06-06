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
require("header.php");


$query_categories = mysql_query("SELECT * FROM pp_categories WHERE disable='0'");


if(mysql_num_rows($query_categories) == 0){  //if no categories display error.
	$error = $smarty->get_template_vars('LAN_29');
	$smarty->assign_by_ref('error', $error);
	$smarty->display('error.tpl');
	exit;
}

$result = array();
$i=0;
while ($row_cat = mysql_fetch_array($query_categories)) {
$cat_id = $row_cat['id'];
//gets info from first media file
if ($row_cat['image'] == null){
$query_files = mysql_query("SELECT * FROM pp_files WHERE category = $cat_id AND approved = '1'");
$row_file = mysql_fetch_array($query_files);
$picture = $row_file['picture'];
}else{
$picture = $row_cat['image'];
}
	$tmp = array(
'id' => $row_cat['id'], 
'name' => $row_cat['name'],
'picture' => $picture
);
$result[$i++] = $tmp;
}

$smarty->assign('cat', $result);
$smarty->display('category.tpl');


mysql_close($mysql_link);
?>