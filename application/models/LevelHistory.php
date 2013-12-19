<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_LevelHistory extends Core_Model  {

	public function save($levelHistory){
		$insert['user_id'] 			= $levelHistory['user_id'];
		$insert['level_id'] 		= $levelHistory['level_id'];
		$insert['level_completed'] 	= $levelHistory['level_completed'];
		$insert['video_name'] 		= $levelHistory['video_name'];
		$insert['score'] 			= $levelHistory['score'];
		$insert['data'] 			= $levelHistory['data'];
		$this->db->insert('LevelHistory', $insert); 
	}

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

	public function latestsResult($userId){
		$sql = 'SELECT levelHistory.*, Levels.order as level, LevelParts.description as partName  
				FROM levelHistory, Levels, LevelParts WHERE levelHistory.level_id = Levels.id AND Levels.part = LevelParts.id 
				AND levelHistory.level_completed = 1 AND levelHistory.user_id = ?';
		$bind[] = $userId;
		return $this->returnLevelHistory( $this->db->query($sql, $bind) );
	}

	private function returnLevelHistory($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}