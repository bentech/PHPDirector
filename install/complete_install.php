<?php
define("PHPdirector", 1);
include("header.php");
?>

<?php
if(isset($_POST["Editing"])){
	include("../config.php");
	include("../includes/function.inc.php");
	$connect1 = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
	mysql_select_db($cfg["db_name"], $connect1) or die(mysql_error());
	mysql_query("INSERT INTO pp_config (name, vids_per_page, exerntalheader, externalheaderurl, header_height, logo, cssstyle, lang, version) 
VALUES ('$_POST[name]', '$_POST[vids_per_page]', '$_POST[exerntalheader]', '$_POST[externalheaderurl]', '$_POST[header_height]', '$_POST[logo]', '$_POST[cssstyle]', '$_POST[lang]', '0.1')");

$filename = '../installed.php';
$somecontent = "Yes";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

   // In our example we're opening $filename in append mode.
   // The file pointer is at the bottom of the file hence
   // that's where $somecontent will go when we fwrite() it.
   if (!$handle = fopen($filename, 'a')) {
         echo "Cannot write to file please set permissions to 777";
         exit;
   }

   // Write $somecontent to our opened file.
   if (fwrite($handle, $somecontent) === FALSE) {
       echo "Cannot write to file please set permissions to 777";
       exit;
   }

   echo "You have succesfuly installed PHPDirector now you can feel free to delete the install folder if you want to.<p><a href='../admin/'>This is a link to the admin section if you forget the url just look into the readme file</a><p>";

   fclose($handle);

} else {
   echo "Cannot write to file please set permissions to 777";
}

}else{



}
?>

<?php
include("footer.php");
?>