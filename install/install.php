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
  <input type="hidden" value="license" name="step" />
  <input type="submit" value="Install" />
</div>
</form>
CODE;

    return $output;
}

// Step 2
function License() {
    // Get the license string
    $license = file_get_contents('license.html');

    $output = <<< CODE
{$license}
<form action="{$_SERVER['PHP_SELF']}" method="post"><div>
  <input type="hidden" value="connections" name="step" />
  <input type="submit" value="I hereby have read and agreed to the License" />
</form>
CODE;

    return $output;
}

// Step 3
function Connections() {
    $error_string = '';
    if (!empty($GLOBALS['error'])) {
        $errors = $GLOBALS['error'];
        if (!is_array($errors)) {
            $errors = array($errors);
        }
        foreach ($errors as $error) {
            $error_string .= '<span style="color: red;">' . $error . '</span><br />';
        }
    }

	$output = <<< CODE
{$error_string}
<p>
<form action="{$_SERVER['PHP_SELF']}" method="post">
  <input type="hidden" value="setupdb" name="step">
  <div>
    Database Host:<input name="Host" type="text" size="50" value="localhost" /><br />
    Database Username:<input name="Username" type="text" size="50" /><br />
    Database Password:<input name="Password" type="password" size="50" /><br />
    Database Name:<input name="Name" type="text" size="50" /><br />
    Admin Username:<input name="AUsername" type="text" size="50" /><br />
    Admin Password:<input name="APassword" type="password" size="50" /><br /><br />
    <input type="submit" value="Create Mysql Table" />
  </div>
</form>
</p>
CODE;

	return $output;
}

// Step 4
function SetupDB() {
    global $step;       // we may change steps

    $output = '';

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
        $GLOBALS['error'] = '<b>Could not connect to the database.</b><br />MySQL Error: ' . mysql_error();
        $output = Connections();
        return $output;
	} else if (!@mysql_select_db($name, $con)) {
		// We could not select the database!
		// Set the error and redisplay the connections form
		$GLOBALS['error'] = '<b>Could not use database \'' . $name . '\'. It may not exist.</b><br />MySQL Error: ' . mysql_error();
		$output = Connections();
		return $output;
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
	    $step = 'options';             // modify the global step variable to reflect new step
	    $output = Options();
	} else {
		foreach ($errors as $error) {
			$output .= "<span style=\"color: red;\">{$error}</span><br />";
		}

		$output .= <<< FORMS
<br />
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="connections" name="step" />
  <input type="submit" value="Back" />
</form>
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="setupdb" name="step" />
  <input type="hidden" value="{$host}" name="Host" />
  <input type="hidden" value="{$username}" name="Username" />
  <input type="hidden" value="{$password}" name="Password" />
  <input type="hidden" value="{$name}" name="Name" />
  <input type="hidden" value="{$ausername}" name="AUsername" />
  <input type="hidden" value="{$apassword}" name="APassword" />
  <input type="submit" value="Try Again" />
</form>
<form action="{$_SERVER['PHP_SELF']}" method="post" style="display: inline;">
  <input type="hidden" value="options" name="step" />
  <input type="submit" value="Continue" />
</form><br />
FORMS;

	}

	return $output;
}

// Step 5
function Options() {
    $output = <<< CODE
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<form action="{$_SERVER['PHP_SELF']}" method="post">
  <input type="hidden" value="done" name="step">
  <table border="0">
    <tr><td align="right">Name: </td><td><input type="text" value="My Videos" name="name" /></td></tr>
	<tr><td align="right">Videos Per Page: </td><td><input type="text" value="10" name="vids_per_page" /></td></tr>
	<tr><td align="right">News: </td><td><input type="text" value="PHP Director Just Installed" name="news" /></td></tr>
	<tr><td align="center" colspan="2"><br /><input type="submit" value="Edit" /></td></tr>
  </table>
</form>
CODE;

    return $output;
}

