<?php 
/**
 * Pickup_Request Page Controller
 * @category  Controller
 */
class Pickup_RequestController extends SecureController{
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
		$fields = array('id', 	'tracking_id', 	'pickup_userid', 	'receiver_userid', 	'receiver_name', 	'receiver_phoneno', 	'receiver_email', 	'driver_id', 	'pickup_address', 	'pickup_city', 	'pickup_state', 	'receiver_address', 	'receiver_city', 	'receiver_state', 	'picture', 	'pickup_code', 	'delivery_option_id', 	'totalamount', 	'created_at', 	'delivery_status', 	'pickup_status', 	'payment_status');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('tracking_id',"%$text%",'LIKE');
			$db->orWhere('pickup_userid',"%$text%",'LIKE');
			$db->orWhere('receiver_userid',"%$text%",'LIKE');
			$db->orWhere('receiver_name',"%$text%",'LIKE');
			$db->orWhere('receiver_phoneno',"%$text%",'LIKE');
			$db->orWhere('receiver_email',"%$text%",'LIKE');
			$db->orWhere('driver_id',"%$text%",'LIKE');
			$db->orWhere('pickup_address',"%$text%",'LIKE');
			$db->orWhere('pickup_city',"%$text%",'LIKE');
			$db->orWhere('pickup_state',"%$text%",'LIKE');
			$db->orWhere('receiver_address',"%$text%",'LIKE');
			$db->orWhere('receiver_city',"%$text%",'LIKE');
			$db->orWhere('receiver_state',"%$text%",'LIKE');
			$db->orWhere('picture',"%$text%",'LIKE');
			$db->orWhere('pickup_code',"%$text%",'LIKE');
			$db->orWhere('delivery_option_id',"%$text%",'LIKE');
			$db->orWhere('totalamount',"%$text%",'LIKE');
			$db->orWhere('created_at',"%$text%",'LIKE');
			$db->orWhere('delivery_status',"%$text%",'LIKE');
			$db->orWhere('pickup_status',"%$text%",'LIKE');
			$db->orWhere('payment_status',"%$text%",'LIKE');
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
		$records = $db->get('pickup_request', $limit, $fields);
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
					$options = array('table' => 'pickup_request', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'pickup_request' , false );
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
		$fields = array('pickup_request.reviewcomment,pickup_request.rate,pickup_request.notes,pickup_request.id ,pickup_request.item_name ,pickup_request.category ,pickup_request.tracking_id ,pickup_request.pickup_userid ,pickup_request.distance,
		pickup_request.receiver_userid ,pickup_request.receiver_name ,pickup_request.receiver_phoneno ,pickup_request.receiver_email ,pickup_request.driver_id ,
		pickup_request.pickup_address ,pickup_request.pickup_state ,pickup_request.pickup_city ,pickup_request.receiver_address ,pickup_request.receiver_city ,
		pickup_request.receiver_state ,pickup_request.picture ,pickup_request.pickup_code ,pickup_request.delivery_option_id ,pickup_request.totalamount ,
		pickup_request.created_at ,pickup_request.delivery_status ,pickup_request.pickup_status ,pickup_request.payment_status,user.email,user.phoneno
		,user.role_id,user.firstname,user.lastname,user.profile_pics,delivery_option.items, delivery_option.category as delivery_category, delivery_option.delivery_option,
		 delivery_option.pricing_per_km, delivery_option.pricing_higher_km, delivery_option.totalamount as delivery_amount');
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('pickup_request.id' , $rec_id);
		}
		$db->join("user","user.id = pickup_request.driver_id","LEFT");
		$db->join("delivery_option","delivery_option.id = pickup_request.delivery_option_id","LEFT");
		$record = $db->getOne( 'pickup_request', $fields );

		$fields1 = array('pickup_request.reviewcomment,pickup_request.rate,pickup_request.id ,pickup_request.item_name ,pickup_request.category ,pickup_request.tracking_id ,pickup_request.pickup_userid ,pickup_request.distance,
		pickup_request.receiver_userid ,pickup_request.receiver_name ,pickup_request.receiver_phoneno ,pickup_request.receiver_email ,pickup_request.driver_id ,
		pickup_request.pickup_address ,pickup_request.pickup_state ,pickup_request.pickup_city ,pickup_request.receiver_address ,pickup_request.receiver_city ,
		pickup_request.receiver_state ,pickup_request.picture ,pickup_request.pickup_code ,pickup_request.delivery_option_id ,pickup_request.totalamount ,
		pickup_request.created_at ,pickup_request.delivery_status ,pickup_request.pickup_status ,pickup_request.payment_status,user.email,user.phoneno
		,user.role_id,user.firstname,user.lastname,user.profile_pics,delivery_option.items, delivery_option.category as delivery_category, delivery_option.delivery_option,
		 delivery_option.pricing_per_km, delivery_option.pricing_higher_km, delivery_option.totalamount as delivery_amount');
		$db->join("user","user.id = pickup_request.driver_id","LEFT");
		$db->join("delivery_option","delivery_option.id = pickup_request.delivery_option_id","LEFT");
		if(ROLE_ID=="user"){
			$db->where('pickup_request.pickup_userid' , USER_ID);
		}
		else if(ROLE_ID=="driver"){
			$db->where('pickup_request.driver_id' , USER_ID);
		}
		$db->where('pickup_request.pickup_status' , 0)->orWhere('pickup_request.pickup_status' , 1);
		$db->orderBy('pickup_request.id', 'DESC');
		$records_recent = $db->get('pickup_request', 5 ,$fields1);

		if(!empty($record)){
		$data = new stdClass;
		$data->data = $record;
		$data->records = $records_recent;
		render_json($data);
		//render_json($record);
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
				'receiver_name' => 'required',
				'receiver_phoneno' => 'required',
				'receiver_email' => 'required|valid_email',
				//'pickup_address' => 'required',
				'pickup_city' => 'required',
				'pickup_state' => 'required',
				//'receiver_address' => 'required',
				'receiver_city' => 'required',
				'receiver_state' => 'required',
				'picture' => 'required',
				'delivery_option_id' => 'required|numeric',
				'totalamount' => 'required',
			);
			$modeldata['pickup_userid'] = USER_ID;
			$modeldata['tracking_id'] = 'TRA'.rand(10000,99999);
			$modeldata['pickup_code'] = rand(1000,9999);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('pickup_request',$modeldata);
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

		$data = file_get_contents('php://input');
		$processed_data = json_decode($data, true);
		
		$reviewmessage = (isset($processed_data['review'])) ? $processed_data['review'] : "";
		$selectedStars = (isset($processed_data['rate'])) ? $processed_data['rate'] : 0;

		$db->where('id' , $rec_id);
		$bool = $db->update('pickup_request',array("reviewcomment"=>$reviewmessage,"rate"=>$selectedStars));

		render_json('');
	
		/*if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$db->where('id' , $rec_id);
			$bool = $db->update('pickup_request',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','receiver_name','receiver_phoneno','receiver_email','pickup_address','pickup_city','pickup_state','receiver_address','receiver_city','receiver_state','picture','delivery_option_id','totalamount');
			$db->where('id' , $rec_id);
			$data = $db->getOne('pickup_request',$fields);
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
		}*/
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
		$bool = $db->delete( 'pickup_request' );
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
