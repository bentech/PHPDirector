<?php
session_start();
include("includes/check_install.inc.php");
include("db.php");
include("includes/function.inc.php");
include("lang/".config('lang')."/lang.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo config('name');?></title>
<link rel="stylesheet" href="<?php echo config('cssstyle');?>" type="text/css" />
<script type="text/javascript" src="js/show_hide.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/JavaScript" src="js/rollover.js"></script>
</head>
<body onload="MM_preloadImages('images/arrowdownani.gif'), MM_preloadImages('images/arrowupani.gif')">

<?php
if ($pagetype == null){
$pagetype = $_GET["pt"];
}
if ($pagetype == null){
$pagetype = "all";
}
?>
<div id='content'>	
<div id='header'>
<!--<div id='top_info'>Browse <a href='#'>Today's favorites</a> or <a href='#'>All time favorites</a></div>-->
<?php
if(config('logo') == "default"){
echo'		
<div id="logo"><img src="images/phpdirectorbeta.png" width="243" height="52" alt="Php Director" />
';
}else{
echo'
<div id="logo"><img src="config("logo")" alt="Php Director">
';
}
?>
</div>
</div>

<div id='tabs'>
<ul>
<li>
<a <?php if ($pagetype == "feature"){echo "class='current'";}?> href='index.php?pt=feature' accesskey='m'><span class='key'>
<?php echo LAN_2 ?>
</span></a>
</li>
<li>
<a <?php if ($pagetype == "all"){echo "class='current'";}?> href='index.php?pt=all' accesskey='v'><span class='key'>
<?php echo LAN_3 ?>
</span></a>
</li>
<li>
<a <?php if ($pagetype == "pictures"){echo "class='current'";}?> href='index.php?pt=pictures' accesskey='i'><span class='key'>
<?php echo LAN_4 ?>
</span></a>
</li>
<li>
<a <?php if ($pagetype == "submit"){echo "class='current'";}?> href='submit.php?pt=submit' accesskey='a'><span class='key'>
<?php echo LAN_5 ?>
</span></a>
</li>
<?php
if (isset($_COOKIE["admin"])){
echo"<li><a class='current' href='admin/admin_manage.php' accesskey='a'><span class='key'>".LAN_6."</span></a></li>";
}
?>
</ul>
</div>
<div id='search'>
<form action="index.php" method="POST">
<input type="text" name="searching">
<input type="submit" value="Search">
</form>
</div>
<br><br><br>