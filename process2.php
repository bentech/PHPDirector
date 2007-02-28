<?php
include("db.php");
include("includes/function.inc.php");
include("lang/".config('lang')."/lang.inc.php");
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
	$return_var = between('&lt;img src=&quot;', '&quot; width=&quot;', $newphrase);
	return $image;
}
function getdesc($id){		
	$gv_contet = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp = array("&apos;", "&quot;");
	$new_replace  = array("'", "\"");
	$newphrase = str_replace("$amp", "$new_replace", "$gv_contet");
	$return_var = between('&lt;/font&gt;&lt;br/&gt;&lt;br/&gt;', '</description>', $newphrase);
	return $desc;
}
function gettitle($id){
	$gv_contet = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp = array("&apos;", "&quot;", "&amp;");
	$new_replace  = array("'", "\"", "&");
	$newphrase = str_replace("$amp", "$new_replace", "$gv_contet");
	$return_var = between('<item><title>', '</title>', $newphrase);
	return $title;
}
function thedate($id){
	$gv_contet = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$return_var = between('<pubDate>', '00:00:00 PDT</pubDate>', $gv_contet);
	return $date;
}
function getauthor($id){
	$gv_contet = @file_get_contents("http://video.google.com/videosearch?q=$id&output=rss");
	$amp = array("&apos;", "&quot;", "&amp;");
	$new_replace  = array("'", "\"", "&");
	$newphrase = str_replace("$amp", "$new_replace", "$gv_contet");
	$return_var = between('<author>', '</author>', $newphrase);
	return $author;
}

$baseurl = $_POST["gvideo"];;
$url = between('?', '&q', $baseurl);
$url2 = between('=-', '&q', $baseurl);
if($url2 == null){
	$url3 = between('=', '&q', $baseurl);
}
if($url2 == null){
gettitle($url3);echo"<br>";
thedate($url3);echo"<br>";
getauthor($url3);echo"<br>";
echo"<img src=\"";getimage($url3);echo ">";
echo"<br><br><br>";
getdesc($url3);
}
if($url3 == null){
gettitle($url2);echo"<br>";
thedate($url2);echo"<br>";
getauthor($url2);echo"<br>";
echo"<img src=\"";getimage($url2);echo ">";
echo"<br><br><br>";
getdesc($url2);
}
$result1 = mysql_query("SELECT * FROM pp_files WHERE file='$videoid'");
$row1 = mysql_fetch_array($result1);
include("header.php");


if ($videoid == config('disabled videos')){
echo "<p>".$LAN_20."</p>";
echo "<p><a href='submit.php'>Submit Another?</a></p>";
include("footer.php");
exit;
}
if ($row1['file'] == $baseurl){
echo "<p>".$LAN_22."</p>";
echo "This Video Allready Exists";
echo "<p><a href='submit.php'>Submit Another Video?</a></p>";
include("footer.php");
exit;
}
	
$ip = $_SERVER['REMOTE_ADDR'];

mysql_query("INSERT INTO pp_files (name, creator, description, date, file, approved, ip, picture) VALUES ('$title', '$author', '$desc', CURDATE(), '$baseurl', '0', '$ip', '$image')")	or die(mysql_error());

	echo "<P>".LAN_24." <b><u> ".$inserttitle." </b></u>".LAN_25."</P>";
	include("footer.php");
	exit;
echo "<p><a href='submit.php'>".LAN_21."</a></p>";
?>