<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_Level extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('Levels');
		return $this->returnLevel($result);
	}

	public function byPartId($partId){
		$this->db->reset();
		$this->db->where('part', $partId);
		$this->db->orderBy('order');
		return $this->db->get('Levels');
	}

	public function all(){
		$this->db->reset();
		$result = $this->db->get('Levels');
		return $result;
	}

	public function allWithUserHis($userId){
		$sql = 'SELECT Levels.*, 
               max( COALESCE(levelHistory.level_completed, 0))  as completed, 
               LevelParts.description,
               LevelParts.image as partImage
               FROM Levels
               LEFT JOIN LevelParts
               ON Levels.part = LevelParts.id
               LEFT JOIN levelHistory
               ON Levels.id = levelHistory.level_id
               AND user_id = ?
               GROUP BY id
               ORDER BY part ASC, Levels.order ASC';
      $bind[] = $userId;
      return $this->db->query($sql ,$bind);
	}

	private function returnLevel($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}