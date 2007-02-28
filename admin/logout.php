<?php
// i will keep yelling this
// DON'T FORGET TO START THE SESSION !!!
session_start();

// if the user is logged in, unset the session
if (isset($_SESSION['phpdirector'])) {
   unset($_SESSION['phpdirector']);
}

// now that the user is logged out,
// go to login page
header('Location: ../');
?>


<head>
<body>
Logged Out
</body>
<?php session_destroy(); ?>