{include file="header.tpl"}
{section name=video loop=$video}
<div align='center'>
{if $reject eq "1"}
{$LAN_26}
{/if}
<br />
<h2>{$video[video].name}</h2>
<br />
<b>{$LAN_36}: </b>{$video[video].creator}
<br />
<a href="javascript:viewMore('description');" id="xtwo">+/- {$LAN_35}</a>:
<div id='description'>{$video[video].description}</div>
<br />
{include file="players.tpl"}
<br />
<b>{$LAN_32}: </b>{$video[video].views}<p>
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
{php}rating_bar($_GET["id"],5){/php}
</p></div>
{/section}
{include file="footer.tpl"}
