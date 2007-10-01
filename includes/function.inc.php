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
$variable = htmlentities($variable);
return $variable;
}

function show_sql($variable) {
$variable = stripslashes($variable);
return $variable;
}


function config($type){

$confresult = mysql_query("SELECT `content` FROM pp_config WHERE name = '".$type."'");

$row = mysql_fetch_array($confresult);
$variable = $row[content];

return $variable;
}

function between($beg, $end, $str) {
$a = explode($beg, $str, 2);
$b = explode($end, $a[1]);
return $beg . $b[0] . $end;
}
?>