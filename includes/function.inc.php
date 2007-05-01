<?php
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

while($row = mysql_fetch_array($confresult))
  {
  $variable = $row[$type];
  }
return $variable;
}

function dmgetfile($id){
$dm_xml_pic_string = @file_get_contents("http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id);
$dm_xml_pic_start = explode("/swf/",$dm_xml_pic_string,2);
$dm_xml_pic_end = explode("\"",$dm_xml_pic_start[1],2);
$dm_pic = $dm_xml_pic_end[0];
return $dm_pic;
}

function configupdate($type, $newvalue){

mysql_query("UPDATE pp_config SET $type = '$newvalue'");
}


function between($beg, $end, $str) {
$a = explode($beg, $str, 2);
$b = explode($end, $a[1]);
return $beg . $b[0] . $end;
}
?>