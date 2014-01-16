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
      $this->load->model('Level');
      $this->ModelApp->setButton('main', 'javascript:void(0)', '<span class="playIcon"></span>');
      $this->ModelApp->setButton('back', baseUrl());

      $currentLevel = $this->LibSession->get('user_level');

      $levels = $this->ModelLevel->allWithUserHis( $this->LibSession->get('user_id') );

      $data['currentLevel']   = 0;
      $data['currentPart']    = 0;
      foreach ($levels as $level) {
         if($level['id'] == $currentLevel){
            $data['currentLevel']   = $level['id'];
            $data['currentPart']    = $level['part'];
            break;
         }
      }

      if(!empty($levels)){
         $data['levels'] = $levels;
         $this->loadView('levelsView', $data);
      } else {
         $data['titleMessage'] = 'Error loading levels';
         $data['error']      = 'Cannot load the list of levels!';
         $this->loadView('message', $data);
      }

   }

   function career(){
      $this->load->model('Level');
      $this->ModelApp->setButton('back', baseUrl());

      $sql = 'SELECT * , COALESCE( (SELECT max(score) FROM LevelHistory WHERE level_id = Levels.id AND level_completed = 1 ), 0) AS score
              FROM Levels
              WHERE part = 4
              ORDER BY Levels.order ASC';

      $data['levels'] = $this->db->query($sql);
      //$data['levels'] = $this->ModelLevel->byPartId(1);
      $this->loadView('levelCareer', $data);
   }

   function battle(){
      $this->ModelApp->setButton('back', baseUrl());
      $data['titleMessage'] = 'Not implemented yet';
      $data['info']      = 'The battle function is not yet implemented!';
      $this->loadView('levelBattle', $data);
   }
}        