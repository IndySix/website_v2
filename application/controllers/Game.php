<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Game extends Core_Controller {
	public function index(){

	}

	public function stop() {
		$user_id = $this->LibSession->get('user_id');
		$this->load->model('LevelPart');
		$this->ModelLevelPart->removeUserFromQueue($user_id);
		redirect('level');
	}

	public function play(){
		$user_id = $this->LibSession->get('user_id');
		$this->load->model('LevelPart');
		$this->load->model('Level');

		$this->ModelApp->setButton('back', baseUrl('game/stop') );
		$this->ModelApp->setButton('settings', '', '');

		//get Level
		$levelId = $this->uri->segment(3);
		$level = $this->ModelLevel->byId($levelId);
		if(empty($level)){
			redirect('level');
			return;
		}
		$partId = $level['part'];
		//json set
		$json = $this->uri->segment(4);
		$json = $json == 'json';

		$this->ModelLevelPart->addToQueue($partId, $user_id);
		
		$queueList = $this->ModelLevelPart->queue($partId);
		$topQueue = $queueList[0];
		
		if($topQueue['playing'] == 1){
			//check if top players time is up
			if(datetimeToTimestamp($topQueue['playStartTime'])+(60*2.5) < time() ) {
				$this->ModelLevelPart->removeFromQueue($topQueue['id']);
				if(isset($queueList[1]))
					$topQueue = $queueList[1];
				else
					$topQueue = null;
				unset($queueList[0]);
			}	
		} else {
			if($topQueue['queueStartTime'] == 0){
				$this->ModelLevelPart->startQueueTime($topQueue['id']);
			} elseif( datetimeToTimestamp($topQueue['queueStartTime'])+(15) < time() ){
				$this->ModelLevelPart->removeFromQueue($topQueue['id']);
				if(isset($queueList[1])) {
					$topQueue = $queueList[1];
					$this->ModelLevelPart->startQueueTime($topQueue['id']);
				} else {
					$topQueue = null;
				}
				unset($queueList[0]);
			}
		}

		$play = false;
		if($topQueue == null){
			redirect('level');
		}elseif($topQueue['user_id'] == $user_id){
			$play = $json ? true : $this->playGame($topQueue, $level);
		} else {
			$play = $json ? false : $this->showQueue($queueList, $level);
		}
		echo $json ? json_encode(array('play' => $play)) : null;
	}

	private function showQueue($queueList, $level){
		$data['queue'] = $queueList;
		$data['level'] = $level;
		$this->loadView('gameQueue', $data);
	}

	private function playGame($queue, $level){
		//When first time on playing screen set status to playing
		if($queue['playing'] == 0)
			$this->ModelLevelPart->setToPlaying($queue['id']);

		$this->ModelApp->setButton('one', '');
		$this->ModelApp->setButton('two', '');
		$this->ModelApp->setButton('three', '');
		$this->ModelApp->setButton('four', '');
		$this->ModelApp->setButton('main', baseUrl('game/stop'), '<span class="stopIcon"></span>');
		$this->ModelApp->setButton('settings', '');
		$this->ModelApp->setButton('back', '');
		
		$data['level'] = $level;
		$this->loadView('gamePlay', $data);
	}
}