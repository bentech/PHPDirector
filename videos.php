<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/

$id = $_GET["id"];
//add a new view?
if(!isset($_COOKIE[$id])){
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
$viewaddone = true;
}

require('header.php');
if(isset($id)){

//get the video from the id

$result = mysql_query(" SELECT * FROM `pp_files` WHERE `id` = CONVERT( _utf8 '$id' USING latin1 ) COLLATE latin1_swedish_ci LIMIT 0 , 1");  
}elseif (isset($_GET["name"])){

//this is so you can use videos.php?name=ben ect
$name = $_GET["name"];
$result = mysql_query("SELECT * FROM pp_files WHERE `approved` = '1' AND `name` = '$name' LIMIT 1") or die();  

}else{

//if no video is specified it uses a random one
$result = mysql_query("select * from pp_files WHERE approved='1' AND reject='0' order by rand() LIMIT 1") or die();  
}
// For each result that we got from the Database
while ($row = mysql_fetch_array($result)){
 $video[] = $row;

 	if($viewaddone == true){
		$new_views = $row["views"] + 1;
		mysql_query("UPDATE pp_files SET views = '$new_views' WHERE id = '$id'");
	}
$play = true;
$videoid = $row['file'];
include("processes/process_".strtolower($row['video_type']).".inc.php");	
$smarty->assign('player_code', $player_code);

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