<?php
require("config.php");

$mysql_link = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]) or die(mysql_error());

mysql_select_db($cfg["db_name"], $mysql_link) or die(mysql_error());
?>