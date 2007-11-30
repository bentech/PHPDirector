<?PHP
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
function validate_alphanumeric( $string ) {
	$check = preg_match('/^[a-zA-Z0-9_]+$/', $string);
	if(!$check) return false;
}
function validate_alpha( $string ) {
	$check = preg_match('/^[a-zA-Z_]+$/', $string);
	if(!$check) return false;	
}
function validate_numeric( $string ) {
	$check = preg_match('/^[0-9_]+$/', $string);
	if(!$check) return false;	
}
function validate_email( $string ) {
	$check = preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $string);
	if(!$check) return false;
}

?>