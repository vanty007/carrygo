<?php 

/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends BaseController{
	/**
     * Index Action 
     * @return View
     */
	function index(){
		$this->view->render(null ,null,"main_layout.php");
	}
	
	private function login_user($username , $password_text, $rememberme = false){
		$db = $this->GetModel();
		$fields = array( 'user.firstname','user.lastname','auth.id','auth.email','auth.role_id','auth.profile_pics','auth.login_session_key','auth.email_status','auth.password_reset_key','auth.password','auth.login_system');
		$db->where("email", $username)->orWhere("email", $username);
		$db->join("user","auth.id = user.auth_id","LEFT ");
		$user = $db->getOne('auth',$fields);
		if(!empty($user)){
			
			//Verify User Password Text With DB Password Hash Value.
			//Uses PHP password_verify() function with default options
			$password_hash = $user['password'];
			if(password_verify($password_text,$password_hash)){

				
				// Check If User Email Is Verified
				if(strtolower($user['email_status'])!='verified'){
					//$view_data = array("user_email"=>$user['email'] , "status"=>true);
					
					//page to redirect to for email verification
					//render_json('');
					render_json( "index/send_verify_email_link/verify" );
				}

				unset($user['password']); //Remove user password as it's not needed.
				set_session('user_data',$user); // Set Active User Data in A Sessions
				//if Remeber Me, Set Cookie
				if($rememberme==true){
					$sessionkey=time().random_str(20);// Generate a Session Key for the User
					//Update User Detail in Database with the session key
					$db->where('id' , $user['id']);
					$res = $db -> update(array("login_session_key"=>hash_value($sessionkey)));
					if(!empty($res)){
						set_cookie("login_session_key",$sessionkey);// save user login_session_key in a Cookie
					}
				}
				else{
					clear_cookie("login_session_key");// Clear any Previous Set Cookie
				}
				render_json('');
			}
			else{
				render_error("Username or password not correct" , 401);
			}
		}
		else{
			render_error("Username or password not correct" , 401);
		}
	}
	
	
	/**
     * Login Action
     * If Not $_POST Request, Display Login Form View
     * @return View
     */
	function login(){
		if(is_post_request()){
			
			$form_collection=$_POST;
			$username=trim($form_collection['username']);
			$password=$form_collection['password'];
			$rememberme=(!empty($form_collection['rememberme']) ? $form_collection['rememberme'] : false);
			
			$this->login_user($username , $password, $rememberme = false);
			
		}
		else{
			render_error("Invalid request");
		}
	}
	
	
	/**
     * Register User Action 
     * If Not $_POST Request, Display Register Form View
     * @return View
     */
	function register(){
		if(is_post_request()){
			
			$modeldata=transform_request_data($_POST);

			$rules_array = array(
				
				'email' => 'required|valid_email',
				'lastname' => 'required',
				'firstname' => 'required',
				'password' => 'required',
			);
			$firstname = $modeldata['firstname'];
			$lastname = $modeldata['lastname'];
			$email = $modeldata['email'];
			
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
						
			$cpassword = $modeldata['confirm_password'];
			$password = $modeldata['password'];
			if($cpassword != $password){
				render_error('Your Password Does not Conform to be Unique');
			}
			unset($modeldata['confirm_password']);
			unset($modeldata['firstname']);
			unset($modeldata['lastname']);
			
			$password_text = $modeldata['password'];
			$modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			
			//$modeldata['email_status'] = 'verified';
			$modeldata['email_status'] = 'Not Verified';

			
			$db = $this->GetModel();
			
			//Check if Duplicate Record Already Exit In The Database
			$db->where('email',$modeldata['email']);
			if($db->has('auth')){
				render_error($modeldata['email']." Already exist!");
			}
			//var_dump($modeldata);
			$rec_id = $db->insert('auth',$modeldata);
			
			if(!empty($rec_id)){

				$modeldata['firstname'] = $firstname;
				$modeldata['lastname'] = $lastname;
				$modeldata['auth_id'] = $rec_id;
				unset($modeldata['password']);
				unset($modeldata['email']);
				unset($modeldata['email_status']);
				$db->insert('user',$modeldata);

				//$user=$this->login_user($email, $password_text);
			
				
				//$user = $result['user'];
				//set_session('user_data',$user);

				//page to redirect to after register
				//render_json('');
				//render_json("index/send_verify_email_link/$email");


						$hashvalue=hash_value($rec_id);
						$verify_link=SITE_ADDR."index/verifyemail/".md5($rec_id)."?h=$hashvalue";
						$mailtitle="Email Address Verification";
						
						$sitename=SITE_NAME;
						
						//Password reset html template
						$mailbody=file_get_contents(PAGES_DIR . "index/emailverify_template.html");
						
						$mailbody=str_ireplace("{{username}}",$email,$mailbody);
						$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
						$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
						
						
						$mailer=new Mailer;
						if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
							//$view_data=array("status"=>true,"user_email"=>$email);
							render_json("index/send_verify_email_link/verify");
							//var_dump($view_data);
							//$this->view->render("index/emailverification.php" , $view_data , "info_layout.php");
							//render_json('');
						}
						else{
							//$view_data=array("status"=>false,"user_email"=>$email);
							//render_json('');
							render_json("index/send_verify_email_link/verify");
							//$this->view->render("index/emailverification.php" , $view_data , "info_layout.php");
						}


			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Error registering user");
				}
			}
		}
		else{
			render_error("Invalid request");
		}
	}

	
	/**
     * Logout Action
     * Destroy All Sessions And Cookies
     * @return View
     */
	function logout($arg=null){
		
		session_destroy();
		clear_cookie("login_session_key");
		redirect_to_page("");
	}
	
	
