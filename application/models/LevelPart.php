<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_LevelPart extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('LevelParts');
		return $this->returnPart($result);
	}

	public function queue($id){
		$sql = 'SELECT p.*, u.username, u.avatar FROM PartQueue p, Users u WHERE p.user_id = u.id AND part_id = ? ORDER BY id ASC';
		$bind[] = $id;
		return $this->db->query($sql, $bind);
	}

	public function addToQueue($partId, $userId){
		if($this->isInQueue($partId, $userId))
			return;
		$insert['part_id'] = $partId;
		$insert['user_id'] = $userId;
		$this->db->insert('PartQueue', $insert); 
		return $this->db->lastInsertId();
	}
	public function removeUserFromQueue($userId){
		$this->db->reset();
		$this->db->where('user_id', $userId);
		$this->db->delete('PartQueue');
	}

	private function isInQueue($partId, $userId){
		$this->db->reset();
		$this->db->where('user_id', $userId);
		$result = $this->db->get('PartQueue');
		if(!empty($result) && $result[0]['part_id'] == $partId)
			return true;
		$this->db->delete('PartQueue');
		return false;
	}

	public function removeFromQueue($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$this->db->delete('PartQueue');
	}

	public function startQueueTime($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$update['queueStartTime'] = timestampToDatetime( time() );
		$this->db->update('PartQueue', $update);
	}

	public function setToPlaying($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$update['playing'] = 1;
		$update['playStartTime'] = timestampToDatetime( time() );
		$this->db->update('PartQueue', $update);
	}

	private function returnPart($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}