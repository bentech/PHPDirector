{include file="header.tpl"}
{literal}
<script>
function checkform()
{
	if (document.video.titletext.value == '') {
	alert('Please Enter A Title');
	return false;
	}	
	else if (document.video.descriptiontext.value == '')
	{
	alert('Please Enter A description');
	return false;
	}
	else if (document.video.authortext.value == '')
	{
	alert('Please Enter A Author');
	return false;
	}
	else if(!document.video.picture[0].checked && !document.video.picture[1].checked && !document.video.picture[2].checked) {
	alert('Please Choose A Screenshot');
	return false;
}
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}</script>
{/literal}
<div align="center">
	<!--Center Page-->
	<h3><b>Source</b>:{$source}</h3>
	<!--Source Of Media-->
	<b>Confirm Default Screenshot</b>
	<form action="submit.php?pt=submit&part=3" method="post" name="video" onSubmit="return checkform()">
		<table width="136" border="0">
			<!--Shows All The Images-->
			<tr> {section name=default loop=$image}
				<td  align="center" width="130"><img src="{$image[default]}" alt="{$title}" width="130" height="97" /> </td>
				{/section} </tr>
			<tr> {section name=default loop=$image}
				<td align="center"><input name="picture" type="radio" value="{$image[default]}" />
				</td>
				{/section} </tr>
		</table>
		<!-- END - Shows All The Images-->
		<table width="83" border="0">
			<tr>
				<td height="21" align="center"><b>Title</b></td>
			</tr>
			<tr>
				<td height="21" align="center"><textarea name="titletext" cols="50" rows="1" id="titletext" style="text-align:center; text-shadow:#990000">{$title}</textarea></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="77" height="21" align="center"><b>Author</b></td>
			</tr>
			<tr>
				<td height="42"><textarea name="authortext" cols="50" rows="1" style="text-align:center;">{$author}</textarea>				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td height="21" align="center"><b>Description</b></td>
			</tr>
			<tr>
				<td height="104"><textarea name="descriptiontext" cols="50" rows="6" style="text-align:center;">{$description}</textarea>				</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td height="19" align="center"><b>Category</b></td>
			</tr>
			<tr>
				<td height="104" align="center"><select name="category" size="6">
						
						
        {section name=cat loop=$cat}
						<option value="{$cat[cat].id}" {if $cat[cat].id eq "1"}selected="selected"{/if}>{$cat[cat].name}</option>
		{/section}

					
				
					</select>				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<p align="center">{include file="players.tpl"} </p>
		<p align="center">
			<input type="submit" value="Submit">
		</p>
	</form>
</div>
{include file="footer.tpl"}