<h2 align="center">{$admin_42}<br><br></h2>
<h3 align='center'>{$admin_43}</h3>
<center>
<form action="catigories.php" method="POST">
<pre>
<table border="0" width="auto" height="auto">
<tr><td>{$admin_43}:</td><td><input type="text" name="add"></td><td><center><input type="submit" value="Add"></center></td></tr>
</table>
</pre>
</form>
<br>
<h3 align='center'>{$admin_21}</h3>
<table border='0' cellpadding='10'>
<pre>
{section name=cat loop=$cat}
<tr><td>{$cat[cat].name}&nbsp;&nbsp;&nbsp;</td><td><a href='catigories.php?del={$cat[cat].name}'>{$admin_21}</a></td></tr>
{/section}
</pre>
</table>
<br>
</center>
</pre>
</body>
</html>