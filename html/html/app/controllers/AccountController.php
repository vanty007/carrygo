<?php 

/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$db->where ("id", USER_ID);
		$user = $db->getOne('auth' , '*');
		render_json($user);
	}
	
	
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id=null){
		$db = $this->GetModel();
		if(is_post_request()){
			
			$modeldata=transform_request_data($_POST);
			 
			unset($modeldata['auth_id']);
			unset($modeldata['id']);
			unset($modeldata['email']);
			unset($modeldata['password']);
			unset($modeldata['role_id']);
			unset($modeldata['login_session_key']);
			unset($modeldata['email_status']);
			unset($modeldata['password_reset_key']);
			unset($modeldata['login_system']);
			
			$db->where('auth_id' , USER_ID);
			$bool = $db->update('user',$modeldata);
			if($bool){

				$fields = array( 'user.title','user.sex','user.profile_pics','user.firstname','user.lastname','user.id','auth.email','auth.role_id','auth.login_session_key','auth.email_status','auth.password_reset_key','auth.password','auth.login_system');
				$db->Where("user.auth_id", USER_ID);
				$db->join("user","auth.id = user.auth_id","LEFT ");
				$user = $db->getOne('auth',$fields);
				//set_session('user_data',$user);
				render_json(USER_ID);
			}
			else{
				render_error($db->getLastError());
			}
			echo $bool." || ".$modeldata;
			//return null;
		}
		else{
			$fields = array( 'user.title','user.sex','user.profile_pics','user.firstname','user.lastname','user.id','auth.id','auth.email','auth.password','auth.role_id','auth.login_session_key','auth.email_status','auth.password_reset_key','auth.password','auth.login_system');
			$db->Where("user.auth_id", USER_ID);
			$db->join("user","auth.id = user.auth_id","LEFT ");
			$data = $db->getOne('auth',$fields);
			
			if(!empty($data)){
				render_json($data);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Record not found",404);
				}
			}
		}
	}

	
	/**
     * Change Email Action
     * @return View
     */
	function change_email(){
		if(is_post_request()){
			
			$form_collection = $_POST;
			$email=trim($form_collection['email']);
			
			
			$db = $this->GetModel();
			
			$db->where ("id", USER_ID);
			$result = $db->update('auth', array('email' => $email ,'email_status'=>'not verified'));
			if($result){
				

				//logout user and send new email verification link
				session_destroy();
				redirect_to_page("index/send_verify_email_link/$email");

			}
			else{
				$this->view->form_error="Email Not Changed ";
				$this->view->render("account/change_email.php" ,null,"default_layout.php");
			}
		}
		else{
			$this->view->render("account/change_email.php" ,null,"default_layout.php");
		}
	}
}
