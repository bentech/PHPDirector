<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko and Monte Ohrt (Monte Ohrt)
+----------------------------------------------------------------------------+
*/
include("header.php");

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
<br /><br />
<!-- Creative Commons License --><br /><br /><br /><br />
<a href="http://creativecommons.org/licenses/GPL/2.0/">
<img alt="CC-GNU GPL" border="0" src="http://creativecommons.org/images
/public/cc-GPL-a.png" /></a><br />
This software is licensed under the <a href="http://creativecommons.org/licenses/GPL/2.0/">CC-GNU GPL</a>.
<!-- /Creative Commons License -->

<!--

<rdf:RDF xmlns="http://web.resource.org/cc/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
<Work rdf:about="">
   <license rdf:resource="http://creativecommons.org/licenses/GPL/2.0/" />
   <dc:type rdf:resource="http://purl.org/dc/dcmitype/Software" />
</Work>

<License rdf:about="http://creativecommons.org/licenses/GPL/2.0/">
<permits rdf:resource="http://web.resource.org/cc/Reproduction" />
   <permits rdf:resource="http://web.resource.org/cc/Distribution" />
   <requires rdf:resource="http://web.resource.org/cc/Notice" />
   <permits rdf:resource="http://web.resource.org/cc/DerivativeWorks" />
   <requires rdf:resource="http://web.resource.org/cc/ShareAlike" />
   <requires rdf:resource="http://web.resource.org/cc/SourceCode" />
</License>

</rdf:RDF>

-->
<br /><br /><br /><br /><br /><br />
	<form ACTION="index.php" METHOD="POST"><div>
	<input type="hidden" value="Connections" name="Installing">
	<input TYPE="submit" VALUE="I hearby have read and agreed to the License">
	</form>	
	';
}

function Connections(){
	echo'
	<p>
<div align="center">
<form action="index.php"  method="POST">
<input type="hidden" value="Connections2" name="Installing">
<div>Database Host:<input name="Host" type="text" size="50" value="localhost" ><br />
Database Username:<input name="Username" type="text" size="50"><br />
Database Password:<input name="Password" type="password" size="50"><br />
Database Name:<input name="Name" type="text" size="50"><br />
Admin Username:<input name="AUsername" type="text" size="50"><br />
Admin Password:<input name="Apassword" type="password" size="50"><br />
<input type="submit" value="Create Mysql Table"> </div>
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
	
		$sql1 = "CREATE TABLE `pp_config` (
  `name` varchar(225) default NULL,
  `news` varchar(225) NOT NULL default 'Welcome!',
  `vids_per_page` int(4) NOT NULL default '10',
  `lang` varchar(225) NOT NULL default 'en-gb.inc.php',
  `version` double NOT NULL,
  `template` varchar(255) NOT NULL default 'Photine'
)";
	$sql2 = "CREATE TABLE `pp_files` (
  `id` int(64) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `video_type` varchar(225) NOT NULL default 'YouTube',
  `creator` varchar(64) NOT NULL default '',
  `description` longtext NOT NULL,
  `date` date NOT NULL default '2007-01-01',
  `file` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `approved` char(2) NOT NULL default '',
  `feature` char(2) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `picture` varchar(225) NOT NULL,
  `category` varchar(225) NOT NULL default '0',
  `reject` char(2) default '0',
  `views` int(225) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)";
	$sql3 = "CREATE TABLE `pp_rating` (
  `id` int(11) NOT NULL,
  `total_votes` int(225) NOT NULL default '0',
  `total_value` int(225) NOT NULL default '0',
  `used_ips` longtext NOT NULL,
  PRIMARY KEY  (`id`)
)";
	$sql4 = "CREATE TABLE `pp_categories` (
  `id` int(225) NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `disable` varchar(2) NOT NULL default '0',
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
)";
	mysql_query($sql1,$con);
	mysql_query($sql2,$con);
	mysql_query($sql3,$con);
	mysql_query($sql4,$con);
	
	$filename = '../config.php';
	$somecontent = '
<?php/*
+ ----------------------------------------------------------------------------+
|     PHPDirector Config File
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
+----------------------------------------------------------------------------+
*/
$cfg["db_host"] = "'.$host.'";
$cfg["db_name"] = "'.$name.'";
$cfg["db_user"] = "'.$username.'";
$cfg["db_pass"] = "'.$password.'"; 
$cfg["admin_user"] = "'.$ausername.'"; 
$cfg["admin_pass"] = "'.$apassword.'"; 	
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
	<br /><br /><br /><br /><br /><br /><br /><br /><br />
	<table BORDER="0" WIDTH="auto" HEIGHT="auto">
	<form action="complete_install.php" method="POST">
	<tr><td>Name:</td><td><input TYPE="text" VALUE="Bens Videos" NAME="name"></td></tr>
	<tr><td>Videos Per Page:</td><td><input TYPE="text" VALUE="10" NAME="vids_per_page"></td></tr>
	<tr><td>News:</td><td><input TYPE="text" VALUE="PHP Director Just Installed" NAME="news"></td></tr>
	<tr><td></td><td><tr><td>&nbsp;</td><td>
	<tr><td COLSPAN="2"><center><input TYPE="hidden" NAME="Editing"><input TYPE="submit" VALUE="Edit"></center></td></tr>
	</table>
	</form>';
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
