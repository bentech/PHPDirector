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
$source = "GoogleVideo";

if ($play == true){

//player code
$player_code = '<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='.$row[file].'&hl=en-GB" flashvars=""> </embed>';
return;
}

//This is to get the id from the link eg youtube http://www.youtube.com/watch?v=xxxxxxxx&.....
//$link_start is the start of where the id is, $link_end is the end which you do not need
$link_start = "docid=";
$link_end = "&";

//IGNORE//
$videoid = trim(getytid($videourl,$link_start,$link_end));
///IGNORE//

//Xml Url for the video
$xml_url = "http://video.google.com/videofeed?docid=".$videoid;

//These are for the xml parsing, you will have to re-write this script completly if it doesnt support this

//These are the tags where the text is


//Title

$xml_title_start = "<media:title>"; //Start

$xml_title_end = "</media:title>"; //End

//Author

$xml_author_start = "<media:author>";//Start

$xml_author_end = "</media:author>";//End


//description

$xml_description_start = "<media:description>";//Start

$xml_description_end = "</media:description>";//End




//Images --Put as many as you need or just one

//use php code if needed

$xml_image_start = "<media:thumbnail url=\"";//Start

$xml_image_end = "\"";//End

///Most Video Sites You Shouln't Need to Change Below This!!!
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


//check if its allready there


		if($videoid !== null){
		$title  = safe_sql_insert(between($videoid,$xml_title_start,$xml_title_end,$xml_url)); //Function to make the sql safe
		$smarty->assign('title', $title);
		
		$author = safe_sql_insert(between($videoid,$xml_author_start,$xml_author_end,$xml_url));
		$smarty->assign('author', $author);
		
		$des    = safe_sql_insert(between($videoid,$xml_description_start,$xml_description_end,$xml_url));
		$smarty->assign('description', $des);
		
		$des    = safe_sql_insert(between($videoid,$xml_image_start,$xml_image_end,$xml_url));
		$smarty->assign('image', $thumb);
		
		$smarty->assign('videoid', $videoid);
		
		$smarty->assign('vidtype', $source);
		

				}//check for blank end
			
 ?>