<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {rating_bar} function plugin
 *
 * Type:     function<br>
 * Name:     rating_bar<br>
 * Purpose:  Insert rating bar<br>
 * Adapted by ryan chapman, true-industry.com
 * Based on work by ryan masuga, masugadesign.com
 * ryan@masugadesign.com
 * Created:	Dec 2006
 * 
 * Parameters:
 * unitwidth - the width (in pixels) of each rating unit (star, etc.)
 * tableName - name of the table where the ratings are recorded
 * tableID - name of the key value in the rating table
 * units - number of units for the rating bar
 * recordUrl - non javascript rating script location
 * id - (REQUIRED) id of the item being rated
 * configs - alternate defaults location
 * 
 * Sample Usage:
 * {rating_bar id=$data.ID}
 */


function smarty_function_rating_bar($params, &$smarty) { 

	if (empty($params['configs'])) $params['configs'] = '_config-rating.php';

	require($params['configs']); // get the db connection info
	//Set Defaults
	if (empty($params['unitwidth'])) $params['unitwidth'] = $unitwidth;
	if (empty($params['tableName'])) $params['tableName'] = $tableName;
	if (empty($params['tableID'])) $params['tableID'] = $tableID;
	if (empty($params['units'])) $params['units'] = $units;
	if (empty($params['recordUrl'])) $params['recordUrl'] = $recordUrl;
	
	
	// Set variables
	// the width (in pixels) of each rating unit (star, etc.)
	// if you changed your graphic to be 50 pixels wide, you should change the value above
	$unitwidth	=	$params['unitwidth'];
	$tableName	=	$params['tableName'];
	$tableID	=	$params['tableID'];
	$ip 		=	$_SERVER['REMOTE_ADDR'];
	$units		=	$params['units'];
	$recordUrl	=	$params['recordUrl'];
	$id			=	$params['id'];
	
	$query = mysql_query("SELECT total_votes, total_value, used_ips FROM $tableName WHERE $tableID = '$id' ")or die(" Error: ".mysql_error());
	$numbers = mysql_fetch_assoc($query);
	$count = $numbers['total_votes']; //how many total_votes total
	$current_rating = $numbers['total_value']; //total number of rating added together and stored
	$tense = ($count == 1) ? "vote" : "total_votes"; //plural form total_votes/vote
	
	// determine whether the user has voted, so we know how to draw the ul/li
	$voted = mysql_num_rows(mysql_query("SELECT used_ips FROM $tableName WHERE used_ips LIKE '%".$ip."%' AND $tableID = '".$id."' ")); 
	
	// now draw the rating bar
	$returner = '<div class="ratingblock">';	
	$returner.= '<div id="unit_long'.$id.'">';
	$returner.= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:';
	$gerth = $unitwidth*$units;
	$returner.= $gerth.'px;">';
	$returner.= '<li class="current-rating" style="width:';
	$Num1 = @number_format($current_rating/$count,2)*$unitwidth;
	$returner.= $Num1.'px;">Currently ';
	$Num2 = @number_format($current_rating/$count,2);
	$returner.= $Num2.'/'.$units.'</li>';
	
	for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
		if(!$voted) { // if the user hasn't yet voted, draw the voting stars 
	$returner.= '<li><a href="'.$recordUrl.'?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'" title="'.$ncount.' out of '.$units.'" class="r'.$ncount.'-unit rater">'.$ncount.'</a></li>';
		} 
	}
	$ncount=0; // resets the count
	$returner.= '</ul><p';
	if($voted){
	$returner.= ' class="voted"';
	}
	$returner.= '>Rating: <strong> ';
	$Num3 = @number_format($current_rating/$count,1);
	$returner.= $Num3 .'</strong>/'.$units.' ('.$count.' '.$tense.' cast)</p></div></div>';

	return $returner;
	
}
