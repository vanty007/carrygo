<?php 
/**
 * Vet Page Controller
 * @category  Controller
 */
class VetController extends SecureController{
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
		$fields = array('id', 	'user_id', 	'name', 	'contactname', 	'contactphone', 	'address', 	'document', 	'dum1', 	'dum2', 	'referalname', 	'referalphoneno', 	'status', 	'created_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('user_id',"%$text%",'LIKE');
			$db->orWhere('name',"%$text%",'LIKE');
			$db->orWhere('contactname',"%$text%",'LIKE');
			$db->orWhere('contactphone',"%$text%",'LIKE');
			$db->orWhere('address',"%$text%",'LIKE');
			$db->orWhere('document',"%$text%",'LIKE');
			$db->orWhere('dum1',"%$text%",'LIKE');
			$db->orWhere('dum2',"%$text%",'LIKE');
			$db->orWhere('referalname',"%$text%",'LIKE');
			$db->orWhere('referalphoneno',"%$text%",'LIKE');
			$db->orWhere('status',"%$text%",'LIKE');
			$db->orWhere('created_at',"%$text%",'LIKE');
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('vet', $limit, $fields);
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
					$options = array('table' => 'vet', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'vet' , false );
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
		$record = $db->getOne( 'vet', $fields );
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
				'user_id' => 'required|numeric',
				'name' => 'required',
				'contactname' => 'required',
				'contactphone' => 'required',
				'address' => 'required',
				'document' => 'required',
				'dum1' => 'required',
				'dum2' => 'required',
				'referalname' => 'required',
				'referalphoneno' => 'required',
				'status' => 'required|numeric',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('vet',$modeldata);
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
			$db->where('id' , $rec_id);
			$bool = $db->update('vet',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','user_id','name','contactname','contactphone','address','document','dum1','dum2','referalname','referalphoneno','status');
			$db->where('id' , $rec_id);
			$data = $db->getOne('vet',$fields);
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
		$bool = $db->delete( 'vet' );
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
