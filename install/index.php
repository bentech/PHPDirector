<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko, Monte Ohrt (Monte Ohrt), Theodore Ni
+----------------------------------------------------------------------------+
*/

// If our filename ends in _old.php, we know that the name has been changed to
// prevent accidental reinstallation. We'll redirect to the main page.
$filename = basename(__FILE__, '.php');

    // Convenience function to clarify code
    function endsWith($str, $sub) {
        return (substr($str, strlen($str) - strlen($sub)) === $sub);
    }

if (endsWith($filename, '_old')) {
    header('Location: ../index.php');
    exit;
}
// End installation check

// Force inclusion of compatability file that emulates some newer functions for
// lower PHP versions.
require_once '../includes/compatability.php';

include("header.php");

// To maintain form POST yet still allow the flexibility to display errors, we hold
// a global error variable. The contents can be any type, so each function can choose
// to display errors differently.
$GLOBALS['errors'] = null;

// Step 1
function Install() {
    $output = <<< CODE
Welcome to PHP Directory Install
<form action="{$_SERVER['PHP_SELF']}" method="post">
<div>
  <input type="hidden" value="license" name="step">
  <input type="submit" value="Install">
</div>
</form>
CODE;

    echo $output;
}

// Step 2
function License() {
    // Get the license string
    $license = file_get_contents('license.html');

    $output = <<< CODE
{$license}
<form action="{$_SERVER['PHP_SELF']}" method="post"><div>
  <input type="hidden" value="connections" name="step">
  <input type="submit" value="I hereby have read and agreed to the License">
</form>
CODE;

    echo $output;
}

function Connections() {
    $error_string = '';
    if (!empty($GLOBALS['error'])) {
        $errors = $GLOBALS['error'];
        if (!is_array($errors)) {
            $errors = array($errors);
        }
        foreach ($errors as $error) {
            $error_string .= '<span style="color: red;">' . $error . '</span><br>';
        }
    }

	$output = <<< CODE
{$error_string}
<p>
<div align="center">
<form action="{$_SERVER['PHP_SELF']}" method="post">
  <input type="hidden" value="setupdb" name="step">
  <div>
    Database Host:<input name="Host" type="text" size="50" value="localhost"><br />
    Database Username:<input name="Username" type="text" size="50"><br />
    Database Password:<input name="Password" type="password" size="50"><br />
    Database Name:<input name="Name" type="text" size="50"><br />
    Admin Username:<input name="AUsername" type="text" size="50"><br />
    Admin Password:<input name="APassword" type="password" size="50"><br /><br />
    <input type="submit" value="Create Mysql Table">
  </div>
</form>
</div>
</p>
CODE;

	echo $output;
}

function SetupDB() {
    //:TODO: Input validation, even though this is the administrator installing

    $host       = $_POST['Host'];
    $username   = $_POST['Username'];
    $password   = $_POST['Password'];
    $name       = $_POST['Name'];
    $ausername  = $_POST['AUsername'];
    $apassword  = $_POST['APassword'];

	$sql = array();
	if(!($con = @mysql_connect($host, $username, $password))) {
        // We could not establish a database connection!
        // Set the error and redisplay the connections form
        $GLOBALS['error'] = '<b>Could not connect to the database.</b><br>MySQL Error: ' . mysql_error();
        Connections();
        return;
	} else if (!@mysql_select_db($name, $con)) {
		// We could not select the database!
		// Set the error and redisplay the connections form
		$GLOBALS['error'] = '<b>Could not use database \'' . $name . '\'. It may not exist.</b><br>MySQL Error: ' . mysql_error();
		Connections();
		return;
	}

	$sql[] = "CREATE TABLE `pp_config` (
  `name` varchar(225) default NULL,
  `news` varchar(225) NOT NULL default 'Welcome!',
  `vids_per_page` int(4) NOT NULL default '10',
  `lang` varchar(225) NOT NULL default 'en-gb.inc.php',
  `version` double NOT NULL,
  `template` varchar(255) NOT NULL default 'Photine'
)";
	$sql[] = "CREATE TABLE `pp_files` (
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
	$sql[] = "CREATE TABLE `pp_rating` (
  `id` int(11) NOT NULL,
  `total_votes` int(225) NOT NULL default '0',
  `total_value` int(225) NOT NULL default '0',
  `used_ips` longtext NOT NULL,
  PRIMARY KEY  (`id`)
)";
	$sql[] = "CREATE TABLE `pp_categories` (
  `id` int(225) NOT NULL auto_increment,
  `name` varchar(225) NOT NULL,
  `disable` varchar(2) NOT NULL default '0',
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
)";

	// Local error array for quick display. We will try to execute each query and record any errors.
	$errors = array();
	foreach ($sql as $query) {
		if (mysql_query($query, $con) === false) {
			$errors[] = mysql_error();
		}
	}


	// We will try to create the configuration file on the fly -- only if there were no DB errors, though.
	$num_errors = count($errors);
	if ($num_errors === 0):

	$config_content = <<< CONFIG
