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
require("config.php");

$mysql_link = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]) or die(mysql_error());

mysql_select_db($cfg["db_name"], $mysql_link) or die(mysql_error());
?>