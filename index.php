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

require('header.php');

// Setup Smarty Pagination
SmartyPaginate::connect();      // required connect

// Set number of items per page
$limit = config($registry, 'vids_per_page');
SmartyPaginate::setLimit($limit);

/**
 * SORT THE RESULTS
 */
// Set which attribute to sort by
$sort = 'id';   // default sort
if (!empty($_GET['sort'])) {
    $sortReq = strtolower($_GET['sort']);
    switch ($sortReq) {
        case 'name':
            $sort = 'name'; break;
        case 'date':
            $sort = 'id'; break;
        case 'views':
            $sort = 'views'; break;
    }
}
// Set which order to sort by
$order = 'DESC';    // default order
if (!empty($_GET['order'])) {
    $orderReq = strtolower($_GET['order']);
    switch ($orderReq) {
        case 'up':
        case 'u':
            $order = 'ASC'; break;
        case 'down':
        case 'd':
            $order = 'DESC'; break;
    }
}


if ($_GET["pt"] == "all") {
		$_query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `reject` = '0' ORDER BY $sort $order LIMIT %d,%d",
		 SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
}elseif ($_GET["pt"] == "feature") {
		$_query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `feature` = '1' AND `reject` = '0' ORDER BY $sort $order LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
}elseif (isset($_GET["cat"])) {
$cat = $_GET["cat"];
		$_query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `category` = '$cat' AND `approved` = '1' ORDER BY $sort $order LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
}elseif (isset($_POST["searching"])){

		$search = $_POST[searching];
		$_query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `name` like '%%$search%%' AND `approved` = '1' ORDER BY $sort $order LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
}else{
		$_query = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM pp_files WHERE `approved` = '1' AND `reject` = '0' ORDER BY $sort $order LIMIT %d,%d",
            SmartyPaginate::getCurrentIndex(), SmartyPaginate::getLimit());
};
        $_result = mysql_query($_query);   // assign your db results to the template

$_data = array();
$i=0;
       while ($_row = mysql_fetch_array($_result, MYSQL_ASSOC)) {


		$month = date("M", strtotime($_row[date]));
		$day = date("d", strtotime($_row[date]));
		//image
		if ($_row['picture'] !== null){
			$tehpic = $_row[picture];
			$amp = array("&amp;");
			$new_replace  = array("&");
			$newphrase = str_replace("$amp", "$new_replace", "$tehpic");
			$picture = $newphrase;
		}
		//image

		$tmp = array(
			'id' => $_row['id'],
			'month' => $month,
			'day' => $day,
			'name' => $_row['name'],
			'creator' => $_row['creator'],
			'picture' => $picture,
			'description' => $_row['description'],
			'br' => $br
		);

			$_data[$i++] = $tmp;


            // collect each record into $_data
        }

        // now we get the total number of records from the table
// now we get the total number of records from the table
        $_query = "SELECT FOUND_ROWS() as total";
        $_result = mysql_query($_query);
        $_row = mysql_fetch_array($_result, MYSQL_ASSOC);
        SmartyPaginate::setTotal($_row['total']);

        mysql_free_result($_result);

	///DB


	$smarty->assign('videos', $_data);

		if ($_row['total'] == 0){ //if no videos display error.
	$error = $smarty->get_template_vars('LAN_29');
	$smarty->assign_by_ref('error', $error);
	$smarty->display('error.tpl');
	exit;
}
    // assign {$paginate} var
    SmartyPaginate::assign($smarty);
	if (isset($_GET["pt"])){
	SmartyPaginate::setUrl('index.php?pt='.$_GET["pt"]);
	}elseif(isset($_GET["cat"])){
	SmartyPaginate::setUrl('index.php?cat='.$_GET["cat"]);
	}else{

	}
    // display results
    $smarty->display('index.tpl');
SmartyPaginate::disconnect();
mysql_close($mysql_link);
?>