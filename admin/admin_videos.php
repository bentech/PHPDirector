<?php
if (!isset($_COOKIE["admin"])){
    header('location: login.php');
}
?>

<?php include("admin_header.php")?>
<?php require("../db.php");?>
<body>
<?php 
if ($_GET['vidpage'] !== "approve"){
if ( $_GET['id'] == "" ) {
    echo "Please do not browse videos this way<br />";
}
}

$id = $_GET['id'];

if ($_GET['vidpage'] == "approve"){
// Get a specific result from the "pp_files" table
$result = mysql_query("SELECT * FROM pp_files
WHERE approved='0' AND reject='0'") or die();  
}else{
$result = mysql_query("SELECT * FROM pp_files
WHERE id=$id") or die();  }


// get the first (and hopefully only) entry from the result
$row = mysql_fetch_array( $result );

	    	if($row['name']  == null){
			if ($_GET['vidpage'] == "approve"){
					echo("<div align='center'><h2>No Videos To Approve</h2></div>");
			}else{
					echo("<div align='center'><h2>This Video Doesnt exist</h2></div>");
			}
		exit;
			}
?>

<?php 
echo "<div align='center'>";
echo "<p><h2>".$row['name']."</h2></p>";
echo "<p><b>This Video is Currently:</b>";
if($row['approved'] == "1"){echo "<font color='#00CC00' face='Arial Black' size='4'>Aprroved";}else{echo "<font color='#FF0000' face='Arial Black' size='4'>Not Aprroved";}
if($row['feature'] == "1"){echo "...Featured";}
if($row['reject'] == "1"){echo "<font color='#FF0000' face='Arial Black' size='4'>...Rejected";}
echo "</font></font></font><br>";



////PICTURES



if ($row['picture'] == ""){
//no pic
	  echo "<td><img border='0' src='images/noimage.bmp' height='64'>";
}else{
	if($row["video_type"] == "YouTube"){
   		//pic
		//this double checks if the image is valid for getting multiple images from youtube
   		$yt_pic_broken = explode("/", $row['picture']);
		$yt_pic_final = $yt_pic_broken[5];
 		if ($yt_pic_final = "2.jpg"){
		// this gets the inital link for the picture before 2.jpg
		$yt_pic_getstart = explode("2.jpg", $row['picture']);
		$yt_pic_link_final = $yt_pic_getstart[0];
		//this shows 3 images
	
   			echo "<img border='1' src='".$yt_pic_link_final."1.jpg' height='97' ><img border='1' src='".$yt_pic_link_final."2.jpg' height='97'><img border='1' src='".$yt_pic_link_final."3.jpg' height='97' >";
		}else{
			echo "
				<td>
					<a href='videos.php?id=".show_sql($row[id])."'>
					<img border='0' src='".show_sql($row['picture'])."' height='64'>
				</a>
			";
			}
			}else{
			$tehpic = $row[picture];
			$amp = array("&amp;");
			$new_replace  = array("&");
			$newphrase = str_replace("$amp", "$new_replace", "$tehpic");
			echo"
			<a href='admin_videos.php?id=".show_sql($row[id])."'>
			<img border='1' src='$newphrase' height='64'>
			</a>
			";
			}
			}




////PICTURES END
echo "<div style='border:3px dashed #808080; position: absolute; z-index: 1; left: 200px; top: 350px; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px;' id='layer1'>";
if ( $row['approved'] == "0" ){
	echo "<a href='?id=".$row[id]."&what=approve&vidpage=".$_GET['vidpage']."'>Approve</a>";
}else{
	echo "<a href='?id=".$row[id]."&what=unapprove&vidpage=".$_GET['vidpage']."'>UnApprove</a>";
}
//UN FEATURE or feature
//only feature on approved vids
if ( $row['feature'] == "0" ){	
	if ($_GET['pt'] == "all"){
		echo "<p><a href='?id=".$row[id]."&what=featureapprove&vidpage=".$_GET['vidpage']."'>Feature</a></p>";
	}else{
echo "<p><a href='?id=".$row[id]."&what=featureapprove&vidpage=".$_GET['vidpage']."'>Approve then Feature</a></p>";
	}
		
		
}else{
	echo "<p><a href='?id=".$row[id]."&what=unfeature&vidpage=".$_GET['vidpage']."'>UnFeature</a></p>";
}
		
			
//REJECT OR DELETE
		//reject or not
if ($_GET['pt'] == "rejected"){
		echo "<a href='?id=".$row[id]."&what=unreject&vidpage=".$_GET['vidpage']."'>  approve</a> or ";
}else{
		echo "<a href='?id=".$row[id]."&what=reject&vidpage=".$_GET['vidpage']."'>  Reject  </a> or ";
}
//delete
		echo "<a href='?id=".$row[id]."&what=delete&vidpage=".$_GET['vidpage']."'>Delete</a></div>";
		


//VIDEOS
?>
<br />
<?php 
include("../includes/players.inc.php");
?>
<br />
<?php echo "<b>Made by:</b> ".$row['creator'];?>
<br />
<?php echo "<b>Description:</b>  ".$row['description'];?>
<br />

<?
$what = $_GET['what'];
$id = $_GET['id'];
include("includes/admin_videos_functions.php");
echo "<br>&nbsp;<b>ID:</b>".$row['id'];
				?>
</div>
</html>
<?php mysql_close($mysql_link); ?>