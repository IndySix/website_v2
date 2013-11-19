<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');


class Model_User extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('Users');
		return $this->returnUser($result);
	}

	public function byUsername($username) {
		$this->db->reset();
		$this->db->where('username', $username);
		$result = $this->db->get('Users');
		return $this->returnUser($result);
	}

	public function byEmail($email) {
		$this->db->reset();
		$this->db->where('email', $email);
		$result = $this->db->get('Users');
		return $this->returnUser($result);
	}

	public function searchByUsername($username){
		$sql = 'SELECT id, username, avatar  FROM Users WHERE username like ?
				ORDER BY CASE WHEN username like ? THEN 0
               	WHEN username like ? THEN 1
               	WHEN username like ? THEN 2
               	ELSE 3
          		END, username';
        $bind[] = '%'.$username.'%';
        $bind[] = $username.' %';
        $bind[] = $username.'%';
        $bind[] = '%'.$username;
        return $this->db->query($sql, $bind);
	}

	public function save($user){
		if(!isset($user['id']))
			return false;
		
		$columns = array('username'
						,'password'
						,'email'
						,'validEmail'
						,'level'
						,'blocked'
						,'registrationDate'
						,'avatar'
						,'difficulty'
						,'place'
						,'birthday'
						,'gender'
						,'aboutMe'
					 );
		$update = array();

		foreach ($user as $key => $value) {
			if( in_array($key, $columns, true) )
				$update[$key] = $value;
		}

		if(count($update) > 0){
			$this->db->reset();
			$this->db->where('id', $user['id']);
			$this->db->update('Users', $update);
			return true;
		}
		return false;
	}

	private function returnUser($result){
		if(!empty($result))
			return $result[0];
		return null;
	}

}