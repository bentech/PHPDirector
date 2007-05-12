{include file="admin_header.tpl"}
<h2 align="center">{$LAN_40}<br></h2>
<h3 align="center">{$error}<br></h3>
<center><form action="categories.php?pt=categories&pag=options" method="POST"><pre><input type="text" name="add" /><input name="submit" type="submit" value="Add" /></form>
</pre>
<br />
<h3 align='center'>{$LAN_65}</h3>

<table width="410" border='0' cellpadding='10'>
<tr><td width="113"></td><td width="79" align="center"><a href='categories.php?pt=categories&pag=options&del={$cat[cat].id}'></a>
{$LAN_4}</td>
	<td width="79" align="center"></td>
	<td width="242"></td>
</tr>

{section name=cat loop=$cat}
<form action="categories.php?pt=categories&pag=options" method="POST">
<tr><td width="113"><input name="name" type="text" value="{$cat[cat].name}" size="25" /></td><td width="79">
	<input name="image" type="text" value="{$cat[cat].image}" size="25" /></td>
	<td width="79"><input name="imageid" type="hidden" value="{$cat[cat].id}" />	<input type="submit" name="Submit" value="Update" />
	</form></td>
	<td width="242"><a href='categories.php?pt=categories&amp;pag=options&amp;del={$cat[cat].id}'>{$LAN_56}</a>
		</td></tr>
{/section}
</table>
</p>
</center>
</pre>
</body>
</html>