/**
 * Page To Display After Email Verification
 * @return View
 */
function emailverified(){
	$this->view->render("index/emailverified.php" ,null,"info_layout.php");
}

/**
 * Send Verify Email Link to user Action 
 * @return View
 */
function send_verify_email_link($email=null){
	/*if(!empty($email)){
		$db = $this->GetModel();
		
		$db->where ('email', $email);
		$user = $db->getOne('auth');

		if(!empty($user)){
			if(strtolower($user['email']) != 'verified'){
				$hashvalue=hash_value($user['id']);
				$verify_link=SITE_ADDR."index/verifyemail/".md5($user['id'])."?h=$hashvalue";
				$user_name=$user['email'];
				$email=$user['email'];
				$mailtitle="Email Address Verification";
				
				$sitename=SITE_NAME;
				
				//Password reset html template
				$mailbody=file_get_contents(PAGES_DIR . "index/emailverify_template.html");
				
				$mailbody=str_ireplace("{{username}}",$user_name,$mailbody);
				$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
				$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
				
				
				$mailer=new Mailer;
				if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
					$view_data=array("status"=>true,"user_email"=>$email);
					//var_dump($view_data);*/
					$this->view->render("index/emailverification.php" , '' , "info_layout.php");
				/*}
				else{
					$view_data=array("status"=>false,"user_email"=>$email);
					
					$this->view->render("index/emailverification.php" , $view_data , "info_layout.php");
				}
				
			}
			else{
				$this->view->render("errors/error_general.php" ,"Email address is already verified","info_layout.php");
			}
		}
		else{
			$this->view->render("errors/error_general.php" ,"Email address is not registered","info_layout.php");
		}
	}
	else{
		redirect_to_page("index/login");
	}*/
}

/**
 * Verify Email Action 
 * Get User By Hashed User Id
 * Compare User Hashed Value ($_GET['h']) With Server Hashed Value
 * @param $hasheduserid Hashed String
 * @param $_GET['h'] Server user_id Hashed With Salt Text
 * @return View
 */
function verifyemail($hasheduserid){
	if(!empty($hasheduserid)){
		$db = $this->GetModel();
		
		$fields = array( 'user.firstname','user.lastname','auth.id','auth.email','auth.role_id','auth.profile_pics','auth.login_session_key','auth.email_status','auth.password_reset_key','auth.password','auth.login_system');
		//get user by userid hash value
		//$db->where ('md5(id)', $hasheduserid);
		//$user = $db->getOne('auth');
		$db->where ('md5(auth.id)', $hasheduserid);
		$db->join("user","auth.id = user.auth_id","LEFT ");
		$user = $db->getOne('auth',$fields);
		
		if(!empty($user) && !empty($_GET['h'])){
			$checkhashvalue=hash_value($user['id']);
			if($checkhashvalue==$_GET['h']){
				$db->where ('id', $user["id"]);
				$db->update('auth' , array("email_status"=>"verified"));
				set_session('user_data' , $user);
				$this->view->render("index/emailverified.php" , null ,"info_layout.php");
			}
			else{
				$this->view->render("errors/error_general.php" ,"The email verification link is not valid","info_layout.php");
			}
		}
		else{
			$this->view->render("errors/error_general.php" ,"The email verification link is not valid","info_layout.php");
		}
	}
	else{
		redirect_to_page("index/login");
	}
}

	
}
