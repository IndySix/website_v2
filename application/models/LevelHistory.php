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
		$sql = 'SELECT U.avatar, U.username, U.id, SUM(LH.score) AS highscore 
				FROM LevelHistory AS LH, Users AS U 
				WHERE LH.user_id = U.id
				AND LH.level_completed = 1
				AND LH.score = (SELECT max(score) FROM LevelHistory WHERE LH.level_id = level_id AND LH.user_id = user_id )
				GROUP BY LH.user_id 
				ORDER BY highscore DESC LIMIT 20';
		return $this->db->query($sql);
	}

	public function rankingLevels(){
		$sql = 'SELECT LP.id AS part_id, L.id AS level_id, LP.description AS levelName, L.order AS level 
				FROM LevelParts AS LP, Levels AS L  
				WHERE L.part = LP.id
				ORDER BY part_id, level ASC';
		$levels = $this->db->query($sql);

		$sql = 'SELECT LH.score, U.username, U.avatar
				FROM LevelHistory AS LH, Users AS U
				WHERE LH.user_id = U.id
				AND LH.level_id = ?
				ORDER BY score DESC
				LIMIT 5';
		foreach ($levels as $key => $level) {
			$bind[0] = $level['level_id'];
			$levels[$key]['ranks'] = $this->db->query($sql, $bind);
		}
		return $levels;
	}

	public function rankingParts(){
		$sql 	= 'SELECT * FROM LevelParts';
		$parts 	= $this->db->query($sql);
		$sql 	= 'SELECT U.avatar, U.username, U.id, sum(LH.score) AS score
					FROM Levels AS L, LevelHistory AS LH, Users AS U
					WHERE L.id = LH.level_id
					AND U.id = LH.user_id
					AND L.part = ?
					AND LH.level_completed = 1
					AND LH.score = (SELECT max(score) FROM LevelHistory WHERE level_id = L.id AND U.id = user_id)
					GROUP BY U.id
					ORDER BY score DESC
					LIMIT 5';
		foreach ($parts as $key => $part) {
			$bind[0] = $part['id'];
			$parts[$key]['ranks'] = $this->db->query($sql, $bind);
		}
		return $parts;
	}

	private function returnLevelHistory($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}