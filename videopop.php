<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);

if(!isset($_COOKIE["$id"])){ 
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
include("header.php");
 
$id = $_GET["id"];
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();  
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

$smarty->display('viewvidpop.tpl');
?>