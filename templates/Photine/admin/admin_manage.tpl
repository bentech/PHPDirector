{if $pagevalue eq ""}
    <div align='center'><p><h2><?php echo Admin_33;?></h2></p></div>
{elseif $pagevalue eq "home"}
<h2>FRAMED HOME</h2>
<p>
<iframe name="homepage" src="../" width="100%" height="2050" border="0" frameborder="0" marginwidth="1" marginheight="1" scrolling="no" align="top">
Please Use Firefox
</iframe></p>
{else}
{if $vidsammount == "0"}
	{if $pagevalue eq "approve"}
	<div align='center'><h2>No Videos To Approve</h2></div>
	{else}
	<div align='center'><h2>No Videos Here</div></h2>
	{/if}
{else}
{if $pagevalue eq "all"}
 <h2>{$admin34}</tr></h2>   

{elseif $pagevalue eq "feature"}
<h2>{$admin5}</h2></tr>

{elseif $pagevalue eq "approve"}
<h2>{$admin4}</h2></tr>

{elseif $pagevalue eq "rejected"}
<h2>{$admin6}</h2></tr>
{/if}
<table cellspacing="0" cellpadding="0" border="1" id="categorias"><tbody>
	<tr class="categoria_h">
		<th class="s1">ID</th>
		<th class="s2">{$admin9}</th>
		<th class="s3">{$admin10}</th>
		<th class="s4">{$admin11}</th>
		<th class="s5">{$admin12}</th>
		<th class="s6">{$admin13}</th>
		<th class="s7">{$admin14}</th>
	</tr>

{section name=video loop=$video}		

<tr class="subcategoria">
	<td class="s1">	
		<a href="admin_videos.php?id={$video[video].id}" target="_blank">
		{$video[video].id}</a>
	</td>
	
	<td class="s2">
		<a href="admin_videos.php?id={$video[video].id}" target="_blank">
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
<a href='videos.php?id={$video[video].id}'><img border='0' src='images/noimage.bmp' height='64'></a>

	</td>

	<td class="s7">
<a href='?id={$video[video].id}&what={$approve}&pt={$pagevalue}&page={$video[video].page}'>{$approve}</a>
<p><a href='?id={$video[video].id}&what={$featureapprove}&pt={$pagevalue}&page={$page}'>{$featureapprove}</a></p>
<p><a href='?id={$video[video].id}&what={$feature}&pt={$pagevalue}&page={$page}'>{$feature}</a></p>
<p><a href='?id={$video[video].id}&what={$reject}&pt={$pagevalue}&page={$page}'>{$reject}</a></p>
	</td>
	</tr>
</tbody>
{section}
	</table>
	</font></p>

</body>
</html>
{/if}{/if}