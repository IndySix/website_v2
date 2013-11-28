<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Level extends Core_Controller {
   
  	function index(){
      $this->all();
   }

   function view(){
      $this->contentTitle = "<a href='/indysix2/level'>&#8617; Back to Career</a>";

      $this->ModelLogin->checkLogin();
   	
      $level = $this->uri->segment(3);

      $this->load->model('Level');

      $this->load->model('LevelPart');

      $level_data = $this->ModelLevel->byId($level);

      $level_part = $this->ModelLevelPart->byId($level_data['part']);


      if(!empty($level_data)){
         $user_name = $this->LibSession->get('user_username');
         $user_avatar = baseUrl( 'data/avatars/' . $this->LibSession->get('user_avatar'));

         $data['level'] = $level_data['id'];
         $data['difficulty'] = $level_data['difficulty'];
         $data['description'] = $level_data['level_description'];

         $data['part'] = $level_part;

         $this->load->view('levelView', $data);

      } else {
         $data['titleMessage'] = 'Error loading level';
         $data['message']      = 'The level that you are looking for does not exists!';
         $this->load->view('message', $data);
      }
   }

   function all(){
      $this->contentTitle = "Career";


      $this->load->model('Level');

      $this->load->model('LevelPart');

      $sql = 'SELECT * FROM Levels, LevelParts WHERE Levels.part = LevelParts.id';

      $levels = $this->db->query($sql);

      if(!empty($levels)){
         $data['levels'] = $levels;
         $this->load->view('levelsView', $data);
      } else {
         $data['titleMessage'] = 'Error loading levels';
         $data['message']      = 'Cannot load the list of levels!';
         $this->load->view('message', $data);
      }

   }


}        