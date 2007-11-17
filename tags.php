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
require("header.php");

$query = "SELECT id, name, COUNT(id) FROM pp_tags GROUP BY name ORDER BY COUNT(id) DESC LIMIT 0,500";

$result = mysql_query($query);

if (!$result)die(mysql_error()); //If no results end


//////////////////////////////
/////Check There Are  Enough tags
/////////////////////////////
$totalrows = mysql_num_rows($result);
if($totalrows == 0){  //if no videos display error.
	$smarty->assign('error', 'Now Tags Sumbitted Yet');
	$smarty->display('error.tpl');
	exit;
}

//////////////////////////////
/////Assign Tags to smarty
/////////////////////////////
$i = 0;
while ($row = mysql_fetch_assoc($result)){


//This is used to find the number of tags in the middle of the table, i didn't use a average because this way it allows for errors.
if($i == floor($totalrows / 2)){
$number1 = $row['COUNT(id)']; 

}

		$tmp = array(
		'id' => $row['id'], 
		'name' => $row['name'],
		'number' => $row['COUNT(id)']
	);
	
$tags[$i] = $tmp;
$i = $i + 1; //yer , $i++ thought i would make it easier to read
}
$smarty->assign('tags', $tags);

//////////////////////////////
///This works out what size they should be and it is set in the tpl
/////////////////////////////
$number[1] = $number1 * 4;

$number[2] = $number1 * 2;

$number[3] = floor($number1 / 2);

$number[4] = floor($number[3] / 2);


$smarty->assign('number', $number);

//////////////////////////////
////assings
/////////////////////////////

$smarty->display('tags.tpl');

mysql_close($mysql_link);
?>