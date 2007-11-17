{include file="admin_header.tpl"}
			{if $pagevalue eq "all"}
				<h2>All Videos</h2>   
			{elseif $pagevalue eq "feature"}
				<h2>Featured Videos</h2>
			{elseif $pagevalue eq "approve"}
				<h2>Approved Videos</h2>
			{elseif $pagevalue eq "rejected"}
				<h2>Rejected Videos</h2>
			{/if}

			{if paginate_middle eq ""}
			no vids{else}

<table cellspacing="0" cellpadding="0" border="1" id="categorias"><tbody>
<div align="center">{paginate_prev}&nbsp;{paginate_next}</div>
	<tr class="categoria_h">
		<th class="s1">ID</th>
		<th class="s2">Name</th>
		<th class="s3">Description</th>
		<th class="s4">Date</th>
		<th class="s5">Author</th>
		<th class="s6">Images</th>
		<th class="s7">Action</th>
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
<a href='?id={$video[video].id}&what=approve&pt={$pagevalue}&page={$video[video].page}&pag=vid'>Approve</a>
{/if}
{if $video[video].featured eq "0"}
<p><a href='?id={$video[video].id}&what=feature&pt={$pagevalue}&page={$page}&pag=vid'>Feature</a></p>
{else}
<p><a href='?id={$video[video].id}&what=unfeature&pt={$pagevalue}&page={$page}&pag=vid'>Unfeature</a></p>
{/if}
{if $video[video].rejected eq "0"}<p><a href='?id={$video[video].id}&what=reject&pt={$pagevalue}&page={$page}&pag=vid'>Reject</a></p>{else}
<a href='?id={$video[video].id}&what=delete&pt={$pagevalue}&page={$page}&pag=vid'>Delete</a></p>{/if}
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