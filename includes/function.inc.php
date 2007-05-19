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
// Prevent SQL Injections!
function safe_sql_insert($variable) {
$variable = mysql_real_escape_string(htmlentities($variable));
return $variable;
}

function show_sql($variable) {
$variable = stripslashes($variable);
return $variable;
}


function config($type){

$confresult = mysql_query("SELECT * FROM pp_config");

$row = mysql_fetch_array($confresult);
$variable = $row[$type];

return $variable;
}

function between($beg, $end, $str) {
$a = explode($beg, $str, 2);
$b = explode($end, $a[1]);
return $beg . $b[0] . $end;
}
?>