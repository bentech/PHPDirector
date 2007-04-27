<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
require('header.php');

// required connect
    SmartyPaginate::connect();
// set items per page
    SmartyPaginate::setLimit(5);
	
	$smarty->assign('videos', get_db_results());
    // assign {$paginate} var
    SmartyPaginate::assign($smarty);
    // display results
    $smarty->display('index.tpl');	
	  
	  
 
	  
	    function get_db_results() {
		
		
		//SORTING???
		
switch ($sort1){
case "name":
	$sort = "name";
	break;
case "date":
	$sort = "id";
	break;
case "views":
	$sort = "views";
	break;
default:
	$sort = "id";
	$order1 = "DESC";
}

//Check if theres a Get called order then is its down order by DESC if its up dont order by DESC if no get varriable order by non DESC
if(isset($_GET["order"])){
	$order = $_GET["order"];
	if($order == "up"){
		$order1 = "";
	}
	if($order == "down"){
		$order1 = "DESC";
	}
}
		
		//SORTING END ???
		$_POST['searching'] = $search;
if ($_GET["pt"] == "all") {		
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `reject` = '0' LIMIT %d,%d";
}elseif ($_GET["pt"] == "feature") {
		$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `feature` = '1' AND `reject` = '0' LIMIT %d,%d ";
}elseif (isset($search)){
		$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM `pp_files` WHERE `name` LIKE \'%$search%\' OR `creator` \'%$search%\' OR `description` LIKE \'%$search%\' LIMIT %d,%d';
}else{
		//$query = "SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `reject` = '0' LIMIT %d,%d";
};
    
		$_query = sprintf($query, SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
        $_result = mysql_query($_query);   // assign your db results to the template

$_data = array();
$i=0;
        while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {
		
		
		$month = date("M", strtotime($_row[date]));
		$day = date("d", strtotime($_row[date]));
		$name = substr($_row['name'], 0,32);
		if (strlen($_row['name']) >32){$name2 = "...";}
		$creator = substr($_row['creator'], 0,20);
		
		//image
		if ($_row['picture'] !== null){
			$tehpic = $_row[picture];
			$amp = array("&amp;");
			$new_replace  = array("&");
			$newphrase = str_replace("$amp", "$new_replace", "$tehpic");
			$picture = $newphrase;
		}
		//image
		
		$description = substr($_row['description'], 0, 450);
		$desclenght = strlen($_row['description']);
		if ($desclenght > 450){ $description2 = "..."; }
		if ($desclenght < 92){ $br = "<br><br><br><br>"; }
		if ($desclenght > 92 && $desclenght < 182){ $br = "<br><br><br>" ;}
		if ($desclenght > 982 && $desclenght < 272){ $br = "<br><br>"; }
		if ($desclenght > 272 && $desclenght < 362){ $br = "<br>"; }
		if ($desclenght > 362){ $br = null; }
		
		$tmp = array(
			'id' => $_row['id'], 
			'month' => $month, 
			'day' => $day,
			'name' => $name.$name2,
			'creator' => $creator,
			'picture' => $picture,
			'description' => $description.$description2,
			'br' => $br
		);
			
			$_data[$i++] = $tmp;
		
		
            // collect each record into $_data
        }
        
        // now we get the total number of records from the table
        $_query = "SELECT FOUND_ROWS() as total";
        $_result = mysql_query($_query);
        $_row = mysql_fetch_array($_result, MYSQL_ASSOC);
        
        SmartyPaginate::setTotal($_row['total']);

        mysql_free_result($_result);
      
        return $_data;

    }
?>