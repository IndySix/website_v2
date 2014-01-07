<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Controller_User extends Core_Controller {
   
  	function index(){
      if( $this->ModelApp->isGame() ){
         if($this->ModelLogin->isLoggedin())
            $this->view();
         else
            $this->login();
      } else {
         if($this->ModelLogin->isLoggedin())
            $this->view();
         else
            $this->register();
      }
   }

   function friends(){
      $this->load->model('User');
      $data['friends'] = $this->ModelUser->getFriends($this->LibSession->get('user_id'));
      $this->load->view('friendsView', $data);
   }
   function battles(){
      $this->load->view('battlesView');
   }

   function view(){
      $this->ModelLogin->checkLogin();
      $this->contentTitle = "View user";
   	
      $this->load->model('User');

      $user_id = $this->uri->segment(3);
      if($user_id == null || !is_numeric($user_id))
         $user_id = $this->LibSession->get('user_id');

      //ranking back button
      if($this->uri->segment(4) == 'ranking')
         $this->ModelApp->setButton('back', baseUrl('ranking'));

      $user = $this->ModelUser->byId($user_id);
      $user_loggedin_id = $this->LibSession->get('user_id');

      if(!empty($user)){
         $this->load->model('Level');
         $this->load->model('LevelHistory');
         $this->contentTitle = ucfirst($user['username']); 
         $data['owner'] = $user_loggedin_id == $user_id ? true : false;
         $data['isFriend'] = $this->ModelUser->isFriend($user_loggedin_id, $user_id);
         $data['isConnection'] = $this->ModelUser->isConnection($user_loggedin_id, $user_id);
         $data['user_id']  = $user['id'];
         $data['username'] = $user['username'];
         $data['registrationDate'] =  date("j F Y", datetimeToTimestamp($user['registrationDate'])); 
         $data['avatarUrl'] = baseUrl( 'data/avatars/'.$user['avatar'] );
         $data['difficulty'] = $user['difficulty'];
         $data['latestLevelName'] = '';
         $data['latestLevelScore'] = 0;

         //Calculate progress
         $levels = $this->ModelLevel->allWithUserHis( $user['id'] );
         $levelCount = count($levels);
         $levelCompleted = 0;
         foreach ($levels as $level) {
            if($level['completed'])
               $levelCompleted++;
         }

         $data['progress'] = $levelCount == 0 ? 0 : (int)(($levelCompleted / $levelCount) * 100);

         //get latest level
         $latestLevel = $this->ModelLevelHistory->latestsResult( $user['id'] );
         if( !empty($latestLevel) ){
            $data['latestLevelName'] = $latestLevel['partName'].' Level: '.$latestLevel['level'];
            $data['latestLevelScore'] = $latestLevel['score'];
         }



         if ($data['owner']){
            $edit = '<a href="'.baseUrl('user/edit').'">';
            $edit .= ' <img src="'.baseUrl( 'data/img/edit.png').'" style="height:18px; margin-bottom: -2px"/></a>';
            $this->contentTitle .= $edit;
         }
         
         $data['userinfo'] = array();
         if(!empty($user['place']))
            $data['userinfo']['Place'] = $user['place'];

         $age = calculateAge($user['birthday'] );
         if($age > 0)
            $data['userinfo']['Age'] = $age.' years';

         if(!empty($user['gender']))
            $data['userinfo']['Gender'] = $user['gender'] == 'm' ? 'Men' : 'Woman';

         $data['aboutMe'] = $user['aboutMe'];           

         $this->loadView('userView', $data);
      } else {
         $data['error']  = 'The profile that you are looking for does not exists!';
         $this->loadView('message', $data);
      }
   }

   function login(){
      $this->contentTitle = "Login";
   	if($this->ModelLogin->isLoggedin()){
         $data['titleMessage'] = 'Already Loggedin';
         $data['message']      = 'You are already loggedin!';
         $this->loadView('message', $data);
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
         $this->loadView('userLogin', $data);
      else
         redirect("user");
   }

   function logout(){
      $this->ModelLogin->logout();
      $this->index();
   }

   function register(){
      $this->contentTitle = "Register";
      $_registerSuccessful = true;
   	$data['username'] = '';
      $data['password'] = '';
      $data['email']    = '';
      $data['error_username'] = '';
      $data['error_password'] = '';
      $data['error_email']    = '';

      if(isset($_POST['register'])){
         $this->load->library('InputValidate');
         $this->load->model('User');
         $data['username'] = $_POST['username'];
         $data['password'] = $_POST['password'];
         $data['email']    = $_POST['email'];

         #validate username
         $user = $this->ModelUser->byUsername($data['username']);
         if($user == null) {
            $this->LibInputValidate->add('username', $data['username'], 'alphanumeric', 'empty= false');
         } else {
            $_registerSuccessful = false;
            $data['error_username'] = "Username already used!";
         }

         #validate password
         $this->LibInputValidate->add('password', $data['password'], 'none', 'empty = false; minlength = 6');

         #validate email
         $user = $this->ModelUser->byEmail($data['email']);
         if($user == null) {
            $this->LibInputValidate->add('email', $data['email'], 'email', 'empty= false');
         } else {
            $_registerSuccessful = false;
            $data['error_email'] = "Email already used!";
         }

         #get errors
         $errors = $this->LibInputValidate->validate();

         if ( $_registerSuccessful && empty($errors) ) {
            $this->load->library('Secure');
            $this->load->model('Tokens');
            $this->load->model('Mail');
            
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
         } else {

            $_registerSuccessful = false;
            foreach ($errors as $input => $input_errors) {
                foreach ($input_errors as $error) {
                        $data['error_'.$input] .= $error."<br/>";
                }
            }
         }
      } else {
         $_registerSuccessful = false;
      }

      if($this->uri->segment(3) == 'json')
         echo json_encode($data);
      elseif( !$_registerSuccessful)
         $this->loadView('userRegister', $data);
      else
         redirect("user");
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
      $this->loadView('message', $data); 
   }

   function edit(){
      $this->ModelLogin->checkLogin();
      $this->contentTitle = "Edit profile";
      
      $this->load->model('User');
      $this->load->library('Upload');

      $this->LibUpload->setIsImage(true);
      $this->LibUpload->setMaximumWidth(120);
      $this->LibUpload->setMaximumHeight(120);
      $this->LibUpload->setValidExtensions("jpg|jpeg|png");
      $this->LibUpload->setUploadDirectory('data/avatars');

      $user = $this->ModelUser->byId( $this->LibSession->get('user_id') );
      $_validate_user      = null;
      $_editSuccessful     = true;
      $data['saved']       = false;
      $data['password']    = '';
      $data['password2']   = '';
      $data['email']       = '';
      $data['difficulty']  = '';
      $data['place']       = '';
      $data['birthday']    = '';
      $data['gender']      = '';
      $data['aboutMe']     = '';

      $data['error_form']     = '';
      $data['error_avatar']   = '';
      $data['error_password'] = '';
      $data['error_email']    = '';
      $data['error_place']    = '';
      $data['error_birthday'] = '';

      #upload avater when set
      if( $user != null && isset($_POST['upload'])){
         
         $this->load->library('Upload');

         $this->LibUpload->setIsImage(true);
         $this->LibUpload->setMaximumWidth(120);
         $this->LibUpload->setMaximumHeight(120);
         $this->LibUpload->setValidExtensions("jpg|jpeg|png");
         $this->LibUpload->setUploadDirectory('data/avatars');

         #change file name to random
         $x = explode('.', $_FILES['avatar']['name']);
         $extension = strtolower( $x[count($x) - 1] );
         $_FILES['avatar']['name'] = randomString(16).'.'.$extension;
         
         $this->LibUpload->loadFile( $_FILES['avatar'] );
         if($this->LibUpload->uploadFile()){
            #remove old avatar
            if($user['avatar'] != 'noavatar.jpg'){
               unlink(__SITE_PATH.'data/avatars/'.$user['avatar']);
            }

            #save upload to user
            $avatar['id'] = $user['id'];
            $avatar['avatar'] = $this->LibUpload->getFileName();
            $user['avatar'] = $avatar['avatar'];
            $this->ModelUser->save($avatar);
            $this->ModelLogin->updateUserSession();
         } else {
            foreach ($this->LibUpload->getErrors() as $error) {
               $data['error_avatar'] .= $error."<br>";
            }
         }
      } 

      #get edit post data when set
      if($user != null && isset($_POST['edit'])){
         $_validate_user                = $user;
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
         if($_validate_user['email'] != $user['email']){
            $_validate_user['validEmail'] = false;
            $user = $this->ModelUser->byEmail($_validate_user['email']);
            if($user == null) {
               $this->LibInputValidate->add('email', $_validate_user['email'], 'email', 'empty= false');
            } else {
               $_editSuccessful = false;
               $data['error_email'] = "Email already used!";
            }
         }

         #validate difficulty
         if(!in_array($_validate_user['difficulty'], array('Easy','Medium','Hard'))) {
            $_editSuccessful = false;
            $data['error_form'] = "Invalid difficulty is given!";
         }

         #validate place when set
         if($user['place'] != $_validate_user['place'])
            $this->LibInputValidate->add('place', $_validate_user['place'], 'alphabet');

         #validate birthday when set
         if(!empty($_validate_user['birthday'])){
            $d = DateTime::createFromFormat("Y-m-d", $_validate_user['birthday']);
            if ( !($d && $d->format("Y-m-d") == $_validate_user['birthday']) ) {
               $_editSuccessful = false;
               $data['error_form'] = 'Invalid birthday is given!';
            }
         }

         #validate gender when set
         if(!in_array($_validate_user['gender'], array('m','w'))){
            $_editSuccessful = false;
            $data['error_form'] = "Invalid gender is given!";
         }

         #validate aboutme
         $_validate_user['aboutMe'] = htmlentities($_validate_user['aboutMe']);

         #validate password when set
         if(!empty($_validate_user['password'])){
            if($_validate_user['password'] != $_validate_user['password2']){
                $_editSuccessful = false;
               $data['error_password'] = "Passwords doesn't match!";
            }else{
              $this->LibInputValidate->add('password', $_validate_user['password'], 'none', 'empty = false; minlength = 6');
            }
         }

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

         #save results
         if($_editSuccessful){
            $this->load->library('Secure');
            $data['saved'] = true;
            
            if(empty($_validate_user['password']))
               unset($_validate_user['password']);
            else
               $_validate_user['password'] = $this->LibSecure->hashPassword( $_validate_user['password'] );
            
            $this->ModelUser->save($_validate_user);
            $this->ModelLogin->updateUserSession();
         }

         $user = $_validate_user;
      }


      #empty birhtday when default set
      $user['birthday'] = $user['birthday'] == 0 ? '' : $user['birthday'];

      $data['user'] = $user;
      if($this->uri->segment(3) == 'json')
         echo json_encode($data);
      else
         $this->loadView('userEdit', $data);
   }

   public function search(){
      $this->load->model('User');
      $this->contentTitle = "Search user";
      $data["user_id"] = $this->LibSession->get('user_id');
      $data['search'] = '';
   
      if(isset($_GET['search']))
         $data['search'] = $_GET['search'];

      if(isset($_GET['term']))
         $data['search'] = $_GET['term'];

      $data['users'] = $this->ModelUser->searchByUsername($data['search']);
      
      if($this->uri->segment(3) == 'searchBar'){
         $search = array();
         $counter = 0;
         foreach ($data['users'] as $user) {
            if($counter > 5)
               break;
            $item = new stdClass();
            $item->label = '<div id="'.$user['id'] .'"> <img src="'.baseUrl('data/avatars/').$user['avatar'].'" width="25px"> '.$user['username'].'</div>';
            $item->value = $user['username'];
            $search[] = $item;
         }
         echo json_encode($search);
      } elseif($this->uri->segment(3) == 'json'){
         echo json_encode($data);
      } else{
         $this->loadView('userSearch', $data);
      }
   }
}        