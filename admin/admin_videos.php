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

require_once 'admin_header.php';
require_once 'functions.php';

if ( !checkLoggedin() ) {
    header('Location: login.php');
    exit;
}

include("includes/admin_videos_functions.php");
$result1 = array();
$i=0;

if ($_POST[category] !== null){  //Category Change

$sql = 'UPDATE `pp_files` SET `category` = '.$_POST[category].' WHERE `pp_files`.`id` = '.$_POST[id].' LIMIT 1;';
mysql_query($sql) or die();
}



if ($_GET['pt'] == "easyapprove"){
// Get a specific result from the "pp_files" table


$result = mysql_query("SELECT * FROM `pp_files` WHERE `approved` = CONVERT( _utf8 '0' USING latin1 )COLLATE latin1_swedish_ci AND `reject` = CONVERT( _utf8 '0'
USING latin1 ) COLLATE latin1_swedish_ci LIMIT 0 , 1") or die();
}else{
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();
 }

// get the first (and hopefully only) entry from the result




while ($row = mysql_fetch_array($result)) {
	$video[] = $row; //Assignes row to video as a variable

$smarty->assign('id', $row['id']); //Smarty Assign, id to row id
$smarty->assign('vidtype', $row['video_type']);

$cat1 = $row["category"]; //If category is blank say null so we dont get a mysql error
if ($cat1 == null){
$cat1 = "null";
}

$query_categories = mysql_query("SELECT * FROM pp_categories WHERE disable='0'"); //Gets all the categories

while ($rowc = mysql_fetch_assoc($query_categories)){
	$cat2[] = $rowc;
}


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




	//Smarty Assings
$smarty->assign('ytpic', $ytpic);
$smarty->assign('pt', $_GET['pt']);
$smarty->assign('video', $video);
$smarty->assign('page', $page);
$smarty->assign('categories', $cat2);  //Got the categorys and assigned in to smarty
$smarty->assign('categories_current', $cat1);  //Got the categorys and assigned in to smarty

$smarty->display('admin_videos.tpl');

mysql_close($mysql_link);
?>
