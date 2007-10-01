	{include file="header.tpl"}

			<div class="left_articles">
            				<h2>Categories</h2>
			<div align="center">
<table border="0" align="center">
{section name=i loop=$cat step=3 max=6} <!--ROWS EG change max=???-->
    <tr> 
{section name=cat loop=$cat start=$smarty.section.i.index max=3}<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
	<td align="center">
	
	<table border="0">
  <tr>
    <td colspan="3"><h3>{$cat[cat].name|capitalize:true}</h3></td>
  </tr>
  <tr>
    <td rowspan="2"><span class="catVstill"><a href="index.php?cat={$cat[cat].id}"><img border="0" height="97"{if $cat[cat].picture eq ""}src="templates/zest/images/bigimage.gif"{else} src="{$cat[cat].picture}"{/if} {if $firefox eq "1"}class="reflect" alt="Sorry No Image Yet"{/if} /></a></span></td>
    <td><p>Recent Video:</p>
    <p>Mad Max Poll</p></td>
  </tr>

</table>

	</a></td>
    {/section}
    </tr>
{/section}
</table>
</div>
		  </div>
                   
            
	           </div>	
	
{include file="footer.tpl"}