<?php
define("PHPdirector", 1);

$sort1 = $_GET['sort'];
$page = $_GET['page'];
$pagetype = $_GET["pt"];

require('libs/Smarty.class.php');
include("includes/check_install.inc.php");
include("db.php");
include("includes/function.inc.php");
$smarty = new Smarty();
$smarty->template_dir = './templates/Photine';
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';

include("lang/".config('lang')."/lang.inc.php");
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
	if(isset($_POST["searching"])){
	$query_count   = mysql_query("SELECT * FROM pp_files WHERE name like '%$_POST[searching]%'");
	}else{
	if ($pagetype == "all"){
    $query_count   = mysql_query("SELECT * FROM pp_files WHERE approved='1' AND reject='0'");
	}
	}

		if ($pagetype == "feature"){ 
	$query_count  = mysql_query("SELECT * FROM pp_files WHERE approved='1' AND feature = '1'");
	}

		if ($pagetype == "pictures"){
    $query_count   = mysql_query("SELECT * FROM pp_files WHERE approved='1' AND reject='0'");
	}

    $totalrows  = mysql_num_rows($query_count);
    // This counts the number of users


if ((empty($page)) || ($page <= 0)){
    $page = 1;
}

  $limitvalue = $page * $limit - $limit;
    // Ex: (2 * 25) - 25 = 25 <- data starts at 25
	if(isset($_POST["searching"])){
	$query  = "SELECT * FROM pp_files WHERE name like '%$_POST[searching]%' ORDER BY $sort $order1 LIMIT $limitvalue, $limit ";
	}else{
	if($sort1 == "rating"){
	$query  = "
	SELECT ppf.*, ppr.total_value/ppr.total_votes as r 
	FROM pp_files AS ppf
	INNER JOIN pp_rating as ppr ON ppr.id=ppf.id 
	ORDER BY r $order1 LIMIT $limitvalue, $limit";
	
	}else{
		if ($pagetype == "all"){
    $query  = "SELECT * FROM pp_files WHERE approved='1' AND reject='0' ORDER BY $sort $order1 LIMIT $limitvalue, $limit ";
    // Pulls what we want from the database
	}	
	}
	}

			if ($pagetype == "pictures"){
    $query  = "SELECT * FROM pp_files WHERE approved='1' AND reject='0' ORDER BY $sort $order1 LIMIT 0, 110 ";
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
        $smarty->assign('error', $LAN_29);
    }

	if(mysql_num_rows == false){
	     $smarty->assign('error', $LAN_29);
    }
    // This reads the number of rows returned
    // from the result above.







//NEWS//
$news = config('news');

$smarty->assign('news', $news);
//NEWS//






//Pictures
if ($pagetype == "pictures"){

// For each result that we got from the Database
while ($row = mysql_fetch_assoc($result))
{
 $images[] = $row;
}

// Assign this array to smarty

$smarty->assign('images', $images);

//Display Images page
$smarty->display('images.tpl');
exit;
}
//pictures





//main video list
$result1 = array();
$i=0;
while ($row = mysql_fetch_array($result)) {


$month = date("M", strtotime($row[date]));
$day = date("d", strtotime($row[date]));
$name = substr($row['name'], 0,32);
if (strlen($row['name']) >32){$name2 = "...";}
$creator = substr($row['creator'], 0,20);

//image
if ($row['picture'] !== null){
			$tehpic = $row[picture];
			$amp = array("&amp;");
			$new_replace  = array("&");
			$newphrase = str_replace("$amp", "$new_replace", "$tehpic");
			$picture = $newphrase;
			}
//image			
			

$description = substr($row['description'], 0, 450);
if (strlen($row['description']) >450){$description2 = "...";}
      
            $tmp = array(
            	 'id'=> $row['id'], 
            	 'month'=> $month, 
            	 'day'=> $day,
                'name'=> $name.$name2,
            	 'creator'=> $creator,
            	 'picture'=> $picture,
            	 'description'=> $description.$description2,
                    );
            
            
            $result1[$i++] = $tmp;
}
//pass the results to the template
$smarty->assign('videos', $result1);
$smarty->display('index.tpl');

if ($totalrows < $limit){
}else{

    if($page != 1){
        $pageprev = $page-1;
        // Fancy way of subtracting 1 from $page

        echo("<a href='index.php?pt=$pagetype&amp;page=$pageprev&amp;sort=$sort&amp;order=$order1'>".LAN_18."</a> &nbsp;");
        /* Tip: It is a good idea NOT to use $PHP_SELF in this link. It may work,
but to be 99.9% sure that it will, be sure to use the actual name of the file
this script will be running on. Also, the   adds a space to the end of
PREV, and gives some room between the numbers. */
    }else{
        echo("".LAN_18."&nbsp;&nbsp;");
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
        <a href='index.php?pt=<?php echo $pagetype; ?>&amp;page=<?php echo $i; ?>&amp;sort=<?php echo $sort;?>&amp;order=<?php echo $order1;?>'><?php echo $i; ?></a>
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
            <a href='index.php?pt=<?php echo $pagetype; ?>&amp;page=<?php echo $i; ?>&amp;sort=<?php echo $sort;?>&amp;order=<?php echo $order1;?>'><?php echo $i; ?></a>
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
        <a href='index.php?pt=<?php echo $pagetype; ?>&amp;page=<?php echo $pagenext;?>&amp;sort=<?php echo $sort;?>&amp;order=<?php echo $order1;?>'><?php echo LAN_19;?></a></div>
	<?
        /* Since there are pages remaining, this outputs NEXT in link form. */
    }else{
        echo("&nbsp;&nbsp;".LAN_19."");
    }

    mysql_free_result($result);
    /* This line is not required, since MySQL will free the result after all
scripts have finished executing; however, it's a nice little backup. */
    }
?>
