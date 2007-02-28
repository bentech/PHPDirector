<?php
$filename = "installed.php";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
if($contents == "<?phpNo?>"){
	header("location: install/index.php");
}
fclose($handle);
// we must never forget to start the session
session_start();
include("db.php");
include("includes/function.inc.php");
include("lang/".config('lang')."/lang.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo config('name');?></title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<!--
This does rollver images
-->
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onload="MM_preloadImages('/images/arrowdownani.gif')" onload="MM_preloadImages('/images/arrowupani.gif')">

<?php
if ($pagetype == ""){
$pagetype = $_GET['pt'];
}
if ($pagetype == ""){
$pagetype = "all";
}?>

<?php
 if (config('externalheader') == "true"){
?>
<iframe src="<?php echo config('externalheaderurl');?>" align="top" scrolling='no' frameborder="0" width="100%" height="<?php echo config('header_height');?>">
Please Use Firefox
<a href="http://www.spreadfirefox.com/?q=affiliates&amp;id=195437&amp;t=210"><img border="0" alt="Firefox 2" title="Firefox 2" src="http://sfx-images.mozilla.org/affiliates/Buttons/firefox2/firefox-spread-btn-1b.png"/></a>
</iframe>
<link rel='stylesheet' href='<?php echo config('cssstyle');?>' type='text/css' />
<center>
<div id='content'>
<div id='header'>
<?}else{?>
<link rel="stylesheet" href="<?php echo config('cssstyle');?>" type="text/css" />
<div id='content'>	
<div id='header'>
<!--<div id='top_info'>Browse <a href='#'>Today's favorites</a> or <a href='#'>All time favorites</a></div>-->
<?php
if(config('logo') == "default"){
?>		
<div id='logo'><h1><a href='#' title='Centralized Internet Content'>PHP<span class='title'>Director</span></a></h1>
<?php
}else{
?>
<div id='logo'><img src="<?php echo config('logo');?>">
<?php
}
?>
</div>
</div>

<div id='tabs'><ul>
<li><a <?php if ( $pagetype == "feature" ){echo "class='current'";}?> href='index.php?pt=feature<?php if ($_GET['admin'] == "true"){echo "&admin=true";}?>' accesskey='m'><span class='key'>Featured</span></a></li>
<li><a <?php if (defined("submtitab")){ }else{ if ( $pagetype == "all" ){echo "class='current'";}}?> href='index.php?pt=all<?php if ($_GET['admin'] == "true"){echo "&admin=true";}?>' accesskey='v'><span class='key'>All</span></a></li>
<li><a <?php if ( $pagetype == "pictures" ){echo "class='current'";}?> href='index.php?pt=pictures<?php if ($_GET['admin'] == "true"){echo "&admin=true";}?>' accesskey='i'><span class='key'>I</span>mages</a></li>
<li><a <?php if (defined("submtitab")){echo "class='current'";}?> href='submit.php?pt=submit<?php if ($_GET['admin'] == "true"){echo "&admin=true";}?>' accesskey='a'><span class='key'>Submit</span></a></li>
<?php if (isset($_SESSION['phpdirector'])
|| $_SESSION['phpdirector'] == true) {echo "<li><a class='current' href='admin/admin_manage.php' accesskey='a'><span class='key'>Admin</span></a></li>";}?>
</ul></div>
<?php } ?>