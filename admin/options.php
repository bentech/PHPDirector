<?php
if(isset($_POST["options"])){
 header("location: options.php");
 define("PHPdirector", 1);
include("../config.php");
include("../includes/function.inc.php");
$connect1 = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
mysql_select_db($cfg["db_name"]) or die(mysql_error());
$result1 = mysql_query("SELECT * FROM pp_config");

$row1 = mysql_fetch_array($result1);
mysql_query("UPDATE pp_config SET name = '$_POST[name]'");
mysql_query("UPDATE pp_config SET vids_per_page = '$_POST[vids_per_page]'");
mysql_query("UPDATE pp_config SET exerntalheader = '$_POST[exerntalheader]'");
mysql_query("UPDATE pp_config SET externalheaderurl = '$_POST[externalheaderurl]'");
mysql_query("UPDATE pp_config SET header_height = '$_POST[header_height]'");
mysql_query("UPDATE pp_config SET logo = '$_POST[logo]'");
mysql_query("UPDATE pp_config SET cssstyle = '$_POST[cssstyle]'");
mysql_query("UPDATE pp_config SET lang = '$_POST[lang]'");
}
?>
<?php
// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['phpdirector']) || $_SESSION['phpdirector'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}

?>
<?php include("admin_header.php")?>
<?php
$connect2 = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
mysql_select_db($cfg["db_name"]) or die(mysql_error());
$result2 = mysql_query("SELECT * FROM pp_config");

$row2 = mysql_fetch_array($result2);
?>
<h2 align="center">Options</h2>
<form action="options.php" method="POST">
<center><b>Everything is required, Nothing can be blank</b>
<p>
<pre>

<table border="0" width="auto" height="auto">
<tr><td>Name:</td><td><input type="text" value="<?php echo $row2["name"]; ?>" name="name"></td></tr>
<tr><td>Videos Per Page:</td><td><input type="text" value="<?php echo $row2["vids_per_page"]; ?>" name="vids_per_page"></td></tr>
<tr><td>*Your own Header?:</td><td><input type="text" value="<?php echo $row2["exerntalheader"]; ?>" name="exerntalheader"></td></tr>
<tr><td>**Header URL:</td><td><input type="text" value="<?php echo $row2["externalheaderurl"]; ?>" name="externalheaderurl"></td></tr>
<tr><td>**Header Height:</td><td><input type="text" value="<?php echo $row2["header_height"]; ?>" name="header_height"></td></tr>
<tr><td>***Logo:</td><td><input type="text" value="<?php echo $row2["logo"]; ?>" name="logo"></td></tr>
<tr><td>CSS Url:</td><td><input type="text" value="<?php echo $row2["cssstyle"]; ?>" name="cssstyle"></td></tr>
<tr><td>****Lang:</td><td><input type="text" value="<?php echo $row2["lang"]; ?>" name="lang"></td></tr>
<tr><td></td><td><tr><td><input type="hidden" name="options"></td><td>
<tr><td colspan="2"><center><input type="submit" value="Edit"></center></td></tr>
</table>
</form>
<br>
<br>
<br>
</center>
* : If you have a header you would like instead of our type in the URL otherwish type false
<br>
** : If you have your own Header
<br>
*** : If default logo type in default otherwise type in URL
<br>
**** : English or German


</pre>
</body>
</html>
