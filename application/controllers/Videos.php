<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Videos extends Core_Controller {
   
  	function index(){
      $this->videos();
   }

   function view(){
      $this->ModelLogin->checkLogin();

      $this->load->model('LevelHistory');
      $this->load->model('Level');
      $this->load->model('User');
      
      $this->contentTitle = "Video";
      $video_id = $this->uri->segment(3);

      $this->ModelApp->setButton('back', baseUrl('videos/videos') );

      $data = $this->ModelLevelHistory->byId($video_id); 
      
      if(!empty($data)){
         //$data['level_data'] = $this->ModelLevel->byId($data['level_id']);
         //$data['user_data'] = $this->ModelUser->byId($data['user_id']);    
         $this->loadView('videoView', $data);
      } else {
         $data['titleMessage'] = 'Error loading video';
         $data['message']      = 'The video that you are looking for does not exists!';
         $this->loadView('message', $data);
      }
   }

   function videos(){
      $this->contentTitle = "Videos";
   	$this->load->model('LevelHistory');
      $this->ModelApp->setButton('back', baseUrl());
		$data['videos'] = $this->ModelLevelHistory->all();
      $this->loadView('videosView', $data);
   }
}
