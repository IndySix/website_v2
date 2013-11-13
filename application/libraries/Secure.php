<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');


class Library_Secure {
	/* password hasher */
	function hashPassword($pass, $salt = null) {
		if($salt == null)
	  		$salt = substr(md5(time()),0,8);
	  	$encrypted = '';
	  	for($i = 0; $i<10000; $i++) {
	    	$encrypted = hash("sha512",$salt . $pass . $encrypted . $pass . $salt);
	  	}
	  	return $salt.$encrypted;
	}

	/* Check password */
	function checkPassword($password, $hash){
	  	if($hash == $this->hashPassword($password, substr($hash,0,8)))
	    	return true;
	  	else 
	    	return false;
	}

	# get new authToken
	function authToken(){
		$this->session->set("user_authToken", randomString(32));
		return $this->session->get("user_authToken");
	}

	function validateToken($token){
		if( $this->session->get("user_authToken") == $token)
			return true;
		return false;
	}
}