<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko
+----------------------------------------------------------------------------+
*/
$source = "YouTube";
//This is to get the id from the link eg youtube http://www.youtube.com/watch?v=xxxxxxxx
//$link_start is the start of where the id is, $link_end is the end which you do not need
$link_start = "v=";
$link_end = "&";

//IGNORE//
$videoid = trim(getytid($videourl,$link_start,$link_end));
///IGNORE//

//Xml Url for the video
$xml_url = "http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$videoid;

//These are for the xml parsing, you will have to re-write this script completly if it doesnt support this

//These are the tags where the text is


//Title

$xml_title_start = "<title>"; //Start

$xml_title_end = "</title>"; //End

//Author

$xml_author_start = "<author>";//Start

$xml_author_end = "</author>";//End


//description

$xml_description_start = "</description>";//Start

$xml_description_end = "</description>";//End




//Images --Put as many as you need or just one

$thumb[0]  = "http://img.youtube.com/vi/".$videoid."/1.jpg";	
$thumb[1]  = "http://img.youtube.com/vi/".$videoid."/2.jpg";
$thumb[2]  = "http://img.youtube.com/vi/".$videoid."/3.jpg";



///....////
///Most Video Sites You Shoulnt Need to Change Below This!!!
///....////


/**
 * Gets youtube link from eg http://www.youtube.com/watch?v=xxxxxxxxxxx&eurl=
 *
 * @param http://www.youtube.com/watch?v=xxxxxxxxxxx
 * @return Youtube id
 */
function getytid($url,$start,$end){

	//gets vid id
$yt_start = explode($start,$url,2);
$yt_end = explode($end,$yt_start[1],2);
$gotid = $yt_end[0];
return $gotid;
}
/**
 * Gets Author from youtube id
 *
 * @param Youtube Id
 * @return $yt_author
 */
function getauthor($videoid,$start,$end,$xml_url){
$yt_xml_author_string = @file_get_contents($xml_url);
$yt_xml_author_start = explode($start,$yt_xml_author_string,2);
$yt_xml_author_end = explode($end,$yt_xml_author_start[1],2);
$yt_author = addslashes($yt_xml_author_end[0]);
return $yt_author;
}
/**
 * Gets Title from youtube id
 *
 * @param Youtube Id
 * @return $yt_title_noslash
 */
function gettitle($videoid,$start,$end,$xml_url){
$yt_xml_title_string = @file_get_contents($xml_url);
$yt_xml_title_start = explode($start,$yt_xml_title_string,2);
$yt_xml_title_end = explode($end,$yt_xml_title_start[1],2);
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
function getdescription($videoid,$start,$end,$xml_url){
$yt_xml_description_string = @file_get_contents($xml_url);
$yt_xml_description_start = explode($start,$yt_xml_description_string,2);
$yt_xml_description_end = explode($end,$yt_xml_description_start[1],2);
$yt_description = addslashes($yt_xml_description_end[0]);
return $yt_description;
}

//check if its allready there


		if($videoid !== null){
		$title  = safe_sql_insert(gettitle($videoid,$xml_title_start,$xml_title_end,$xml_url)); //Function to make the sql safe
		$smarty->assign('title', $title);
		
		$author = safe_sql_insert(getauthor($videoid,$xml_author_start,$xml_author_end,$xml_url));
		$smarty->assign('author', $author);
		
		$des    = getdescription($videoid,$xml_description_start,$xml_description_end,$xml_url);
		$smarty->assign('description', $des);
		
		$smarty->assign('image', $thumb);
		
		$smarty->assign('videoid', $videoid);
		
		$smarty->assign('vidtype', $source);
		

				}//check for blank end
 ?>