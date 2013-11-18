<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_Level extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('Levels');
		return $this->returnLevel($result);
	}

	public function all(){
		$this->db->reset();
		$result = $this->db->get('Levels');
		return $result;
	}

	private function returnLevel($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}