<?php
if(!isset($_COOKIE["$id"])){ 
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
?>
<?php 
include("includes/players.inc.php");
?>
<br /><?php echo "<b>".LAN_36.":</b> ".$row['creator'];?>
<br/><span class="Warning">Rate to close the page</span>
<?php rating_bar($row['id'],5); ?>
<a href="javascript:void();" onclick="show_hide('exampletbl')">+/- <?php echo LAN_35; ?></a>
<?php echo "<b>:</b> <table border='0' id='exampletbl'><tr><td>".show_sql($row['description'])."</td></tr></table>";?>
<br>
<center>
<?php
$display_video_views = $row["views"];
echo LAN_32.": <b>$display_video_views</b><p>";
?>
</center>