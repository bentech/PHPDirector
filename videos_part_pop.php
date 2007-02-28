<?php
if(!isset($_COOKIE["$id"])){ 
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
?>

<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/<?php echo "".$row['file'];?>" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>
<br /><?php echo "<b>".LAN_36.":</b> ".$row['creator']; //Creator?>
<br/><span class="Warning">Rate to close the page</span>
<?php rating_bar($row['id'],5); ?>
<?php echo "<b>".LAN_35.":</b> ".$row['description']; //description?>
<br>
<center>
<?php
$display_video_views = $row["views"];
echo LAN_32.": <b>$display_video_views</b><p>";
?>
</center>