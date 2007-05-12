{include file="header.tpl"}
<strong>{$LAN_30}</strong>
<table border="0" align="center">
	 {section name=i loop=$images step=6 max=16}
	<!--ROWS EG change max=???-->
	<tr> {section name=images loop=$images start=$smarty.section.i.index max=6}
		<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
		<td><a href="videos.php?id={$images[images].id}"><img border="0" src="{$images[images].picture}" align="right" height="97" width="130" alt="" {if $firefox eq "1"}class="reflect rheight20 ropacity50"{/if}/></a></td>
		{/section} </tr>
	{/section}
</table>
{include file="footer.tpl"} 