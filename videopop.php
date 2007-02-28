<?php
define("PHPdirector", 1);
?>
<?php
$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
?>

<html>
<head>
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
</head>
<body>
<?php
include("db.php");
include("includes/function.inc.php");
include("lang/".config("lang")."/lang.inc.php");
?>
<?php $id = $_GET["id"];
if ( $id == "" ) {
    echo "Please do not browse videos this way<br />";
}
// Get a specific result from the "pp_files" table
$result = mysql_query("SELECT * FROM pp_files
WHERE id=$id") or die();  

// get the first (and hopefully only) entry from the result
$row = mysql_fetch_array( $result );
?>

<?php 
if($row['approved'] == "1") {
echo "<div align='center'>";
include("_drawrating.php");
include("videos_part_pop.php");
echo "</div>";
}
?>

<?php 
if($row['approved'] == "0") {
echo "<p align='center'><b><font size='7' color='#800000'>This video is not approved 
yet</font></b></p>
";
}
?>

<?php 
if($row['approved'] == "") {
echo "<p align='center'><b><font size='5' color='#800000'>This is not a valid video Link</font></b></p>
";
}
?>
</body>
</html>
