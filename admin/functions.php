<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GPL General Public License
|		$Website: phpdirector.co.uk
|		$Author: Ben Swanson
|		$Contributors - Dennis Berko and Monte Ohrt (Monte Ohrt)
+----------------------------------------------------------------------------+
*/
function createsessions($username,$password) 
{ 
    //Add additional member to Session array as per requirement 
    session_register(); 
    $_SESSION["gdusername"] = $username; 
    $_SESSION["gdpassword"] = md5($password); 
 
    if(isset($_POST['remme'])) 
    { 
        //Add additional member to cookie array as per requirement 
        setcookie("gdusername", $_SESSION['gdusername'], time()+60*60*24*100, "/"); 
        setcookie("gdpassword", $_SESSION['gdpassword'], time()+60*60*24*100, "/"); 
        return; 
    } 

} 
function clearsessionscookies() 
{ 
    unset($_SESSION['gdusername']); 
    unset($_SESSION['gdpassword']); 
 
    session_unset();     
    session_destroy(); 
    setcookie ("gdusername", "",time()-60*60*24*100, "/"); 
    setcookie ("gdpassword", "",time()-60*60*24*100, "/"); 
} 
function confirmUser($username,$password) 
{ 
    $md5pass = md5($password); 
    /* Validate from the database but as for now just demo username and password */ 
	include("../config.php");
	$username1 = $cfg["admin_user"];
    if($username == $username1 && $password == $cfg["admin_pass"]) {
        return true; 
    }else{ 
        return false; 
	}
} 
function checkLoggedin() 
{ 
    if(isset($_SESSION['gdusername']) AND isset($_SESSION['gdpassword'])) 
        return true; 
    elseif(isset($_COOKIE['gdusername']) && isset($_COOKIE['gdpassword'])) 
    { 
        if(confirmUser($_COOKIE['gdusername'],$_COOKIE['gdpassword'])) 
        { 
            createsessions($_COOKIE['gdusername'],$_COOKIE['gdpassword']); 
            return true; 
        } 
        else 
        { 
            clearsessionscookies(); 
            return false; 
        } 
    } 
    else 
        return false; 
} 
?>