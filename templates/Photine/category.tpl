{include file="header.tpl"}
<div align="center">
<table border="0" align="center">
{section name=i loop=$cat step=4 max=6} <!--ROWS EG change max=???-->
    <tr> 
{section name=cat loop=$cat start=$smarty.section.i.index max=4}<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
	<td align="center"><a href="index.php?cat={$cat[cat].id}"><b>{$cat[cat].name}</b><br />
	<img border="0" {if $cat[cat].picture eq ""}src="templates/Photine/images/image.gif"{else} width="153" height="120" src="{$cat[cat].picture}"{/if} {if $firefox eq "1"}class="reflect" alt="Sorry No Image Yet"{/if} />
	
	</a></td>
    {/section}
    </tr>
{/section}
</table>
</div>
{include file="footer.tpl"}