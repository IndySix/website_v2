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

   function edit(){
      $this->ModelLogin->checkLogin();
      
      $this->load->model('User');
      $user = $this->ModelUser->byId( $this->LibSession->get('user_id') );
      $_validate_user      = null;
      $_editSuccessful     = false;
      $data['password']    = '';
      $data['password2']   = '';
      $data['email']       = '';
      $data['difficulty']  = '';
      $data['place']       = '';
      $data['birthday']    = '';
      $data['gender']      = '';
      $data['aboutMe']     = '';

      $data['error_form']     = '';
      $data['error_password'] = '';
      $data['error_email']    = '';
      $data['error_place']    = '';
      $data['error_birthday'] = '';

      #get post data when set
      if($user != null && isset($_POST['edit'])){
         $_validate_user['password']    = $_POST['password'];
         $_validate_user['password2']   = $_POST['password2'];
         $_validate_user['email']       = $_POST['email'];
         $_validate_user['difficulty']  = $_POST['difficulty'];
         $_validate_user['place']       = $_POST['place'];
         $_validate_user['birthday']    = $_POST['birthday'];
         $_validate_user['gender']      = $_POST['gender'];
         $_validate_user['aboutMe']     = $_POST['aboutMe'];
      }
      
      if($_validate_user != null){
         $this->load->library('InputValidate');

         #validate email
         $this->LibInputValidate->add('email', $_validate_user['email'], 'email', 'empty= false');

         #validate difficulty
         if(!in_array($_validate_user['difficulty'], array('Easy','Medium','Hard'))) {
            $_editSuccessful = false;
            $data['error_form'] = "Invalid difficulty is given!";
         }

         #validate place when set
         if($user['place'] != $_validate_user['place'])
            $this->LibInputValidate->add('place', $_validate_user['place'], 'alphabet');

         #validate birthday when set
         #echo checkdate($_validate_user['birthday']);

         #validate gender when set
         if(!in_array($_validate_user['gender'], array('m','w'))){
            $_editSuccessful = false;
            $data['error_form'] = "Invalid gender is given!";
         }

         #validate aboutme when set
         $_validate_user['aboutMe'] = htmlentities($_validate_user['aboutMe']);

         #validate password when set
         if(!empty($_validate_user['password'])){
            if($_validate_user['password'] != $_validate_user['password2']){
                $_editSuccessful = false;
               $data['error_password'] = "Passwords doesn't match!";
            }else{

            }
         }

         #validate image

         #check errors;
         $errors = $this->LibInputValidate->validate();
         if( !empty($errors) ){
            $_editSuccessful = false;
            foreach ($errors as $input => $input_errors) {
                foreach ($input_errors as $error) {
                        $data['error_'.$input] .= $error."<br/>";
                }
            }
         }
         $user = $_validate_user;
      }
      $data['user'] = $user;
      if($this->uri->segment(3) == 'json')
         echo json_encode($data);
      else
         $this->load->view('userEdit', $data);
   }
}        