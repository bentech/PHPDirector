<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
require('header.php');  

$part = $_GET["part"];  //Gets which part it is on
if ($part == null){
$part = "1";  //If part isnt set goto part 1
}

if ($part == "1"){
//Display Images page
$smarty->display('submit.tpl');


}elseif ($part == "2"){


//Source
$videourl = $_POST['videourl'];
$source = getsource($videourl);

if ($source == "youtube"){ //youtube
include("processes/process_youtube.inc.php");
$smarty->assign('vidtype', 'YouTube');
$smarty->assign('videoid', $videoid);
}elseif ($source == "google"){ //google
//include("processes/process_google.inc.php");
}elseif ($source == "dailymotion"){ //dailymotion
//include("processes/process_dailymotion.inc.php");
}else{
echo "This Source is not supported"; //not supported
}
//Source End
$smarty->assign('source', $source);
//Categories
$result0 = mysql_query("SELECT * FROM pp_categories") or die("Error: " . mysql_error());

//Gets Categories
while ($row2 = mysql_fetch_assoc($result0)){
	$result11[] = $row2;
}
//pass the results to the template
$smarty->assign('cat', $result11);

//Display Images page
$smarty->display('submit2.tpl');

};

?>