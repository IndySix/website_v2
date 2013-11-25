<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Videos extends Core_Controller {
   
  	function index(){
      $this->videos();
   }

   function view(){
      $this->ModelLogin->checkLogin();
   	
      $video_id = $this->uri->segment(3);

      $this->load->model('Video');

      $this->load->model('Level');

      $this->load->model('User');

      $video_data = $this->ModelVideo->byId($video_id);

      $level_data = $this->ModelLevel->byId($video_data['level']);

      $user_data = $this->ModelUser->byId($video_data['user']);      
      
      if(!empty($video_data)){
      	 $data = $video_data;
      	 $data['level_data'] = $level_data;
          $data['user_data'] = $user_data;
         $this->load->view('videoView', $data);
      } else {
         $data['titleMessage'] = 'Error loading video';
         $data['message']      = 'The video that you are looking for does not exists!';
         $this->load->view('message', $data);
      }
   }

   function videos(){
   		$this->load->model('Video');
		$data['videos'] = $this->ModelVideo->all();
      	$this->load->view('videosView', $data);
   }
}
