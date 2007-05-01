<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
ob_start(); 
session_start(); 
require_once ("functions.php"); 
clearsessionscookies(); 
header("location: ../index.php");
?>
