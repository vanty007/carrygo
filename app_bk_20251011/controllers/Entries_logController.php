<?php 
/**
 * Entries_Log Page Controller
 * @category  Controller
 */
class Entries_LogController extends SecureController{
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
		$fields = array('tid', 	'session_id', 	'msisdn', 	'first_question', 	'first_answer', 	'second_question', 	'second_answer', 	'third_question', 	'third_answer', 	'entrie_date', 	'last_answer_date', 	'question_category', 	'entry_info', 	'entry_qualification', 	'status', 	'location');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('tid',"%$text%",'LIKE');
			$db->orWhere('session_id',"%$text%",'LIKE');
			$db->orWhere('msisdn',"%$text%",'LIKE');
			$db->orWhere('first_question',"%$text%",'LIKE');
			$db->orWhere('first_answer',"%$text%",'LIKE');
			$db->orWhere('second_question',"%$text%",'LIKE');
			$db->orWhere('second_answer',"%$text%",'LIKE');
			$db->orWhere('third_question',"%$text%",'LIKE');
			$db->orWhere('third_answer',"%$text%",'LIKE');
			$db->orWhere('entrie_date',"%$text%",'LIKE');
			$db->orWhere('last_answer_date',"%$text%",'LIKE');
			$db->orWhere('question_category',"%$text%",'LIKE');
			$db->orWhere('entry_info',"%$text%",'LIKE');
			$db->orWhere('entry_qualification',"%$text%",'LIKE');
			$db->orWhere('status',"%$text%",'LIKE');
			$db->orWhere('location',"%$text%",'LIKE');
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('tid', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('entries_log', $limit, $fields);
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
					$options = array('table' => 'entries_log', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'entries_log' , false );
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
		$fields = array( 'tid', 	'session_id', 	'msisdn', 	'first_question', 	'first_answer', 	'second_question', 	'second_answer', 	'third_question', 	'third_answer', 	'entrie_date', 	'last_answer_date', 	'question_category', 	'entry_info', 	'entry_qualification', 	'status', 	'location' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('tid' , $rec_id);
		}
		$record = $db->getOne( 'entries_log', $fields );
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
				'session_id' => 'required',
				'msisdn' => 'required',
				'first_question' => 'required|numeric',
				'first_answer' => 'required',
				'second_question' => 'required|numeric',
				'second_answer' => 'required',
				'third_question' => 'required|numeric',
				'third_answer' => 'required',
				'question_category' => 'required|numeric',
				'entry_info' => 'required',
				'entry_qualification' => 'required',
				'status' => 'required|numeric',
				'location' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('entries_log',$modeldata);
			if(!empty($rec_id)){
				render_json($rec_id);
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
			$db->where('tid' , $rec_id);
			$bool = $db->update('entries_log',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('tid','session_id','msisdn','first_question','first_answer','second_question','second_answer','third_question','third_answer','question_category','entry_info','entry_qualification','status','location');
			$db->where('tid' , $rec_id);
			$data = $db->getOne('entries_log',$fields);
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
			$db->where('tid' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'entries_log' );
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
