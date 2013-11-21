<?PHP if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_LevelPart extends Core_Model  {

	public function byId($id){
		$this->db->reset();
		$this->db->where('id', $id);
		$result = $this->db->get('LevelParts');
		return $this->returnPart($result);
	}

	private function returnPart($result){
		if(!empty($result))
			return $result[0];
		return null;
	}
}