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
 * static - static or dynamic rating bar
 * configs - alternate defaults location
 * 
 * Sample Usage:
 * {rating_bar id=$data.ID}
 */


function smarty_function_rating_bar($params, &$smarty) { 

	if (empty($params['configs'])) $params['configs'] = '_config-rating.php';

	require($params['configs']); // get the db connection info
	//Set Defaults
	if (empty($params['unitwidth'])) $params['unitwidth'] = $rating_unitwidth;
	if (empty($params['tableName'])) $params['tableName'] = $rating_tableName;
	if (empty($params['tableID'])) $params['tableID'] = $rating_tableID;
	if (empty($params['units'])) $params['units'] = $rating_units;
	if (empty($params['recordUrl'])) $params['recordUrl'] = $rating_recordUrl;
	if (empty($params['static'])) $params['static'] = $rating_static;
	
	
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
	$static		=	$params['static'];
	
	$query=mysql_query("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$tableName WHERE $tableID='$id' ")or die(" Error: ".mysql_error());
	
	// insert the id in the DB if it doesn't exist already
	// see: http://www.masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/#comment-121
	if (mysql_num_rows($query) == 0) {
		$sql = "INSERT INTO $rating_dbname.$tableName (`".$tableID."`,`total_votes`, `total_value`, `used_ips`) VALUES ('$id', '0', '0', '')";
		$result = mysql_query($sql);
	}
	$numbers=mysql_fetch_assoc($query);
	
	if ($numbers['total_votes'] < 1) {
		$count = 0;
	} else {
		$count=$numbers['total_votes']; //how many votes total
	}
	$current_rating=$numbers['total_value']; //total number of rating added together and stored
	$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote
	
	// determine whether the user has voted, so we know how to draw the ul/li
	$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM $rating_dbname.$tableName WHERE used_ips LIKE '%".$ip."%' AND $tableID='".$id."' ")); 
	
	// now draw the rating bar
	$rating_width = @number_format($current_rating/$count,2)*$unitwidth;
	$rating1 = @number_format($current_rating/$count,1);
	$rating2 = @number_format($current_rating/$count,2);
	$gerth = @number_format($unitwidth*$units,0,'.','');

	if ($static == 'static') {
	
		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$gerth.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		$static_rater[] .= '</ul>';
		$static_rater[] .= '<p class="static">'.$id.'. Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast) <em>This is \'static\'.</em></p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";
		
		return join("\n", $static_rater);
	
	} else {
	
		$rater ='';
		$rater.='<div class="ratingblock">';
		
		$rater.='<div id="unit_long'.$id.'">';
		$rater.='  <ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$gerth.'px;">';
		$rater.='     <li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		
		for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
			if(!$voted) { // if the user hasn't yet voted, draw the voting stars
				$rater.='<li><a href="'.$recordUrl.'?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'" title="'.$ncount.' out of '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
			}
		}
		$ncount=0; // resets the count
		
		$rater.='  </ul>';
		$rater.='  <p';
		if($voted){ $rater.=' class="voted"'; }
		$rater.='>'.$id.' Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast)';
		$rater.='  </p>';
		$rater.='</div>';
		$rater.='</div>';
		return $rater;
	}
}
?>