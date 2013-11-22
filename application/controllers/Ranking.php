<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Ranking extends Core_Controller {
   
  	function index(){
      $this->ranking();
   }

   function ranking(){
      $this->load->view('rankingView');
   }

}
