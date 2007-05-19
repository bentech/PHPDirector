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
$query = "SELECT * FROM pp_files WHERE approved='1' AND reject='0' ORDER BY RAND()";
$query_count = mysql_query($query);
$totalrows = mysql_num_rows($query_count);
$result = mysql_query($query);
if (!$result)die(mysql_error()); //If no results end


if($totalrows == 0){  //if no videos display error.
	$error = $smarty->get_template_vars('LAN_29');
	$smarty->assign_by_ref('error', $error);
	$smarty->display('error.tpl');
	exit;
}


while ($row = mysql_fetch_assoc($result)){
	$images[] = $row;
}
$smarty->assign('images', $images);
$smarty->display('images.tpl');

mysql_close($mysql_link);
?>