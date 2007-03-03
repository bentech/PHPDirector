<?php 
if($row["video_type"] == "YouTube"){
echo'
<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$row['file'].'" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>
';
}
elseif($row["video_type"] == "GoogleVideo"){
echo'
<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='.$row['file'].'" flashvars=""> </embed>
';
}
?>