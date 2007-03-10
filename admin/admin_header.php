<?php
define("PHPdirector", 1);
?>
<?php 
include("../config.php");
include("../db.php");
include("includes/admin_videos_functions.php");
include("../includes/function.inc.php");
include("../lang/".config('lang')."/lang.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title><?php echo config('name');?> - <?php echo Admin_0; ?></title>
	
		<meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
		<meta content="Copyright 2007 Cross Star Studios" name="copyright"/>
		<meta content="Ben Swanson" name="author"/>
		<link media="screen" type="text/css" href="../css/admin_main.css" rel="stylesheet"/>
</head><body>
<div id="admin-header">
  <h1><?php echo config('name');?> - <?php echo Admin_0; ?> </h1>
</div>
<ul id="admin-menu">
<li><a href="../index.php"><?php echo Admin_1; ?></a> <a href="logout.php"><?php echo Admin_2; ?></a></li>
</ul>
<ul id="admin-submenu">
<li <?php if ($_GET['pt'] == "all"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=all"><?php echo Admin_3; ?></a></li>
<li <?php if ($_GET['pt'] == "approve"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=approve"><?php echo Admin_4; ?></a></li>
<li <?php if ($_GET['pt'] == "feature"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=feature"><?php echo Admin_5; ?></a></li>
<li <?php if ($_GET['pt'] == "rejected"){
echo "class='selected'";
}?>><a href="admin_manage.php?pt=rejected"><?php echo Admin_6; ?></a></li>
<li <?php if ($_GET['vidpage'] == "approve"){
echo "class='selected'";}?>><a href="admin_videos.php?vidpage=approve"><?php echo Admin_7; ?></a></li>
<li <?php if ($_GET['pt'] == "options"){
echo "class='selected'";
}?>><a href="options.php?pt=options"><?php echo Admin_8; ?></a></li><!-- THIS IS JUST SO THE TAB SHOWS AS SELECTED-->


</ul>
<br />