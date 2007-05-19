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
<link REL="stylesheet" TYPE="text/css" HREF="css.css" />
<title>PHPDirector Install Wizard</title>
</head>
<body>
<ul ID="install-header">
	<h1>Php Director Install</h1>
</ul>
<ul ID="install-progress"><li><a HREF="#">Upgrade/Install</a></li><li <?php if ($_POST["Installing"] == "License"){echo "class='selected'";}?>><a HREF="#">License Agreement</a></li><li <?php if ($_POST["Installing"] == "Connections"){echo "class='selected'";}?><?php if ($_GET["connect"] == "connect"){echo "class='selected'";}?>><a HREF="#">MySQL Connection</a></li><li <?php if ($_POST["Installing"] == "Connections2"){echo "class='selected'";}?>><a HREF="#">Create Tables</a></li><li <?php if ($_POST["Installing"] == "Options"){echo "class='selected'";}?>><a HREF="#">Options</a></li></ul>
<div align="center">