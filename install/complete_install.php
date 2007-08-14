<?php

include('header.php');

if (isset($_POST['Editing'])) {
	include("../config.php");
	include("../includes/function.inc.php");
	$connect1 = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
	mysql_select_db($cfg["db_name"], $connect1) or die(mysql_error());
	mysql_query("INSERT INTO pp_config (name, news, vids_per_page, version)
VALUES ('$_POST[name]', '$_POST[news]', '$_POST[vids_per_page]', '0.2')");

	$success_msg = "<p>Congratulations, you have successfully installed PHP Director!</p>\n"
	   . "<p>You should delete the install folder or disable access to it from the browser now.</p>\n"
	   . "<p>You can visit the <a href=\"../admin/\">Admin Section</a>, where I recommend you add some categories.</p>\n";
	$warning_msg = '<span style="color: red;">We were unable to rename your install file to prevent unwanted access to it.'
	   . "You MUST prevent public access to your install folder.</span>\n";

    // We will rename the install file so that even if the user does not delete the install folder,
    // the program is not open to tampering. The new name is a PHP file so malicious users cannot
    // see the source. The install page will have logic built to detect whether it should be active
    // or not.
    $install_file = 'index.php';
    $new_install_file = basename($install_file, '.php') . '_old.php';
    if (file_exists($install_file)) {
        if (rename($install_file, $new_install_file)) {
            $warning_msg = '';      // successful! so we don't need the warning anymore
        }
    }

    echo $success_msg . $warning_msg;
}

include('footer.php');

?>