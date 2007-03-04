<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{phpdirectorname}</title>
<link rel="stylesheet" href="template/Default/style.css" type="text/css" />
<script type="text/javascript" src="js/show_hide.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/JavaScript" src="js/rollover.js"></script>
</head>
<body onload="MM_preloadImages('images/arrowdownani.gif'), MM_preloadImages('images/arrowupani.gif')">
<div id='content'>	
<div id='header'>
<!--<div id='top_info'>Browse <a href='#'>Today's favorites</a> or <a href='#'>All time favorites</a></div>-->
{logo}
</div>
</div>

<div id='tabs'>
<ul>
<li>
<a <?php if ($pagetype == "feature"){echo "class='current'";}?> href='index.php?pt=feature' accesskey='m'><span class='key'>Featured</span></a>
</li>
<li>
<a <?php if ($pagetype == "all"){echo "class='current'";}?> href='index.php?pt=all' accesskey='v'><span class='key'>All</span></a>
</li>
<li>
<a <?php if ($pagetype == "pictures"){echo "class='current'";}?> href='index.php?pt=pictures' accesskey='i'><span class='key'>I</span>mages</a>
</li>
<li>
<a <?php if ($pagetype == "submit"){echo "class='current'";}?> href='submit.php?pt=submit' accesskey='a'><span class='key'>Submit</span></a>
</li>
</ul>
</div>