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
function getthumb($file){
$dm_xml_pic_start = explode("type=\"image/jpeg\" href=\"",$file,2);
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
function getauthor($file){
$dm_xml_pic_start = explode("<author><name>",$file,2);
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
function gettitle($file){
$dm_xml_pic_start = explode("<title>",$file,2);
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
function getdescription($file){
$dm_xml_pic_start = explode("<content type=\"html\">",$file,2);
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
function getswf($file){
$dm_xml_pic_start = explode("/swf/",$file,2);
$dm_xml_pic_end = explode("\"",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

		$did = getdmid($videourl);
		$file = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$did);
		$videoid = getswf($file);
		if($did != null){
		$title  = safe_sql_insert(gettitle($file));
		$author = safe_sql_insert(getauthor($file));
		$des    = safe_sql_insert(getdescription($file));
		$thumb[0]  = safe_sql_insert(getthumb($file));
		$file 	= safe_sql_insert(getswf($file));
		$ip     = safe_sql_insert($_SERVER['REMOTE_ADDR']);
		$smarty->assign('file2', $did);
		$smarty->assign('title', $title);
		$smarty->assign('author', $author);
		$smarty->assign('description', $des);
		$smarty->assign('image', $thumb);
		$smarty->assign('videoid', $file);
		$smarty->assign('vidtype', 'dailymotion');

		}//check for blank end

			$didfile = mysql_query("SELECT * FROM `pp_files` WHERE `file2` = CONVERT(_utf8 '$did' USING latin1) COLLATE latin1_swedish_ci  LIMIT 0 , 1")or die(mysql_error());
			$rowdid = mysql_fetch_array($didfile);
			if ($rowdid['file2'] == $did){
				$smarty->assign('error', 'This Video Has Allready Been Submitted');
				$smarty->display('error.tpl');
				exit;
			}
?>
 