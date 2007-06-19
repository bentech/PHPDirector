{include file="header.tpl"}

{* $LAN_30 = New way to browse Videos *}
<strong>{$LAN_30}</strong>

{* Alligning *}
	<div align="center">
<table border="0" align="center">


{* Change max = for rows *}
	 {section name=i loop=$images step=6 max=16}
	 
	 
{* Change max = below for columns and step = above *}
	<tr> {section name=images loop=$images start=$smarty.section.i.index max=6}
	
	

		<td>
		
		{* The Link To To The video *}
		<a href="videos.php?id={$images[images].id}">
		
		{* The image, with if firefox then reflect *}
		<img src="{$images[images].picture}" border="0" height="97" width="130" alt="" {if $firefox eq "1"}class="reflect rheight20 ropacity50"{/if}/>
		
		</a>
		</td>
		{/section} </tr>
	{/section}
</table>
</div>
{include file="footer.tpl"} 