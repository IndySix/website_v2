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

	private function returnLevelHistory($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}2