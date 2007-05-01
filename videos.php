<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/

$id = $_GET["id"];

if(!isset($_COOKIE[$id])){
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
$viewaddone = true;
}

require('header.php');

if(isset($id)){
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();  
}else{
$result = mysql_query("select * from pp_files WHERE approved='1' AND reject='0' order by rand() limit 1") or die();  
}
// For each result that we got from the Database
while ($row = mysql_fetch_assoc($result))
{
 $video[] = $row;

 	if($viewaddone == true){
		$new_views = $row["views"] + 1;
		mysql_query("UPDATE pp_files SET views = '$new_views' WHERE id = '$id'");
	}

$smarty->assign('vidtype', $row['video_type']);

if( $row['video_type'] == "dailymotion"){
$dmid = dmgetfile($row['file']);
$smarty->assign('dmid', $dmid);
}
}

// Assign this array to smarty

$smarty->assign('video', $video);
$smarty->assign('id', $row['id']);


if(isset($_GET["pop"])){
$smarty->display('viewvidpop.tpl');
}else{
$smarty->display('viewvid.tpl');
}

mysql_close($mysql_link);
?>