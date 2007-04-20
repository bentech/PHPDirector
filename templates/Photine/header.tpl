<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-2" />
	<meta name="author" content="Ben Swanson"/>
	<title>{$title|default:"PhpDirector"}</title>
	<link rel="stylesheet" href="templates/Photine/style.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/thickbox.js"></script>
	{literal}<script>
    	function SetState(obj_checkbox, obj_textarea)
    	{  if(obj_checkbox.checked)
      	 { obj_textarea.disabled = true;
      	 }
      	 else
      	 { obj_textarea.disabled = false;
       	}
    	}
	</script>{/literal}
</head>

<body onload="MM_preloadImages('images/arrowdownani.gif'), MM_preloadImages('images/arrowupani.gif')">
<!--[if IE 6]>
Sorry But this browser is not supported if you wish to use a good browser which is supported please use firefox
<![endif]-->

	<div id='content'>	
		<div id='header'>
			<div id="logo">
				<h1><a href="index.php" title="home"><img src="templates/Photine/images/phpdirectorbeta.png" width="243" height="52" alt="Php Director" border="0" /></a></h1>
			</div>
</div>

<div id='tabs'>
	<ul>
			<li><a {if $pagetype eq "feature"}class="current"{/if} href='index.php?pt=feature' accesskey='m'><span class='key'>{$LAN_2|default:"Featured"}</span></a></li>
			<li><a {if $pagetype eq "all"}class="current"{/if} href='index.php?pt=all' accesskey='v'><span class='key'>{$LAN_3|default:"All"}</span></a></li>
			<li><a {if $pagetype eq "categories"}class="current"{/if} href='categories.php?pt=categories' accesskey='v'><span class='key'>{$LAN_40|default:"Categories"}</span></a></li>
			<li><a {if $pagetype eq "images"}class="current"{/if} href='images.php?pt=images' accesskey='i'><span class='key'>{$LAN_4|default:"Images"}</span></a></li>
			<li><a {if $pagetype eq "videos"}class="current"{/if} href='videos.php?pt=videos' accesskey='r'><span class='key'>{$LAN_39|default:"Videos"}</span></a></li>
			<li><a {if $pagetype eq "submit"}class="current"{/if} href='submit.php?pt=submit&part=1' accesskey='a'><span class='key'>{$LAN_5|default:"Submit"}</span></a></li>
	</ul>
	<div id="search">
				<form method="post" action="index.php">
					<p><input type="text" name="searching" class="search"/> <input type="submit" value="Search"  class="button"/></p>
				</form>
			</div>
</div>

{if $news eq ""}
<br /><br />
{else}
<div class="gboxtop"></div>
<div class="gbox"><p>{$news}</p></div>
{/if}