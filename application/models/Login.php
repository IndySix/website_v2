<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');


class Model_Login extends Core_Model  {

	function __construct() {
		$value = $this->LibSession->get('user_username');
		if(empty($value))
			$this->cookieLogin();
		elseif(time() - $this->LibSession->get('user_sessionSetTime') > 60*5)
			$this->updateUserSession();
	}

	function cookieLogin(){
		$this->load->library('Secure'); 
		if(isset($_COOKIE['user_ses'])) {
			$data = explode(':', $_COOKIE['user_ses']);
			if(count($data) == 2) {
				//get user salt
				$this->db->where('username', $data[0]);
				$user = $this->db->get('Users');

				if(empty($user))
					return;
				
				$data[1] = $this->LibSecure->hashPassword($data[1], substr($user[0]['password'],0,8));
				
				//Check if usersession exist
				$sql = "SELECT * FROM LoginSession WHERE username = ? AND token = ?";
				$check = $this->db->query($sql, $data);
				if(isset($check[0]['username'])) {
					//delete old session
					$this->db->where('token', $data[1]);
					$this->db->delete('LoginSession');
					//login user 
					$this->saveUserToSession($user[0]); 
					//create new session
					$this->saveLoginSession($user[0]['username'], randomString(32), substr($user[0]['password'],0,8));
				}
			}
		}
	 }

	 function saveLoginSession($username, $token, $salt){
	 	$this->load->library('Secure');
	 	$expire = time() + (60*60*24*365);

        /* Get domain */
        $domain = $_SERVER['SERVER_NAME'];
   
        /* Create cookie */
        setcookie('user_ses', $username.':'.$token, $expire, "/", $domain, true, true);

        $data['username'] = $username;
        $data['token'] = $this->LibSecure->hashPassword($token, $salt);
        $data['ip'] = $_SERVER['REMOTE_ADDR'];
        $this->db->insert('LoginSession', $data);
	 }

	function user($username, $password){
		$this->load->library('Secure'); 
		$this->db->where('username', $username);
		$data = $this->db->get('Users');
		if(!empty($data) && $this->LibSecure->checkPassword($password, $data[0]['password'])){
			if($data[0]['blocked']) {
				$this->LibSecure->blocked = true;
				return false;
			}
			$this->saveUserToSession($data[0]);
			$this->saveLoginSession($username, randomString(32), substr($data[0]['password'],0,8));
			return true;
		}
		return false;
	}

	function logout(){
		$this->load->library('Secure'); 
		if(isset($_COOKIE['user_ses']) && $this->LibSession->get('user_Salt') != null) {
			$data = explode(':', $_COOKIE['user_ses']);
			if(count($data) == 2) {
				$hash = $this->LibSecure->hashPassword($data[1], $this->LibSession->get('user_Salt'));
				$this->db->where('token', $hash);
				$this->db->delete('LoginSession');
			}
		}
		$_COOKIE['user_ses'] = null;
		setcookie('user_ses', '', time()-86400, "/", $_SERVER['SERVER_NAME'], true, true);
		$this->saveUserToSession(null, true);
	}

	function updateUserSession(){
		if($this->LibSession->get('user_id') != null){
			$this->db->where('id', $this->LibSession->get('user_id'));
			$data = $this->db->get('Users');
			if(!empty($data)){
				$this->saveUserToSession($data[0]);
				return true;
			}
		}
		return false;
	}

	function saveUserToSession($user, $delete = false) { 
		$this->LibSession->set('user_id', $delete ? null : $user['id']);
		$this->LibSession->set('user_username', $delete ? null : $user['username']);
		$this->LibSession->set('user_salt', $delete ? null : substr($user['password'],0,8));
		$this->LibSession->set('user_level', $delete ? null : $user['level']);
		$this->LibSession->set('user_email', $delete ? null : $user['email']);
		$this->LibSession->set('user_blocked', $delete ? null : $user['blocked']);
		$this->LibSession->set('user_registrationDate', $delete ? null : datetimeToTimestamp($user['registrationDate']));
		$this->LibSession->set('user_avatar', $delete ? null : $user['avatar']);
		$this->LibSession->set('user_sessionSetTime', $delete ? null : time());
	}

	function isLoggedin(){
		if($this->LibSession->get('user_id') != null)
			return true;
		return false;
	}

	function checkLogin(){
		if(!$this->isLoggedin()){
			redirect('user/login');
			die();
		}
	}
}