<?php
$filename = "../installed.php";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
if($contents == "<?phpNo?>"){
	header("location: install/index.php");
}
?>