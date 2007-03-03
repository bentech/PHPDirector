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
 * Gets thumb from youtube id
 *
 * @param Youtube Id
 * @return $yt_pic
 */
function getthumb($id){
$yt_xml_pic_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$id);
$yt_xml_pic_start = explode("<thumbnail_url>",$yt_xml_pic_string,2);
$yt_xml_pic_end = explode("</thumbnail_url>",$yt_xml_pic_start[1],2);
$yt_pic = $yt_xml_pic_end[0];
return $yt_pic;
}

/**
 * Gets Author from youtube id
 *
 * @param Youtube Id
 * @return $yt_author
 */
function getauthor($id){
$yt_xml_author_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$id);
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
function gettitle($id){
$yt_xml_title_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$id);
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
function getdescription($id){
$yt_xml_description_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$id);
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
 */
function getviewcount($id){
$yt_xml_view_count_string = @file_get_contents("http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=BnvzCjJ_Bzw&video_id=".$id);
$yt_xml_view_count_start = explode("<view_count>",$yt_xml_view_count_string,2);
$yt_xml_view_count_end = explode("</view_count>",$yt_xml_view_count_start[1],2);
$yt_view_count = $yt_xml_view_count_end[0];
return $yt_view_count;
}
?>
<?php
define("PHPdirector", 1);	       // for config foo
define("submtitab", 1);
require("header.php");                 // 

//check if its allready there
$videoid = getytid($_POST['ytstring']);
	$result1 = mysql_query("SELECT * FROM pp_files WHERE file='$videoid'")
	or die(mysql_error());
	$row1 = mysql_fetch_array( $result1 );

if ( $row1['file'] == $videoid){
echo "<p>".$LAN_22."</p>";
echo "This Video Allready Exists";
echo "<p><a href='submit.php'>Submit Another Video?</a></p>";
include("footer.php");
exit;
}	
		if($videoid !== null){
		$inserttitle  = safe_sql_insert(gettitle($videoid));
		$insertauthor = safe_sql_insert(getauthor($videoid));
		$insertdes    = safe_sql_insert(getdescription($videoid));
		$insertthumb  = safe_sql_insert(getthumb($videoid));
		$ip           = safe_sql_insert($_SERVER['REMOTE_ADDR']);

mysql_query("INSERT INTO pp_files (name, video_type, creator, description, date, file, approved, ip, picture) VALUES ('$inserttitle', 'YouTube' , '$insertauthor', '$insertdes', CURDATE(), '$videoid', '0', '$ip', '$insertthumb')")	or die(mysql_error());

				echo "<P>".LAN_24." <b><u>".$inserttitle."</b></u>".LAN_25."</P>";
				include("footer.php");
				exit;
		}//check for blank end

		echo "<p><a href='submit.php'>".LAN_21."</a></p>";
 ?>


<?php include("footer.php");?>