<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
/*
Page:           rpc.php
Created:        Aug 2006
This page handles the 'AJAX' type response if the user
has Javascript enabled.	
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
--------------------------------------------------------- */
header("Cache-Control: no-cache");
header("Pragma: nocache");

require('_config-rating.php'); // get the db connection info

//getting the values
$vote_sent = $_REQUEST['j'];
$id_sent = $_REQUEST['q'];
$ip_num = $_REQUEST['t'];
$units = $_REQUEST['c'];
$ip = $_SERVER['REMOTE_ADDR'];

//connecting to the database to get some information
$query = mysql_query("SELECT total_votes, total_value, used_ips FROM $tableName WHERE id='$id_sent' ")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($query);
$checkIP = unserialize($numbers['used_ips']);
$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored
$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

// checking to see if the first vote has been tallied
// or increment the current number of votes
($sum==0 ? $added=0 : $added=$count+1);

// if it is an array i.e. already has entries the push in another value
((is_array($checkIP)) ? array_push($checkIP,$ip_num) : $checkIP=array($ip_num));
$insertip=serialize($checkIP);

if (($vote_sent >= 1 && $vote_sent <= $units) && ($ip == $ip_num)) { // keep votes within range, make sure IP matches - no monkey business!
	$update = "UPDATE $tableName SET total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."' WHERE id='$id_sent'";
	$result = mysql_query($update);		
} 

// these are new queries to get the new values!
$newtotals = mysql_query("SELECT total_votes, total_value, used_ips FROM $tableName WHERE id='$id_sent' ")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($newtotals);
$count = $numbers['total_votes'];//how many votes total
$current_rating = $numbers['total_value'];//total number of rating added together and stored
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

$new_back = 
"<ul class=\"unit-rating\" style=\"width:". $units*$unitwidth ."px;\">\n".
"<li class=\"current-rating\" style=\"width:". @number_format($current_rating/$count,2)*$unitwidth ."px;\">Current rating.</li>\n".
"<li class=\"r1-unit\">1</li>\n".
"<li class=\"r2-unit\">2</li>\n".
"<li class=\"r3-unit\">3</li>\n".
"<li class=\"r4-unit\">4</li>\n".
"<li class=\"r5-unit\">5</li>\n".
"<li class=\"r6-unit\">6</li>\n".
"<li class=\"r7-unit\">7</li>\n".
"<li class=\"r8-unit\">8</li>\n".
"<li class=\"r9-unit\">9</li>\n".
"<li class=\"r10-unit\">10</li>\n".
"</ul>".
"<p class=\"voted\">$id_sent. Rating: <strong>".@number_format($sum/$added,1)."</strong>/".$units." (".$count." ".$tense." cast) ".
"<span class=\"thanks\">Thanks for voting!</span></p>";//show the updated value of the vote


//name of the div id to be updated | the html that needs to be changed
$output = "unit_long$id_sent|$new_back";
echo $output;
?>