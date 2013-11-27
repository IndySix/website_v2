<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Ranking extends Core_Controller {
   
  	function index(){
      $this->ranking();
   	}

	function ranking(){

		$this->ModelLogin->checkLogin();

		// $this->load->model('LevelHistory');
		// $history = $this->ModelLevelHistory->all();

		
	    $sql = 'SELECT Users.username, Users.id, SUM(LevelHistory.score) AS highscore FROM LevelHistory, Users WHERE LevelHistory.user_id = Users.id GROUP BY LevelHistory.user_id ORDER BY highscore DESC';
		$ranking = $this->db->query($sql);
		
		$sql = 'SELECT * FROM Levels';
		$levels = $this->db->query($sql);

		$sql = 'SELECT * FROM Levels, LevelHistory, Users WHERE Levels.id = LevelHistory.level_id AND LevelHistory.user_id = Users.id ORDER BY LevelHistory.score DESC LIMIT 10';
		$scores = $this->db->query($sql);

		// print_r($levels);

		if(!empty($ranking)){
			// $data['history'] = $history;
			$data['ranking'] = $ranking;
			$data['levels'] = $levels;
			$data['scores'] = $scores;
			$this->load->view('rankingView', $data);
		} else {
			$data['titleMessage'] = 'Error loading ranking';
			$data['message']      = 'The ranking could not be loaded!';
			$this->load->view('message', $data);
		}
   	}
}
