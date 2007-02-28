<?php
define("PHPdirector", 1);
?>
<?php
/*
Page:           _config-rating.php
Created:        Aug 2006
Holds info for connecting to the db.
--------------------------------------------------------- 

ryan masuga, masugadesign.com
ryan@masugadesign.com 
--------------------------------------------------------- */
include("config.php");

	//Connect to  your rating database
	$dbhost        = $cfg["db_host"];
	$dbuser        = $cfg["db_user"];
	$dbpass        = $cfg["db_pass"];
	$dbname        = $cfg["db_name"];
	$tableName     = 'pp_rating';
	
	$unitwidth     = 30; // the width (in pixels) of each rating unit (star, etc.)
	// if you changed your graphic to be 50 pixels wide, you should change the value above
	
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');
	mysql_select_db($dbname);

?>