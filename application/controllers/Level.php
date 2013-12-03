<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Level extends Core_Controller {
   
  	function index(){
      $this->all();
   }

   function view(){
      $this->ModelLogin->checkLogin();
      $this->contentTitle = "<a href='/indysix2/level'>&#8617; Back to Career</a>";
      $this->ModelApp->setButton('main', 'javascript:void(0)', '<span class="playIcon"></span>');
      $this->ModelApp->setButton('back', baseUrl());

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
         $this->loadView('message', $data);
      }
   }

   function all(){
      $this->ModelLogin->checkLogin();
      $this->contentTitle = "Career";
      $this->ModelApp->setButton('main', 'javascript:void(0)', '<span class="playIcon"></span>');
      $this->ModelApp->setButton('back', baseUrl());

      //$sql = 'SELECT * FROM Levels, LevelParts WHERE Levels.part = LevelParts.id';
      $sql = 'SELECT Levels.*, 
               max( COALESCE(levelHistory.level_completed, 0))  as completed, 
               LevelParts.description,
               LevelParts.image as partImage
               FROM Levels
               LEFT JOIN LevelParts
               ON Levels.part = LevelParts.id
               LEFT JOIN levelHistory
               ON Levels.id = levelHistory.level_id
               AND user_id = ?
               GROUP BY id
               ORDER BY part ASC, Levels.order ASC';
      $bind[] = $this->LibSession->get('user_id');
      $levels = $this->db->query($sql ,$bind);

      if(!empty($levels)){
         $data['levels'] = $levels;
         $this->loadView('levelsView', $data);
      } else {
         $data['titleMessage'] = 'Error loading levels';
         $data['message']      = 'Cannot load the list of levels!';
         $this->loadView('message', $data);
      }

   }


}        