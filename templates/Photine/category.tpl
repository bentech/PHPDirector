{include file="header.tpl"}
{section name=cat loop=$cat}
<img width="153" height="120" src="{$cat[cat].picture}" />
{$cat[cat].name}
<br />
{/section}
{include file="footer.tpl"}