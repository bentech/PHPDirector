<?php
define("PHPdirector", 1);
define("submtitab", 1);
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

$result = mysql_query("SELECT * FROM pp_catigories") or die("Error: " . mysql_error());

// For each result that we got from the Database

//main video list
$result1 = array();
$i=0;
while ($row = mysql_fetch_array($result)) {
 
            $tmp = array('name'=> $row['name']);
            
            
            $result1[$i++] = $tmp;
}
//pass the results to the template
$smarty->assign('catigories', $result1);

//Display Images page
$smarty->display('submit.tpl');
?>