<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$driver_status = 1;
		$fields = array('pickup_request.reviewcomment,pickup_request.rate,pickup_request.id ,pickup_request.item_name ,pickup_request.category ,pickup_request.tracking_id ,pickup_request.pickup_userid ,pickup_request.distance,
		pickup_request.receiver_userid ,pickup_request.receiver_name ,pickup_request.receiver_phoneno ,pickup_request.receiver_email ,pickup_request.driver_id ,
		pickup_request.pickup_address ,pickup_request.pickup_state ,pickup_request.pickup_city ,pickup_request.receiver_address ,pickup_request.receiver_city ,
		pickup_request.receiver_state ,pickup_request.picture ,pickup_request.pickup_code ,pickup_request.delivery_option_id ,pickup_request.totalamount ,
		pickup_request.created_at ,pickup_request.delivery_status ,pickup_request.pickup_status ,pickup_request.payment_status,user.email,user.phoneno
		,user.role_id,user.firstname,user.lastname,user.profile_pics,delivery_option.items, delivery_option.category as delivery_category, delivery_option.delivery_option,
		 delivery_option.pricing_per_km, delivery_option.pricing_higher_km, delivery_option.totalamount as delivery_amount');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('pickup_request.pickup_address',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_city',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_state',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_address',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_city',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_state',"%$text%",'LIKE');
		}
		$db->join("user","user.id = pickup_request.driver_id","LEFT");
		$db->join("delivery_option","delivery_option.id = pickup_request.delivery_option_id","LEFT");
		if(ROLE_ID=="user"){
			$db->where('pickup_request.pickup_userid' , USER_ID);
			}
			else if(ROLE_ID=="driver"){
				$db->where('pickup_request.driver_id' , USER_ID);
				}
		$db->where('pickup_status' , 0)->orWhere('pickup_status' , 1);
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('pickup_request.id', 'DESC');
		}

		//page filter command
		$tc = $db->withTotalCount();
		$arr_story = array();
		$records = $db->get('pickup_request', $limit,$fields);
		for($i=0;$i<count($records);$i++){

			$db->where('request_id' , $records[$i]['id']);
			$records_payments = $db->getOne('payments');

			array_push($arr_story,array("records"=>$records[$i], "payments"=>$records_payments));
			}


		$db->where('rider_id' , USER_ID);
		$user_driver = $db->getOne('riders_availability');
		if($user_driver){
			$driver_status = $user_driver['status'];
		}
		$data = new stdClass;
		$data->records = $arr_story;
		$data->driver_status = $driver_status;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
}
