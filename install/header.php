<!--/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko and Monte Ohrt (Monte Ohrt)
+----------------------------------------------------------------------------+
*/-->
<html>
<head>
<link rel="stylesheet" type="text/css" href="css.css" />
<title>PHPDirector Install Wizard</title>
</head>
<body>
<ul id="install-header">
	<h1>Php Director Install</h1>
</ul>
<ul id="install-progress">
<li><a href="#">Upgrade/Install</a></li>
<li <?php
	if (@$_POST["Installing"] == "License"){echo "class='selected'";}
?>><a href="#">License Agreement</a></li>
<li <?php
	if (@$_POST["Installing"] == "Connections"){echo "class='selected'";}
	if (@$_GET["connect"] == "connect"){echo "class='selected'";}
?>><a href="#">MySQL Connection</a></li>
<li <?php
	if (@$_POST["Installing"] == "Connections2"){echo "class='selected'";}
?>><a href="#">Create Tables</a></li>
<li <?php
	if (@$_POST["Installing"] == "Options"){echo "class='selected'";}
?>><a href="#">Options</a></li>
</ul>
<div align="center">