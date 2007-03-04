<?php
define("PHPdirector", 1);

$sort1 = $_GET['sort'];
$page = $_GET['page'];

include("header.php");
?>
<?php
if ($sort1 == "name"){
	$sort = "name";
}
elseif ($sort1 == "date"){
	$sort = "id";
}
elseif ($sort1 == "views"){
	$sort = "views";
}  
else {
	$sort = "id";
	$order1 = "DESC";
}

if ($pagetype == null){ // empty?
    $pagetype = "all";
	}
//Check if theres a Get called order then is its down order by DESC if its up dont order by DESC if no get varriable order by non DESC
if(isset($_GET["order"])){
	$order = $_GET["order"];
		if($order == "up"){
			$order1 = "";
		}
		elseif($order == "down"){
			$order1 = "DESC";
		}
}

// Get all the data from the " pp_files" table

$limit = config('vids_per_page');

    // count(*) is better for large databases (thanks Greg!)
	if ($pagetype == "all"){
    $query_count   = mysql_query("SELECT * FROM pp_files WHERE approved='1'");
	}

		if ($pagetype == "feature"){ 
	$query_count  = mysql_query("SELECT * FROM pp_files WHERE approved='1' AND feature = '1'");
	}

		if ($pagetype == "pictures"){
    $query_count   = mysql_query("SELECT * FROM pp_files WHERE approved='1'");
	}

    $totalrows  = mysql_num_rows($query_count);
    // This counts the number of users


if ((empty($page)) || ($page <= 0)){
    $page = 1;
}

  $limitvalue = $page * $limit - $limit;
    // Ex: (2 * 25) - 25 = 25 <- data starts at 25
	if($sort1 == "rating"){
	$query  = "
	SELECT ppf.*, ppr.total_value/ppr.total_votes as r 
	FROM pp_files AS ppf
	INNER JOIN pp_rating as ppr ON ppr.id=ppf.id 
	ORDER BY r $order1 LIMIT $limitvalue, $limit";
	
	}else{
		if ($pagetype == "all"){
    $query  = "SELECT * FROM pp_files WHERE approved='1' ORDER BY $sort $order1 LIMIT $limitvalue, $limit ";
    // Pulls what we want from the database
	}	
	}

			if ($pagetype == "pictures"){
    $query  = "SELECT * FROM pp_files WHERE approved='1' ORDER BY $sort $order1 LIMIT 0, 110 ";
    // Pulls what we want from the database
	}

		if ($pagetype == "feature"){
		$query  = "SELECT * FROM pp_files WHERE approved='1' AND feature = '1' ORDER BY $sort $order1 LIMIT $limitvalue, $limit ";
    // Pulls what we want from the database
	}
	
	
    $result = mysql_query($query) or die("Error: " . mysql_error());
	
    // Selects all the data from table.
    // mysql_error() will print an error if one occurs.

    /* Tip: The MySQL LIMIT value syntax is as follows:

    LIMIT $row_to_start_at, $how_many_rows_to_return

    */

	    if(mysql_num_rows($query_count) == 0){
        echo LAN_29;
    }

	if(mysql_num_rows == false){
	        echo LAN_29;
    }
    // This reads the number of rows returned
    // from the result above.

    /* Tip: You could probably use if($totalrows == 0) for the if statement;
however, reading the actual $result from the data you'll be printing to the
screen is more accurate, and is a surefire way of preventing certain errors. */


if ($pagetype == "pictures"){
    echo "<b>".LAN_30."</b>";
}

//<!--picture list-->

	if ($pagetype == "pictures"){
		echo '<table border="0" width="100%"><tr><td>';
		while($row = mysql_fetch_array($result)){
			//this shows 3 images
			$yt_pic_broken = explode("/", $row['picture']);
		$yt_pic_final = $yt_pic_broken[5];
 		if ($yt_pic_final = "2.jpg"){
		?>
	   		<a href="videos.php?id=<?php echo $row[id];?>"><img border="0" src="<?php echo $row['picture']?>" align="right" height="97" width="130" alt=""/>
			<?
			}
	}
	echo '</td></tr><tr><td>';
	
include("footer.php");
echo '</td></tr></table>';
exit;

	}

?>
<!--SORT BY-->
<div align="left">
<p>
<b>&nbsp;&nbsp;&nbsp;Sort By:&nbsp;</b>
<?php echo LAN_31; //Ratings?>
<a href="?sort=rating&order=up" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('rateup','','images/arrowupani.gif',1)">
<img src="images/arrowup.gif" name="rateup" border="0" id="rateup" title="Worst Rated Videos" alt="arrow up" /></a>

<a href="?sort=rating&order=down" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('ratedwn','','images/arrowdownani.gif',1)"><img src="images/arrowdown.gif" name="ratedwn" border="0" id="ratedwn" title="Best Rated Videos" alt="arrow down" /></a>

&nbsp;
<?php echo LAN_32; //views ?>

<a href="?sort=views&order=up" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('viewup','','images/arrowupani.gif',1)">
<img src="images/arrowup.gif" name="viewup" border="0" id="viewup" title="Least Viewed Videos" alt="arrow up" /></a>

<a href="?sort=views&order=down" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('viewdwn','','images/arrowdownani.gif',1)"><img src="images/arrowdown.gif" name="viewdwn" border="0" id="viewdwn" title="Most Viewed Videos" alt="arrow down" /></a>

&nbsp;
<?php echo LAN_33; //name ?>

<a href="?sort=name&order=up" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('nameup','','images/arrowupani.gif',1)">
<img src="images/arrowup.gif" name="nameup" border="0" id="nameup" title="A-Z" alt="arrow up" /></a>

