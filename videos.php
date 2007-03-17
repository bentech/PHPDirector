<?php
define("PHPdirector", 1);
require('libs/Smarty.class.php');
include("includes/check_install.inc.php");
include("db.php");
include("includes/function.inc.php");
$smarty = new Smarty();
$smarty->template_dir = './templates/Photine';
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';
include("lang/".config('lang')."/lang.inc.php");

if(isset($_GET["id"])){
$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
}



if(isset($_GET["id"])){
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();  
}else{
$result = mysql_query("select * from pp_files WHERE approved='1' AND reject='0' order by rand() limit 1") or die();  
}


// For each result that we got from the Database
while ($row = mysql_fetch_assoc($result))
{
 $video[] = $row;
$smarty->assign('vidtype', $row['video_type']);

if( $row['video_type'] == "dailymotion"){
$dmid = dmgetfile($row['file']);
$smarty->assign('dmid', $dmid);
}
}

// Assign this array to smarty

$smarty->assign('video', $video);


if(!isset($_COOKIE["$id"])){
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views' WHERE id = '$id'");
}


require('_drawrating.php');
$smarty->display('viewvid.tpl');

?>