<?php 
/**
 * Propertysearch Page Controller
 * @category  Controller
 */
class MyfavouriteController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$sqltext = "";
		$user_id=USER_ID;
		if(!strlen($this->what_property)==1 && !strlen($this->where_property)==1){
			$what_property=$this->what_property;
			$where_property=$this->where_property;

			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p3.id as f_id,p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			INNER JOIN myfavourite AS p3 ON p.id=p3.property_id 
			where p3.user_id=$user_id and p.status=0 and p2.status=0 and p.landmark like '%$where_property%' and p2.type like '%$what_property%'";
		}

		else if(strlen($this->what_property)==1 && !strlen($this->where_property)==1){
			$where_property=$this->where_property;

			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p3.id as f_id,p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			INNER JOIN myfavourite AS p3 ON p.id=p3.property_id 
			where p3.user_id=$user_id and p.status=0 and p2.status=0 and p.landmark like '%$where_property%'";
		}
		else if(!strlen($this->what_property)==1 && strlen($this->where_property)==1){
			$what_property=$this->what_property;

			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p3.id as f_id,p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			INNER JOIN myfavourite AS p3 ON p.id=p3.property_id 
			where p3.user_id=$user_id and p.status=0 and p2.status=0 and p2.type like '%$what_property%'";
		}
		else{
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p3.id as f_id,p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			INNER JOIN myfavourite AS p3 ON p.id=p3.property_id 
			where p3.user_id=$user_id and p.status=0 and p2.status=0";
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('p.id', ORDER_TYPE);
		}
		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query( $sqltext, $limit );
		$data=new stdClass;
		$data->records = $records;
		$data->record_count = count( $records );
		$data->total_records = intval( $tc->totalCount );
		render_json( $data );
	}
}
