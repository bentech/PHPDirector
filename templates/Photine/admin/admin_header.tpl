<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>{$config_name} - {$admin_0}</title>
	
		<meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
		<meta content="Copyright 2007 Cross Star Studios" name="copyright"/>
		<meta content="Ben Swanson" name="author"/>
		<link media="screen" type="text/css" href="../templates/Photine/admin_main.css" rel="stylesheet"/>
</head><body>
<div id="admin-header">
  <h1>{$config_name} - {$admin_0}</h1>
</div>
<ul id="admin-menu">
<li><a href="../index.php">{$admin_1}</a> <a href="logout.php">{$admin_2}</a></li>
</ul>
<ul id="admin-submenu"><li {if $pagetype eq "all"}class='selected'{/if}</li>
<a href="admin_manage.php?pt=all">{$admin_3}</a></li>
<li{if $pagetype eq "approve"}class='selected'{/if}>
<a href="admin_manage.php?pt=approve">{$admin_4}</a></li>
<li{if $pagetype eq "all"}class='feature'{/if}><a href="admin_manage.php?pt=feature">{$admin_5}</a></li>
<li{if $pagetype eq "rejected"}class='selected'{/if}><a href="admin_manage.php?pt=rejected">{$admin_6}</a></li>
<li{if $pagetype eq "videos"}class='selected'{/if}><a href="admin_videos.php?vidpage=approve&pt=videos">{$admin_7}</a></li>
<li{if $pagetype eq "all"}class='options'{/if}><a href="options.php?pt=options">{$admin_8}</a></li>
<li{if $pagetype eq "categories"}class='selected'{/if}><a href="categories.php?pt=categories">{$admin_42}</a></li>
</ul>
<br />