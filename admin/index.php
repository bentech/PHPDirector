<?php
// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['phpdirector'])
    || $_SESSION['phpdirector'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}

?>

<head>
<body>

<?php include("admin_header.php")?>
<h2 align="center">Welcome To Admin</h2>
<p>Please select a tab choosing what to do </p>
</body>
</html>