{include file="admin_header.tpl"}
{$message}
{section name=video loop=$video max=1}
{if $video[video].id eq ""}
<div align='center'> <font color='#FF0000' face='Arial Black' size='4'>{$LAN_29}</font></div>
{/if}
{/section}
<div align='center'> {section name=video loop=$video}
	<p>
	<h2>{$video[video].name}</h2>
	</p>
	<p> {if $video[video].approved eq "1"}<font color='#00CC00' face='Arial Black' size='4'>{$LAN_52}d</font>{else}<font color='#FF0000' face='Arial Black' size='4'>Un{$LAN_52}d</font>{/if}
		{if $video[video].feature eq "1"}<font color='#00CC00' face='Arial Black' size='4'>-{$LAN_53}ed</font>{/if}
		{if $video[video].reject eq "1"}<font color='#FF0000' face='Arial Black' size='4'>-{$LAN_54}ed</font>{/if} <br />
	<form id="category" name="category" method="post" action="admin_videos.php?pt={$pt}&amp;page={$page}&amp;id={$id}&amp;pag={$pag}">
		<select name="category">
			
{section name=categories loop=$categories}
	<option value="{$categories[categories].id}"{if $categories_current eq $categories[categories].id} selected="selected"{/if}>{$categories[categories].name}</option>
{/section}
	
		</select>
		<input type="hidden" name="id" value="{$video[video].id}" />
		<input type="submit" name="Submit" value="Update Category" />
	</form>
	<img border='0' src='{if $video[video].video_type eq "YouTube"}http://img.youtube.com/vi/{$video[video].file}/1.jpg' height='100'> <img border='0' src='http://img.youtube.com/vi/{$video[video].file}/2.jpg' height='100'> <img border='0' src='http://img.youtube.com/vi/{$video[video].file}/3.jpg' height='100'> {else}
	{$video[video].picture}' height='100'>{/if}
	<div style='border:3px dashed #808080; position: absolute; z-index: 1; left: 200px; top: 350px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px;' id='layer1'> {if $video[video].approved eq "0"} <a href='?{if $pt eq "approve"}id={$video[video].id}&amp;{/if}what=approve&amp;pag=vid&amp;pt={$pt}&amp;id={$id}'>{$LAN_52}</a> {/if}
		
		{if $video[video].feature eq "0"}
		<p><a href='?{if $pt eq "approve"}id={$video[video].id}&mp;{/if}what=feature&amp;pag=vid&amp;pt={$pt}&amp;id={$id}'>{$LAN_53}</a></p>
		{else}
		<p><a href='?{if $pt eq "approve"}id={$video[video].id}&amp;{/if}what=unfeature&amp;pag=vid&amp;pt={$pt}&amp;id={$id}'>Un{$LAN_53}</a></p>
		{/if}
		
		{if $video[video].reject eq "0"} <a href='?{if $pt eq "approve"}id={$video[video].id}&amp;{/if}what=reject&amp;pag=vid&amp;pt={$pt}&amp;id={$id}'>{$LAN_54}</a> or
		{/if} <a href='?{if $pt eq "approve"}id={$video[video].id}&amp;{/if}what=delete&amp;pag=vid&amp;pt={$pt}&amp;id={$id}'>{$LAN_56}</a></div>
	<br />
	{$player_code} <br />
	<b>{$LAN_36}:</b>{$video[video].creator} <br />
	<b>{$LAN_35}:</b>{$video[video].description} <br />
	<br />
	<b>ID:</b>{$video[video].id}
	{/section} </div>
</html>