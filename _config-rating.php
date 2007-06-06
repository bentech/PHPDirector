<?php
/*
Page:           _config-rating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
Holds info for connecting to the db, and some other vars
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
--------------------------------------------------------- */
require("config.php");
//Connect to  your rating database
$rating_dbhost      = $cfg["db_host"];
$rating_dbuser      = $cfg["db_user"]; //	replace with your username
$rating_dbpass      = $cfg["db_pass"]; //	replace with your password
$rating_dbname      = $cfg["db_name"]; //	replace with your database name

$rating_units		= 5;  //		number of units for the rating bar
$rating_tableID		= "id"; // 		name of the key value in the rating table
$rating_tableName   = 'pp_rating'; //	name of the table where the ratings are recorded
$rating_recordUrl 	= "db_rating.php"; //	non javascript rating script location
$rating_unitwidth   = 30; // 		the width (in pixels) of each rating unit (star, etc.)
$rating_static		= FALSE; // 	static or dynamic rating bar (to invoke static change FALSE to static)
// 									if you changed your graphic to be 50 pixels wide, 
//									you should change the value above
	
$rating_conn = mysql_connect($rating_dbhost, $rating_dbuser, $rating_dbpass) or die  ('Error connecting to mysql');

?>