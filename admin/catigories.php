<?php
if (!isset($_COOKIE["admin"])){
    header('location: login.php');
}
?>
<?php
if(isset($_GET["del"])){
 header("location: catigories.php?pt=catigories");
include("admin_header.php");

$result1 = mysql_query("SELECT * FROM pp_catigories");
$row1 = mysql_fetch_array($result1);
mysql_query("DELETE FROM pp_catigories WHERE name='$_GET[del]'");
}

if(isset($_POST["add"])){
 header("location: catigories.php?pt=catigories");
include("admin_header.php");

$result1 = mysql_query("SELECT * FROM pp_catigories");
$row1 = mysql_fetch_array($result1);
if($row1["name"] == $_POST["add"]){
 header("location: catigories.php?pt=catigories&&error=exist");
}else{
mysql_query("INSERT INTO pp_catigories (name) 
VALUES ('$_POST[add]')");
}
}
?>


<?php
include("admin_header.php");

$result2 = mysql_query("SELECT * FROM pp_catigories");

$row2 = mysql_fetch_array($result2);
?>

<h2 align="center"><?php echo Admin_42; ?><br><br></h2>
<h3 align='center'><?php echo Admin_43; ?></h3>
<?php
if(isset($_GET["error"])){
echo "<font color='red'>This Category already exists</red>";

}
?>
<center>
<form action="catigories.php" method="POST">
<pre>
<table border="0" width="auto" height="auto">
<tr><td><?php echo Admin_43; ?>:</td><td><input type="text" name="add"></td><td><center><input type="submit" value="Add"></center></td></tr>
</table>
</pre>
</form>
<br>
<?php
echo"
<h3 align='center'>".Admin_21."</h3>
<table border='0' cellpadding='10'>
<pre>
";
$result = mysql_query("SELECT * FROM pp_catigories");
while($row = mysql_fetch_array($result)){
echo"
<tr><td>$row[name]&nbsp;&nbsp;&nbsp;</td><td><a href='catigories.php?del=$row[name]'>".Admin_21."</a></td></tr>
";
}
echo"
</pre>
</table>
";
?>
<br>
</center>


</pre>
</body>
</html>