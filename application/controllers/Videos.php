<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Videos extends Core_Controller {
   
  	function index(){
      $this->videos();
   }

   function videos(){
      $this->load->view('videosView');
   }

}
