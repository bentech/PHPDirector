<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Ben Swanson" />
    <meta name="theme" content="luka cvrk"/>
	<meta name="description" content="{$config_description}" />
	<meta name="keywords" content="{$config_keywords}" />	
	<link rel="stylesheet" type="text/css" href="templates/zest/style.css" media="screen" />
    	<link rel="stylesheet" type="text/css" href="templates/zest/rating.css" media="screen" />
    
<script type="text/javascript" src="js/behavior.js"></script>
<script type="text/javascript" src="js/rating.js"></script>
    
<title>{$config_name}</title>
</head>
<body>
	<div id="content">
		<div id="top_info">
			<p>Welcome to <b>PHPDirector</b> <span id="loginbutton"><a href="#" title="Log In">&nbsp;</a></span><br />
			<b>You are not Logged in!</b> <a href="#">Log in</a> to check your messages.</p>
		</div>
		
		<div id="logo">

<h1><a href="index.php" title="home">{if isset($config_image)}<img src="{$config_image}" width="243" height="52" alt="PHP Director" border="0" />{else}{$config_name}{/if}</a></h1>


			{if isset($config_slogan)}<p id="slogan">{$config_slogan}</p>{/if}
		</div>
				
		<ul id="tablist">
			<li><a{if $pagetype eq "all"} class="current"{/if} href="index.php?pt=all" accesskey="n">Videos</a></li>
			<li><a{if $pagetype eq "categories"} class="current"{/if} href="categories.php?pt=categories" accesskey="b">Categories</a></li>
			<li><a{if $pagetype eq "tags"} class="current"{/if} href="tags.php?pt=tags">Tags</a></li>
			<li><a{if $pagetype eq "channels"} class="current"{/if} href="channels.php?pt=channels" accesskey="p">Channels</a></li>
			<li><a{if $pagetype eq "submit"} class="current"{/if} href="submit.php?pt=submit" accesskey="r">Submit</a></li>
		</ul>
		
		<div id="topics">
			<div class="thirds">
				<p><br />Welcome to the Main Page:</p>
			</div>
            
			<div class="thirds">
				<ul>
					<li><a href="index.php?sort=views&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Most Viewed</a></li>
					<li><a href="index.php?sort=date&amp;order=down&amp;next={$next}&amp;pt={$pagetype}">Newest Videos</a></li>
					<li><a href="#">Heighest Rated</a></li>
				</ul>
			</div>
			<div class="thirds">
				<ul>
					<li><a href="index.php?sort=views&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Least Watched</a></li>
					<li><a href="">Lowest Rated</a></li>
					<li><a href="index.php?sort=date&amp;order=up&amp;next={$next}&amp;pt={$pagetype}">Oldest Videos</a></li>
				</ul>
			</div>
		</div>
<div id="search">
			<form method="get" action="index.php" name="search1">
				<p><input type="text" name="search" class="search" /> <input type="submit" value="Search" class="button" /></p>
			</form>
</div>

    	<div id="left">
        {if $news ne ""}
			<div class="subheader">
		
        		<p>{$news}</p>
       
</div>         {/if}
