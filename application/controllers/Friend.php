<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_Friend extends Core_Controller {
	public function index(){

	}

	public function status(){
		$this->load->model('User');
   		$user_id = $this->LibSession->get('user_id');
		$friend_id = $this->uri->segment(3);

		$data['status'] = 'request';

		#check if users already connected
		$connection = $this->ModelUser->getFriendConnection($user_id, $friend_id);
		if( $connection != null && $connection['accepted'] == 1 ){
			$data['status'] = 'friend';
		} elseif($connection != null && $connection['user_id'] == $user_id) {
			$data['status'] = 'request_send';
		}

		echo json_encode($data); 
	}

	public function request(){
		$this->load->model('User');
		$data['status'] = 'request';
		
		$user_id = $this->LibSession->get('user_id');
		$friend_id = $this->uri->segment(3);
		
		#check if user exists
		if($this->ModelUser->byId($friend_id) == null)
			return;

		#check if users already connected
		$connection = $this->ModelUser->getFriendConnection($user_id, $friend_id);
		$data['user_id'] =$user_id;
		$data['friend_id'] = $friend_id;
		$data['connection'] = $connection;
		if( $connection == null  ){
			#create friend connection
			$data['status'] = 'request_send'; 
			$insert['user_id'] = $user_id;
			$insert['friend_id'] = $friend_id;
			$this->db->insert('Friends', $insert);
		} elseif($connection['accepted'] == 1){
			$data['status'] = 'friend';	
		} elseif($connection['user_id'] == $friend_id){
			#Accept friend request
			$data['status'] = 'friend';
			$this->db->where('id', $connection['id']);
			$update['request'] = 0;
			$update['accepted'] = 1;
			$update['friendSince'] = timestampToDatetime(time());
			$this->db->update('Friends', $update);
		}

		echo json_encode($data);
   	}

   	public function delete(){
   		$this->load->model('User');
   		$user_id = $this->LibSession->get('user_id');
		$friend_id = $this->uri->segment(3);

		#check if users already connected
		$connection = $this->ModelUser->getFriendConnection($user_id, $friend_id);
		if( $connection == null )
			return;

		$this->db->where('id', $connection['id']);
		//$this->db->delete('Friends');
   	}

   	public function accept(){
   		$this->load->model('User');
   		$user_id = $this->LibSession->get('user_id');
		$friend_id = $this->uri->segment(3);

		#check if users already connected
		$connection = $this->ModelUser->getFriendConnection($user_id, $friend_id);
		if( $connection == null )
			return;

		if($connection['request'] == 1 && $user_id == $connection['friend_id']){
			$this->db->where('id', $connection['id']);
			$update['request'] = 0;
			$update['accepted'] = 1;
			$update['friendSince'] = timestampToDatetime(time());
			$this->db->update('Friends', $update);
		}
   	}

   	public function refuse(){
   		$this->load->model('User');
   		$user_id = $this->LibSession->get('user_id');
		$friend_id = $this->uri->segment(3);

		#check if users already connected
		$connection = $this->ModelUser->getFriendConnection($user_id, $friend_id);
		if( $connection == null )
			return;

		if($connection['request'] == 1 && $user_id == $connection['friend_id']){
			$this->db->where('id', $connection['id']);
			$update['request'] = 0;
			$this->db->update('Friends', $update);
		}
   	}

   	public function getRequests(){
   		$this->ModelLogin->checkLogin();

   		$this->load->model('User');
   		$data['requests'] = $this->ModelUser->getFriendRequests($this->LibSession->get('user_id'));
   		echo json_encode($data); 
   	}
}
   