<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
define("PHPdirector", 1);
?>
<?php
$id = $_GET["id"];
$twomonths = 60 * 60 * 24 * 60 + time();
setcookie("$id", $id, $twomonths);
?>
<?php
if(!isset($_COOKIE["$id"])){ 
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views'
WHERE id = '$id'");
}
?>
<html>
<head>
<script language="Javascript" type="text/javascript">
<!--
	function show_hide(tblid, show) {
		if (tbl = document.getElementById(tblid)) {
			if (null == show) show = tbl.style.display == 'none';
			tbl.style.display = (show ? '' : 'none');
		}
	}
//!-->
</script>
<script type="text/javascript" language="javascript" src="js/behavior.js"></script>
<script type="text/javascript" language="javascript" src="js/rating.js"></script>
</head>
<body>
<?php
require('libs/Smarty.class.php');
include("includes/check_install.inc.php");
include("db.php");
include("includes/function.inc.php");
$smarty = new Smarty();
$smarty->template_dir = './templates/Photine';
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';
include("lang/".config('lang')."/lang.inc.php");
?>
<?php 
$id = $_GET["id"];
$result = mysql_query("SELECT * FROM pp_files WHERE id=$id") or die();  
// For each result that we got from the Database
while ($row = mysql_fetch_assoc($result))
{
 $video[] = $row;
$smarty->assign('vidtype', $row['video_type']);

if( $row['video_type'] == "dailymotion"){
$dmid = dmgetfile($row['file']);
$smarty->assign('dmid', $dmid);
}
}

// Assign this array to smarty

$smarty->assign('video', $video);


if(!isset($_COOKIE["$id"])){
$old_views = $row["views"];
$new_views = $old_views + 1;
mysql_query("UPDATE pp_files SET views = '$new_views' WHERE id = '$id'");
}


require('_drawrating.php');
$smarty->display('viewvidpop.tpl');
?>
</body>
</html>
