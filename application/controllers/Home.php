<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Home extends Core_Controller {
   function index(){
        $this->load->view('home');
   }
}        