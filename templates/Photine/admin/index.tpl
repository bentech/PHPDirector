{include file="admin_header.tpl"}
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
<b>Time to upgrade!</b> <a href='http://www.phpdirector.co.uk'>Upgrade!</a>
{/if}
</script>

</body>
</html>