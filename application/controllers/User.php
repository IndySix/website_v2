<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_User extends Core_Controller {
   
  	function index(){
      $this->view();
   }

   function view(){
      $this->ModelLogin->checkLogin();
   	
      $this->load->model('User');
      $data['owner'] = false;

      $user_id = $this->uri->segment(3);
      if($user_id == null || !is_numeric($user_id))
         $user_id = $this->LibSession->get('user_id');

      $user = $this->ModelUser->byId($user_id);

      if(!empty($user)){
         $data['owner'] = $this->LibSession->get('user_id') == $user_id ? true : false;
         $data['user_id']  = $user['id'];
         $data['username'] = $user['username'];
         $data['registrationDate'] =  date("j F Y", datetimeToTimestamp($user['registrationDate'])); 
         $data['avatarUrl'] = baseUrl( 'data/avatars/'.$user['avatar'] );
         $data['difficulty'] = $user['difficulty'];
         
         $data['userinfo'] = array();
         if(!empty($user['place']))
            $data['userinfo']['Place'] = $user['place'];

         $age = calculateAge($user['birthday'] );
         if($age > 0)
            $data['userinfo']['Age'] = $age.' years';

         if(!empty($user['gender']))
            $data['userinfo']['Gender'] = $user['gender'] == 'm' ? 'Men' : 'Woman';

         $data['aboutMe'] = $user['aboutMe'];           

         $this->load->view('userView', $data);
      } else {
         $data['titleMessage'] = 'Profile does not exists';
         $data['message']      = 'The profile that you are looking for does not exists!';
         $this->load->view('message', $data);
      }
   }

   function login(){
   	if($this->ModelLogin->isLoggedin()){
         $data['titleMessage'] = 'Already Loggedin';
         $data['message']      = 'You are already loggedin!';
         $this->load->view('message', $data);
         return;
      }

      $_loginSuccessful = false;
      $data['username'] = '';
      $data['password'] = '';
      $data['error_login']    = '';

      if(isset($_POST['login'])){
         $data['username'] = $_POST['username'];
         $data['password'] = $_POST['password'];

         $_loginSuccessful = $this->ModelLogin->user($_POST['username'], $_POST['password']);
         
         if( !$_loginSuccessful)
            $data['error_login'] = "The combination of the username and password is incorrect!";
      }

      if($this->uri->segment(3) == 'json')
         echo json_encode($data);
      elseif( !$_loginSuccessful)
         $this->load->view('userLogin', $data);
      else
         redirect("home");
   }

   function logout(){
      $this->ModelLogin->logout();
      $this->login();
   }

   function register(){
      $_registerSuccessful = false;
   	$data['username'] = '';
      $data['password'] = '';
      $data['email']    = '';
      $data['error_username'] = '';
      $data['error_password'] = '';
      $data['error_email']    = '';

      if(isset($_POST['register'])){
         $this->load->model('Validate');
         $data['username'] = $_POST['username'];
         $data['password'] = $_POST['password'];
         $data['email']    = $_POST['email'];

         #validate username
         if( !$this->ModelValidate->username($data['username']) )
            $data['error_username'] = $this->ModelValidate->getErrors();

         #validate password
         if( !$this->ModelValidate->password($data['password']) )
            $data['error_password'] = $this->ModelValidate->getErrors();

         #validate email
         if( !$this->ModelValidate->email($data['email']) )
            $data['error_email'] = $this->ModelValidate->getErrors();

         if ( empty($data['error_username']) && empty($data['error_password']) && empty($data['error_email']) ) {
            $this->load->library('Secure');
            $this->load->model('Tokens');
            $this->load->model('Mail');
            
            $_registerSuccessful = true;
            
            #save user
            $bind['username'] = $data['username'];
            $bind['password'] = $this->LibSecure->hashPassword( $data['password'] );
            $bind['email']    = $data['email'];
            $this->db->insert('Users', $bind);

            #Login user
            $this->ModelLogin->user($data['username'], $data['password']);

            #send validate email
            $token = $this->ModelTokens->create($this->LibSession->get('user_id'), 'mail');
            $this->ModelMail->register($data['email'], $data['username'], $token);
         }
      }

      if($this->uri->segment(3) == 'json')
         echo json_encode($data);
      elseif( !$_registerSuccessful)
         $this->load->view('userRegister', $data);
      else
         redirect("home");
   }

   function validateEmail(){
      $this->load->model('Tokens');
      $this->load->model('User');
      $data['titleMessage'] = 'Email validation';

      $token = $this->ModelTokens->get( $this->uri->segment(3) );

      if($token != null && $token['type'] == 'mail'){
         $user = $this->ModelUser->byId( $token['user_id'] );
         
         if(!empty($user)){
            $user['validEmail'] = 1;
            $this->ModelUser->save($user);
            $this->ModelTokens->deleteType($token['user_id'], $token['type']);
            $data['message'] = 'Thank you for validating your email address.';
         } else {
            $data['error'] = 'No user with token!';
         }
      } else {
         $data['error'] = 'No valid token is given!';
      }
      $this->load->view('message', $data); 
   }
}        