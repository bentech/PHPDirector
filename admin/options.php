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
if(isset($_POST["options"])){
mysql_query("UPDATE pp_config SET name = '$_POST[name]'");
mysql_query("UPDATE pp_config SET news = '$_POST[news]'");
mysql_query("UPDATE pp_config SET vids_per_page = '$_POST[vids_per_page]'");
mysql_query("UPDATE pp_config SET cssstyle = '$_POST[cssstyle]'");
mysql_query("UPDATE pp_config SET lang = '$_POST[lang]'");
mysql_query("UPDATE pp_config SET template = '$_POST[template]'");
}
$result = mysql_query("SELECT * FROM pp_config");

while ($row = mysql_fetch_assoc($result)){
	$options[] = $row;
}
$smarty->assign('options', $options);


//Gets Languages
if ($handle = opendir('../lang')) {
  while (false !== ($lang = readdir($handle)))
  {
   if ($lang != "." && $lang != ".." && $lang != "index.html"
     && $lang != ".svn")
     $smarty->assign('lang', $lang);
  }
  closedir($handle);
}

////Gets Languages

$smarty->display('options.tpl');
	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>