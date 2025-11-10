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
		$fields = array('propertylist.id', 	'propertylist.propertytype_id', 'propertygallery.thumbnail',	'propertylist.name', 	'propertylist.chargetype_id', 	'propertylist.rating_id', 	'propertylist.address', 	'propertylist.location_id', 	'propertylist.landmark', 	'propertylist.longitude', 	'propertylist.latitude', 	'propertylist.status', 	'propertylist.created_at', 	'propertygallery.pictures', 	'propertygallery.description', 	'chargetype.frequency', 	'chargetype.rate', 	'chargetype.price', 	'chargetype.discount', 	'propertylocations.location_name', 	'propertylocations.area', 	'propertylocations.city', 	'propertylocations.state', 	'propertylocations.country', 	'propertytype.name AS propertytype_name', 	'propertytype.type', 	'rating.user_id AS rating_user_id', 	'rating.rate AS rating_rate', 	'rating.review', 	'auth.id AS auth_id', 	'auth.profile_pics', 	'propertylist.contactphone', 	'propertylist.contactemail', 	'propertylist.contactname', 	'propertylist.checkin', 	'propertylist.checkout', 	'propertylist.cancellation', 	'propertylist.pets', 	'propertylist.views');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('propertylist.address',"%$text%",'LIKE');
			$db->orWhere('propertylist.landmark',"%$text%",'LIKE');
			$db->orWhere('propertylist.longitude',"%$text%",'LIKE');
			$db->orWhere('propertylist.latitude',"%$text%",'LIKE');
			$db->orWhere('propertylist.status',"%$text%",'LIKE');
			$db->orWhere('propertylist.created_at',"%$text%",'LIKE');
			$db->orWhere('propertygallery.description',"%$text%",'LIKE');
			$db->orWhere('chargetype.frequency',"%$text%",'LIKE');
			$db->orWhere('chargetype.rate',"%$text%",'LIKE');
			$db->orWhere('chargetype.price',"%$text%",'LIKE');
			$db->orWhere('propertylocations.location_name',"%$text%",'LIKE');
			$db->orWhere('propertylocations.area',"%$text%",'LIKE');
			$db->orWhere('propertylocations.city',"%$text%",'LIKE');
			$db->orWhere('propertylocations.state',"%$text%",'LIKE');
			$db->orWhere('propertylocations.country',"%$text%",'LIKE');
			$db->orWhere('propertytype.type',"%$text%",'LIKE');
			$db->orWhere('rating.review',"%$text%",'LIKE');
			$db->orWhere('propertylist.contactphone',"%$text%",'LIKE');
			$db->orWhere('propertylist.contactemail',"%$text%",'LIKE');
			$db->orWhere('propertylist.contactname',"%$text%",'LIKE');
			$db->orWhere('propertylist.checkin',"%$text%",'LIKE');
			$db->orWhere('propertylist.checkout',"%$text%",'LIKE');
			$db->orWhere('propertylist.cancellation',"%$text%",'LIKE');
			$db->orWhere('propertylist.pets',"%$text%",'LIKE');
			$db->orWhere('propertylist.views',"%$text%",'LIKE');
		}
		$db->join("propertygallery","propertylist.id = propertygallery.property_id","INNER");
		$db->join("chargetype","propertylist.chargetype_id = chargetype.id","INNER");
		$db->join("propertylocations","propertylist.location_id = propertylocations.id","INNER");
		$db->join("propertytype","propertylist.propertytype_id = propertytype.id","INNER");
		$db->join("rating","propertylist.rating_id = rating.id","LEFT");
		$db->join("auth","propertylist.user_id = auth.id","INNER");
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
		$records = $db->get('propertylist', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
}
