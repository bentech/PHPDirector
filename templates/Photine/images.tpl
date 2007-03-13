{include file="header.tpl"}

<b>lan30</b>
<table border="0" width="100%"><tr><td>

{section name=images loop=$images}
<a href="videos.php?id={$images[images].id}"><img border="0" src="{$images[images].picture}" align="right" height="97" width="130" alt=""/>
{/section}

<tr><td></td></tr>
</td></tr></table>

{include file="footer.tpl"}