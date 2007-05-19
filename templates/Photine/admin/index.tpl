{include file="admin_header.tpl"}
<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total} //tota
*}-->
<h1 align="center">{$LAN_61}</h1>
<p align="center">&nbsp;</p>

<h3 align="center">{if $approves eq 0}No Items To Approve{else}<a href="admin_videos.php?pt=easyapprove&amp;pag=vid">You Have {$approves} Items to Approve </a>{/if}</h3>
<p align="center"><strong>Version</strong> = {$version}</p>
<p align="center"> {if $up2date lte $version} <b>Your version is recent. Good Job!</b> {else}Time to upgrade!
<a href='http://phpdirector.co.uk'>Upgrade!</a> {/if} </p>
</body>
</html>