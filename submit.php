<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
require('header.php');

$result = mysql_query("SELECT * FROM pp_catigories") or die("Error: " . mysql_error());

// For each result that we got from the Database

//main video list
$result1 = array();
$i=0;
while ($row = mysql_fetch_array($result)) {
 
            $tmp = array('name'=> $row['name']);
            
            
            $result1[$i++] = $tmp;
}
//pass the results to the template
$smarty->assign('catigories', $result1);

//Display Images page
$smarty->display('submit.tpl');
?>