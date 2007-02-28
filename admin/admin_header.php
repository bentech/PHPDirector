<?php
define("PHPdirector", 1);
?>
<?php include("../config.php");?>
<?php include("../db.php");
include("includes/admin_videos_functions.php");
include("../includes/function.inc.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?php echo config('name');?> - Admin</title>
	
		<meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
		<meta content="Copyright 2007 Cross Star Studios" name="copyright"/>
		<meta content="Ben Swanson" name="author"/>
		<link media="screen" type="text/css" href="../css/admin_main.css" rel="stylesheet"/>
</head><body>
<div id="admin-header">
  <h1><?php echo config('name');?> - Admin </h1>
</div>
<ul id="admin-menu">
<li><a href="../index.php?admin=true">Home</a> <a href="logout.php">Logout</a></li>
</ul>
<ul id="admin-submenu">
<li <?php if ($_GET['pt'] == "all"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=all">List All </a></li>
<li <?php if ($_GET['pt'] == "approve"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=approve">Approve Videos</a></li>
<li <?php if ($_GET['pt'] == "feature"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=feature">Featured Videos </a></li>
<li <?php if ($_GET['pt'] == "rejected"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=rejected">Rejected Videos </a></li>
<li <?php if ($_GET['vidpage'] == "approve"){
echo "class='selected'";}?>><a href="admin_videos.php?vidpage=approve">Easy Approve</a></li>
<li <?php if ($_GET['pt'] == "options"){
echo "class='selected'";
}?>><a href="options.php?pt=options">Options</a></li><!-- THIS IS JUST SO THE TAB SHOWS AS SELECTED-->


</ul>
<br />