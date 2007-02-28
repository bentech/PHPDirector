<?php
include("header.php");
?>
<?php
function Install(){
	echo'Welcome Php Director Install
	<form action="index.php" method="POST"><div>
	<input type="hidden" value="License" name="Installing">
	<input type="submit" value="Install"></div>
	</form></p>
	';	
}
function License(){
	echo'
	<div class="license_agreement">
	';
	include("gnu.php");
	echo'
	</div>
	<form action="index.php" method="POST"><div>
	<input type="hidden" value="Connections" name="Installing">
	<input type="submit" value="I hearby have read and agreed to the License"></div>
	</form>
	';
}
function Connections(){
	echo'
	<p>
<div align="center">
<form action="index.php"  method="POST">
<input type="hidden" value="Connections2" name="Installing">
<div>Database Host:<input name="Host" type="text" size="50"><br />
Database Username:<input name="Username" type="text" size="50"><br />
Database Password:<input name="Password" type="password" size="50"><br />
Database Name:<input name="Name" type="text" size="50"><br />
Admin Username:<input name="AUsername" type="text" size="50"><br />
Admin Password:<input name="Apassword" type="password" size="50"><br />
<input type="submit" value="Create Mysql Table">
	  </div>
	</form></p>
	';
}
function Connections2(){
	$host = $_POST["Host"];
	$username = $_POST["Username"];
	$password = $_POST["Password"];
	$name = $_POST["Name"];
	$ausername = $_POST["AUsername"];
	$apassword = $_POST["Apassword"];
	$con = mysql_connect("$host","$username","$password");
	if (!$con){
	echo'
	<script type="text/javascript">
	<!--
	window.location = "index.php?connect=connect"
	//-->
	</script>
	';
	}else{
	mysql_select_db("$name", $con);
	
		$sql1 = "CREATE TABLE pp_config 
	(
	name varchar(225),
	vids_per_page int(4),	
	exerntalheader varchar(225),
	externalheaderurl varchar(255),
	header_height int(225),
	logo varchar(255),
	cssstyle varchar(225),
	lang varchar(225),
	version double
	)";
	$sql2 = "CREATE TABLE pp_files
	(
	id int(64)   not null auto_increment primary key,
	name varchar(100),
	creator varchar(64),
	description longtext,
	date date,
	file varchar(36),
	approved char(2),
	feature char(2) NOT NULL default '0',
	ip varchar(20),
	picture varchar(60),
	category varchar(20) NOT NULL default '0',
	reject char(2) NOT NULL default '0',
	views int(225) NOT NULL default '0'
	)";
	$sql3 = "CREATE TABLE pp_rating
	(
	id int(11),
	total_votes int(225) NOT NULL default '0',
	total_value int(225) NOT NULL default '0',
	used_ips longtext
	)";
	mysql_query($sql1,$con);
	mysql_query($sql2,$con);
	mysql_query($sql3,$con);
	
	$filename = '../config.php';
	$somecontent = '
<?php
if (defined("PHPdirector")){
$cfg["db_host"] = "'.$host.'";
$cfg["db_name"] = "'.$name.'";
$cfg["db_user"] = "'.$username.'";
$cfg["db_pass"] = "'.$password.'"; 
$cfg["admin_user"] = "'.$ausername.'"; 
$cfg["admin_pass"] = "'.$apassword.'"; 	
}
?>';
	if (is_writable($filename)) {
		if (!$handle = fopen($filename, 'a')) {
			echo "Cannot write to file please set permissions to 777";
			exit;
	}
   if (fwrite($handle, $somecontent) === FALSE) {
       echo "Cannot write to file please set permissions to 777";
       exit;
	}
	echo "Success, Wrote DB data to file.\n";
	fclose($handle);
	} else {
		echo "Cannot write to file please set permissions to 777";
	}

	
	echo"Success";
	}
	echo'
	<form action="index.php" method="POST"><div>
	<input type="hidden" value="Options" name="Installing">
	<input type="submit" value="Continue"></div>
	</form>	
	';
}

function Options(){
	echo'
	<center><b>Everything is required, Nothing can be blank</b></center>
	<p>
	<pre>

	<table border="0" width="auto" height="auto">
	<form action="complete_install.php" method="POST">
	<tr><td>Name:</td><td><input type="text" value="PHP Director" name="name"></td></tr>
	<tr><td>Videos Per Page:</td><td><input type="text" value="10" name="vids_per_page"></td></tr>
	<tr><td>*Your own Header?:</td><td><input type="text" value="false" name="exerntalheader"></td></tr>
	<tr><td>**Header URL:</td><td><input type="text" value="none" name="externalheaderurl"></td></tr>
	<tr><td>**Header Height:</td><td><input type="text" value="0" name="header_height"></td></tr>
	<tr><td>***Logo:</td><td><input type="text" value="default" name="logo"></td></tr>
	<tr><td>CSS Url:</td><td><input type="text" value="css/style.css" name="cssstyle"></td></tr>
	<tr><td>****Lang:</td><td><input type="text" value="English" name="lang"></td></tr>
	<tr><td></td><td><tr><td><input type="hidden" name="Editing"></td><td>
	<tr><td colspan="2"><center><input type="submit" value="Edit"></center></td></tr>
	</table>
	</form>
	<br>
	<br>
	<br>
	</center>
	* : If you have a header you would like instead of our type in the URL otherwish type false
	<br>
	** : If you have your own Header
	<br>
	*** : If default logo type in default otherwise type in URL
	<br>
	**** : English or German
	</pre>	
	';
}
?>
<?php
if(isset($_POST["Installing"])){
	$installing = $_POST["Installing"];
	
	if($installing == "License"){
		License();
	}
	if($installing == "Connections"){
		Connections();
	}
	if($installing == "Connections2"){
		Connections2();
	}
	if($installing == "Options"){
		Options();
	}


}else{
if(isset($_GET["connect"])){
echo"Could not connect";
	Connections();
}else{
	Install();
}
}
?>
<?php
include("footer.php");
?>
