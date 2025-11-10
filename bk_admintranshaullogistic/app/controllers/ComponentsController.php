<?php 

/**
 * Component Model
 * @category  Model
 */
class ComponentsController extends BaseController{
	
	/**
     * pickup_request_delivery_option_id_option_list Model Action
     * @return array
     */
	function pickup_request_driver_id_option_list(){
		$db = $this->GetModel();
		$sqltext="SELECT u.id as value, u.lastname as label FROM riders_availability AS ra JOIN user AS u ON ra.rider_id=u.id WHERE  (u.role_id  ='driver' ) AND (ra.status  =1 )";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr);
	}

	function rejectPickup($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('pickup_request',array('driver_id'=> NULL));

		$db->insert('request_logs',array("request_id"=>$id, "user_id"=>USER_ID, "details"=>"rejected pickup","status"=>0));

		//$db->where('id' , $record['propertyavailability_id']);
		//$db->update('propertyavailability',array('rooms'=> (int)$record2['rooms']+1));
		
		render_json("#/bookings");
	}

	function acceptPickup($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('pickup_request',array('pickup_status'=> 1));

		$db->insert('request_logs',array("request_id"=>$id, "user_id"=>USER_ID, "details"=>"accepted pickup","status"=>1));

		$mailtitle="Pick Up on the Way";
		$body="Dear customer, a rider is on it's way to pick up your item";
		
		$sitename=SITE_NAME;

		
		$get_userprofile = $db->rawQueryOne("SELECT p.id, p.pickup_userid, u.firstname, u.lastname, u.email FROM pickup_request p 
		JOIN user u ON p.pickup_userid = u.id WHERE p.id = $id");
		if($get_userprofile){

		$email=$get_userprofile['email'];
		$subject = "Pick Accepted!!";
		
		//Password reset html template
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$get_userprofile['lastname'],$mailbody);
		$mailbody=str_ireplace("{{body}}",$body,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$subject,$mailbody);
		
		
		$mailer=new Mailer;
		if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
		}
		else{
		}
	}
		
		render_json("#/bookings");
	}

	function startPickup($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('pickup_request',array('pickup_status'=> 2));

		$db->insert('request_logs',array("request_id"=>$id, "user_id"=>USER_ID, "details"=>"started pickup","status"=>2));

		$mailtitle="Rider has started delivery";
		$body="Dear customer, the rider has started the delivery of your item";
		
		$sitename=SITE_NAME;

		
		$get_userprofile = $db->rawQueryOne("SELECT p.id, p.pickup_userid, u.firstname, u.lastname, u.email FROM pickup_request p 
		JOIN user u ON p.pickup_userid = u.id WHERE p.id = $id");
		if($get_userprofile){

		$email=$get_userprofile['email'];
		$subject = "Delivery Started!!";
		
		//Password reset html template
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$get_userprofile['lastname'],$mailbody);
		$mailbody=str_ireplace("{{body}}",$body,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$subject,$mailbody);
		
		
		$mailer=new Mailer;
		if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
		}
		else{
		}
	}
		
		render_json("#/bookings");
	}
	function endPickup($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('pickup_request',array('pickup_status'=> 3));

		$db->insert('request_logs',array("request_id"=>$id, "user_id"=>USER_ID, "details"=>"end pickup","status"=>3));

		$mailtitle="Rider has ended delivery";
		$body="Dear customer, the rider has completed the delivery of your item";
		
		$sitename=SITE_NAME;

		
		$get_userprofile = $db->rawQueryOne("SELECT p.id, p.pickup_userid, u.firstname, u.lastname, u.email FROM pickup_request p 
		JOIN user u ON p.pickup_userid = u.id WHERE p.id = $id");
		if($get_userprofile){

		$email=$get_userprofile['email'];
		$subject = "Delivery Completed!!";
		
		//Password reset html template
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$get_userprofile['lastname'],$mailbody);
		$mailbody=str_ireplace("{{body}}",$body,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$subject,$mailbody);
		
		
		$mailer=new Mailer;
		if($mailer->send_mail($email,$mailtitle,$mailbody) == true){
		}
		else{
		}
	}
		
		render_json("#/bookings");
	}
	function confirmPayment($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('pickup_request',array('payment_status'=> 1));

		//$db->insert('request_logs',array("request_id"=>$id, "user_id"=>USER_ID, "details"=>"accepted pickup","status"=>1));

		//$db->where('id' , $record['propertyavailability_id']);
		//$db->update('propertyavailability',array('rooms'=> (int)$record2['rooms']+1));
		
		render_json("#/bookings");
	}
		function driverStatus($id){
			$db = $this->GetModel();
	
			$db->where('rider_id' , USER_ID);
			$get_driver_status = $db->getOne('riders_availability');

			if($get_driver_status){
			$db->update('riders_availability',array('status'=> $id));
			}
		else{
			$db->insert('riders_availability',array("status"=>$id, "rider_id"=>USER_ID));
		}
			render_json("#/bookings");
	}
	function cancelPickup($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->delete( 'pickup_request' );
		
		render_json("#/bookings");
	}
	
}
