<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Game extends Core_Controller {
	public function index(){

	}

	public function play(){
		echo $this->uri->segment(3);
	}

	private function showQueue(){

	}

	private function playGame(){

	}
}