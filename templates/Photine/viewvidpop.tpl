{section name=video loop=$video}
<div align='center'>
{if $reject eq "1"}
{$LAN_26}
{/if}
{include file="players.tpl"}
<br />
<b>{$LAN_36}: </b>{$video[video].creator}
<br />
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
{rating_bar units='5' id=$video[video].id}
<br />
<a href="javascript:viewMore('description');" id="xtwo">+/- {$LAN_35}</a>:
<div id='description'>{$video[video].description}</div>
<br />
<b>{$LAN_32}: </b>{$video[video].views}<p>

</p></div>
{/section}