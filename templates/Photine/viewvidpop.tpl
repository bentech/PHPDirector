{section name=video loop=$video}
<div align='center'>
{if $reject eq "1"}
		{$LAN_26}
		{/if}
	{include file="players.tpl"}<br />
	{rating_bar units='5' id=$video[video].id}<span class="redsmall">Rate To Close</span><br />
	
		<b>{$LAN_36}: </b>{$video[video].creator} <br />
		<b>{$LAN_35}</b>:
		{$video[video].description} <br />
		<b>{$LAN_32}: </b>{$video[video].views}</p>
	<p>

</p></div>
{/section}