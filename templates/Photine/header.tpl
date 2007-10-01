<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=iso-8859-2" />
<meta name="author" content="Ben Swanson"/>
<meta name="theme" content="luka cvrk"/>

<title>{$config_name|default:"Php Director"}{section name=video loop=$video}-{$video[video].name}{/section}</title>

<link rel="stylesheet" href="templates/Photine/style.css" type="text/css" />
<script type="text/javascript" src="js/behavior.js"></script>
<script type="text/javascript" src="js/rating.js"></script>
<script type="text/javascript" src="js/reflection.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript" src="js/show_hide.js"></script>
</head>
<body>
<div id='content'>
<div id='header'><p id="top_info">Login</p>
<div id="logo">
<h1>{if $title eq ""}<a href="index.php" title="home"><img src="templates/Photine/images/phpdirectorbeta.png" width="243" height="52" alt="PHP Director" border="0" /></a>{else}{$title}{/if}</h1>
</div>
</div>
<div id='tabs'>
<ul>
<li><a {if $pagetype eq "feature"}class="current"{/if} href='index.php?pt=feature' accesskey='f'><span class='key'>{$LAN_2|default:"Featured"}</span></a></li>
<li><a {if $pagetype eq "all"}class="current"{/if} href='index.php?pt=all' accesskey='a'><span class='key'>{$LAN_3|default:"All"}</span></a></li>
<li><a {if $pagetype eq "categories"}class="current"{/if} href='categories.php?pt=categories' accesskey='c'><span class='key'>{$LAN_40|default:"Categories"}</span></a></li>
<li><a {if $pagetype eq "images"}class="current"{/if} href='images.php?pt=images' accesskey='i'><span class='key'>{$LAN_4|default:"Images"}</span></a></li>
<li><a {if $pagetype eq "videos"}class="current"{/if} href='videos.php?pt=videos' accesskey='r'><span class='key'>{$LAN_39|default:"Videos"}</span></a></li>
<li><a {if $pagetype eq "submit"}class="current"{/if} href='submit.php?pt=submit&amp;part=1' accesskey='s'><span class='key'>{$LAN_5|default:"Submit"}</span></a></li>
</ul>
<div id="search">
<form method="get" action="index.php" name="search1">
<p><input type="text" name="search" class="search"/>
<input type="submit" value="Search"  class="button"/></p>
</form>
</div>
</div>
{if $news eq ""}
{if $firefox eq "1"}<br />
<br />
{/if}
{else}
<div class="gboxtop"></div>
<div class="gbox">
	<p>{$news}</p>
</div>
{/if}
