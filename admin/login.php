<?php
	setcookie("admin", "login", time()+3600);
if (isset($_POST['txtUserId']) && ($_POST['txtPassword'])){
    header("location: index.php");
}
define("PHPdirector", 1);
include("../config.php");
if ($_POST['txtUserId'] == $cfg["admin_user"] && $_POST['txtPassword'] == $cfg["admin_pass"]){
	$errorMessage = '';
}else{
	if (isset($_POST['txtUserId']) && ($_POST['txtPassword'])){
        $errorMessage = 'Sorry, wrong username / password';
	}
}
?>
<html>
<head>
<title>Admin Login</title>
<meta content="text/html; charset=iso-8859-1" http-equiv="content-type"/>
<meta content="Copyright 2007 Cross Star Studios" name="copyright"/>
<meta content="Ben Swanson" name="author"/>
<link media="screen" type="text/css" href="../css/admin_main.css" rel="stylesheet"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<div id="admin-header">
  <h1><?php echo $cfg["name"];?> - Admin </h1>
</div>
<ul id="admin-menu">
<li><a href="../index.php">Home</a></li>
</ul>

<?php
if ($errorMessage != '') {
?>
<div align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></div>
  <?php
}
?>
<form action="login.php" method="post" name="frmLogin" id="frmLogin">
  <div align="center">
    <p>&nbsp;</p>
    <p><span class="categoria_h">User Id</span>
      <input name="txtUserId" type="text" id="txtUserId">
      <span class="categoria_h">Password</span>
      <input name="txtPassword" type="password" id="txtPassword">
    </p>
    <p>
      <input name="btnLogin" type="submit" id="btnLogin" value="Login">
    </p>
  </div>
</form>
</body>
</html>