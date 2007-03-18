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


//NEWS//
$news = config('news');
$smarty->assign('news', $news);
//NEWS//
?>