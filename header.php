<?php
define("PHPdirector", 1);
$filename = "installed.php";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
if($contents == "<?phpNo?>"){
	header("location: install/index.php");
}
require('libs/Smarty.class.php');
require('libs/SmartyPaginate.class.php');
include("db.php");
if(isset($_POST["comment"])){
header("location: videos.php?id=" . $_GET["id"] . "");
$ip = $_SERVER["REMOTE_ADDR"];
mysql_query("INSERT INTO pp_comments (video_id, ip, comment) VALUES ('$_GET[id]', '$ip', '$_POST[comment]')");
}
include("includes/function.inc.php");
$smarty = new Smarty();
$smarty->template_dir = './templates/Photine';
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';

include("lang/".config('lang').".inc.php");

$sort1 = $_GET['sort'];
$page = $_GET['page'];
$pagetype = $_GET["pt"];
$smarty->assign('pagetype', $pagetype);

//NEWS//
$news = config('news');
$smarty->assign('news', $news);
//NEWS//

?>