<?php 

/**
 * Index Page Controller
 * @category  Controller
 */
class LoginController extends BaseController{
	/**
     * Index Action 
     * @return View
     */
	function index(){
		$this->view->render(null ,null,"main_layout.php");
	}
	
	private function login_user($username){
		$db = $this->GetModel();
		$fields = array( 'username','id','email','role_id','password');

		$username = preg_replace('/^(0)/', "234", trim($username));

		/*$db->where("username", $username)->orWhere("email", $username);
		$user = $db->getOne('user',$fields);
		if(!empty($user) && $db->where("msisdn", $username)->has('carrygo_subscriptions')){*/
		$db->where("msisdn", $username);
		$user = $db->getOne('carrygo_subscriptions');
		if(!empty($user)){
			
				set_session('user_bid',$user["msisdn"]);
				render_json('#');
			}
		else{
			render_error("Your not an active subscriber, please dial *20790# to subscribe" , 401);
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
			
			$this->login_user($username);
			
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
				
				'username' => 'required',
				'password' => 'required',
				'category' => 'required',
			);
			$username = $modeldata['username'];
			$password = $modeldata['password'];
			$category = $modeldata['category'];
			
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			
			$password_text = $modeldata['password'];
			$modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);

			$mobile = preg_replace('/^(0)/', "234", trim($username));
			$modeldata['username'] = $mobile;
						
			$db = $this->GetModel();
			
			//Check if Duplicate Record Already Exit In The Database
			$db->where("username", $username)->orWhere("email", $username);
			if($db->has('user')){
				render_error($modeldata['username']." Already exist!");
			}
			if(!$db->has('subscriptions')){
				render_error($modeldata['username']." is yet to Subscriber to Televet!");
			}
			//var_dump($modeldata);
			$rec_id = $db->insert('user',$modeldata);
			if($rec_id){
				$db->where("id", $rec_id);
				$user = $db->getOne('user');
				set_session('user_data',$user);
				render_json('#trivia');
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
		redirect_to_page("#login");
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
