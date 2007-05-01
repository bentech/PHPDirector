<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/

include("admin_header.php");
if(isset($_POST["options"])){
mysql_query("UPDATE pp_config SET name = '$_POST[name]'");
mysql_query("UPDATE pp_config SET news = '$_POST[news]'");
mysql_query("UPDATE pp_config SET vids_per_page = '$_POST[vids_per_page]'");
mysql_query("UPDATE pp_config SET cssstyle = '$_POST[cssstyle]'");
mysql_query("UPDATE pp_config SET lang = '$_POST[lang]'");
}
$result = mysql_query("SELECT * FROM pp_config");

while ($row = mysql_fetch_assoc($result)){
	$options[] = $row;
}
$smarty->assign('options', $options);
$smarty->display('options.tpl');
mysql_close($mysql_link);
?>