{if $vidtype eq "YouTube"}

<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/{if $video[video].file eq ""}{$videoid}{else}{$video[video].file}{/if}" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>

{elseif $vidtype eq "GoogleVideo"}

<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId={if $video[video].file eq ""}{$videoid}{else}{$video[video].file}{/if}" flashvars=""> </embed>

{elseif $vidtype eq "dailymotion"}

<div><object width="425" height="335"><param name="movie" value="http://www.dailymotion.com/swf/{if $video[video].file eq ""}{$videoid}{else}{$video[video].file}{/if}"></param><param name="allowfullscreen" value="true"></param><embed src="http://www.dailymotion.com/swf/{if $video[video].file eq ""}{$videoid}{else}{$video[video].file}{/if}" type="application/x-shockwave-flash" width="425" height="334" allowfullscreen="true"></embed></object></div>

{else}
This video type is currently unsuppotred
{/if}