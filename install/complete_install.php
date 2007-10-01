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
	mysql_query("INSERT INTO pp_config (name, news, vids_per_page, version) 
VALUES ('$_POST[name]', '$_POST[news]', '$_POST[vids_per_page]', '0.2')");

$filename = '../installed.php';
$somecontent = ";Yes;";

// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

   // In our example we're opening $filename in append mode.
   // The file pointer is at the bottom of the file hence
   // that's where $somecontent will go when we fwrite() it.
   if (!$handle = fopen($filename, 'w')) {
         echo "Cannot write to file please set permissions to 777";
         exit;
   }

   // Write $somecontent to our opened file.
   if (fwrite($handle, $somecontent) === FALSE) {
       echo "Cannot write to file please set permissions to 777";
       exit;
   }

   echo "<p>You have sucesfully installed PHP Director</p>
<p>You must Delete the install folder now.</p>
<p>You can visit the <a href=\"../admin\">admin section </a> where i recommend you add a category </p>";

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