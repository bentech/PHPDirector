<?php
function between($beg, $end, $str) {
	$a = explode($beg, $str, 2);
	$b = explode($end, $a[1]);
	return $b[0];
}
function getimage($id){
	$gv_contet = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp = array("&amp;");
	$new_replace  = array("&");
	$newphrase = str_replace("$amp", "$new_replace", "$gv_contet");
	$image = between('&lt;img src=&quot;', '&quot; width=&quot;', $newphrase);
	return $image;
}
function getdesc($id){		
	$gv_contet1 = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp1 = array("&apos;", "&quot;");
	$new_replace1  = array("'", "\"");
	$newphrase1 = str_replace("$amp1", "$new_replace1", "$gv_contet1");
	$desc = between('&lt;/font&gt;&lt;br/&gt;&lt;br/&gt;', '</description>', $newphrase1);
	return $desc;
}
function gettitle($id){
	$gv_contet2 = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp2 = array("&apos;", "&quot;", "&amp;");
	$new_replace2  = array("'", "\"", "&");
	$newphrase2 = str_replace("$amp2", "$new_replace2", "$gv_contet2");
	$title = between('<item><title>', '</title>', $newphrase2);
	return $title;
}
function thedate($id){
	$gv_contet3 = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$date = between('<pubDate>', '00:00:00 PDT</pubDate>', $gv_contet3);
	return $date;
}
function getauthor($id){
	$gv_contet4 = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp4 = array("&apos;", "&quot;", "&amp;");
	$new_replace4 = array("'", "\"", "&");
	$newphrase4 = str_replace("$amp4", "$new_replace4", "$gv_contet4");
	$author = between('<author>', '</author>', $newphrase4);
	return $author;
}

$baseurl = $videourl;
$url = between('?', '&q', $baseurl);
$url2 = between('=-', '&q', $baseurl);
if($url2 == null){
	$url3 = between('=', '&q', $baseurl);
}else{
	$url4 = between('=', '&q', $baseurl);
}
if($url2 == null){
$geturl = $url3;
$gettitle = gettitle($url3);
$thedate = thedate($url3);
$getauthor = getauthor($url3);
$getimage = getimage($url3);
$getimage2 = $getimage;
$getdesc = getdesc($url3);
}
if($url3 == null){
$geturl = $url4;
$gettitle = gettitle($url2);
$thedate = thedate($url2);
$getauthor = getauthor($url2);
$getimage = getimage($url2);
$getimage2 = $getimage;
$getdesc = getdesc($url2);
}
if(!isset($baseurl)){
echo"<center>No video specified<center>";
include("footer.php");
exit;
}
$result1 = mysql_query("SELECT * FROM pp_files WHERE file='$geturl'");
$row1 = mysql_fetch_array($result1);

if ($row1['file'] == $geturl){
echo "<p>".LAN_22."</p>";
echo "<p><a href='submit.php'>Submit Another Video?</a></p>";
include("footer.php");
exit;
}	

if ($getimage2 == null){
echo "<p>".LAN_23."</p>";
echo "<p><a href='submit.php'>Submit Another Video?</a></p>";
include("footer.php");
exit;
}	

$ip = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO pp_files (name, video_type, creator, description, date, file, approved, ip, picture) VALUES ('$gettitle', 'GoogleVideo' ,'$getauthor', '$getdesc', CURDATE(), '$geturl', '0', '$ip', '$getimage2')")	or die(mysql_error());

	echo "<center><P>".LAN_24." <b><u> $gettitle</b></u> ".LAN_25."</P>";
	echo "<p><a href='submit.php'>Submit Another Video?</a></p></center>";
?>