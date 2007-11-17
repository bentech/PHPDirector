{include file="header.tpl"}
{section name=video loop=$video}
<div align='center'>
{if $reject eq "1"}
This Video Was Rejected
{/if}
<h2>{$video[video].name}</h2>
<p><b>Author:</b><br />
	{$video[video].creator}	</p>
{$player_code}<br />
{rating_bar units='5' id=$video[video].id}
<strong>Description:</strong>
		<br />
<div id='description'>{$video[video].description}</div>
<br />
<b>Views: </b>{$video[video].views}
{/section}
</div>
</div>
{include file="footer.tpl"}