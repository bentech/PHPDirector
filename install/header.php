<!--/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko, Monte Ohrt (Monte Ohrt), Theodore Ni
+----------------------------------------------------------------------------+
*/-->

<?php
  // Perform output buffering, so we can prepare the entire page first
  ob_start();
?>

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
	if (@$_POST['step'] == "license") { echo 'class="selected"'; }
?>><a href="#">License Agreement</a></li>
<li <?php
	if (@$_POST['step'] == "connections") { echo 'class="selected"'; }
?>><a href="#">MySQL Connection</a></li>
<li <?php
	if (@$_POST['step'] == "setupdb") { echo 'class="selected"'; }
?>><a href="#">Create Tables</a></li>
<li <?php
	if (@$_POST['step'] == "options") { echo 'class="selected"'; }
?>><a href="#">Options</a></li>
</ul>
<div align="center">