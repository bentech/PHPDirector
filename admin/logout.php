<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!

// if the user is logged in, unset the session
if (isset($_COOKIE["admin"])) {
	setcookie("admin", "login", time()-3600);
}

// now that the user is logged out,
// go to login page
header('Location: ../');
?>

<html>
<head>
<body>
</body>
<html>