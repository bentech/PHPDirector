<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
require('header.php');
include('includes/user_register.class.php');

$validate = new user_register( $mysql_link );
$form = $_POST['register'];
if(!isset( $form )) {
	$smarty->display('register.tpl');
} else {
if(!$validate->alpha_field($_POST['user'])) {
	$smarty->assign('error', 'Username must be between 6 and 40 characters and must only contain letters, numbers and _');
	$smarty->display('error.tpl');		
} else {
if(!$validate->user_exists($_POST['user'])) {
	$smarty->assign('error', 'Sorry that username already exists!');	
	$smarty->display('error.tpl');								
} else {
if(!$validate->email_field($_POST['email'])) {
	$smarty->assign('error', 'Email must follow the format of you@yourdomain.com');
	$smarty->display('error.tpl');				
} else {
if(!$validate->email_exists($_POST['email'])) {
	$smarty->assign('error', 'This email already exists, sorry.');	
	$smarty->display('error.tpl');									
} else {
if(strlen($_POST['passwrd1'])<6 || strlen($_POST['passwrd1'])>30) {
	$smarty->assign('error', 'Password must be between 6 and 30 characters');	
	$smarty->display('error.tpl');			
} else {
if($_POST['passwrd1']!=$_POST['passwrd2']) {
	$smarty->assign('error', 'Passwords do not match');	
	$smarty->display('error.tpl');						
} else {								
if($validate->register_user($_POST['passwrd1'])) {	
	$smarty->display('success.tpl');
} else {
	$smarty->assign('error', 'There was a problem connecting to the MySQL server.');	
	$smarty->display('error.tpl');					
} } } } } } } }

mysql_close($mysql_link);
?>