// Step 6
function Done() {
    $name        = $_POST['name'];
    $news        = $_POST['news'];
    $vidsPerPage = $_POST['vids_per_page'];

    // Since we are finished, we can go ahead and include our configuration file
    require_once '../config.php';
    $con = @mysql_connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass']);
    mysql_select_db($cfg['db_name'], $con);

    // Add some config variables to the database
    $query = sprintf('INSERT INTO `pp_config` (`name`, `news`, `vids_per_page`, `version`) VALUES ("%s", "%s", "%s", "%s")',
                mysql_real_escape_string($name),
                mysql_real_escape_string($news),
                mysql_real_escape_string($vidsPerPage),
                '0.3'
             );

    mysql_query($query, $con);

	$success_msg = "<p>Congratulations, you have successfully installed PHP Director!</p>\n"
	   . "<p>You should delete the install folder or disable access to it from the browser now.</p>\n"
	   . "<p>You can visit the <a href=\"../admin/index.php\">Admin Section</a>, where I recommend you add some categories.</p>\n";
	$warning_msg = '<span style="color: red;">We were unable to rename your install file to prevent unwanted access to it.'
	   . "You MUST prevent public access to your install folder.</span>\n";

    // We will rename the install file so that even if the user does not delete the install folder,
    // the program is not open to tampering. The new name is a PHP file so malicious users cannot
    // see the source. The install page will have logic built to detect whether it should be active
    // or not.
    $install_file = 'install.php';
    $new_install_file = basename($install_file, '.php') . '_old.php';
    if (file_exists($install_file)) {
        if (rename($install_file, $new_install_file)) {
            $warning_msg = '';      // successful! so we don't need the warning anymore
        }
    }

    return $success_msg . $warning_msg;
}

/**
 * PAGE ENTRY POINT. THIS IS WHERE WE START OUTPUTTING EVERYTHING
 */

// Figure out on which step we are. This may be changed by each individual step if they
// redirect. This emulates redirect without a real redirect ;-)
$step = 'start';
if (!empty($_POST['step'])) {
    $step = strtolower($_POST['step']);

    $allowed_steps = array('start', 'license', 'connections', 'setupdb', 'options', 'done');
    if (!in_array($step, $allowed_steps)) {
        $step = 'start';
    }
}

// Decide which step to display
$body = '';
switch ($step) {
    case 'start':
        $body = Install(); break;
    case 'license':
        $body = License(); break;
    case 'connections':
        $body = Connections(); break;
    case 'setupdb':
        $body = SetupDB(); break;
    case 'options':
        $body = Options(); break;
    case 'done':
        $body = Done(); break;
    default:
        break;
}

$steps = array(
    'start'         => '<li' . ($step == 'start' ? ' class="selected"' : '') . '>Start</li>',
    'license'       => '<li' . ($step == 'license' ? ' class="selected"' : '') . '>License Agreement</li>',
    'connections'   => '<li' . ($step == 'connections' || $step == 'setupdb' ? ' class="selected"' : '') . '>MySQL Connection</li>',
    'options'       => '<li' . ($step == 'options' ? ' class="selected"' : '') . '>Options</li>',
    'done'          => '<li' . ($step == 'done' ? ' class="selected"' : '') . '>Finish</li>'
);

// Output HTML header
echo <<< HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>PHP Director Install Wizard</title>
<link rel="stylesheet" type="text/css" href="css.css" />
</head>
<body>
<div id="install-header">
  <h1>PHP Director Installation</h1>
</div>
<ul id="install-progress">
  {$steps['start']}
  {$steps['license']}
  {$steps['connections']}
  {$steps['options']}
  {$steps['done']}
</ul>
<div align="center">
HEADER;

echo $body;

// Output HTML footer
echo <<< FOOTER
<a href="http://www.phpdirector.co.uk/">Powered by PHP Director 0.3</a> | PHPDIRECTOR &copy; 2007, Ben Swanson
<br />

<!-- Creative Commons License -->
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
</div>
</body>
</html>
FOOTER;
?>