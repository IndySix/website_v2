<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Level extends Core_Controller {
   
  	function index(){
      $this->view();
   }

   function view(){
      $this->ModelLogin->checkLogin();
   	
      $level = $this->LibSession->get('user_level');



      if(!empty($level)){
         $user_name = $this->LibSession->get('user_username');
         $user_avatar = baseUrl( 'data/avatars/' . $this->LibSession->get('user_avatar'));
         $level_difficulty = $this->LibSession->get('difficulty');
         $this->load->view('levelView'); //, $data);
      } else {
         $data['titleMessage'] = 'Error loading level';
         $data['message']      = 'The level that you are looking for does not exists!';
         $this->load->view('message', $data);
      }
   }
}        