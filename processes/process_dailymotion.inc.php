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
$dm_xml_pic_end = explode("&",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

define("PHPdirector", 1);	       // for config foo
define("submtitab", 1);
require("header.php");    
//check if its allready there
$dmid = getdmid($videourl);

		if($dmid !== null){
		$inserttitle  = safe_sql_insert(gettitle($dmid));
		$insertauthor = safe_sql_insert(getauthor($dmid));
		$insertdes    = safe_sql_insert(getdescription($dmid));
		$insertthumb  = safe_sql_insert(getthumb($dmid));
		$file 		  = safe_sql_insert($dmid);
		$ip           = safe_sql_insert($_SERVER['REMOTE_ADDR']);
		
		
	$result1 = mysql_query("SELECT * FROM pp_files WHERE file='$file'")
	or die(mysql_error());
	$row1 = mysql_fetch_array( $result1 );
	
	if ( $row1['file'] == $file){
echo "<p>".$LAN_22."</p>";
echo "This Video Allready Exists";
echo "<p><a href='submit.php'>Submit Another Video?</a></p>";
include("footer.php");
exit;
}	

mysql_query("INSERT INTO pp_files (name, video_type, creator, description, date, file, approved, ip, picture) VALUES ('$inserttitle', 'dailymotion' , '$insertauthor', '$insertdes', CURDATE(), '$file', '0', '$ip', '$insertthumb')")	or die(mysql_error());

				echo "<P>".LAN_24." <b><u>".$inserttitle."</b></u>".LAN_25."</P>";
				include("footer.php");
				exit;
		}//check for blank end

		echo "<p><a href='submit.php'>".LAN_21."</a></p>";
		include("footer.php");
?>
 