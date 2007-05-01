<?php 
ob_start(); 
session_start(); 
require_once ("functions.php"); 
$returnurl = urlencode(isset($_GET["returnurl"])?$_GET["returnurl"]:""); 
if($returnurl == "") 
    $returnurl = urlencode(isset($_POST["returnurl"])?$_POST["returnurl"]:""); 
$do = isset($_GET["do"])?$_GET["do"]:""; 
$do = strtolower($do); 
switch($do) 
{ 
case "": 
    if (checkLoggedin()) 
    { 
        echo "<H1>You are already logged in - <A href = \"login.php?do=logout\">logout</A></h1>"; 
    } 
    else 
    { 
        ?> 
        <form NAME="login1" ACTION="login.php?do=login" METHOD="POST" ONSUBMIT="return aValidator();"> 
        <TABLE cellspacing="3"> 
        <TR> 
            <TD>Username:</TD> 
            <TD><input TYPE="TEXT" NAME="username"></TD> 
            <TD>Password:</TD> 
            <TD><input TYPE="PASSWORD" NAME="password"></TD> 
        </TR> 
        <TR> 
            <TD colspan="4" ALIGN="center"><input TYPE="CHECKBOX" NAME="remme">&nbsp;Remember me for the next time I visit</TD> 
        </TR> 
        <TR> 
            <TD ALIGN="CENTER" COLSPAN="4"><input TYPE="SUBMIT" name="submit" value="Login"></TD> 
        </TR> 
        </form> 
        </TABLE> 
    <?php
    } 
    break; 
case "login": 
    $username = isset($_POST["username"])?$_POST["username"]:""; 
    $password = isset($_POST["password"])?$_POST["password"]:""; 
    if ($username=="" or $password=="" ) 
    { 
        echo "<h1>Username or password is blank</h1>"; 
        clearsessionscookies(); 
        header("location: login.php"); 
    } 
    else 
    { 
        if(confirmuser($username,$password)) 
        { 
            createsessions($username,$password); 
                header("Location: index.php"); 
        } 
        else 
        { 
            echo "<h1>Invalid Username and/Or password</h1>"; 
            clearsessionscookies(); 
            header("location: login.php"); 
        } 
    } 
    break; 
case "logout": 
    header("location: logout.php"); 
    break; 
} 
?>