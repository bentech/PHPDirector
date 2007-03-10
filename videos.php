<?php
define("PHPdirector", 1);
if(isset($_GET["id"])){
$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
}
// includes
require("header.php");

if(isset($_GET["id"])){
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();  
}else{
$result = mysql_query("select * from pp_files WHERE approved='1' AND reject='0' order by rand() limit 1") or die();  
}
$row = mysql_fetch_array($result);
?>

<?php
if ($row['reject'] == "1") {
echo "<div align='center'>".LAN_26."</div>";
include("footer.php");
exit;
}
?>
<?php 
if($row['feature'] = null) {
echo "<p><center>".LAN_27."</center></p>";
include("footer.php");
exit;
}
?>


<div align='center'>
<?php 

include("videos_part.php");
?>
</div>
<?php include("footer.php")?>