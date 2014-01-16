<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Api extends Core_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('Jsend');
	}

	public function index(){
		$apiKey = $this->uri->segment(3);
		if( $apiKey != 'indysix') {
			$this->LibJsend->setStatus( Library_Jsend::$ERROR );
			$this->LibJsend->code = 1;
			$this->LibJsend->message = 'Invalid api key!';
			echo $this->LibJsend->getJson();
			die();
		}
	}

	public function saveGame(){
		//$this->index();
		header('Access-Control-Allow-Origin: *');

		$this->load->model('User');
      	$this->load->model('Level');
      	$this->load->model('LevelPart');
      	$this->load->model('LevelHistory');

      	$partId = $this->uri->segment(3);
      	$order = $this->uri->segment(4);

      	$username = isset($_POST['username']) ? $_POST['username'] : null;
      	$result = isset($_POST['result']) ? $_POST['result'] : null;
      	//$movie = isset($_FILES["movie"]) ? $_FILES["movie"] : null;
      	$movie = isset($_POST["movie"]) ? $_POST["movie"] : null;

      	$level = $this->ModelLevel->byPartIdAndOrder($partId, $order);
      	$user = $this->ModelUser->byUsername($username);

      	if(!empty($level) && !empty($user) && !empty($result)){
      		//Calculate score
      		$this->load->library('Score');
         	$score = $this->LibScore->grind($level[0]['targetScore'], $result);

         	//Check if score is positive
	         if($score > 0) {
	            //upload video when uploaded
	            //$movieFileName = null;
	            // if(!empty($movie)) {
	            //    $this->load->library("upload");
	            //    $this->upload->loadFile($movie);

	            //    if($this->upload->uploadFile() ) {
	            //       $movieFileName = $this->upload->getFileName();
	            //    }
	            // }
	            //Remove from queue
	            $this->ModelLevelPart->removeFromQueue($user['id']);
	            //Save challenge result
	            $insert['level_id'] 		= $level[0]['id'];
	            $insert['user_id'] 			= $user['id'];
	            $insert['score'] 			= $score;
	            $insert['level_completed'] 	= true;
	            $insert['data'] 			= $result;
	            $insert['video_name'] 		= $movie;
	            $this->ModelLevelHistory->save($insert);

	            $this->LibJsend->data = $score;
	            echo $this->LibJsend->getJson();
	            return;
	         }

	      }
	      $this->LibJsend->setStatus(Library_Jsend::$FAIL);
	      $this->LibJsend->data = "Failed uplouding challenge!";
	      echo $this->LibJsend->getJson();
	}
}
