<?php
/**
 * Gets Google Video link from eg http://www.Google Video.com/watch?v=xxxxxxxxxxx&eurl=
 *
 * @param http://www.Google Video.com/watch?v=xxxxxxxxxxx
 * @return Google Video id
 */
function getgvid($url){

//checks if valid Google Video link

$checkgv = explode(".", $url);

if ($checkgv[1] == "google" ){

	//gets vid id
$gv_start = explode("docid=",$url,2);
$gv_end = explode("&",$gv_start[1],2);
$gotid = $gv_end[0];
return $gotid;
}
}
/**
 * Gets Author from Google Video id
 *
 * @param Google Video Id
 * @return $gv_author
 */
function getauthor($videoid){
$gv_xml_author_string = @file_get_contents("http://video.google.com/videofeed?docid=".$videoid);
$gv_xml_author_start = explode("<author>",$gv_xml_author_string,2);
$gv_xml_author_end = explode("</author>",$gv_xml_author_start[1],2);
$gv_author = addslashes($gv_xml_author_end[0]);
return $gv_author;
}
/**
 * Gets Title from Google Video id
 *
 * @param Google Video Id
 * @return $gv_title_noslash
 */
function gettitle($videoid){
$gv_xml_title_string = @file_get_contents("http://video.google.com/videofeed?docid=".$videoid);
$gv_xml_title_start = explode("<title>",$gv_xml_title_string,2);
$gv_xml_title_end = explode("</title>",$gv_xml_title_start[1],2);
$gv_title = addslashes($gv_xml_title_end[0]);
$gv_title_noslash = $gv_xml_title_end[0];
return $gv_title_noslash;
}

/**
 * Gets description from Google Video id
 *
 * @param Google Video Id
 * @return $gv_description
 */
function getdescription($videoid){
$gv_xml_description_string = @file_get_contents("http://video.google.com/videofeed?docid=".$videoid);
$gv_xml_description_start = explode("<description>",$gv_xml_description_string,2);
$gv_xml_description_end = explode("</description>",$gv_xml_description_start[1],2);
$gv_description = addslashes($gv_xml_description_end[0]);
return $gv_description;
}

/**
 * Gets description from Google Video image
 *
 * @param Google Video image
 * @return $gv_description
 */
function getimage($videoid){
$gv_xml_image_string = @file_get_contents("http://video.google.com/videofeed?docid=".$videoid);
$gv_xml_image_start = explode('&lt;img src=&quot;',$gv_xml_image_string,2);
$gv_xml_image_end = explode('&quot; width=&quot;',$gv_xml_image_start[1],2);
$gv_image = addslashes($gv_xml_image_end[0]);
return $gv_image;
}

//check if its allready there
$videoid_untrim = getgvid($videourl);

$videoid = trim($videoid_untrim);  //removes whitespaces at the end

		if($videoid !== null){
		$title  = safe_sql_insert(gettitle($videoid));
		$smarty->assign('title', $title);
		
		$author = safe_sql_insert(getauthor($videoid));
		$smarty->assign('author', $author);
		
		$des    = safe_sql_insert(getdescription($videoid));
		$smarty->assign('description', $des);
		
		$thumb[0]  = getimage($videoid);	
		$smarty->assign('image', $thumb);
		

				}//check for blank end
 ?>