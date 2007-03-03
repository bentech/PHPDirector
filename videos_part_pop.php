<?php
if(!isset($_COOKIE["$id"])){ 
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
?>
<?php 
if($row["video_type"] == "YouTube"){
echo'
<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$row['file'].'" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>
';
}else{
echo'
<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='.$row['file'].'" flashvars=""> </embed>
';
}
?>
<br /><?php echo "<b>".LAN_36.":</b> ".$row['creator'];?>
<br/><span class="Warning">Rate to close the page</span>
<?php rating_bar($row['id'],5); ?>
<a href="javascript:void();" onclick="show_hide('exampletbl')">+/- <?php echo LAN_35; ?></a>
<?php echo "<b>:</b> <table border='0' id='exampletbl'><tr><td>".$row['description']."</td></tr></table>";?>
<br>
<center>
<?php
$display_video_views = $row["views"];
echo LAN_32.": <b>$display_video_views</b><p>";
?>
</center>