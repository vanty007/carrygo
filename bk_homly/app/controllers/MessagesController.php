<?php 
/**
 * Owner Page Controller
 * @category  Controller
 */
class MessagesController extends BaseController{
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

		$user_id = USER_ID;
		$sqltext = "SELECT p2.firstname,p2.lastname,p2.title,p2.profile_pics,p.id,p.message_id,p.sender,p.receiver,p.message, p.type,p.subject,p.receipt,p.created_at, 
		@diff:=ABS( UNIX_TIMESTAMP(p.created_at) - UNIX_TIMESTAMP() ) , 
		CAST(@days := IF(@diff/86400 >= 1, floor(@diff / 86400 ),0) AS SIGNED) as days, 
		CAST(@hours := IF(@diff/3600 >= 1, floor((@diff:=@diff-@days*86400) / 3600),0) AS SIGNED) as hours, 
		CAST(@minutes := IF(@diff/60 >= 1, floor((@diff:=@diff-@hours*3600) / 60),0) AS SIGNED) as minutes, 
		CAST(@diff-@minutes*60 AS SIGNED) as seconds FROM message p, user p2
		where p2.auth_id = p.sender and (p.sender = $user_id or p.receiver = $user_id) group by p.message_id";

		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('p.created_at', 'desc');
		}
		/*$fields = array('user.firstname','user.lastname','user.title','user.profile_pics','message.id','message.message_id','message.sender','message.receiver','message.message','message.type','message.subject','message.receipt', 	'message.created_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('message.message',"%$text%",'LIKE');
		}
		//$db->where('user.auth_id' , USER_ID);
		$db->where('message.sender' , USER_ID);
		$db->orWhere('message.receiver' , USER_ID);
		$db->join("user","user.auth_id = message.receiver","INNER");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('message.id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}*/
		//page filter command
		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query( $sqltext, $limit );
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
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
		$sqltext = "SELECT p2.firstname,p2.lastname,p2.title,p2.profile_pics,p.id,p.message_id,p.sender,p.receiver,p.message, p.type,p.subject,p.receipt,p.created_at, 
		@diff:=ABS( UNIX_TIMESTAMP(p.created_at) - UNIX_TIMESTAMP() ) , 
		CAST(@days := IF(@diff/86400 >= 1, floor(@diff / 86400 ),0) AS SIGNED) as days, 
		CAST(@hours := IF(@diff/3600 >= 1, floor((@diff:=@diff-@days*86400) / 3600),0) AS SIGNED) as hours, 
		CAST(@minutes := IF(@diff/60 >= 1, floor((@diff:=@diff-@hours*3600) / 60),0) AS SIGNED) as minutes, 
		CAST(@diff-@minutes*60 AS SIGNED) as seconds FROM message p, user p2
		where p2.auth_id = p.sender and p.message_id='$rec_id' order by p.created_at asc";

		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT);

		$db->where('message_id' , $rec_id);
		$db->orderBy('id', 'desc');
		$data = $db->getOne('message');
		if(!empty($data) && $data['receipt']==0){
			$db->where('message_id' , $rec_id);
			$db->update('message',array('receipt'=>1));
		}
		$db1 = $this->GetModel();
		$record = $db1->query( $sqltext );
		if(!empty($record)){
			render_json($record);
		}
		else{
			if($db1->getLastError()){
				render_error($db1->getLastError());
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
		$data = file_get_contents('php://input');
		$processed_data = json_decode($data, true);
		
		$message_id = (isset($processed_data['message_id'])) ? $processed_data['message_id'] : "";
		$receiver = (isset($processed_data['sender'])) ? $processed_data['sender'] : "";
		$subject = (isset($processed_data['subject'])) ? $processed_data['subject'] : "";
		$sender = USER_ID;
		if($receiver==$sender){
			render_error("Cannot send message to self");
			}
			else{
		$message = (isset($processed_data['message'])) ? $processed_data['message'] : "";
		
			$db = $this->GetModel();
			$rec_id = $db->insert('message',array('message'=>$message,'message_id'=>$message_id,'sender'=>$sender,'receiver'=>$receiver,'subject'=>$subject));
			if(!empty($rec_id)){

				$sqltext = "SELECT a.id,a.email FROM auth a where a.id=$receiver limit 1";
				$sqltext1 = "SELECT a.firstname,a.lastname FROM user a where a.auth_id=$receiver limit 1";
		
				$getuser = $db->rawQueryOne($sqltext);
				$getuser_receiver = $db->rawQueryOne($sqltext1);
		
				$email = $getuser['email'];
				$verify_link=SITE_ADDR."#message";
				$mailtitle="New Message Notifiction";
				$sitename=SITE_NAME;
				$bodymessage = "You just received a new message from ".$getuser_receiver['lastname'].' '.$getuser_receiver['firstname'];
				
				$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
				
				$mailbody=str_ireplace("{{username}}",$email,$mailbody);
				$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
				$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
				$mailbody=str_ireplace("{{subject}}",$mailtitle,$mailbody);
				$mailbody=str_ireplace("{{body}}",$bodymessage,$mailbody);
				
				
				$mailer=new Mailer;
				$mailer->send_mail($email,$mailtitle,$mailbody);

				render_json('#/message');
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
