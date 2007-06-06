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




//PART 2
}elseif ($part == "2"){

		//Source
		$videourl = $_POST['videourl'];
		$smarty->assign('id', $videourl);
		
		
		if ($videourl == null){
		$smarty->assign('error', 'Please Do Not Submit Blank Links');
		$smarty->display('error.tpl');
		exit;
		}
		
		$check = explode(".", $videourl);

		$source = $check[1];
		
		$source2 = between('http://', '.', $videourl);

				if ($source2 !== "http://video."){ //google
		if ($source2 !== "http://www."){
		$smarty->assign('error', 'Invalid Link, Try http://<b>www</b>...');
		$smarty->display('error.tpl');
		exit;
		}
		}
		

$extensionwhere = count($check) -1; // Gets which point the conent after the last . is   eg .wmv

$extension = $check[$extensionwhere];// Returns eg wmv

				if ($source == "youtube"){ //youtube
				include("processes/process_youtube.inc.php");
							
				}elseif ($source == "google"){ //google
				include("processes/process_google.inc.php");
						
				}elseif ($source == "dailymotion"){ //dailymotion
				include("processes/process_dailymotion.inc.php");
				
				}elseif ($extension == "wmv"){ //wmv
				include("processes/wmv.inc.php");
				
				
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
			$fileresult = mysql_query("SELECT file FROM pp_files WHERE file='$videoid' LIMIT 0 , 1")or die(mysql_error());
			$rowfile = mysql_fetch_array($fileresult);
			if ($rowfile['file'] == $videoid){
				$smarty->assign('error', 'This Video Has Allready Been Submitted');
				$smarty->display('error.tpl');
				exit;
			}
			}
			
		//Categories
		$catresult = mysql_query("SELECT * FROM pp_categories WHERE disable='0'") or die("Error: " . mysql_error());
		//Gets Categories
		while ($catrow2 =  mysql_fetch_array($catresult)){
			$result11[] = $catrow2;
		}
		//pass the results to the template
		$smarty->assign('cat', $result11);
		
		//Display Images page
		$smarty->display('submit2.tpl');
}elseif ($part == "3"){
$insertthumb = $_POST["picture"];
$inserttitle = $_POST["titletext"];
$insertauthor = $_POST["authortext"];
$insertdes = safe_sql_insert($_POST["descriptiontext"]);
$insetycat = $_POST["category"];
$videoid = $_POST["videoid"];
$source = $_POST["vidtype"];
$file2 = $_POST["file2"];

			$fileresult = mysql_query("SELECT file FROM pp_files WHERE file='$videoid' LIMIT 0 , 1")or die(mysql_error());
			$rowfile = mysql_fetch_array($fileresult);
			if ($rowfile['file'] == $videoid){
				$smarty->assign('error', 'This Video Has Allready Been Submitted');
				$smarty->display('error.tpl');
				exit;
			}
mysql_query("INSERT INTO pp_files (name, video_type, creator, description, date, file, file2, approved, ip, picture, category) VALUES ('$inserttitle', '$source' , '$insertauthor', '$insertdes', CURDATE(), '$videoid', '$file2', '0', '$ip', '$insertthumb', '$insetycat')")	or die(mysql_error());

	$error = $smarty->get_template_vars('LAN_24');
	$smarty->assign_by_ref('error', $error);
	$smarty->display('error.tpl');
	exit;
	}


?>