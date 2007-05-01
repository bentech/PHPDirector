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
		
		
		if ($videourl == null){
		$smarty->assign('error', 'Please Do Not Submit Blank Links');
		$smarty->display('error.tpl');
		exit;
		}
		
		$check = explode(".", $videourl);

		$source = $check[1];
		
		$source2 = between('http://', '.', $videourl);
		echo $source2;

				if ($source2 !== "http://www."){ //youtube
				echo $source;
				$source = $check[0];
				
				}elseif ($source == "youtube"){ //youtube
				include("processes/process_youtube.inc.php");
				$smarty->assign('vidtype', 'YouTube');
				$smarty->assign('videoid', $videoid);
				
				}elseif ($source == "google"){ //google
				$smarty->assign('vidtype', 'google');
				$smarty->assign('videoid', $videoid);
				include("processes/process_google.inc.php");
				
				
				}elseif ($source == "dailymotion"){ //dailymotion
				$smarty->assign('vidtype', 'dailymotion');
				include("processes/process_dailymotion.inc.php");
				}else{
					$error = $smarty->get_template_vars('LAN_22');
					$smarty->assign_by_ref('error', $error);
					$smarty->display('error.tpl');
					exit;
				}
				
		$smarty->assign('source', $source);
		//Source End
		
		
		//ALLREADY EXIST?
		
		if ($videoid !==  null){
			$resultfile = mysql_query("SELECT * FROM pp_files WHERE file='$videoid'")or die(mysql_error());
			$rowfile = mysql_fetch_array( $resultfile );
			
			if ($rowfile['file'] == $videoid){
				$smarty->assign('error', 'This Video Has Allready Been Submitted');
				$smarty->display('error.tpl');
				exit;
			}
		}
		
		//exist end
		
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
}elseif ($part == "3"){
echo $_POST["titletext"];
if ($rowfile['file'] == $videoid){
	$error = $smarty->get_template_vars('LAN_24');
	$smarty->assign_by_ref('error', $error);
	$smarty->display('error.tpl');
	exit;
	}
	}

?>