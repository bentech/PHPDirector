<?php
require("header.php");
$query_count = mysql_query("SELECT * FROM pp_files WHERE approved='1' AND reject='0'");
$query = "SELECT * FROM pp_files WHERE approved='1' AND reject='0'";
$totalrows = mysql_num_rows($query_count);
$result = mysql_query($query);
if (!$result)
	die(mysql_error());
if(mysql_num_rows($query_count) == 0){
	$smarty->assign('error', $LAN_29);
}
if(mysql_num_rows == false){
	$smarty->assign('error', $LAN_29);
}
while ($row = mysql_fetch_assoc($result)){
	$images[] = $row;
}
$smarty->assign('images', $images);
$smarty->display('images.tpl');
?>