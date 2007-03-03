<?php 

//$id = $_GET['id'];
//$text = $_GET['text'];

$result1 = mysql_query("SELECT * FROM pp_files") 
or die(mysql_error());  

if ( $id == "" ){
echo "";
}else{

if ( $what == "approve" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='0', approved='1', reject='0' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."d! <br>";
}

if ( $what == "unapprove" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='0', approved='0', reject='0' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."d!<br>";
}

if ( $what == "feature" ) {
    $result1 = mysql_query("UPDATE pp_files SET feature='1' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."d! <br>";
}

if ( $what == "unfeature" ) {
$result1 = mysql_query("UPDATE pp_files SET feature='0' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."d!<br>";
}

if ( $what == "delete" ) {
   $result1 = mysql_query("DELETE FROM pp_files WHERE id=$id") 
or die(mysql_error());  
echo "<br>id".$id." has been ".$what."d!<br>";
}

if ( $what == "reject" ) {
    $result1 = mysql_query("UPDATE pp_files SET reject='1', approved='0' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."d! <br>";
}

if ( $what == "unreject" ) {
    $result1 = mysql_query("UPDATE pp_files SET reject='0', approved='1' WHERE id=$id") 
or die(mysql_error());
echo "<br>".$id." has been ".$what."ed! <br>";
}

if ( $what == "featureapprove" ) {
 $result1 = mysql_query("UPDATE pp_files SET feature='1', approved='1' WHERE id=$id")  
or die(mysql_error());  
echo "<br>id ".$id." has been ".$what."d!<br>";
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

