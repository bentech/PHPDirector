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
$source = "dailymotion";


//This is to get the id from the link eg youtube http://www.youtube.com/watch?v=xxxxxxxx&.....
//$link_start is the start of where the id is, $link_end is the end which you do not need

$link_start = "/video/";
$link_end = "&";



//IGNORE//
if ($play !== true){
$videoid = trim(getytid($videourl,$link_start,$link_end));

}
///IGNORE//

//Xml Url for the video
$xml_url = "http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$videoid;



//IGNORE//
$dmid = getinfo('/swf/', '"',$xml_url);
///IGNORE//




//player code
$player_code = '<object width="425" height="335"><param name="movie" value="http://www.dailymotion.com/swf/'.$dmid.'"></param><param name="allowfullscreen" value="true"></param><embed src="http://www.dailymotion.com/swf/'.$dmid.'" type="application/x-shockwave-flash" width="425" height="335" allowfullscreen="true"></embed></object>';


//These are for the xml parsing, you will have to re-write this script completly if it doesnt support this

//These are the tags where the text is


//Title

$xml_title_start = "<title>"; //Start

$xml_title_end = "</title>"; //End

//Author

$xml_start = "<author><name>";//Start

$xml_end = "</name>";//End


//description

$xml_description_start = "<content type=\"html\">";//Start

$xml_description_end = "</content>";//End




//Images --Put as many as you need or just one

//CUSTOM CODE FOR DAILY MOTION
$xml_image_start = '/preview/';

$xml_image_end = '?';



///Most Video Sites You Shouln't Need to Change Below This!!!
///....////

if ($play == true){
return;
}

function getytid($url,$start,$end){

	//gets vid id
$yt_start = explode($start,$url,2);
$yt_end = explode($end,$yt_start[1],2);
$gotid = $yt_end[0];
return $gotid;
}

function getinfo($start,$end,$xml_url){
$yt_xml_string = @file_get_contents($xml_url);
$yt_xml_start = explode($start,$yt_xml_string,2);
$yt_xml_end = explode($end,$yt_xml_start[1],2);
$yt = addslashes($yt_xml_end[0]);
return $yt;
}

//check if its allready there

		if($videoid !== null){
		$title  = safe_sql_insert(getinfo($xml_title_start,$xml_title_end,$xml_url)); //Function to make the sql safe
		
		$smarty->assign('title', $title);
		
		$author = safe_sql_insert(getinfo($xml_start,$xml_end,$xml_url));
		$smarty->assign('author', $author);
		
		$des    = safe_sql_insert(getinfo($xml_description_start,$xml_description_end,$xml_url));
		$smarty->assign('description', $des);
		
		$thumb[0] = safe_sql_insert(getinfo($xml_image_start,$xml_image_end,$xml_url));
$thumbpart2 = "http://limelight-450.static.dailymotion.com/dyn/preview/160x120/".$thumb[0];

		$smarty->assign('image', $thumbpart2);
		
		$smarty->assign('videoid', $videoid);
		
		$smarty->assign('vidtype', $source);
		
		$smarty->assign('player_code', $player_code);
		

				}//check for blank end
			
 ?>