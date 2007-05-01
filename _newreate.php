<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
require('_config-rating.php'); // get the db connection info
$id_sent = $_GET['q'];
//getting the values
$query = "INSERT INTO pp_rating (id, total_votes, total_value, used_ips) VALUES ('$id_sent', '0', '0', '')";
mysql_query($query);

mysql_close($rating_conn);
?>