<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko and Monte Ohrt (Monte Ohrt)
+----------------------------------------------------------------------------+
*/
ob_start(); 
session_start(); 
require_once ("functions.php"); 
clearsessionscookies(); 
header("location: ../index.php");
?>
