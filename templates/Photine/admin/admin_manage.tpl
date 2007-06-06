{include file="admin_header.tpl"}
			{if $pagevalue eq "all"}
				<h2>{$LAN_68}s</h2>   
			{elseif $pagevalue eq "feature"}
				<h2>{$LAN_53}</h2>
			{elseif $pagevalue eq "approve"}
				<h2>{$LAN_52}</h2>
			{elseif $pagevalue eq "rejected"}
				<h2>{$LAN_54}</h2>
			{/if}

			{if paginate_middle eq ""}
			no vids{else}

<table cellspacing="0" cellpadding="0" border="1" id="categorias"><tbody>
<div align="center">{paginate_prev}&nbsp;{paginate_next}</div>
	<tr class="categoria_h">
		<th class="s1">ID</th>
		<th class="s2">{$LAN_33}</th>
		<th class="s3">{$LAN_35}</th>
		<th class="s4">{$LAN_34}</th>
		<th class="s5">{$LAN_36}</th>
		<th class="s6">{$LAN_4}</th>
		<th class="s7">{$LAN_51}</th>
	</tr>
{section name=video loop=$video}	
<tr class="subcategoria">
	<td class="s1">	
		<a href="admin_videos.php?id={$video[video].id}&pag=vid" target="_blank">
		{$video[video].id}</a>
	</td>
	
	<td class="s2">
		<a href="admin_videos.php?id={$video[video].id}&pag=vid" target="_blank">
		{$video[video].name|truncate:80:'...'}</a>
	</td>
	
	<td class="s3">	
		{$video[video].description|truncate:250:'...'}
	
	</td>
	
	<td class="s4">
		{$video[video].date}
	</td>
	<td class="s5">	
		{$video[video].creator|truncate:40:'...'}
	</td>
	<td class="s6" align="center">
<a href='admin_videos.php?id={$video[video].id}&pag=vid'>
<img border='0' src='{if $video[video].video_type eq "YouTube"}{$video[video].ytpic}1.jpg' height='64'><img border='0' src='{$video[video].ytpic}2.jpg' height='64'><img border='0' src='{$video[video].ytpic}3.jpg' height='64'>
{else}{$video[video].picture}' height='64'>{/if}</a>
	</td>

	<td class="s7">
{if $video[video].approved eq "0"}
<a href='?id={$video[video].id}&what=approve&pt={$pagevalue}&page={$video[video].page}&pag=vid'>{$LAN_52}</a>
{/if}
{if $video[video].featured eq "0"}
<p><a href='?id={$video[video].id}&what=feature&pt={$pagevalue}&page={$page}&pag=vid'>{$LAN_53}</a></p>
{else}
<p><a href='?id={$video[video].id}&what=unfeature&pt={$pagevalue}&page={$page}&pag=vid'>Un{$LAN_53}</a></p>
{/if}
{if $video[video].rejected eq "0"}<p><a href='?id={$video[video].id}&what=reject&pt={$pagevalue}&page={$page}&pag=vid'>{$LAN_54}</a>
{$LAN_55}{else}<p>{/if}
<a href='?id={$video[video].id}&what=delete&pt={$pagevalue}&page={$page}&pag=vid'>{$LAN_56}</a></p>
	</td>
	</tr>
</tbody>
{/section}
	</table>
	</font></p>
	<br />{* display pagination info *}
    <p align="center">&nbsp;&nbsp;{paginate_prev}&nbsp;&nbsp;{paginate_next} <br />{paginate_middle page_limit="20"} </p>
	{/if}
</body>
</html>