<?php 
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
<?php echo "<b>".LAN_36.":</b> ".show_sql($row['creator']); //Creator?>
<br />
<a href="javascript:void();" onclick="show_hide('exampletbl')">+/- <?php echo LAN_35; ?></a>
<?php echo "<b>:</b>  <table border='0' id='exampletbl'><tr><td>".show_sql($row['description'])."</td></tr></table>"; //Description?>
<br />
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