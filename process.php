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
$source = getsource($videourl);

if ($source == "youtube"){ //youtube
include("processes/process_youtube.inc.php");
}elseif ($source == "google"){ //google
include("processes/process_google.inc.php");
}elseif ($source == "dailymotion"){ //dailymotion
include("processes/process_dailymotion.inc.php");
}else{
echo "This Source is not supported"; //not supported
}
?>