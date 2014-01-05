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
		$sql = 'SELECT LevelHistory.*, Levels.order as level, LevelParts.description as levelName, Users.username as username 
				FROM LevelHistory, Levels, LevelParts, Users 
				WHERE LevelHistory.level_id = Levels.id 
				AND Levels.part = LevelParts.id
				AND LevelHistory.user_id = Users.id';
		return $this->db->query($sql);
	}

	public function userLevelStats($levelId, $userId){
		$sql ='SELECT count(id) as trys,
			   COALESCE( max( score), 0) as score
			   FROM LevelHistory WHERE level_id = ? AND user_id = ?';
		$bind[] = $levelId;
		$bind[] = $userId;
		$result = $this->db->query($sql, $bind);
		return $result[0];
	}

	public function latestsLevelResult($levelId, $userId){
		$sql = 'SELECT * FROM `LevelHistory` WHERE id in (SELECT max(id) FROM LevelHistory WHERE level_id = ? AND user_id = ?)';
		$bind[] = $levelId;
		$bind[] = $userId;
		$result = $this->db->query($sql, $bind);
		return $this->returnLevelHistory($result);
	}

	public function latestsResult($userId){
		$sql = 'SELECT LevelHistory.*, Levels.order as level, LevelParts.description as partName  
				FROM LevelHistory, Levels, LevelParts WHERE LevelHistory.level_id = Levels.id AND Levels.part = LevelParts.id 
				AND LevelHistory.level_completed = 1 AND LevelHistory.user_id = ?';
		$bind[] = $userId;
		return $this->returnLevelHistory( $this->db->query($sql, $bind) );
	}

	public function rankingKing(){
		$sql = 'SELECT U.username, U.id, SUM(LH.score) AS highscore 
				FROM LevelHistory AS LH, Users AS U 
				WHERE LH.user_id = U.id
				AND LH.level_completed = 1
				AND LH.score = (SELECT max(score) FROM LevelHistory WHERE LH.level_id = level_id)
				GROUP BY LH.user_id 
				ORDER BY highscore DESC LIMIT 20';
		return $this->db->query($sql);
	}

	private function returnLevelHistory($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}