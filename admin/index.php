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
<?php 
$result = mysql_query("SELECT * FROM pp_config");
$row = mysql_fetch_array($result);

echo"
<b>Your Version :</b> $row[version] 
<br>
<script type='text/javascript' src='http://www.crossstar.co.uk/phpdirector_test/version/version.js'>
</script>
<b>Your Patch Version:</b> 1
<br>
<br>
<br>
<br>
<b>Could it be time to upgrade?</b> <a href'http://www.crossstar.co.uk/phpdirector_test/version/'>Upgrade!</a>
";
?>

</body>
</html>