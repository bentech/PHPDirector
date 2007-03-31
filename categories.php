<?php
define("PHPdirector", 1);

$sort1 = $_GET['sort'];
$page = $_GET['page'];

include("header.php");

require('libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = './templates/Photine';
$smarty->compile_dir = './templates_c';
$smarty->cache_dir = './cache';
$smarty->config_dir = './configs';

$smarty->assign('name', 'Ned');
?>
<?php
$result = mysql_query("select * from pp_files order by rand() limit 1");
$result1 = mysql_query("select * from pp_catigories order by rand()");

while($row = mysql_fetch_array($result)){
while($row2 = mysql_fetch_array($result2)){
?>
<div class='left'>
	<div class="left_articles">
		<div class="buttons">
			<p align="center"><a href="videos.php?id=<?php echo $row[id]?>" class="bluebtn"><?php echo LAN_14; ?></a>
			<a href="videopop.php?KeepThis=true&amp;height=530&amp;width=430&amp;id=<?php echo $row[id];?>"class="thickbox greenbtn" rel="gallery-videos" title="<?php echo show_sql($row['name']);?>"><?php echo LAN_15; ?></a></p>
		</div>
		<div class="calendar"><p><?php echo date("M", strtotime($row[date]));?><br /><?php echo date("d", strtotime($row[date]));?></p></div>
			<h2><a href="videos.php?id=<?php echo $row[id]?>"><?php echo show_sql(substr($row['name'], 0,32));
			if (strlen($row['name']) >32){
 			echo "...</a></h2>";}else{
 			echo "</a></h2>";
			}
			?>

			<p class="description"><b><?php echo LAN_16; ?>: </b> 
			<?php echo show_sql(substr($row['creator'], 0,20))?> - <b><?php echo LAN_17; ?>: </b>
			<?php echo show_sql($row['views'])?></p>
			<p><img height='97' width='130' src="<?php if ($row['picture'] == ""){
			echo "images/noimage.bmp";
			}else{
			$tehpic = $row[picture];
			$amp = array("&amp;");
			$new_replace  = array("&");
			$newphrase = str_replace("$amp", "$new_replace", "$tehpic");
			echo"
			$newphrase
			";
			}?>" class="thumbnail" alt="<?php show_sql(substr($row['name'], 0,10))?>" />
			<?php echo show_sql(substr($row['description'], 0, 450)); //BUGGY: if &quote; or something splitten, you doesn't see &, you see &quo or something 
 			if (strlen($row['description']) >450){
 			echo "...</p>";}else{
 			echo "</p>";
 			}
?>
		</div>

<?php }} ?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
 <?php
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
	echo "<br/><br/><br/><br/><br/><br/>";


include("footer.php");
//$smarty->display('index.tpl');
?>
