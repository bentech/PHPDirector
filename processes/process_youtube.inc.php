<?php
/**
 * Gets youtube link from eg http://www.youtube.com/watch?v=xxxxxxxxxxx&eurl=
 *
 * @param http://www.youtube.com/watch?v=xxxxxxxxxxx
 * @return Youtube id
 */
function getytid($url){

//checks if valid youtube link

$checkyt = explode(".", $url);

if ($checkyt[1] == "youtube" ){

	//gets vid id
$yt_start = explode("v=",$url,2);
$yt_end = explode("&",$yt_start[1],2);
$gotid = $yt_end[0];
return $gotid;
}
}
/**
 * Gets Author from youtube id
 *
 * @param Youtube Id
 * @return $yt_author
 */
function getauthor($videoid){
$yt_xml_author_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$videoid);
$yt_xml_author_start = explode("<author>",$yt_xml_author_string,2);
$yt_xml_author_end = explode("</author>",$yt_xml_author_start[1],2);
$yt_author = addslashes($yt_xml_author_end[0]);
return $yt_author;
}
/**
 * Gets Title from youtube id
 *
 * @param Youtube Id
 * @return $yt_title_noslash
 */
function gettitle($videoid){
$yt_xml_title_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$videoid);
$yt_xml_title_start = explode("<title>",$yt_xml_title_string,2);
$yt_xml_title_end = explode("</title>",$yt_xml_title_start[1],2);
$yt_title = addslashes($yt_xml_title_end[0]);
$yt_title_noslash = $yt_xml_title_end[0];
return $yt_title_noslash;
}

/**
 * Gets description from youtube id
 *
 * @param Youtube Id
 * @return $yt_description
 */
function getdescription($videoid){
$yt_xml_description_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$videoid);
$yt_xml_description_start = explode("<description>",$yt_xml_description_string,2);
$yt_xml_description_end = explode("</description>",$yt_xml_description_start[1],2);
$yt_description = addslashes($yt_xml_description_end[0]);
return $yt_description;
}

/**
 * Gets Viewcount from youtube id
 *
 * @param Youtube Id
 * @return $yt_view_count
 *//*
function getviewcount($videoid){
$yt_xml_view_count_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$videoid);
$yt_xml_view_count_start = explode("<view_count>",$yt_xml_view_count_string,2);
$yt_xml_view_count_end = explode("</view_count>",$yt_xml_view_count_start[1],2);
$yt_view_count = $yt_xml_view_count_end[0];
return $yt_view_count;
}
*/
//check if its allready there

//$videourl is the input link eg http://www.youtube.com/watch?v=VflOBMTZiQw
//$videoid is the id that gets sorted in mysql for link above it is VflOBMTZiQw
$videoid_untrim = getytid($videourl);

$videoid = trim($videoid_untrim);  //removes whitespaces at the end

		if($videoid !== null){
		$title  = safe_sql_insert(gettitle($videoid)); //Function to make the sql safe
		$smarty->assign('title', $title);
		
		$author = safe_sql_insert(getauthor($videoid));
		$smarty->assign('author', $author);
		
		$des    = getdescription($videoid);
		$smarty->assign('description', $des);
		
		$thumb[0]  = "http://img.youtube.com/vi/".$videoid."/1.jpg";	//Put as many as you need or just one
		$thumb[1]  = "http://img.youtube.com/vi/".$videoid."/2.jpg";
		$thumb[2]  = "http://img.youtube.com/vi/".$videoid."/3.jpg";	
		$smarty->assign('image', $thumb);
		$smarty->assign('vidtype', 'YouTube');
		$smarty->assign('videoid', $videoid);

				}//check for blank end
 ?>