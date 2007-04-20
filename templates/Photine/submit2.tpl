{include file="header.tpl"}
{if $noshow eq "1"}
{$submiterror}
{else}
{literal}
<script language="javascript"> 
function checkscript() {
	if (some value is/is not something) {
		// something is wrong
		alert('alert user of problem');
		return false;
	}
	else if (another value is/is not something) {
		// something else is wrong
		alert('alert user of problem');
		return false;
	}

	// If the script makes it to here, everything is OK,
	// so you can submit the form

	return false;
}
</script>
{/literal}
<div align="center">
	<!--Center Page-->
	<h3><b>Source</b>:{$source}</h3>
	<!--Source Of Media-->
	<b>Choose Default Screenshot</b>
	<form name="video" method="post" action="something.pl" onsubmit="return checkscript()">
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
		<br />
		<table width="83" border="0">
			<tr>
				<td height="21" align="center"><b>Title</b></td>
			</tr>
			<tr>
				<td height="21" align="center"><textarea name="title" cols="50" rows="1" id="title" style="text-align:center; text-shadow:#990000"{if $title eq ""}{else}disabled{/if}>{$title}</textarea></td>
				<td>
				<input name="authorcheck2" type="checkbox" onclick="SetState(this, this.form.title)" value="1" {if $author eq ""}{else}checked="checked"{/if}/></td>
			</tr>
			<tr>
				<td width="77" height="21" align="center"><b>Author</b></td>
			</tr>
			<tr>
				<td height="42"><textarea name="authortext" cols="50" rows="1" style="text-align:center;"{if $author eq ""}{else}disabled{/if}>{$author}</textarea>				</td>
				<td><input name="authorcheck" type="checkbox" onClick="SetState(this, this.form.authortext)" value="1" {if $author eq ""}{else}checked="checked"{/if}/>				</td>
			</tr>
			<tr>
				<td height="21" align="center"><b>Description</b></td>
			</tr>
			<tr>
				<td height="104"><textarea name="descriptiontext" cols="50" rows="6" style="text-align:center;" {if $description eq ""}{else}disabled{/if}>{$description}</textarea>				</td>
				<td><input name="descriptioncheck" type="checkbox" onClick="SetState(this, this.form.descriptiontext)" value="1" {if $description eq ""}{else}checked="checked"{/if}/>				</td>
			</tr>
			<tr>
				<td height="19" align="center"><b>Category</b></td>
			</tr>
			<tr>
				<td height="104" align="center"><select name="category" size="6">
						
        {section name=cat loop=$cat}<option value="{$cat[cat].id}">{$cat[cat].name}</option>{/section}

					</select>				</td>
				<td><input name="categorycheck" type="checkbox" onClick="SetState(this, this.form.category)" value="1"/></td>
			</tr>
		</table>
		<p align="center">{include file="players.tpl"} </p>
		<p align="center">
			<input type="submit" value="Submit" onClick="document.forms[0].submit()">
		</p>
	</form>
</div>
{/if}
{include file="footer.tpl"}