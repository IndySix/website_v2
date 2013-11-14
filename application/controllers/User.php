<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_User extends Core_Controller {
   
  	function index(){
    	$this->view();
    	$this->ModelLogin->updateUserSession();
   	}

   	function view(){
   		echo "view";
   	}

   	function login(){
   		echo "login";
   	}

   	function register(){
   		echo "register";
   	}
}        