	{include file="header.tpl"}
			<div class="left_articles">

	<h2>Images</h2>

{* Alligning *}
	<div align="center">
<table border="0" align="center">


{* Change max = for rows *}
	 {section name=i loop=$images step=4 max=16}
	 
	 
{* Change max = below for columns and step = above *}
	<tr> {section name=images loop=$images start=$smarty.section.i.index max=4}
	
	

		<td>
		
		{* The Link To To The video *}
		<a href="videos.php?id={$images[images].id}">
		
		{* The image, with if firefox then reflect *}
		<img src="{$images[images].picture}" border="0" height="97" width="130" alt="" {if $firefox eq "1"}class="imageborder2 reflect rheight20 ropacity50"{/if}/>
		
		</a>
		</td>
		{/section} </tr>
	{/section}
</table>
</div>
</div>
</div>
{include file="footer.tpl"}