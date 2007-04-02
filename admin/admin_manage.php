<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
if (!isset($_COOKIE["admin"])){
    header('location: login.php');
}
$pagevalue = $_GET["pt"];
$id = $_GET["id"];
$page = $_GET['page'];
$text = $_GET["text"];
$what = $_GET['what'];
include("admin_header.php");
include("includes/admin_videos_functions.php");
$smarty->assign('id', $id);
$smarty->assign('pagevalue', $pagevalue);
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


$result1 = array();
$i=0;
while ($row = mysql_fetch_array($result)) {
	
	//PICTURE
		if($row["video_type"] == "YouTube"){
			$yt_pic_broken = explode("/", show_sql($row['picture']));
			$yt_pic_final = $yt_pic_broken[5];
		if ($yt_pic_final = "2.jpg"){
			$yt_pic_getstart = explode("2.jpg", show_sql($row['picture']));
			$ytpic = $yt_pic_getstart[0];
	}
	}
	
	
	$tmp = array(
'id' => $row['id'], 
'name' => $row['name'],
'creator' => $row['creator'],
'picture' => $row['picture'],
'ytpic' => $ytpic,
'description' => $row['description'],
'date' => $row['date'],
'video_type' => $row['video_type']
);
$result1[$i++] = $tmp;
}
//PICTURE_END
$smarty->assign('video', $result1);

$smarty->display('admin_manage.tpl');

if ($checking < $limit){
}else{
    if($page != 1){ 
        $pageprev = $page-1;
        echo("<p><a href='admin_manage.php?pt=$pagevalue&page=$pageprev'>".LAN_18."</a>&nbsp;&nbsp;");  
			/* Tip: It is a good idea NOT to use $PHP_SELF in this link. It may work, 
			but to be 99.9% sure that it will, be sure to use the actual name of the file 
			this script will be running on. Also, the   adds a space to the end of 
			PREV, and gives some room between the numbers. */
    }else{
        echo("".LAN_18."&nbsp;&nbsp;"); 
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
			echo("&nbsp;&nbsp;<a href='admin_manage.php?pt=".$pagevalue."&page=".$pagenext."'>".LAN_19."</a> ");
			/* Since there are pages remaining, this outputs NEXT in link form. */ 
		}else{
			echo("&nbsp;&nbsp;".LAN_19.""); 
			/* If we're on the last page possible, NEXT will NOT be displayed in link form. */
		}
 
	}