<?php
if($_POST['videourl'] == null){
exit;
}

function getsource($url){

//checks if valid youtube link
$check = explode(".", $url);
return $check[1];
}

$videourl = $_POST['videourl'];

define("PHPdirector", 1);	       // for config foo
define("submtitab", 1);
require("header.php");    
$source = getsource($videourl);

if ($source == "youtube"){ //youtube
include("processes/process_youtube.inc.php");
}elseif ($source == "google"){ //google
include("processes/process_google.inc.php");
}elseif ($source == "dailymotion"){ //dailymotion
echo "Currently In Development";
}else{
echo "This Source is not supported"; //not supported
}
include("footer.php");
?>