<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko, Monte Ohrt (Monte Ohrt), Theodore Ni
+----------------------------------------------------------------------------+
*/

// Load all of the configuration variable at one time
function &loadConfig(&$conn) {
    $result = @mysql_query('SELECT * FROM `pp_config`', $conn);
    $config = @mysql_fetch_assoc($result);
    return $config;
}

// Load the configuration variable from the registry
function config(&$registry, $name) {
    $config = $registry->get('config');

    if ($config === null) {
        return null;
    }

    return $config[$name];
}

// Prevent SQL Injections!
function safe_sql_insert($variable) {
$variable = htmlentities($variable);
return $variable;
}

function show_sql($variable) {
$variable = stripslashes($variable);
return $variable;
}

function between($beg, $end, $str) {
$a = explode($beg, $str, 2);
$b = explode($end, $a[1]);
return $beg . $b[0] . $end;
}
?>