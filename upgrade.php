<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
+----------------------------------------------------------------------------+
*/?>
<html>
<head>
<style>
html, body {
background:#BFE4FF;
font-family:"Trebuchet MS",Helvetica,Arial,sans-serif;
font-size:12px;
height:100%;
left:0pt;
margin:0pt;
min-width:700px;
padding:0pt;
position:absolute;
top:0pt;
width:100%;
}
a {
color:#333333;
}
a:hover {
text-decoration:none;
}
h1, h2, h3, h4, h5, h6 {
margin: 0 0 0 0;
padding:0pt;
}
img {
border:0px none;
}
.hidden {
display:none;
}
.right {
clear:none;
float:right;
}
.left {
clear:none;
float:left;
}
#license_agreement{
text-align:center;
}
#install-header {
margin: auto auto auto -10px;
background:#00487D;
border-bottom:8px solid #0066B3;
color:#FFFFFF;
height:60px;
vertical-align:top;
}
#install-header h1 {
font-family:"Trebuchet MS",Helvetica,Arial,sans-serif;
font-size:30px;
font-weight:bold;
padding-left:14px;
padding-top:14px;
vertical-align:top;
width:auto;
}
#install-progress {
background:#80C9FF none repeat scroll 0%;
clear:both;
color:#00487D;
float:left;
height:40px;
list-style-image:none;
list-style-position:outside;
list-style-type:none;
margin:0pt 0pt 0pt 0px;
padding:0px;
width:100%;
}
#install-progress li a {
float:left;
position:relative;
color:#FFFFFF;
display:block;
float:left;
font-weight:bold;
height:20px;
margin:5px 2px;
padding:7px 15px 3px;
text-decoration:none;
vertical-align:middle;
}
#install-progress li.selected a {
background:#0066B3 none repeat scroll 0%;
}
form {
margin-bottom:20px;
}
form div {
margin:auto;
padding:5px;
text-align:left;
width:400px;
}
form div input, form div textarea, form div select {
border:1px solid #AAAAAA;
font-family:"Trebuchet MS",Helvetica,Arial,sans-serif;
font-size:12px;
margin-top:2px;
padding:4px;
width:390px;
}
form div select {
width:100%;
}
form div input.submit {
height:30px;
width:200px;
}
</style>

<title>PHPDirector Install Wizard</title>
</head>
<body>
<ul ID="install-header">
	<h1>Php Director Upgrade </h1>
</ul>
<ul ID="install-progress"><li><a HREF="#">Upgrade/Install</a></li><li <?php if ($_POST["Installing"] == "License"){echo "class='selected'";}?>><a HREF="#">License Agreement</a></li>
<li <?php if ($_POST["Installing"] == "Upgrade"){echo "class='selected'";}?>><a HREF="#">Upgrade Mysql </a></li>
</ul>
<div align="center">
<?php
function Install(){
define("PHPdirector", 1);
require("db.php");
	$confresult = mysql_query("SELECT * FROM pp_config");
	$row1 = mysql_fetch_array($confresult);
	
	if($row1["version"] == "0.1"){
	echo'Welcome Php Director Upgrader<br />
	<form action="upgrade.php" method="POST"><div>
	<input type="hidden" value="License" name="Installing">
	<input type="submit" value="Upgrade"></div>
	</form></p>
	';
	}else{
	echo "Wrong Version";
	}
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
Cliking this will also start the upgrade process
	<form ACTION="upgrade.php" METHOD="POST"><div>
	<input type="hidden" value="Upgrade" name="Installing">
	<input TYPE="submit" VALUE="I hearby have read and agreed to the License">
	</form>	
	';
}

function Upgrade(){
define("PHPdirector", 1);
require("db.php");

//CONFIG
mysql_query("ALTER TABLE `pp_config` DROP `exerntalheader");
mysql_query("ALTER TABLE `pp_config` DROP `externalheaderurl`");
mysql_query("ALTER TABLE `pp_config` DROP `header_height`");
mysql_query("ALTER TABLE `pp_config` DROP DROP `cssstyle`");
mysql_query("ALTER TABLE `pp_config` DROP `logo`");
mysql_query("ALTER TABLE `pp_config` ADD `news` VARCHAR(255) NOT NULL");
mysql_query("ALTER TABLE `pp_config` ADD `news` VARCHAR(255) NOT NULL");
mysql_query("ALTER TABLE `pp_config` ADD `template` VARCHAR(255) NOT NULL");
mysql_query("UPDATE `pp_config` SET `version` = '0.2'");
mysql_query("UPDATE `pp_config` SET `template` = 'Photine'");

//Files
 
mysql_query("ALTER TABLE `pp_files` CHANGE `category` `category` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0'");
mysql_query("ALTER TABLE `pp_files` ADD `file2` VARCHAR(255) NOT NULL");
mysql_query("ALTER TABLE `pp_files` ADD `video_type` VARCHAR(255) NOT NULL");

//Categories

mysql_query("CREATE TABLE `pp_categories` (
  `id` int(225) NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `disable` varchar(2) NOT NULL default '0',
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
)");
	

	$filename = 'config.php';
	$somecontent = '
<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector Config File
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
+----------------------------------------------------------------------------+
*/
$cfg["db_host"] = "'.$cfg[db_host].'";
$cfg["db_name"] = "'.$cfg[db_name].'";
$cfg["db_user"] = "'.$cfg[db_user].'";
$cfg["db_pass"] = "'.$cfg[db_pass].'"; 
$cfg["admin_user"] = "'.$cfg[admin_user].'"; 
$cfg["admin_pass"] = "'.$cfg[admin_pass].'"; 	
?>';
	if (is_writable($filename)) {
		if (!$handle = fopen($filename, 'w')) {
			echo "Cannot write to file please change permissions";
			exit;
	}
   if (fwrite($handle, $somecontent) === FALSE) {
     echo "Cannot write to file please change permissions";
     exit;
	}
	echo "Config.php updated\n";
	fclose($handle);
	} else {
		echo "Cannot write to file please change permissions";
	}
	
	$confresult = mysql_query("SELECT * FROM pp_config");
	$row1 = mysql_fetch_array($confresult);
	if($row1[template] == "Photine"){
	
	echo"<br />Success<br /><b>VERY IMPORTANT-</b> Must delete upgrade.php and install director if there<br /><a href='../'>Goto Site</a>";
	}else{
	echo"<br />Failed -mysql conumications- Please see phpdirector forums <br /> <a href='../'>Check Anyway?</a>";
	}
	}

if(isset($_POST["Installing"])){
	$installing = $_POST["Installing"];
	
	if($installing == "License"){
		License();
	}
	if($installing == "Upgrade"){
		Upgrade();
	}

}else{
if(isset($_GET["connect"])){
echo"Could not connect";
	Connections();
}else{
	Install();
}
}
?><br /><br />
<a HREF="http://www.phpdirector.co.uk/">Powered by PHP Director 0.2</a> | PHPDIRECTOR &copy; 2007, Ben Swanson
<br />

<!-- Creative Commons License -->
This software is licensed under the <a HREF="http://creativecommons.org/licenses/GPL/2.0/">CC-GNU GPL</a>.
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
</body>
</html>
