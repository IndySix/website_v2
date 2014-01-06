<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Ranking extends Core_Controller {
   
  	function index(){
      $this->ranking();
   	}

	function ranking(){
		$this->ModelApp->setButton('back', baseUrl());
 		$this->contentTitle = "Ranking";
		$this->ModelLogin->checkLogin();
		$this->load->model('LevelHistory');
		
		//get King ranking
		$data['ranking'] = $this->ModelLevelHistory->rankingKing();

		//Level ranking
		$data['levelRanking'] = $this->ModelLevelHistory->rankingLevels();

		if(!empty($data['ranking'])){
			$this->loadView('rankingView', $data);
		} else {
			$data['titleMessage'] = 'Error loading ranking';
			$data['message']      = 'The ranking could not be loaded!';
			$this->loadView('message', $data);
		}
   	}
}
