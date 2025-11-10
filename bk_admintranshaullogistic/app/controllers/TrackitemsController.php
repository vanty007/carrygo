<?php 
/**
 * Trackitems Page Controller
 * @category  Controller
 */
class TrackitemsController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$fields = array('pickup_request.id', 	'pickup_request.item_name', 	'pickup_request.category', 	'pickup_request.tracking_id', 	'pickup_request.receiver_name', 	'pickup_request.pickup_name', 	'pickup_request.pickup_phoneno', 'pickup_request.driver_id', 	'pickup_request.pickup_email', 	'pickup_request.receiver_phoneno', 	'pickup_request.receiver_email', 	'pickup_request.pickup_address', 	'pickup_request.pickup_city', 	'pickup_request.pickup_state', 	'pickup_request.receiver_address', 	'pickup_request.receiver_city', 	'pickup_request.receiver_state', 	'pickup_request.distance', 	'pickup_request.picture', 	'pickup_request.pickup_code', 	'pickup_request.delivery_option_id', 	'pickup_request.totalamount', 	'pickup_request.created_at', 	'pickup_request.delivery_status', 	'pickup_request.pickup_status', 	'pickup_request.payment_status', 	'pickup_request.reviewcomment', 	'pickup_request.rate', 	'delivery_option.category AS delivery_option_category', 	'delivery_option.pricing_per_km', 	'delivery_option.pricing_higher_km', 	'delivery_option.totalamount AS delivery_option_totalamount', 	'user.email', 	'user.phoneno', 	'user.firstname', 	'user.lastname');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('pickup_request.id',"%$text%",'LIKE');
			$db->orWhere('pickup_request.item_name',"%$text%",'LIKE');
			$db->orWhere('pickup_request.category',"%$text%",'LIKE');
			$db->orWhere('pickup_request.tracking_id',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_name',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_name',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_phoneno',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_email',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_phoneno',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_email',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_address',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_city',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_state',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_address',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_city',"%$text%",'LIKE');
			$db->orWhere('pickup_request.receiver_state',"%$text%",'LIKE');
			$db->orWhere('pickup_request.distance',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_code',"%$text%",'LIKE');
			$db->orWhere('pickup_request.totalamount',"%$text%",'LIKE');
			$db->orWhere('pickup_request.created_at',"%$text%",'LIKE');
			$db->orWhere('pickup_request.delivery_status',"%$text%",'LIKE');
			$db->orWhere('pickup_request.pickup_status',"%$text%",'LIKE');
			$db->orWhere('pickup_request.payment_status',"%$text%",'LIKE');
			$db->orWhere('pickup_request.reviewcomment',"%$text%",'LIKE');
			$db->orWhere('pickup_request.rate',"%$text%",'LIKE');
			$db->orWhere('delivery_option.delivery_option',"%$text%",'LIKE');
			$db->orWhere('user.email',"%$text%",'LIKE');
			$db->orWhere('user.phoneno',"%$text%",'LIKE');
			$db->orWhere('user.firstname',"%$text%",'LIKE');
			$db->orWhere('user.lastname',"%$text%",'LIKE');
		}
		$db->join("delivery_option","pickup_request.delivery_option_id = delivery_option.id","LEFT");
		$db->join("user","pickup_request.pickup_userid = user.id","LEFT");
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
}
