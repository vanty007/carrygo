<?php 
/**
 * Riders_Availability Page Controller
 * @category  Controller
 */
class Riders_AvailabilityController extends SecureController{
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
		$fields = array('riders_availability.id', 	'riders_availability.location', 	'riders_availability.status', 	'user.driver_status', 'user.email', 	'user.phoneno', 	'user.firstname', 	'user.lastname');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('riders_availability.location',"%$text%",'LIKE');
			$db->orWhere('riders_availability.status',"%$text%",'LIKE');
			$db->orWhere('user.email',"%$text%",'LIKE');
			$db->orWhere('user.phoneno',"%$text%",'LIKE');
			$db->orWhere('user.firstname',"%$text%",'LIKE');
			$db->orWhere('user.lastname',"%$text%",'LIKE');
		}
		$db->join("user","riders_availability.rider_id = user.id","INNER");
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
		$records = $db->get('riders_availability', $limit, $fields);
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
					$options = array('table' => 'riders_availability', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'riders_availability' , false );
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
		$fields = array( 'riders_availability.id', 	'riders_availability.rider_id', 	'riders_availability.location', 	'riders_availability.status', 	'user.id AS user_id', 	'user.email', 	'user.phoneno', 	'user.password', 	'user.role_id', 	'user.firstname', 	'user.lastname', 	'user.title', 	'user.sex', 	'user.profile_pics', 	'user.created_at' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('riders_availability.id' , $rec_id);
		}
		$db->join("user","riders_availability.rider_id = user.id","INNER ");  
		$record = $db->getOne( 'riders_availability', $fields );
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
				'rider_id' => 'required|numeric',
				'location' => 'required',
				'status' => 'required|numeric',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('riders_availability',$modeldata);
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
			$driver_status = $modeldata['driver_status'];
			$rider_id = $modeldata['rider_id'];

			unset($modeldata['driver_status']);
			$db->where('id' , $rec_id);
			$bool = $db->update('riders_availability',$modeldata);

			$db->where('id' , $rider_id);
			$bool = $db->update('user',array('driver_status'=>$driver_status));

			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields = array('riders_availability.id','riders_availability.rider_id','riders_availability.location','riders_availability.status', 'user.driver_status');
			$db->where('riders_availability.id' , $rec_id);
			$db->join("user","riders_availability.rider_id = user.id","INNER");
			$data = $db->getOne('riders_availability',$fields);
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
		$bool = $db->delete( 'riders_availability' );
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
