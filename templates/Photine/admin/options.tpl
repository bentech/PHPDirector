{include file="admin_header.tpl"}
<h2 align="center">{$admin_8}</h2>
<form action="options.php" method="POST">
<center><b>{$admin_30}</b>
<p>
<pre>

<table border="0" width="auto" height="auto">
{section name=options loop=$options}
<tr><td>{$admin_22}:</td><td><input type="text" value="{$options[options].name}" name="name"></td></tr>
<tr><td>{$admin_41}:</td><td><input type="text" value="{$options[options].news}" name="news"></td></tr>
<tr><td>{$admin_23}:</td><td><input type="text" value="{$options[options].vids_per_page}" name="vids_per_page"></td></tr>
<tr><td>{$admin_24}:</td><td><input type="text" value="{$options[options].logo}" name="logo"></td></tr>
<tr><td>{$admin_26}:</td><td><input type="text" value="{$options[options].lang}" name="lang"></td></tr>
{/section}
<tr><td></td><td><tr><td><input type="hidden" name="options"></td><td>
<tr><td colspan="2"><center><input type="submit" value="Edit"></center></td></tr>
</table>
</form>
<br>
<br>
<br>
</center>
</pre>
</body>
</html>
