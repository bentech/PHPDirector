<?php
if (!isset($_COOKIE["admin"])){
    header('location: login.php');
}
?>
<html>
<head>
<body>

<?php include("admin_header.php")?>
<h2 align="center"><?php echo Admin_33; ?></h2>
<p><?php echo Admin_32; ?></p>
<br>
<br>
<script type='text/javascript' src='http://www.crossstar.co.uk/phpdirector_test/version/version.js'>
</script>
<script type='text/javascript'>
version = 0.1
patch = 1
if(version == nversion && patch == npatch){
document.write("<b>Your version is recent. Good Job!</b>")
}else{
document.write("<b>Time to upgrade!</b> <a href='http://sourceforge.net/projects/phpdirector/'>Upgrade!</a>")
}
</script>

</body>
</html>