{include file="header.tpl"}
<table border="0" align="center">
	<b>{$LAN_30}</b> {section name=i loop=$images step=6 max=16}
	<!--ROWS EG change max=???-->
	<tr> {section name=images loop=$images start=$smarty.section.i.index max=6}
		<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
		<td><a href="videos.php?id={$images[images].id}"><img border="0" src="{$images[images].picture}" align="right" height="97" width="130" alt="" class="reflect rheight20 ropacity50"/></a></td>
		{/section} </tr>
	{/section}
</table>
{include file="footer.tpl"} 