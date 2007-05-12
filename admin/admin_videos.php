<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
ob_start(); 
session_start(); 

include("admin_header.php");
if (checkLoggedin()){
include("includes/admin_videos_functions.php");
$result1 = array();
$i=0;

if ($_GET['pt'] == "easyapprove"){
// Get a specific result from the "pp_files" table


$result = mysql_query("SELECT * FROM `pp_files` WHERE `approved` = CONVERT( _utf8 '0' USING latin1 )COLLATE latin1_swedish_ci AND `reject` = CONVERT( _utf8 '0'
USING latin1 ) COLLATE latin1_swedish_ci LIMIT 0 , 1") or die();  
}else{
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();
 }

// get the first (and hopefully only) entry from the result



while ($row = mysql_fetch_array($result)) {
	$video[] = $row;
	
$smarty->assign('id', $row['id']);
$smarty->assign('vidtype', $row['video_type']);
	
	//PICTURE
		if($row["video_type"] == "YouTube"){
			$yt_pic_broken = explode("/", show_sql($row['picture']));
			$yt_pic_final = $yt_pic_broken[5];
		if ($yt_pic_final = "2.jpg"){
			$yt_pic_getstart = explode("2.jpg", show_sql($row['picture']));
			$ytpic = $yt_pic_getstart[0];
	}	
	}
	}
	
$smarty->assign('ytpic', $ytpic);
$smarty->assign('pt', $_GET['pt']);
$smarty->assign('video', $video);
$smarty->assign('page', $page);

$smarty->display('admin_videos.tpl');

	}else{
header("location: login.php");
}
mysql_close($mysql_link);
?>
