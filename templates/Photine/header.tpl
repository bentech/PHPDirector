<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$title}</title>
<link rel="stylesheet" href="templates/Photine/style.css" type="text/css" />
<script language="Javascript" type="text/javascript">
<!--
	function show_hide(tblid, show) {$
		if (tbl = document.getElementById(tblid)) {$
			if (null == show) show = tbl.style.display == 'none';
			tbl.style.display = (show ? '' : 'none');
		}
	}
//!-->
</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/JavaScript" src="js/rollover.js"></script>
</head>
<body onload="MM_preloadImages('images/arrowdownani.gif'), MM_preloadImages('images/arrowupani.gif')">
<div id='content'>	
<div id='header'>
<!--<div id='top_info'>Browse <a href='#'>Today's favorites</a> or <a href='#'>All time favorites</a></div>-->
<div id="logo"><img src="images/phpdirectorbeta.png" width="243" height="52" alt="Php Director" />
</div>
</div>

<div id='tabs'>
<ul>
<li><a {$current[0]} href='index.php?pt=feature' accesskey='m'><span class='key'>
<?php echo LAN_2 ?>
</span></a>
</li>
<li>
<a {$current[1]} href='index.php?pt=all' accesskey='v'><span class='key'>
<?php echo LAN_3 ?>
</span></a>
</li>
<li>
<a {$current[2]} href='index.php?pt=categories' accesskey='v'><span class='key'>
<?php echo LAN_3 ?>
</span></a>
</li><li>
<a {$current[3]} href='index.php?pt=pictures' accesskey='i'><span class='key'>
<?php echo LAN_4 ?>
</span></a>
</li>
<li>
<a {$current[4]} href='videos.php' accesskey='r'><span class='key'>
<?php echo LAN_39 ?>
</span></a>
</li>
<li>
<a {$current[5]} href='submit.php?pt=submit' accesskey='a'><span class='key'>
{$LAN_5}
</span></a>
</li>
</ul>
	<div id="search">
				<form method="post" action="index.php">
					<p><input type="text" name="searching" /> <input type="submit" value="Search"/></p>
				</form>
			</div>
</div>
<br/><br/>
<div class="gboxtop"></div>
<div class="gbox">
			<p>{$news}</p>
		</div>