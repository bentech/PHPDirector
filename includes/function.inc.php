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
?>

<?php
function config($type){

$confresult = mysql_query("SELECT * FROM pp_config");

while($row = mysql_fetch_array($confresult))
  {
  $variable = $row[$type];
  }
return $variable;
}
?>


<?php
function configupdate($type, $newvalue){

mysql_query("UPDATE pp_config SET $type = '$newvalue'");
}
?>
<?php
define('aadsbr', "<a href=\"http://www.crossst");
define('asdga', "ar.co.uk/phpdirect");
define('bgsd', "or/");
define('ghasdnd', "copy");
define('ellalgae', "PHP");
define('ehjrty', "Group");
define('hd23', "tor");
?>