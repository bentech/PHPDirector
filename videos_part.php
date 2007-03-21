<?php 
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
if(!isset($_COOKIE["$id"])){
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
?>
<br />
<?php echo "<h2>".show_sql($row['name'])."</h2>";?>
<br />
<?php echo "<b>".LAN_36.":</b> ".show_sql($row['creator']); //Creator
?>
<br />
<a href="javascript:void();" onclick="show_hide('exampletbl')">+/- <?php echo LAN_35; ?></a>
<?php echo "<b>:</b> <table border='0' id='exampletbl'><tr><td>".show_sql($row['description'])."</td></tr></table>";?>
<br />
<?php 
include("includes/players.inc.php");
?>
<br />
<center>
<?php
$display_video_views = $row["views"];
echo LAN_32.": <b>$display_video_views</b><p>";
?>
</center>
<?php
require('_drawrating.php');
?>

<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
<?php rating_bar($row['id'],5); ?>