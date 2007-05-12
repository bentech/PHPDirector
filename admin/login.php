<?php 
ob_start(); 
session_start(); 

require_once ("admin_header.php"); 
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
        $smarty->assign('error', 'You are already logged in.'); 
    } 
    break; 
case "login": 
    $username = isset($_POST["username"])?$_POST["username"]:""; 
    $password = isset($_POST["password"])?$_POST["password"]:""; 
    if ($username=="" or $password=="" ) 
    { 
       $smarty->assign('error', 'Username or password is blank.');
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
		$smarty->assign('error', 'Invalid Username and/Or password.');
            clearsessionscookies(); 
            header("location: login.php"); 
        } 
    } 
    break; 
case "logout": 
    header("location: logout.php"); 
    break; 
} 

$smarty->display("login.tpl");
?>