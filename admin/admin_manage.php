<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
include("admin_header.php");
include("includes/admin_videos_functions.php");
$smarty->assign('pagevalue', $_GET["pt"]);
$limit = config('vids_per_page');

// required connect
    SmartyPaginate::connect();
// set items per page
    SmartyPaginate::setLimit($limit);
	
	$smarty->assign('video', get_db_results());
    // assign {$paginate} var
    SmartyPaginate::assign($smarty);
	
	
if($pagevalue == null){
$smarty->display('admin_manage.tpl');
exit;
}

$smarty->display('admin_manage.tpl');


  function get_db_results() {
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
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE approved='1' ORDER BY id DESC LIMIT %d,%d";
}

		$_query = sprintf($query, SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
		
		
		        $_result = mysql_query($_query);   // assign your db results to the template
$_data = array();
$i=0;

 while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
	
	//PICTURE
		if($_row["video_type"] == "YouTube"){
			$yt_pic_broken = explode("/", show_sql($_row['picture']));
			$yt_pic_final = $yt_pic_broken[5];
		if ($yt_pic_final = "2.jpg"){
			$yt_pic_getstart = explode("2.jpg", show_sql($_row['picture']));
			$ytpic = $yt_pic_getstart[0];
	}
	}
	
	
	$tmp = array(
'id' => $_row['id'],
'name' => $_row['name'],
'creator' => $_row['creator'],
'picture' => $_row['picture'],
'ytpic' => $ytpic,
'description' => $_row['description'],
'date' => $_row['date'],
'video_type' => $_row['video_type']
);

$_data[$i++] = $tmp;
}
//PICTURE_EN

        $_query = "SELECT FOUND_ROWS() as total";
        $_result = mysql_query($_query);
        $_row = mysql_fetch_array($_result, MYSQL_ASSOC);
        
        SmartyPaginate::setTotal($_row['total']);

        mysql_free_result($_result);
      
        return $_data;

	}
	
	mysql_close($mysql_link);
	
	?>
