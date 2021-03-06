<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Game extends Core_Controller {
	public function index(){

	}

	public function stop() {
		$user_id = $this->LibSession->get('user_id');
		$this->load->model('LevelPart');
		$this->ModelLevelPart->removeUserFromQueue($user_id);
		file_get_contents(__BOX_ADDRESS.'stop');
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
			if(datetimeToTimestamp($topQueue['playStartTime'])+$level['playTime'] < time() ) {
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
		$this->load->model('LevelHistory');
		//When first time on playing screen set status to playing
		if($queue['playing'] == 0) {
			$queue['playStartTime'] = timestampToDatetime( time() );
			$this->ModelLevelPart->setToPlaying($queue['id']);

			//Send start data to box
			$url = __BOX_ADDRESS.'start';
			$level['queue'] = $queue;
			$postData = 'data='.json_encode( $level );

			$ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_POST, 1);
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt( $ch, CURLOPT_HEADER, 0);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

			curl_exec( $ch );
		}
		$this->ModelApp->setButton('one', '');
		$this->ModelApp->setButton('two', '');
		$this->ModelApp->setButton('three', '');
		$this->ModelApp->setButton('four', '');
		$this->ModelApp->setButton('main', baseUrl('game/stop'), '<span class="stopIcon"></span>');
		$this->ModelApp->setButton('settings', '');
		$this->ModelApp->setButton('back', '');

		$levelStats = $this->ModelLevelHistory->userLevelStats($level['id'], $this->LibSession->get('user_id') );
		
		$data['level'] 		= $level;
		$data['part_name'] 	= $this->ModelLevelPart->byId($level['id'])['description'];
		$data['endTime'] 	= datetimeToTimestamp( $queue['playStartTime'] ) + $level['playTime'];
		$data['maxScore']  	= $levelStats['score']; 
		$data['trys']		= $levelStats['trys'];
		$this->loadView('gamePlay', $data);
	}

	public function status(){
		$this->load->model('LevelHistory');
		$this->load->model('LevelPart');
		$this->load->model('Level');
		$json = new stdClass();
		$json->status = 'stop';

		$levelId 	= $this->uri->segment(3);
		$userId 	= $this->LibSession->get('user_id');

		$level = $this->ModelLevel->byId($levelId);
		$savedLevel = $this->ModelLevelHistory->latestsLevelResult($levelId, $userId);
		$queue = $this->ModelLevelPart->getPlayerInQueue($userId);
		if($level == null){

		//check if score is saved
		} elseif($savedLevel != null && datetimeToTimestamp($savedLevel['timestamp'])+30 > time()  ) {
			$json->status = 'score';
			$this->ModelLevelPart->removeUserFromQueue($userId);
		//check if is in queue and time is not up
		} elseif($queue != null ){
			if(datetimeToTimestamp($queue['playStartTime'])+$level['playTime'] < time()){ 
				$this->ModelLevelPart->removeUserFromQueue($userId);
				$json->status = 'stop';
			} else {
				$json->status = 'running';
			}
		}
		echo json_encode($json);
	}

	public function feedback(){
		$this->load->model('LevelHistory');
		$this->load->model('LevelPart');
		$this->load->model('Level');

		$levelId 	= $this->uri->segment(3);
		$userId 	= $this->LibSession->get('user_id');

		$this->ModelApp->setButton('one', baseUrl('level'), 'Level', baseUrl('data/img/level_button.png'));
		$this->ModelApp->setButton('two', baseUrl(), 'Skills', baseUrl('data/img/skills_button.png'));
		$this->ModelApp->setButton('three', baseUrl('game/play/'.$levelId), 'Retry', baseUrl('data/img/retry_button.png'));
		$this->ModelApp->setButton('four', baseUrl(''), 'Quit', baseUrl('data/img/quit_button.png'));
		
		$this->ModelApp->setButton('settings', '');

		$level 		= $this->ModelLevel->byId($levelId);
		$nextLevel 	= $this->ModelLevel->byPartIdAndOrder($level['part'], $level['order']+1);	
		$savedLevel = $this->ModelLevelHistory->latestsLevelResult($levelId, $userId);
		$levelStats = $this->ModelLevelHistory->userLevelStats( $levelId, $userId );

		if( datetimeToTimestamp($savedLevel['timestamp'])+30 < time() ){
			//redirect('level');
			//return;
		}

		$data['video'] = $savedLevel['video_name'];
		$data['score'] = $savedLevel['score'];
		$nextLevelId = isset($nextLevel[0]['id']) ? $nextLevel[0]['id'] :  $level['id'];
		$this->ModelApp->setButton('main', baseUrl('game/play/'.$nextLevelId), '<img class="mainButLogo" src="'.baseUrl('data/img/next_level_button.png').'"/>');
		//stars and percentage
		//$data['']
		$data['trys']	= $levelStats['trys'];
		$time = date('i:s', $level['playTime']);
		$data['time']  	= substr($time, 0, 1) == '0' ? substr($time, 1, 5) : $time;

		$this->loadView('gameFeedback', $data);
	}

	public function save(){
	$apiKey = $this->uri->segment(3);
	if($apiKey != __API_KEY) { return; }
	
	if(isset($_POST['level_id'])){
		
	}

	print "save result";
	}
}