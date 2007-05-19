{include file="admin_header.tpl"}
<h2 align="center">{$LAN_48}</h2>
<form action="options.php?pt=options&pag=options" method="POST">
	<p>
		{section name=options loop=$options}</p>
	<p align="center"> {$LAN_33}<br />
		<input name="name" type="text" value="{$options[options].name}" size="30" maxlength="200" />
		<br />
		<br />
		{$LAN_67}<br />
		<textarea name="news" cols="30" rows="2">{$options[options].news}</textarea>
		<br />
		<br />
		{$LAN_57}<br />
		<input name="vids_per_page" type="text" value="{$options[options].vids_per_page}" size="2" maxlength="2" />
		<br />
	</p>
	<p align="center">{$LAN_69}<br />
		<input name="template" type="text" value="{$options[options].template}" size="10" maxlength="30" />
	</p>
	<p align="center"><br />
		{$LAN_58}<br />
		<label><input name="lang" type="radio" value="en-gb.inc.php" {if $options[options].lang eq "en-gb.inc.php"}checked="checked"{/if} />English</label>
		<br />
		<label><input name="lang" type="radio" value="fr.inc.php" {if $options[options].lang eq "fr.inc.php"}checked="checked"{/if} />French</label>
		<br />
		{/section}<br />
		<input type="hidden" name="options" />
		<input name="submit" type="submit" value="Edit" />
		<br />
		<span class="redsmall">{$LAN_66}</span></p>
</form>
</pre>
</body>
</html>
