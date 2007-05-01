<?php 
$id = $_GET["id"];
$page = $_GET['page'];
$text = $_GET["text"];
$what = $_GET['what'];

$result1 = mysql_query("SELECT * FROM pp_files") 
or die(mysql_error());  

if ( $id !== null ){
if ( $what == "approve" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='0', approved='1', reject='0' WHERE id=$id") 
or die(mysql_error());
$smarty->assign('message', "<br>".$id." has been ".$what."d! <br>");
}

if ( $what == "unapprove" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='0', approved='0', reject='0' WHERE id=$id") 
or die(mysql_error());
$smarty->assign('message', "<br>".$id." has been ".$what."d!<br>");
}

if ( $what == "feature" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='1', approved='1', reject='0' WHERE id=$id") 
or die(mysql_error());
$smarty->assign('message', "<br>".$id." has been ".$what."d! <br>");
}

if ( $what == "unfeature" ) {
$result1 = mysql_query("UPDATE pp_files SET feature='0' WHERE id=$id") 
or die(mysql_error());
$smarty->assign('message', "<br>".$id." has been ".$what."d!<br>");
}

if ( $what == "delete" ) {
   $result1 = mysql_query("DELETE FROM pp_files WHERE id=$id") 
or die(mysql_error());  
$smarty->assign('message', "<br>id".$id." has been ".$what."d!<br>");
}

if ( $what == "reject" ) {
    $result1 = mysql_query("UPDATE pp_files SET reject='1', approved='0', feature='0' WHERE id=$id") 
or die(mysql_error());
$smarty->assign('message', "<br>".$id." has been ".$what."d! <br>");
}

/* if ( $what == "editname" ) {
    $result1 = mysql_query("UPDATE pp_files SET name=$text WHERE id=$id") 
or die(mysql_error());
echo "id ".$id." name has been edited to say ".$text;
}

if ( $what == "editcreator" ) {
    $result1 = mysql_query("UPDATE pp_files SET creator=$text WHERE id=$id") 
or die(mysql_error());
echo "id ".$id." creator has been edited to say ".$text;
} */

}
 ?>

