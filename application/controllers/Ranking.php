<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Ranking extends Core_Controller {
   
  	function index(){
      $this->ranking();
   	}

	function ranking(){
 		$this->contentTitle = "Ranking";
		$this->ModelLogin->checkLogin();
		$this->load->model('LevelHistory');
		
		//get King ranking
		$data['ranking'] = $this->ModelLevelHistory->rankingKing();

		$sql = 'SELECT * FROM Levels';
		$levels = $this->db->query($sql);

		$sql = 'SELECT * FROM Levels, LevelHistory, Users WHERE Levels.id = LevelHistory.level_id AND LevelHistory.user_id = Users.id ORDER BY LevelHistory.score DESC LIMIT 10';
		$scores = $this->db->query($sql);

		// print_r($levels);

		if(!empty($data['ranking'])){
			$data['levels'] = $levels;
			$data['scores'] = $scores;
			$this->loadView('rankingView', $data);
		} else {
			$data['titleMessage'] = 'Error loading ranking';
			$data['message']      = 'The ranking could not be loaded!';
			$this->loadView('message', $data);
		}
   	}
}
