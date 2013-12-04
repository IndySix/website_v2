<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_LevelHistory extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('LevelHistory');
		return $this->returnLevelHistory($result);
	}

	public function all(){
		$sql = 'SELECT * FROM LevelHistory';
		return $this->db->query($sql);
	}

	public function userLevelStats($levelId, $userId){
		$sql ='SELECT count(id) as trys,
			   COALESCE( max( score), 0) as score
			   FROM levelHistory WHERE level_id = ? AND user_id = ?';
		$bind[] = $levelId;
		$bind[] = $userId;
		$result = $this->db->query($sql, $bind);
		return $result[0];
	}

	public function latestsLevelResult($levelId, $userId){
		$sql = 'SELECT * FROM `levelHistory` WHERE id in (SELECT max(id) FROM levelHistory WHERE level_id = ? AND user_id = ?)';
		$bind[] = $levelId;
		$bind[] = $userId;
		$result = $this->db->query($sql, $bind);
		return $this->returnLevelHistory($result);
	}

	private function returnLevelHistory($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}