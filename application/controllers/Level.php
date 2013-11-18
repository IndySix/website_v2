<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Level extends Core_Controller {
   
  	function index(){
      $this->view();
   }

   function view(){
      $this->ModelLogin->checkLogin();
   	
      $level = $this->uri->segment(3);

      $this->load->model('Level');

      $level_data = $this->ModelLevel->byId($level);

      if(!empty($level_data)){
         $user_name = $this->LibSession->get('user_username');
         $user_avatar = baseUrl( 'data/avatars/' . $this->LibSession->get('user_avatar'));

         $data['level'] = $level_data['id'];
         $data['difficulty'] = $level_data['difficulty'];
         $data['description'] = $level_data['description'];

         $this->load->view('levelView', $data);

      } else {
         $data['titleMessage'] = 'Error loading level';
         $data['message']      = 'The level that you are looking for does not exists!';
         $this->load->view('message', $data);
      }
   }
}        