<a href="?sort=name&order=down" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('namedwn','','images/arrowdownani.gif',1)"><img src="images/arrowdown.gif" name="namedwn" border="0" id="namedwn" title="Z-A" alt="arrow down" /></a>

&nbsp;
<?php echo LAN_34; //date ?>

<a href="?sort=date&order=up" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('dateup','','images/arrowupani.gif',1)"> <img src="images/arrowup.gif" name="dateup" border="0" id="dateup" title="Least Recent Videos" alt="arrow up" /></a>

<a href="?sort=date&order=down" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('datedown','','images/arrowdownani.gif',1)"><img src="images/arrowdown.gif" name="datedown" border="0" id="datedown" title="Most Recent Videos" alt="arrow down" /></a>
</p>
</div>
<?
// write a shortcut for arrow down/up


// keeps getting the next row until there are no more to get
while($row = mysql_fetch_array($result)){
 //differnt colours each row
?>
<div class='left'>
	<div class="left_articles">
		<div class="buttons">
			<p align="center"><a href="videos.php?id=<?php echo $row[id]?>" class="bluebtn">View</a>
			<a href="videopop.php?KeepThis=true&amp;height=530&amp;width=430&amp;id=<?php echo $row[id];?>"class="thickbox greenbtn" rel="gallery-videos" title="<?php echo show_sql($row['name']);?>">Popup</a></p>
		</div>
		<div class="calendar"><p><?php echo date("M", strtotime($row[date]));?><br /><?php echo date("d", strtotime($row[date]));?></p></div>
			<h2><a href="videos.php?id=<?php echo $row[id]?>"><?php echo show_sql(substr($row['name'], 0,32));
			if (strlen($row['name']) >32){
 			echo "...</a></h2>";}else{
 			echo "</a></h2>";
			}
			?>

			<p class="description"><b>by: </b> <?php echo show_sql(substr($row['creator'], 0,20))?> - <b>Views: </b><?php echo show_sql($row[			 'views'])?></p>
			<p><img height='97' width='130' src="<?php if ($row['picture'] == ""){
			echo "images/noimage.bmp";
			}else{
			echo $row['picture'];
			}?>" class="thumbnail" alt="<?php show_sql(substr($row['name'], 0,10))?>" />
			<?php echo show_sql(substr($row['description'], 0, 450)); //BUGGY: if &quote; or something splitten, you doesn't see &, you see &quo or something 
 			if (strlen($row['description']) >450){
 			echo "...</p>";}else{
 			echo "</p>";
 			}
?>
		</div>

<? } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
 <?php

if ($totalrows < $limit){
}else{

    if($page != 1){
        $pageprev = $page-1;
        // Fancy way of subtracting 1 from $page

        echo("<a href='index.php?pt=$pagetype&page=$pageprev&sort=$sort&order=$order1'>PREV</a> &nbsp;");
        /* Tip: It is a good idea NOT to use $PHP_SELF in this link. It may work,
but to be 99.9% sure that it will, be sure to use the actual name of the file
this script will be running on. Also, the   adds a space to the end of
PREV, and gives some room between the numbers. */
    }else{
        echo("PREV&nbsp;&nbsp;");
        // If we're on page 1, PREV is not a link
		}
		
		


		$numofpages = $totalrows / $limit;
    /* We divide our total amount of rows (for example 102) by the limit (25). This

will yield 4.08, which we can round down to 4. In the next few lines, we'll
create 4 pages, and then check to see if we have extra rows remaining for a 5th
page. */

    for($i = 1; $i <= $numofpages; $i++){
    /* This for loop will add 1 to $i at the end of each pass until $i is greater
than $numofpages (4.08). */

        if($i == $page){
            echo($i." ");
        }else{
		?>
        <a href='index.php?pt=<?php echo $pagetype; ?>&page=<?php echo $i; ?>&sort=<?php echo $sort;?>&order=<?php echo $order1;?>'><?php echo $i; ?></a>
			<?
        }

        /* This if statement will not make the current page number available in
link form. It will, however, make all other pages available in link form. */
    }   // This ends the for loop




    if(($totalrows % $limit) != 0){
    /* The above statement is the key to knowing if there are remainders, and it's
all because of the %. In PHP, C++, and other languages, the % is known as a
Modulus. It returns the remainder after dividing two numbers. If there is no
remainder, it returns zero. In our example, it will return 0.8 */

        if($i == $page){
            echo($i." ");
        }else{
		?>
            <a href='index.php?pt=<?php echo $pagetype; ?>&page=<?php echo $i; ?>&sort=<?php echo $sort;?>&order=<?php echo $order1;?>'><?php echo $i; ?></a>
			<?
        }
        /* This is the exact statement that turns pages into link form that is used

above */
    }   // Ends the if statement

	    if(($totalrows - ($limit * $page)) > 0){
    /* This statement checks to see if there are more rows remaining, meaning there
are pages in front of the current one. */

        $pagenext   = $page+1;
        // Fancy way of adding 1 to page
		?>
        <a href='index.php?pt=<?php echo $pagetype; ?>&page=<?php echo $pagenext;?>&sort=<?php echo $sort;?>&order=<?php echo $order1;?>'>NEXT</a></div>
	<?
        /* Since there are pages remaining, this outputs NEXT in link form. */
    }else{
        echo("&nbsp;&nbsp;NEXT");
    }

    mysql_free_result($result);
    /* This line is not required, since MySQL will free the result after all
scripts have finished executing; however, it's a nice little backup. */
    }
	echo "<br/><br/><br/><br/><br/><br/>";


?>
</p>
<?php
include("footer.php");
?>
