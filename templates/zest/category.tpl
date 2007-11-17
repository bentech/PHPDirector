	{include file="header.tpl"}

			<div class="left_articles">
            				<h2>Categories</h2>
			<div align="center">
<table border="0" align="center">
{section name=i loop=$cat step=3} <!--ROWS EG change max=???-->
    <tr> 
{section name=cat loop=$cat start=$smarty.section.i.index max=3}<!-- COLUMNS EG change max=??? to the ammount and step=??? to the same ammount-->
	<td width="180" height="155" align="center">
	
	<table bgcolor="#EEEEEE">
  <tr>
    <td width="165"><h2>{$cat[cat].name|capitalize:true}
    </h2>
      <h2>        <a href="index.php?cat={$cat[cat].id}" ><img class="imageborder" height="97"{if $cat[cat].picture eq ""}src="templates/zest/images/bigimage.gif"{else} src="{$cat[cat].picture}"{/if}/></a></h2></td>
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