{include file="header.tpl"}
{section name=video loop=$video}
<div align='center'>
{if $reject eq "1"}
{$LAN_26}
{/if}
<h2>{$video[video].name}</h2>
<p><b>{$LAN_36}:</b><br />
	{$video[video].creator}	</p>
{include file="players.tpl"}<br />
{rating_bar units='5' id=$video[video].id}<br />
		<strong>{$LAN_35}:</strong>
		<br />
<div id='description'>{$video[video].description}</div>
<br />
<b>{$LAN_32}: </b>{$video[video].views}
{/section}
</div>
{include file="footer.tpl"}