<?php 
/**
 * Myreservation Page Controller
 * @category  Controller
 */
class DashboardController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$role_id = ROLE_ID;
		$user_id = USER_ID;
		$sql_messages = "SELECT count(*) as unread_messages from message where receiver=$user_id";
		$sql_total_owner = 0;
		$sql_pending_owner = 0;
		if(	$role_id == "administrator"){
		$sql_myfavourite = "SELECT count(*) as myfavourite from myfavourite p1, propertylist p2  where p1.property_id=p2.id and p2.user_id=$user_id";
		$sql_total_payments = "SELECT sum(amount) as total_payments from payments p, propertyreservation p1, propertylist p2 where p.reserve_id=p1.id and  
		 p1.property_id=p2.id and p2.user_id=$user_id";
		$sql_pending_payments = "SELECT count(*) as pending_payments from payments p, propertyreservation p1, propertylist p2 where p.reserve_id=p1.id and  
		p1.property_id=p2.id and p2.user_id=$user_id and p.status=0";
		$sql_total_booking = "SELECT count(*) as total_booking from propertyreservation p1, propertylist p2 where p1.property_id=p2.id and p2.user_id=$user_id";
		$sql_pending_booking = "SELECT count(*) as pending_booking from propertyreservation p1, propertylist p2 where p1.property_id=p2.id and p2.user_id=$user_id and p1.status=0";
		$sql_total_reviews = "SELECT count(*) as total_reviews,AVG(rate) as avg_rate from rating r,propertylist p2  where r.propertylist_id=p2.id and p2.user_id=$user_id";
		$sql_total_properties = "SELECT count(*) as total_properties from propertylist p, propertyavailability p2 where p.id=p2.property_id and p.user_id=$user_id";
		$sql_pending_payments_list = "SELECT u.title,u.lastname,u.firstname,p.* from payments p, user u,propertyreservation p1, propertylist p2
		 where p.reserve_id=p1.id and p1.property_id=p2.id and u.auth_id=p.user_id and p2.user_id=$user_id and p.status=0";
		//$sql_top_reviews = "SELECT * from rating where user_id=$user_id limit 7";
		$sql_top_reviews = "SELECT u.title,u.lastname,u.firstname, r.*, p.name from rating r, propertylist p, user u where r.propertylist_id = p.id and p.user_id=u.auth_id and p.user_id=$user_id  limit 7";
		}
		else if($role_id == "super"){
			$sql_myfavourite = "SELECT count(*) as myfavourite from myfavourite";
			$sql_total_owner = "SELECT count(*) as total_owner from owner";
			$sql_pending_owner = "SELECT count(*) as pending_owner from owner where status=0";
			$sql_total_payments = "SELECT sum(amount) as total_payments from payments";
			$sql_pending_payments = "SELECT count(*) as pending_payments from payments where status=0";
			$sql_total_booking = "SELECT count(*) as total_booking from propertyreservation";
			$sql_pending_booking = "SELECT count(*) as pending_booking from propertyreservation where status=0";
			$sql_total_reviews = "SELECT count(*) as total_reviews,AVG(rate) as avg_rate from rating";
			$sql_total_properties = "SELECT count(*) as total_properties from propertylist p, propertyavailability p2 where p.id=p2.property_id";
			$sql_pending_payments_list = "SELECT u.title,u.lastname,u.firstname,p.* from payments p, user u where u.auth_id=p.user_id and status=0";
			$sql_top_reviews = "SELECT u.title,u.lastname,u.firstname, r.*, p.name from rating r, propertylist p, user u where r.propertylist_id = p.id and p.user_id=u.auth_id limit 7";

			$sql_total_owner = $db->rawQueryOne( $sql_total_owner );
			$sql_pending_owner = $db->rawQueryOne( $sql_pending_owner );
		}
		$tc = 0;
		$sql_messages = $db->rawQueryOne( $sql_messages );
		$sql_myfavourite = $db->rawQueryOne( $sql_myfavourite );
		$sql_total_payments = $db->rawQueryOne( $sql_total_payments );
		$sql_pending_payments = $db->rawQueryOne( $sql_pending_payments );
		$sql_total_booking = $db->rawQueryOne( $sql_total_booking );
		$sql_pending_booking = $db->rawQueryOne( $sql_pending_booking );
		$sql_total_reviews = $db->rawQueryOne( $sql_total_reviews );
		$sql_total_properties = $db->rawQueryOne( $sql_total_properties );
		$sql_pending_payments_list = $db->rawQuery( $sql_pending_payments_list );
		$sql_top_reviews = $db->rawQuery( $sql_top_reviews );

		$data=new stdClass;

		$data->records = array('messages'=>$sql_messages,'myfavourite'=>$sql_myfavourite,'total_owner'=>$sql_total_owner,'pending_owner'=>$sql_pending_owner,
		'total_payments'=>$sql_total_payments,'total_booking'=>$sql_total_booking,'pending_booking'=>$sql_pending_booking,'total_reviews'=>$sql_total_reviews,
		'total_properties'=>$sql_total_properties,'pending_payments_list'=>$sql_pending_payments_list,'top_reviews'=>$sql_top_reviews);
		
		$data->record_count = 0;
		$data->total_records = 0;

		render_json( $data );
	}
}
