<?php
function getdmid($url){

//checks if valid youtube link

$checkdm = explode(".", $url);

if ($checkdm[1] == "dailymotion" ){

	//gets vid id
$dm_start = explode("/video/",$url,2);
$dm_end = explode("&",$dm_start[1],2);
$gotid = $dm_end[0];
return $gotid;
}
}
/**
 * Gets thumb from dailymotion id
 *
 * @param dailymotion Id
 * @return $dm_pic
 */
function getthumb($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("type=\"image/jpeg\" href=\"",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("\"",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

/**
 * Gets Author from dailymotion id
 *
 * @param dailymotion Id
 * @return $dm_author
 */
function getauthor($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("<author><name>",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("</name><uri>",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}
/**
 * Gets Title from dailymotion id
 *
 * @param dailymotion Id
 * @return $dm_title_noslash
 */
function gettitle($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("<title>",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("</title>",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

/**
 * Gets description from dailymotion id
 *
 * @param dailymotion Id
 * @return $dm_description
 */
function getdescription($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("<content type=\"html\">",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("<",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

/**
 * Gets description from dailymotion id
 *
 * @param dailymotion Id
 * @return $dm_description
 */
function getswf($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("/swf/",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("\"",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

$videoid = getdmid($videourl);
$dmid = getswf($videoid);
$smarty->assign('dmid', $dmid);

		if($videoid != null){
		$title  = safe_sql_insert(gettitle($videoid));
		$author = safe_sql_insert(getauthor($videoid));
		$des    = safe_sql_insert(getdescription($videoid));
		$thumb[0]  = safe_sql_insert(getthumb($videoid));
		$file 	= safe_sql_insert($videoid);
		$ip     = safe_sql_insert($_SERVER['REMOTE_ADDR']);
		
		$smarty->assign('title', $title);
		$smarty->assign('author', $author);
		$smarty->assign('description', $des);
		$smarty->assign('image', $thumb);
		
//mysql_query("INSERT INTO pp_files (name, video_type, creator, description, date, file, approved, ip, picture, category) VALUES ('$inserttitle', 'dailymotion' , '$insertauthor', '$insertdes', CURDATE(), '$file', '0', '$ip', '$insertthumb', '$category')")	or die(mysql_error());

		}//check for blank end
?>
 