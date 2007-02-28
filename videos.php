<?php
define("PHPdirector", 1);

$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);

// includes
require("header.php");

// start code
if ($id == null) {
    echo "<br><center>".LAN_28."<br /></center>"; //dont browse videsos this way
	exit;
}
// Get a specific result from the "pp_files" table
$result = mysql_query("SELECT * FROM pp_files
WHERE id=$id") or die();  
$row = mysql_fetch_array( $result );
// get the first (and hopefully only) entry from the result

?>

<?php
if ($row['reject'] == "1") {
echo "<div align='center'>".LAN_26."</div>"; //Rejected
include("footer.php");
exit;
}
?>
<?php 
///error in this line!
//if($row['approved'] == "0") {
if($row['feature'] = null) {
echo "<p><center>".LAN_27."</center></p>"; //Doesnt exist
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