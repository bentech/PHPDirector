{include file="admin_header.tpl"}
<!--{*
Things not used that you might find usefull
{$paginate.first}
{$paginate.last}
{$paginate.total} //tota
*}-->
<h2 align="center">{$admin_31}</h2>
<p>{$admin_32}</p>
<br>
<br>
<script type='text/javascript' src='http://www.crossstar.co.uk/phpdirector_test/version/version.js'>
</script>
<script type='text/javascript'>
version = {$version}
{if $up2date eq "1"}
<b>Your version is recent. Good Job!</b>
{else}
<b>Time to upgrade!</b> <a href='http://sourceforge.net/projects/phpdirector/'>Upgrade!</a>
{/if}
</script>

</body>
</html>