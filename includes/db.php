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

// If the page was loaded without being included, bad :-(
if (!defined('PHPDIRECTOR_INSTALLED')) {
    header('Location: ../index.php');
}

require_once(PHPDIRECTOR_ROOT . 'config.php');

$mysql_link = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]) or die(mysql_error());

mysql_select_db($cfg["db_name"], $mysql_link) or die(mysql_error());

// Function which connects to the database and returns a MySQL connection. It takes
// a Registry object as a parameter
function &dbConnect(&$registry) {
    $conn = @mysql_connect($registry->get('dbhost'),
                           $registry->get('dbuser'),
                           $registry->get('dbpass'))
            or die('Error: ' . mysql_error());

    if (($dbname = $registry->get('dbname')) !== null) {
        mysql_select_db($dbname, $conn) or die('Error: ' . mysql_error());
    }

    return $conn;
}

// Connect to the database if necessary. This lets the registry hold a single connection
function connect(&$registry) {
    if (!$registry->has('db')) {
        $registry->set('db', dbConnect($registry));
    }
}
?>