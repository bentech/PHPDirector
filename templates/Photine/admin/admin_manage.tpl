{include file="admin_header.tpl"}
			{if $pagevalue eq "all"}
				<h2>{$admin_34}</h2>   
			{elseif $pagevalue eq "feature"}
				<h2>{$admin_5}</h2>
			{elseif $pagevalue eq "approve"}
				<h2>{$admin_4}</h2>
			{elseif $pagevalue eq "rejected"}
				<h2>{$admin_6}</h2>
			{/if}
			
			{if paginate_middle eq ""}
			no vids{else}
<table cellspacing="0" cellpadding="0" border="1" id="categorias"><tbody>
	<tr class="categoria_h">
		<th class="s1">ID</th>
		<th class="s2">{$admin_9}</th>
		<th class="s3">{$admin_10}</th>
		<th class="s4">{$admin_11}</th>
		<th class="s5">{$admin_12}</th>
		<th class="s6">{$admin_13}</th>
		<th class="s7">{$admin_14}</th>
	</tr>
{section name=video loop=$video}	
<tr class="subcategoria">
	<td class="s1">	
		<a href="admin_videos.php?id={$video[video].id}&pag=vid" target="_blank">
		{$video[video].id}</a>
	</td>
	
	<td class="s2">
		<a href="admin_videos.php?id={$video[video].id}&pag=vid" target="_blank">
		{$video[video].name}</a>
	</td>
	
	<td class="s3">	
		{$video[video].description}
	
	</td>
	
	<td class="s4">
		{$video[video].date}
	</td>
	<td class="s5">	
		{$video[video].creator}
	</td>
	<td class="s6">
<a href='admin_videos.php?id={$video[video].id}&pag=vid'>
<img border='0' src='{if $video[video].video_type eq "YouTube"}{$video[video].ytpic}1.jpg' height='64'><img border='0' src='{$video[video].ytpic}2.jpg' height='64'><img border='0' src='{$video[video].ytpic}3.jpg' height='64'>
{else}{$video[video].picture}' height='64'>{/if}</a>
	</td>


	<td class="s7">
<a href='?id={$video[video].id}&what=approve&pt={$pagevalue}&page={$video[video].page}&pag=vid'>{$admin_16}</a>
<p><a href='?id={$video[video].id}&what=feature&pt={$pagevalue}&page={$page}&pag=vid'>{$admin_35}</a></p>
<p><a href='?id={$video[video].id}&what=reject&pt={$pagevalue}&page={$page}&pag=vid'>{$admin_19}</a>{$admin_20}<a href='?id={$video[video].id}&what=delete&pt={$pagevalue}&page={$page}&pag=vid'>{$admin_21}</a></p>
	</td>
	</tr>
</tbody>
{/section}
	</table>
	</font></p>
	<br />{* display pagination info *}
    {paginate_prev} {paginate_middle} {paginate_next}
	{/if}
</body>
</html>