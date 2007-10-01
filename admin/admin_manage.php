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
ob_start(); 
session_start(); 

include("admin_header.php");
if (checkLoggedin()){
include("includes/admin_videos_functions.php");
$smarty->assign('pagevalue', $_GET["pt"]);
$limit = config('vids_per_page');

// required connect
    SmartyPaginate::connect();
// set items per page
    SmartyPaginate::setLimit($limit);
	
	
	// count(*) is better for large databases (thanks Greg!)
if ($_GET["pt"]  == "all"){
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE approved='1' ORDER BY id DESC LIMIT %d,%d";	
}elseif ($_GET["pt"] == "feature") {
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE feature = '1' ORDER BY id DESC LIMIT %d,%d";
}elseif ($_GET["pt"] == "approve"){
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE approved='0' AND reject='0' ORDER BY id DESC LIMIT %d,%d";
}elseif ($_GET["pt"] == "rejected"){
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE approved='0' AND reject='1' ORDER BY id DESC LIMIT %d,%d";	
}else{
$smarty->assign('message1', 'Welcome To Admin');
	$smarty->display('admin_header.tpl');
	exit;
}

		$_query = sprintf($query, SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
		
		
		        $_result = mysql_query($_query);   // assign your db results to the template
$_data = array();
$i=0;

 while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
	
	//PICTURE
		if($_row["video_type"] == "YouTube"){
		
	$ytpic = "http://img.youtube.com/vi/".$_row['file']."/";
	}
	
	
	$tmp = array(
'id' => $_row['id'],
'name' => $_row['name'],
'creator' => $_row['creator'],
'picture' => $_row['picture'],
'ytpic' => $ytpic,
'description' => $_row['description'],
'date' => $_row['date'],
'approved' => $_row['approved'],
'featured' => $_row['feature'],
'rejected' => $_row['reject'],
'video_type' => $_row['video_type']
);

$_data[$i++] = $tmp;
//PICTURE_EN
}
        $_query = "SELECT FOUND_ROWS() as total";
        $_result = mysql_query($_query);
        $_row = mysql_fetch_array($_result, MYSQL_ASSOC);
        
        SmartyPaginate::setTotal($_row['total']);

        mysql_free_result($_result);
      
	$smarty->assign('video', $_data);
    // assign {$paginate} var
    SmartyPaginate::assign($smarty);
	SmartyPaginate::setUrl('admin_manage.php?pt='.$_GET["pt"].'&pag=vid');

if ($_row['total'] == "0"){
$smarty->assign('message1', 'No Media');
$smarty->display('admin_header.tpl');
exit;
}
	
$smarty->display('admin_manage.tpl');
}else{
header("location: login.php"); 
}	
mysql_close($mysql_link);
?>