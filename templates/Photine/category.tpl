{include file="header.tpl"}

<table border="0" align="center">
{section name=i loop=$cat step=4 max=6} <!--ROWS EG change max=???-->
    <tr> 
{section name=cat loop=$cat start=$smarty.section.i.index max=4}<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
	<td align="center"><b>{$cat[cat].name}</b><br /><img width="153" height="120" src="{$cat[cat].picture}" class="reflect" />
</td>
    {/section}
    </tr>
{/section}
</table>
{include file="footer.tpl"}