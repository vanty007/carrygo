<?php 
/**
 * Subscriptions Page Controller
 * @category  Controller
 */
class PropertyoccupancyController extends SecureController{
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
		$fields = array('propertyreservation.validdatestart','propertyreservation.validdateend','propertyreservation.rooms as frequency',
		'propertyreservation.chargestatus','propertyreservation.status', 'propertylist.id','propertylist.name','propertyavailability.type',
		'propertylist.landmark','propertyavailability.price','propertyavailability.service_charge','propertyavailability.rooms','propertyavailability.facilities',
		'propertyreservation.created_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(isset($this->facilities_property) && strlen($this->facilities_property)>1){
			$text=$this->facilities_property;
			$db->orWhere('propertylist.name',"%$text%",'LIKE');
			$db->orWhere('propertyavailability.facilities',"%$text%",'LIKE');
			$db->orWhere('propertylist.landmark',"%$text%",'LIKE');
			$db->orWhere('propertyavailability.price',"%$text%",'LIKE');
			//$db->orWhere('propertyreservation.chargestatus',"%($text==Payment Pending || $text==pending)?0:1 %",'LIKE');
			$db->orWhere('propertyreservation.chargestatus',"%$text%",'LIKE');
		}
		else if((isset($this->price_slider_min) && strlen($this->price_slider_min)>1) && (isset($this->price_slider_max) && strlen($this->price_slider_max)>1) ){
			//$db->orWhere('propertyfacility.cost',"%$text%",'LIKE');
			//$db->Where('propertylist.created_at',[$this->price_slider_min,$this->price_slider_max],'between');//->Where('propertylist.created_at',"$this->price_slider_max",'<=');
			$db->Where('propertyreservation.validdatestart',"$this->price_slider_min",'>=')->Where('propertyreservation.validdateend',"$this->price_slider_max",'<=');
		}
		else if(isset($this->where_property) && strlen($this->where_property)>1){
			$property_filter=$this->where_property;
			$array_property_filter = explode(",", $property_filter);
			for($i=0;$i<count($array_property_filter);$i++){
				$db->orWhere('propertylist.name', trim($array_property_filter[$i]));
			}	
		}
		$db->join("propertyavailability","propertyavailability.property_id = propertylist.id","INNER");
		$db->join("propertyreservation","propertyreservation.property_id = propertylist.id","INNER");
		if(ROLE_ID == "super"){

		}
		else{
			$db->Where('propertylist.user_id', USER_ID);
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('propertyreservation.id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('propertylist', $limit, $fields);
		$db->Where('user_id', USER_ID);
		$records_new = $db->get('propertylist');
		$data = new stdClass;
		$data->records = $records;
		$data->records_new = $records_new;
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
					$options = array('table' => 'subscriptions', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'subscriptions' , false );
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
		$fields = array( 'tid', 	'msisdn', 	'action', 	'subid', 	'pcode', 	'amount', 	'expirydate', 	'requestdate', 	'others', 	'others1', 	'others2', 	'status', 	'cptransid' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('tid' , $rec_id);
		}
		$record = $db->getOne( 'subscriptions', $fields );
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
				'msisdn' => 'required',
				'action' => 'required',
				'subid' => 'required',
				'pcode' => 'required',
				'amount' => 'required',
				'expirydate' => 'required',
				'requestdate' => 'required',
				'others' => 'required',
				'others1' => 'required',
				'others2' => 'required',
				'status' => 'required|numeric',
				'cptransid' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('subscriptions',$modeldata);
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
			$bool = $db->update('subscriptions',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('tid','msisdn','action','subid','pcode','amount','expirydate','requestdate','others','others1','others2','status','cptransid');
			$db->where('tid' , $rec_id);
			$data = $db->getOne('subscriptions',$fields);
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
		$bool = $db->delete( 'subscriptions' );
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
