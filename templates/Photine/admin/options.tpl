{include file="admin_header.tpl"}
<h2 align="center">{$admin_8}</h2>
<form action="options.php?pt=options&pag=options" method="POST">
	<p>{$admin_30}
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
		<br />
		{$LAN_58}<br />
		<label><input name="lang" type="radio" value="en-gb" {if $options[options].lang eq "en-gb"}checked="checked"{/if} />
		English</label><!--<br />
		<label>	<input type="radio" name="lang" value="de" {if $options[options].lang eq "Deutsch"}checked="checked"{/if}/>German</label>--><br />
		{/section}<br />
		<input type="hidden" name="options" />
		<input name="submit" type="submit" value="Edit" /><br />
		<span class="redsmall">{$admin_44}</span></p>
</form>
</pre>
</body>
</html>
