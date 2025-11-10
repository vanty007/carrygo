<?php 
/**
 * Owner Page Controller
 * @category  Controller
 */
class OwnerController extends BaseController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();

		$g=get_session('user_data');
		if(empty($g)){
			render_error("Unauthorized" , 401);
		}
		else{
		$fields = array('user.firstname','user.lastname','user.title','user.profile_pics','owner.id', 	'owner.user_id', 	'owner.name', 	'owner.contactname', 	'owner.contactphone', 	'owner.address', 	'owner.document', 	'owner.dum1', 	'owner.dum2', 	'owner.referalname', 	'owner.referalphoneno', 	'owner.status', 	'owner.created_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		
		$db->join("user","user.auth_id = owner.user_id","INNER");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('owner.id', ORDER_TYPE);
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('owner', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
	}
	/**
     * Load csv|json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv','json'))){
				render_error("File format not supported");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if(!empty($file_path)){
				$db = $this->GetModel();
				if($ext == 'csv'){
					$options = array('table' => 'owner', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'owner' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error(html-lang-0047);
			}
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'id', 	'user_id', 	'name', 	'contactname', 	'contactphone', 	'address', 	'document', 	'dum1', 	'dum2', 	'referalname', 	'referalphoneno', 	'status', 	'created_at' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id' , $rec_id);
		}
		$record = $db->getOne( 'owner', $fields );
		if(!empty($record)){
			render_json($record);
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
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$rules_array = array(
				'name' => 'required',
				'address' => 'required',
				'document' => 'required',
				'referalname' => 'required',
				'referalphoneno' => 'required'
			);
			$user_id = USER_ID;
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$modeldata['user_id']=USER_ID;
			$rec_id = $db->insert('owner',$modeldata);
			if(!empty($rec_id)){
				$db->where('id' , USER_ID);
				$db->update('auth',array("role_id"=>"administrator"));
				//session_destroy();

				$fields = array( 'user.firstname','user.lastname','auth.id','auth.email','auth.role_id','auth.profile_pics','auth.login_session_key','auth.email_status','auth.password_reset_key','auth.password','auth.login_system');
				$db->Where("auth.id", $user_id);
				$db->join("user","auth.id = user.auth_id","LEFT ");
				$user = $db->getOne('auth',$fields);
				set_session('user_data',$user);

				$email = ADMIN_ADDR;
				$verify_link=SITE_ADDR."#owner/list";
				$mailtitle="New Property Owner Registration";
				$sitename=SITE_NAME;
				$bodymessage = "Please a new user has registered to be a property owner on Homly.";
				
				$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
				
				$mailbody=str_ireplace("{{username}}",$email,$mailbody);
				$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
				$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
				$mailbody=str_ireplace("{{subject}}",$mailtitle,$mailbody);
				$mailbody=str_ireplace("{{body}}",$bodymessage,$mailbody);
				
				
				$mailer=new Mailer;
				$mailer->send_mail($email,$mailtitle,$mailbody);
					


				render_json($user_id);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Error inserting record");
				}
			}
		}
		else{
			render_error("Invalid request");
		}
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
			$db->where('user_id' , USER_ID);
			$bool = $db->update('owner',$modeldata);
			if($bool){
				render_json(USER_ID);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','user_id','name','contactname','contactphone','address','document','dum1','dum2','referalname','referalphoneno','status');
			$db->where('user_id' , USER_ID);
			$data = $db->getOne('owner',$fields);
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
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		$db = $this->GetModel();
		$arr_id = explode( ',', $rec_ids );
		foreach( $arr_id as $rec_id ){
			$db->where('id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'owner' );
		if($bool){
			render_json( $bool );
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Error deleting the record. please make sure that the record exit");
			}
		}
	}
}
