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
<html>
<head>
<body>

<?php include("admin_header.php")?>
<h2 align="center">Welcome To Admin</h2>
<p>Please select a tab choosing what to do </p>
<br>
<br>
<script type='text/javascript' src='http://www.crossstar.co.uk/phpdirector_test/version/version.js'>
</script>
<script type='text/javascript'>
version = 0.1
patch = 1
if(version == nversion && patch == npatch){
document.write("<b>Time to upgrade!</b> <a href='http://sourceforge.net/projects/phpdirector/'>Upgrade!</a>")
}else{
document.write("<b>Your version is recent. Good Job!</b>")
}
</script>

</body>
</html>