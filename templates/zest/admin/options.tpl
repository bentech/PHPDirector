{include file="admin_header.tpl"}
<h2 align="center">Options</h2>
<form action="options.php?pt=options&pag=options" method="POST">
	<p>
</p>
	<p align="center">Title<br />
		<input name="name" type="text" value="{$name}" size="30" maxlength="200" />
	</p>
	<p align="center">Slogan<br />
      <input name="slogan" type="text" id="slogan" value="{$slogan}" size="30" maxlength="200" />
</p>
	<p align="center">Header Logo<br />
      <input name="image" type="text" id="image" value="{$image}" size="30" maxlength="200" />
<br />
		<br />
		News<br />
		<textarea name="news" cols="30" rows="2">{$news}
		</textarea>
		<br />
		<br />
		Videos Per Page<br />
		<input name="vids_per_page" type="text" value="{$vids_per_page}" size="2" maxlength="2" />
		<br />
	</p>
<p align="center">Template<br />
		<input name="template" type="text" value="{$template}" size="10" maxlength="30" />
	</p>
	<p align="center">
<br />
		<input type="hidden" name="options" />
		<input name="submit" type="submit" value="Edit" />
		<br />
		</p>
</form>
</pre>
</body>
</html>
