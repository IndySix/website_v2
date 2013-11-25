<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_Video extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('Videos');
		return $this->returnVideo($result);
	}

	public function all(){
		$this->db->reset();
		$result = $this->db->get('Videos');
		return $result;
	}

	private function returnVideo($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}