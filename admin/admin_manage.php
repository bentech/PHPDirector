<?php
session_start();
// is the one accessing this page logged in or not?
if (!isset($_SESSION['phpdirector'])
    || $_SESSION['phpdirector'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}
$pagevalue = $_GET["pt"];
$id = $_GET["id"];
$page = $_GET['page'];
$text = $_GET["text"];
$what = $_GET['what'];
include("admin_header.php");
?>
<?php 
	if ($pagevalue == ""){
	?>
    <div align='center'><p><h2>Welcome To The Admin Area</h2></p></div>
<p>Thank you for helping moderate the videos</p>
	<?
	exit;
	}
	
	if ($pagevalue == "home"){
	?>
	
<h2>
FRAMED HOME</h2>
<p>
<iframe name="homepage" src="../" width="100%" height="2050" border="0" frameborder="0" marginwidth="1" marginheight="1" scrolling="no" align="top">
Please Use Firefox
</iframe></p>
	<?
	exit;
	}
	
	
$limit = config('vids_per_page');
if ((empty($page)) || ($page <= 0)){
    $page = 1;
} 
$limitvalue = $page * $limit - $limit; 
  
	// count(*) is better for large databases (thanks Greg!)
if ($pagevalue  == "all"){
	$result_check = mysql_query("SELECT count(*) AS cnt FROM pp_files WHERE approved='1'"); 
	$result = mysql_query("SELECT * FROM pp_files WHERE approved='1' ORDER BY id DESC LIMIT $limitvalue, $limit");	
}	
if ($pagevalue == "feature"){
    $result_check = mysql_query("SELECT count(*) AS cnt FROM pp_files WHERE feature='1'"); 
	$result = mysql_query("SELECT * FROM pp_files WHERE feature = '1' ORDER BY id DESC LIMIT $limitvalue, $limit");
}
if ($pagevalue == "approve"){
    $result_check = mysql_query("SELECT count(*) AS cnt FROM pp_files WHERE approved='0' AND reject='0'");
	$result = mysql_query("SELECT * FROM pp_files WHERE approved='0' AND reject='0' ORDER BY id DESC LIMIT $limitvalue, $limit");
}
if ($pagevalue == "rejected"){
    $result_check = mysql_query("SELECT count(*) AS cnt FROM pp_files WHERE approved='0' AND reject='1'"); 
	$result = mysql_query("SELECT * FROM pp_files WHERE approved='0' AND reject='1' ORDER BY id DESC LIMIT $limitvalue, $limit");	
}
$check = mysql_fetch_array($result_check);
$checking = $check["cnt"];
	if($checking == "0"){
		if ($pagevalue == "approve"){
			echo("<div align='center'><h2>No Videos To Approve</h2></div>");
		}else{
			echo("<div align='center'><h2>No Videos Here</div></h2>");
		}
		exit;
	}
	
if ($pagevalue == "all"){
    echo "<h2>Movies</tr></h2>";   
}	
if ($pagevalue == "feature"){
    echo "<h2>Featured Movies</h2></tr>";
}
if ($pagevalue == "approve"){
    echo "<h2>Movies that need approving</h2></tr>";
}	
if ($pagevalue == "rejected"){
    echo "<h2>Movies that have been rejected</h2></tr>";
}
?>	
<table cellspacing="0" cellpadding="0" border="1" id="categorias"><tbody>
	<tr class="categoria_h">
		<th class="s1">ID</th>
		<th class="s2">Video Name</th>
		<th class="s3">Description</th>
		<th class="s4">Date</th>
		<th class="s5">Author</th>
		<th class="s6">Pictures</th>
		<th class="s7">Actions</th>
	</tr>
<?php
while($row = mysql_fetch_array($result)){				
?>
<tr class="subcategoria">
	<td class="s1">	
		<a href="admin_videos.php?id=<?php echo show_sql($row["id"]); ?>" target="_blank">
		<?php echo show_sql($row["id"]); ?></a>
	</td>
	
	<td class="s2">
		<a href="admin_videos.php?id=<?php echo show_sql($row["id"]); ?>" target="_blank">
		<?php echo show_sql(substr($row['name'], 0,40)); ?></a>
	</td>
	
	<td class="s3">	
		<?php echo show_sql(substr($row['description'], 0,100)); ?>
	</td>
	
	<td class="s4">
		<?php echo show_sql($row['date']);?>
	</td>
	<td class="s5">	
		<?php echo show_sql($row['creator']);?>
	</td>

	<td class="s6">
	<?php 
		if ($row['picture'] == null){
			echo "<td><a href='videos.php?id=".show_sql($row["id"])."'><img border='0' src='images/noimage.bmp' height='64'></a>";
		}else{
			$yt_pic_broken = explode("/", show_sql($row['picture']));
			$yt_pic_final = $yt_pic_broken[5];
			if ($yt_pic_final = "2.jpg"){
					$yt_pic_getstart = explode("2.jpg", show_sql($row['picture']));
					$yt_pic_link_final = $yt_pic_getstart[0];
					echo "
						<a href='admin_videos.php?id=".show_sql($row[id])."'>
							<img border='1' src='".$yt_pic_link_final."3.jpg' height='64'>
							<img border='1' src='".$yt_pic_link_final."2.jpg' height='64'>
							<img border='1' src='".$yt_pic_link_final."1.jpg' height='64'>
						</a>";
			}else{
			echo "
				<td>
					<a href='videos.php?id=".show_sql($row[id])."'>
					<img border='0' src='".show_sql($row['picture'])."' height='64'>
				</a>
			";
			}
		}
?>
	</td>
	
	<td class="s7">
		<?php
		if ($row['approved'] == "0"){
			echo "<a href='?id=".show_sql($row[id])."&what=approve&pt=".$pagevalue."&page=".$page."'>Approve</a>";
		}else{
			echo "<a href='?id=".show_sql($row[id])."&what=unapprove&pt=".$pagevalue."&page=".$page."'>UnApprove</a>";
		}
		if ($row['feature'] == "0" ){	
			if ($pagevalue == "all"){
				echo "<p><a href='?id=".show_sql($row[id])."&what=featureapprove&pt=".$pagevalue."&page=".$page."'>Feature</a></p>";
			}else{
				echo "<p><a href='?id=".show_sql($row[id])."&what=featureapprove&pt=".$pagevalue."&page=".$page."'>Approve then Feature</a></p>";
			}
		}else{
			echo "<p><a href='?id=".show_sql($row[id])."&what=unfeature&pt=".$pagevalue."&page=".$page."'>UnFeature</a></p>";
		}

		if ($_GET['pt'] == "rejected"){
			echo "<a href='?id=".show_sql($row[id])."&what=unreject&pt=".$pagevalue."&page=".$page."'>Approve</a> or ";
		}else{
			echo "<a href='?id=".show_sql($row[id])."&what=reject&pt=".$pagevalue."&page=".$page."'>Reject</a> or ";
		}
			echo "<a href='?id=".show_sql($row[id])."&what=delete&pt=".$pagevalue."&page=".$page."'>Delete</a>";
		?>
	</td>
	</tr>
<?php  
	echo "</tbody>";
}
	echo "</table>";
if ($checking < $limit){
}else{
    if($page != 1){ 
        $pageprev = $page-1;
        echo("<p><a href='admin_manage.php?pt=$pagevalue&page=$pageprev'>PREV</a>&nbsp;&nbsp;");  
			/* Tip: It is a good idea NOT to use $PHP_SELF in this link. It may work, 
			but to be 99.9% sure that it will, be sure to use the actual name of the file 
			this script will be running on. Also, the   adds a space to the end of 
			PREV, and gives some room between the numbers. */
    }else{
        echo("PREV&nbsp;&nbsp;"); 
	}

		$numofpages = $checking / $limit; 
			/* We divide our total amount of rows (for example 102) by the limit (25). This 
			will yield 4.08, which we can round down to 4. In the next few lines, we'll 
			create 4 pages, and then check to see if we have extra rows remaining for a 5th page. */
		for($i = 1; $i <= $numofpages; $i++){
				/* This for loop will add 1 to $i at the end of each pass until $i is greater than $numofpages (4.08). */
			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href='admin_manage.php?pt=".$pagevalue."&page=".$i."'>$i</a> "); 
			}
				/* This if statement will not make the current page number available in link form. It will, however, make all other pages available in link form. */
		}
		if(($checking % $limit) != 0){
				/* The above statement is the key to knowing if there are remainders, and it's all because of the %. In PHP, C++, and other languages, the % is known as a 
				Modulus. It returns the remainder after dividing two numbers. If there is no remainder, it returns zero. In our example, it will return 0.8 */
			if($i == $page){
				echo($i." ");
			}else{
				echo("<a href='admin_manage.php?pt=".$pagevalue."&page=".$i."'>$i</a> ");
			}
				/* This is the exact statement that turns pages into link form that is used above */ 
		}
	
	    if(($checking - ($limit * $page)) > 0){
			/* This statement checks to see if there are more rows remaining, meaning there are pages in front of the current one. */
			$pagenext   = $page+1;
			// Fancy way of adding 1 to page
			echo("&nbsp;&nbsp;<a href='admin_manage.php?pt=".$pagevalue."&page=".$pagenext."'>NEXT</a> ");
			/* Since there are pages remaining, this outputs NEXT in link form. */ 
		}else{
			echo("&nbsp;&nbsp;NEXT"); 
			/* If we're on the last page possible, NEXT will NOT be displayed in link form. */
		}
 
	}
?> 
</font></p>

</body>
</html>
<?php mysql_close($mysql_link); ?>