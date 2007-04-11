<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
/*
Page:           _drawrating.php
Created:        Aug 2006
The function that draws the rating bar.	
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
--------------------------------------------------------- */
/**
 * Shows A rating bar with id, units normally 5
 *
 * @param video id
 * @param how many stars $units
 */
function rating_bar($id,$units='') { 

require('_config-rating.php'); // get the db connection info
	
//set some variables
$ip = $_SERVER['REMOTE_ADDR'];
if (!$units) {$units = 10;}

$query=mysql_query("SELECT total_votes, total_value, used_ips FROM $tableName WHERE id='$id' ")or die(" Error: ".mysql_error());
if (!mysql_num_rows($query)) { //This is the edit
$sql = "INSERT INTO $tableName (`id`,
`total_votes`, `total_value`, `used_ips`)
VALUES ('$id', '0', '0', '')";
$result = mysql_query($sql);
}

$numbers=mysql_fetch_assoc($query);
$count=$numbers['total_votes']; //how many votes total
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM $tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id."' ")); 

// now draw the rating bar

?>
<div id="unit_long<?php echo $id ?>">
		<ul id="unit_ul<?php echo $id ?>" class="unit-rating" style="width:<?php echo $unitwidth*$units; ?>px;">
		<li class="current-rating" style="width:<?php echo @number_format($current_rating/$count,2)*$unitwidth; ?>px;">Currently <?php echo @number_format($current_rating/$count,2); ?>/<?php echo $units ?></li>
<?php
	for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
		if(!$voted) { // if the user hasn't yet voted, draw the voting stars 
		?>
<li><a href="db_rating.php?j=<?php echo $ncount ?>&q=<?php echo $id ?>&t=<?php echo $ip ?>&c=<?php echo $units ?>" title="<?php echo $ncount ?> out of <?php echo $units ?>" class="r<?php echo $ncount ?>-unit rater"><?php echo $ncount ?></a></li>
<?php
	 } 
  }
	$ncount=0; // resets the count
?>
		</ul>
		<p<?php if($voted){?> class="voted"<?php } ?> >Rating: <strong> <?php echo @number_format($current_rating/$count,1) ?></strong>/<?php echo $units ?> (<?php echo $count ?> <?php echo $tense ?> cast)	    <span class="style1"><br />
		 </span></p>
</div>
<?php
}
?>