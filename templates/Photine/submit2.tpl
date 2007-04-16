{include file="header.tpl"}

<body>
<h1 align="center" class="submit">{$title}</h1>
<h3 align="center" class="submit"><strong>Source</strong>:{$source}</h3>
<div align="center" class="submit"><strong>Choose Default Screenshot  </strong>
<form>  <table width="405" border="0">
    <tr>
	{section name=default loop=$image}
      <td  align="center" width="130"><img src="{$image[default]}" alt="{$title}" width="130" height="97" /></td>
	  {/section}
  </tr>
    <tr>
	{section name=default loop=$image}
      <td align="center"><input name="picture" type="radio" value="{$image[default].id}" /></td>
	  {/section}
    </tr>
  </table>
<br />
</div>
<div align="center" class="submit">
  <table width="83" border="0" align="center" cellpadding="0">

    <tr>
      <td width="77" height="21" align="center"><div align="center"><strong>Author</strong></div></td>
      <td width="77">&nbsp;</td>
    </tr>
    <tr>
	
      <td height="42"> <textarea name="authortext" cols="50" rows="1" style="text-align:center;" {if $author eq ""}{else}disabled{/if}>{$author}</textarea></td>
     <td><div class="required"><input name="authorcheck" type="checkbox" {if $author eq ""}{else}checked="checked"{/if} onClick="SetState(this, this.form.authortext)"/></div></td>
    </tr>
    <tr>
      <td height="21"><div align="center"><strong>Description</strong></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="104"><textarea name="descriptiontext" cols="50" rows="6" style="text-align:center;" {if $description eq ""}{else}disabled{/if}>{$description}</textarea></td>
      <td><input name="descriptioncheck" type="checkbox" {if $description eq ""}{else}checked="checked"{/if} onClick="SetState(this, this.form.descriptiontext)"/></td>
    </tr>
    <tr>
      <td height="19"><div align="center"><strong>Category</strong></div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="104"><div align="center">
        <select name="category" size="6">
		{section name=cat loop=$cat}
          <option value="{$cat[cat].id}">{$cat[cat].name}</option>
		 {/section}
         </select>
      </div></td>
      <td><input name="categorycheck" type="checkbox" onClick="SetState(this, this.form.category)"/></td>
    </tr>
  </table>
</div>
<p align="center" class="submit">
 {include file="players.tpl"}
</p>
<p align="center" class="submit">
  <input type="submit" name="Submit" value="Submit" />
</p>
</form>

</body>
{include file="footer.tpl"}