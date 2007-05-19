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

include("lang/".config('lang'));

$sort1 = $_GET['sort'];
$page = $_GET['page'];
$pagetype = $_GET["pt"];
$smarty->assign('pagetype', $pagetype);
$smarty->assign('next', $_GET["next"]);
$cnf_name = config('name');
$smarty->assign('config_name', $cnf_name);

//NEWS//
$news = config('news');
$smarty->assign('news', $news);
//NEWS//

//Firefox?
$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
if (!(strpos($HTTP_USER_AGENT,'Mozilla/5') === false)) {
$smarty->assign('firefox', '1');
} else {
$smarty->assign('firefox', '0');
}
//Firefox? END
?>