<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector Config File
|		\$License: GPL General Public License
|		\$Website: phpdirector.co.uk
|		\$Author: Ben Swanson
+----------------------------------------------------------------------------+
*/
\$cfg['db_host']     = '$host';
\$cfg['db_name']     = '$name';
\$cfg['db_user']     = '$username';
\$cfg['db_pass']     = '$password';
\$cfg['admin_user']  = '$ausername';
\$cfg['admin_pass']  = '$apassword';
?>
CONFIG;

	// Let's try to save the configuration file
    $config_filename = '../config.php';
    $generic_error = 'Could not write to configuration file. Please set folder permissions to 777';
    if (($handle = @fopen($filename, 'w')) !== false) {
        if (fwrite($handle, $config_content) === false) {
            $errors[] = $generic_error;
        }
    } else {
        $errors[] = $generic_error;
    }

    endif;      // Ends if clause that tested for DB errors


	// We will need to display errors if there were any. Otherwise, we'll just send
	// the user along to the next step.
	$num_errors = count($errors);
	if ($num_errors === 0) {
	    Options();
	    return;
	} else {
		foreach ($errors as $error) {
			echo "<span style=\"color: red;\">{$error}</span><br />";
		}

		echo <<< FORMS
<br>
<div>
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="connections" name="step">
  <input type="submit" value="Back">
</form>
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="setupdb" name="step">
  <input type="hidden" value="{$host}" name="Host">
  <input type="hidden" value="{$username}" name="Username">
  <input type="hidden" value="{$password}" name="Password">
  <input type="hidden" value="{$name}" name="Name">
  <input type="hidden" value="{$ausername}" name="AUsername">
  <input type="hidden" value="{$apassword}" name="APassword">
  <input type="submit" value="Try Again">
</form>
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="options" name="step">
  <input type="submit" value="Continue">
</form>
</div>
FORMS;

	}
}

function Options() {
    $output = <<< CODE
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<form action="complete_install.php" method="post">
  <table border="0">
    <tr><td align="right">Name: </td><td><input type="text" value="My Videos" name="name"></td></tr>
	<tr><td align="right">Videos Per Page: </td><td><input type="text" value="10" name="vids_per_page"></td></tr>
	<tr><td align="right">News: </td><td><input type="text" value="PHP Director Just Installed" name="news"></td></tr>
	<tr><td align="center" colspan="2"><br><input type="hidden" name="Editing"><input type="submit" value="Edit"></td></tr>
  </table>
</form>
CODE;

    echo $output;
}
?>
<?php
if (!empty($_POST['step'])) {
	$step = $_POST['step'];

	// Decide which step to display
	switch ($step) {
	    case 'license':
	        License(); break;
	    case 'connections':
	        Connections(); break;
	    case 'setupdb':
	        SetupDB(); break;
	    case 'options':
	        Options(); break;
	    default:
	        break;
	}
}else{
if(@$_GET["connect"] == 'connect'){
echo "Could not connect";
	Connections();
}elseif(@$_GET["connect"] == 'db'){
echo "Could not select database";
	Connections();
}else{
	Install();
}
}
?>
<?php
include("footer.php");
?>