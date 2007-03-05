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
elseif($row["video_type"] == "dailymotion"){
function dmgetfile($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("/swf/",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("\"",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

echo'<div><object width="425" height="335"><param name="movie" value="http://www.dailymotion.com/swf/'.dmgetfile($row['file']).'"></param><param name="allowfullscreen" value="true"></param><embed src="http://www.dailymotion.com/swf/'.dmgetfile($row['file']).'" type="application/x-shockwave-flash" width="425" height="334" allowfullscreen="true"></embed></object></div>';


}else{
echo "this video type is currently unsuppotred";
}
?>