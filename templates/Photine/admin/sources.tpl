{include file="admin_header.tpl"}
<center>
<h2>{$LAN_69|default:"Source"}<br></h2>

{* If there is a error show this *}
{if $error ne ""}
<h3>{$error}<br></h3>
{/if}
<br />
<h3>{$LAN_65|default:"Edit"}</h3>

<table width="200" border="0">
  {section name=source loop=$source}


  <tr>
    <td height="53">
    
     {if $source[source].disable eq "1"}
    <span style="color: #FF0000">
    {else}
    <span style="color:  #009900">
    {/if}
    <h3>{$source[source].name}</h3></span>
    
    </td>
    {if $source[source].disable eq "1"}
    <td><a href='sources.php?pt=sources&amp;pag=options&amp;enable={$source[source].id}'>{$LAN_70|default:"Enable"}</a></td>
    {else}
    <td><a href='sources.php?pt=sources&amp;pag=options&amp;disable={$source[source].id}'>{$LAN_71|default:"Disable"}</a></td>
    {/if}
  </tr>

{/section}
</table>
</center>
</pre>
</body>
</html>