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
	<h1>Php Director Update </h1>
</ul>
<ul ID="install-progress">
<li <?php if ($_POST["Installing"] == "Upgrade"){echo "class='selected'";}?>><a HREF="#">Update</a></li>
</ul>
<div align="center">
<?php
require("db.php");
	$confresult = mysql_query("SELECT * FROM pp_config");
	$row1 = mysql_fetch_array($confresult);
	
	if($row1["version"] == "0.2"){
	echo'Updated<br />';
	mysql_query("UPDATE `pp_config` SET `version` = '0.21'");
	

	}else{
	echo "Wrong Version";
	}
?>
<br /><br />
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
