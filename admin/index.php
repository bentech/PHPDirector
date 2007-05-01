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
include("admin_header.php");

if (checkLoggedin()) 
    $smarty->display('index.tpl');
else 
echo "<H1>You are not logged in - <A href = \"login.php\">login</A></h1></h1>"; 
mysql_close($mysql_link);
?>
