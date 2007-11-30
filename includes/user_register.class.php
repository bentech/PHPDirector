<?PHP
class user_register {
 	var $connect;
 	var $user;
 	var $email;
 	var $user_ip;
 	var $user_browser;

	function user_register( $server ) {
		$this->connect = $server;
		$this->user_ip = $_SERVER['REMOTE_ADDR'];
		$this->user_browser = $_SERVER['HTTP_USER_AGENT'];
	}
	function alpha_field( $value ) {
		$check = preg_match('/^[a-zA-Z0-9_]+$/', $value);
		if(strlen($value) < 6 || strlen($value)>80) {
			return false;
		} else {
			if(!$check || !isset($value)) { return false; } else { return true; }
		}
	}
	function email_field( $value ) {
		$check = preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $value);
		if(!$check || !isset($value)) { return false; } else { return true; }
	}
	function user_exists( $user ) {
	 	if(isset($user) && isset($this->connect)) {
	 		$q = "SELECT memberName FROM pp_members WHERE memberName = '$user' LIMIT 1";
			$r = mysql_query($q, $this->connect);
			if(mysql_num_rows( $r ) == 0) { $this->user = $user; return true; }
		} else { return false; }
	}	
	function email_exists( $email ) {
	 	if(isset($email) && isset($this->connect)) {
	 		$q = "SELECT emailAddress FROM pp_members WHERE emailAddress = '$email' LIMIT 1";
			$r = mysql_query($q, $this->connect);
			if(mysql_num_rows( $r ) == 0) { $this->email = $email; return true; }
		} else { return false; }		
	}
	function register_user($password) {
		$password = md5($password);
		$q = "INSERT into pp_members (memberName, passwd, emailAddress, memberIP) VALUES ('$this->user', '$password', '$this->email', '$this->user_ip')";
		$r = mysql_query($q, $this->connect);
		if($r) { return true; } else { return false; }
	}
}
?>