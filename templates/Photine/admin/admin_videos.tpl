{include file="admin_header.tpl"}
{$message}
<body>

{if $video[video].id eq ""}<div align='center'>
<font color='#FF0000' face='Arial Black' size='4'>No Videos</font></div>
{/if}

<div align='center'>
{section name=video loop=$video}
<p><h2>{$video[video].name}</h2></p>
<p><b>{$admin_36}:</b>

{if $video[video].approved eq "1"}
<font color='#00CC00' face='Arial Black' size='4'>{$admin_37}</font>
{else}
<font color='#FF0000' face='Arial Black' size='4'>Not Aprroved</font>
{/if}


{if $video[video].feature eq "1"}...Featured{/if}

{if $video[video].reject eq "1"}<font color='#FF0000' face='Arial Black' size='4'>...{$admin_38}</font>{/if}

<br />

<img border='0' src='{if $video[video].video_type eq "YouTube"}{$ytpic}1.jpg' height='64'><img border='0' src='{$ytpic}2.jpg' height='64'><img border='0' src='{$ytpic}3.jpg' height='64'>
{else}
{$video[video].picture}' height='64'>{/if}

<div style='border:3px dashed #808080; position: absolute; z-index: 1; left: 200px; top: 350px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px;' id='layer1'>

{if $video[video].approved eq "0"}
<a href='?id={$video[video].id}&what=approve&page={$page}&pag=vid'>{$admin_16}</a>
{else}
<a href='?id={$video[video].id}&what=unapprove&page={$page}&pag=vid'>{$admin_15}</a>
{/if}


{if $video[video].feature eq "0"}
	
	{if $pagetype eq "all"}
	<p><a href='?id={$video[video].id}&what=featureapprove&page={$page}&pag=vid'>{$admin_18}</a></p>
	{else}
	<p><a href='?id={$video[video].id}&what=featureapprove&page={$page}&pag=vid'>{$admin_35}</a></p>
	{/if}
				
{else}
	<p><a href='?id={$video[video].id}&what=unfeature&page={$page}&pag=vid'>{$admin_17}</a></p>
{/if}
		
{if $pagetype eq "rejected"}
<a href='?id={$video[video].id}&what=unreject&page={$page}&pag=vid'>{$admin_16}</a> or
{else}
<a href='?id={$video[video].id}&what=reject&page={$page}&pag=vid'>{$admin_19}</a> or
{/if}
<a href='?id={$video[video].id}&what=delete&page={$page}&pag=vid'>{$admin_21}</a></div>

<br />
{include file="../players.tpl"}
<br />
<b>{$admin_36}:</b>{$video[video].creator}
<br />
<b>{$admin_35}:</b>{$video[video].description}
<br />
<br>&nbsp;<b>ID:</b>{$video[video].id}
{/section}
</div>

</html>