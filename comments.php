<html>
<body>
<p>
<?php
safe_sql_insert($frm_idcm = $_GET['idcm']);
safe_sql_insert($frm_namecm = $_GET['namecm']);
safe_sql_insert($frm_commentcm = $_GET['commentcm']);
safe_sql_insert($ip=$_SERVER['REMOTE_ADDR']);

require("header.php")
require("db.php")

//GETS INFO FROM ADRESS EG ?creator=1
	$result1cm = mysql_query("SELECT * FROM pp_comments WHERE id='$frm_idcm'") 
	or die(mysql_error());
	$row1 = mysql_fetch_array( $result1cm );
	$result2cm = mysql_query("SELECT * FROM pp_comments WHERE comment='$frm_commentcm'") 
	or die(mysql_error());

		//INSERT INTO DB

if($frm_commentcm == ""){
	echo "Please Enter A Comment";
} else {
	if ($result2cm['name'] = $frm_commentcm){
		echo "Please Dont Double Post";}else{		
		mysql_query("INSERT INTO pp_comments (id, name, ip, date, comment, approve) VALUES ('$frm_idcm ', '$frm_namecm', '$ip', CURDATE(), '$frm_commentcm', '1') ")
		or die(mysql_error());

				
		echo "Thank You for sumbitting A Comment.";
	}
}//check for blank end
	//end submit
?>


<?php require("footer.php")?>
</body>
</html>
