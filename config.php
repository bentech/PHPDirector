<?php
if (defined("PHPdirector")){
$cfg["db_host"] = "localhost";   // DB host computer name or IP
$cfg["db_name"] = "example"; // Name of the Database
$cfg["db_user"] = "example";        // username for your MySQL database
$cfg["db_pass"] = "example";     // password for database
$cfg["admin_user"] = "admin";
$cfg["admin_pass"] = "password";

/*
$connect = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
mysql_select_db($cfg["db_name"]) or die(mysql_error());
$result = mysql_query("SELECT * FROM pp_config");

$row = mysql_fetch_array($result);
$cfg["name"] = $row["name"];
$cfg["vids_per_page"] = $row["vids_per_page"]; //number of videos per page
$cfg["date"] = false; //show date?
$cfg["debug"] = false; //only for dugging

$cfg["oldend"] = 7;
$cfg["disabled videos"] = null;
$exerntalheader = $row["exerntalheader"]; //turn exernal headers on or off
$cfg["externalheaderurl"] = $row["externalheaderurl"]; //If you have a exernal header place link here.
$cfg["header_height"] = $row["header_height"];
$cfg["logo"] = $row["logo"];//If no logo leave default if logo add url
//footer you may edit, just leave Copyright 2007 PHPDirector Group
$cfg["cssstyle"] = $row["cssstyle"];
$addlong = ""; //eg. $addlong = "<img src='http://www.google.co.uk/google.jpg'>"; This add goes on movies page
$cfg["lang"] = $row["lang"]; //English, German (more soon)
$cfg["version"] = $row["version"];// phpdirector Version
}
*/
?>