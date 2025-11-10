<?php

/**
 * Index Page Controller
 * @category  Controller
 */
class IndexController extends BaseController
{
	/**
	 * Index Action 
	 * @return View
	 */
	function index()
	{
		$this->view->render(null, null, "main_layout.php");
	}

	private function login_user($username, $password_text, $rememberme = false)
	{
		$db = $this->GetModel();
		$driver_status = 0;

		$db->where("email", $username)->orWhere("phoneno", $username);
		$user = $db->getOne('user');
		if (!empty($user)) {

			//Verify User Password Text With DB Password Hash Value.
			//Uses PHP password_verify() function with default options
			$password_hash = $user['password'];
			if (password_verify($password_text, $password_hash)) {


				unset($user['password']); //Remove user password as it's not needed.
				set_session('user_data', $user); // Set Active User Data in A Sessions
				//if Remeber Me, Set Cookie
				/*if($rememberme==true){
					$db->where('id' , $user['id']);
					$user_driver = $db->getOne('riders_availability');
					if($user_driver){
						$driver_status = $user_driver['status'];
					}
				}*/


				render_json('');
			} else {
				render_error("Username or password not correct", 401);
			}
		} else {
			render_error("Username or password not correct", 401);
		}
	}


	/**
	 * Login Action
	 * If Not $_POST Request, Display Login Form View
	 * @return View
	 */
	function login()
	{
		if (is_post_request()) {

			$form_collection = $_POST;
			$username = trim($form_collection['username']);
			$password = $form_collection['password'];
			$rememberme = (!empty($form_collection['rememberme']) ? $form_collection['rememberme'] : false);

			$this->login_user($username, $password, $rememberme = false);
		} else {
			render_error("Invalid request");
		}
	}


	/**
	 * Register User Action 
	 * If Not $_POST Request, Display Register Form View
	 * @return View
	 */
	function register()
	{
		if (is_post_request()) {



			$modeldata = transform_request_data($_POST);

			$rules_array = array(

				'email' => 'required|valid_email',
				'phoneno' => 'required',
				'password' => 'required',
				'role_id' => 'required',
				'firstname' => 'required',
				'lastname' => 'required',
			);

			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if ($is_valid != true) {
				render_error($is_valid);
			}


			$cpassword = $modeldata['confirm_password'];
			$password = $modeldata['password'];
			if ($cpassword != $password) {
				render_error('Your Password Does not Conform to be Unique');
			}
			unset($modeldata['confirm_password']);

			$password_text = $modeldata['password'];
			$modeldata['password'] = password_hash($password_text, PASSWORD_DEFAULT);




			$db = $this->GetModel();




			//Check if Duplicate Record Already Exit In The Database
			$db->where('email', $modeldata['email']);
			if ($db->has('user')) {
				render_error($modeldata['email'] . " Already exist!");
			}

			$rec_id = $db->insert('user', $modeldata);

			if (!empty($rec_id)) {

				//$hashvalue=hash_value("5533");
				//$verify_link=SITE_ADDR."index/verifyemail/"."?h=$hashvalue";
				$mailtitle = "Registration Successful";
				$body = "Dear customer, you can book pick up's and take pick up's through our platform";

				$sitename = SITE_NAME;
				$email = $modeldata['email'];
				$subject = "Welcome to Transhaul Logistics";

				//Password reset html template
				$mailbody = file_get_contents(PAGES_DIR . "index/emailpush_template.html");

				$mailbody = str_ireplace("{{username}}", $email, $mailbody);
				$mailbody = str_ireplace("{{body}}", $body, $mailbody);
				$mailbody = str_ireplace("{{sitename}}", $sitename, $mailbody);
				$mailbody = str_ireplace("{{subject}}", $subject, $mailbody);


				$mailer = new Mailer;
				if ($mailer->send_mail($email, $mailtitle, $mailbody) == true) {
				} else {
				}

				$user = $this->login_user($modeldata['email'], $password_text);


				$user = $result['user'];
				set_session('user_data', $user);

				//page to redirect to after register
				render_json('');
			} else {
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_error("Error registering user");
				}
			}
		} else {
			render_error("Invalid request");
		}
	}


	/**
	 * Logout Action
	 * Destroy All Sessions And Cookies
	 * @return View
	 */
	function logout($arg = null)
	{

		session_destroy();
		clear_cookie("login_session_key");
		redirect_to_page("");
	}
}
