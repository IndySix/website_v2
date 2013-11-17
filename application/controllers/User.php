<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_User extends Core_Controller {
   
  	function index(){
      $this->ModelLogin->checkLogin();
   }

   function view(){
      $this->ModelLogin->checkLogin();
   	echo "view";
   }

   function login(){
   	echo "login";
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