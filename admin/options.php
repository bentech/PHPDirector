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
if (!isset($_COOKIE["admin"])){
    header('location: login.php');
}
?>
<?php include("admin_header.php")?>
<?php
$connect2 = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
mysql_select_db($cfg["db_name"]) or die(mysql_error());
$result2 = mysql_query("SELECT * FROM pp_config");

$row2 = mysql_fetch_array($result2);
?>
<h2 align="center"><?php echo Admin_8; ?></h2>
<form action="options.php" method="POST">
<center><b><?php echo Admin_30; ?></b>
<p>
<pre>

<table border="0" width="auto" height="auto">
<tr><td><?php echo Admin_22; ?>:</td><td><input type="text" value="<?php echo $row2["name"]; ?>" name="name"></td></tr>
<tr><td><?php echo Admin_23; ?>:</td><td><input type="text" value="<?php echo $row2["vids_per_page"]; ?>" name="vids_per_page"></td></tr>
<tr><td>*<?php echo Admin_24; ?>:</td><td><input type="text" value="<?php echo $row2["logo"]; ?>" name="logo"></td></tr>
<tr><td><?php echo Admin_25; ?>:</td><td><input type="text" value="<?php echo $row2["cssstyle"]; ?>" name="cssstyle"></td></tr>
<tr><td>**<?php echo Admin_26; ?>:</td><td><input type="text" value="<?php echo $row2["lang"]; ?>" name="lang"></td></tr>
<tr><td></td><td><tr><td><input type="hidden" name="options"></td><td>
<tr><td colspan="2"><center><input type="submit" value="Edit"></center></td></tr>
</table>
</form>
<br>
<br>
<br>
</center>
<br>
<br>
* : <?php echo Admin_28; ?>
<br>
** : <?php echo Admin_29; ?>


</pre>
</body>
</html>
