<?php 

/**
 * Component Model
 * @category  Model
 */
class ComponentsController extends BaseController{
	
    function getFacilities($id){
		$db = $this->GetModel();

		$sqltext="SELECT type as value,property_id as id from propertyavailability where type like '%$id%' group by type";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr) ;
	}

    function getLocation($id){
		$db = $this->GetModel();

		$sqltext="SELECT landmark as value,id from propertylist where landmark like '%$id%' group by landmark";
		$arr=$db->rawQuery($sqltext);
		
		render_json($arr) ;
	}

    function approvePayment($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('propertyreservation',array('chargestatus'=> 2));
		
		render_json("#/bookings") ;
	}
    function acceptPaymentAdmin($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('payments',array('status'=> 1));

		$db->where('id' , $id);
		$record = $db->getOne( 'payments');

		$db->where('propertyavailability_id' , $record['propertyavai_id']);
		$db->update('propertyreservation',array('chargestatus'=>2));
		
		$sqltext = "SELECT a.id,a.email FROM auth a, payments p2
		where a.id=p2.user_id and p2.id=$id order by p2.id desc limit 1";

		$getuser = $db->rawQueryOne($sqltext);

		$email = $getuser['email'];
		$verify_link=SITE_ADDR."#payment";
		$mailtitle="Payment Notification";
		$sitename=SITE_NAME;
		$bodymessage = "Hello! Your booking payment has been approved.";
		
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$email,$mailbody);
		$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$mailtitle,$mailbody);
		$mailbody=str_ireplace("{{body}}",$bodymessage,$mailbody);
		
		
		$mailer=new Mailer;
		$mailer->send_mail($email,$mailtitle,$mailbody);
		
		render_json("#/payments") ;
	}
	function requestHandleProperty($id){
		$db = $this->GetModel();
		$modeldata=transform_request_data($_POST);
		
		$status = $modeldata['status'];

		$db->where('id' , $id);
		$bool = $db->update('owner',array('status'=> $status));

		$fields = array('user.firstname','user.lastname','owner.id','auth.email' );
		$db->join("user","user.auth_id = owner.user_id","INNER");
		$db->join("auth","auth.id = owner.user_id","INNER");
		$db->where('owner.id' , $id);
		$user = $db->getOne('owner',$fields);
		
		$email = $user['email'];
		$verify_link=SITE_ADDR."#owner/edit/".$id;
		$mailtitle="Property Owner Notification";
		$sitename=SITE_NAME;
		$bodymessage = "";

		if($status == 1){
		$bodymessage = "Your property owneship registration has been approved.";
		}
		else if($status == 2){
			$bodymessage = "Your property owneship registration has been restricted.";
		}
		else if($status == 0){
			$bodymessage = "Your property owneship registration has been rejected.";
		}
		else{
			$bodymessage = "Your property owneship registration is invalid.";
		}
		
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$email,$mailbody);
		$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$mailtitle,$mailbody);
		$mailbody=str_ireplace("{{body}}",$bodymessage,$mailbody);
		
		
		$mailer=new Mailer;
		$mailer->send_mail($email,$mailtitle,$mailbody);

		render_json("#/owner") ;
	}

	function approveBooking($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$bool = $db->update('propertyreservation',array('status'=> 1));
		
		render_json("#/bookings") ;
	}
	function addtoFavourite($id){
		$db = $this->GetModel();
		$g=get_session('user_data');
		if(empty($g)){
			render_error("Unauthorized" , 401);
		}
		else{
		$bool = $db->insert('myfavourite',array('user_id'=>USER_ID, 'property_id'=>$id, 'propertyavailbility_id'=>$id, ));
		
		render_json("#/propertysearch") ;
		}
	}

	function removetoFavourite($id){
		$db = $this->GetModel();
		$db->where('id' , $id);
		$bool = $db->delete( 'myfavourite' );
		render_json("#/propertysearch") ;
	}

	function makeReview(){
		$db = $this->GetModel();
		$data = file_get_contents('php://input');
		$processed_data = json_decode($data, true);
		
		$rate = (isset($processed_data['rate'])) ? $processed_data['rate'] : "";
		$idreview = (isset($processed_data['idreview'])) ? $processed_data['idreview'] : "";
		$property_id = (isset($processed_data['property_id'])) ? $processed_data['property_id'] : "";

		if(USER_ID==null){
			echo "LoginNo";
		}
		else{
		$db->insert('rating',array('rate'=>$rate,'review'=>$idreview,'propertylist_id'=>$property_id,'user_id'=>USER_ID));
		
		render_json("#/propertylist/view/".$property_id);
		}
		
	}

	function makeBooking(){
		$db = $this->GetModel();
		$data = file_get_contents('php://input');
		$processed_data = json_decode($data, true);
		
		$validdate = (isset($processed_data['validdate'])) ? $processed_data['validdate'] : "";
		$validdatestart = explode ("-", $validdate)[0];
		$validdateend = explode ("-", $validdate)[1];
		//$rooms = (isset($processed_data['rooms'])) ? $processed_data['rooms'] : "";
		$property_id = (isset($processed_data['property_id'])) ? $processed_data['property_id'] : "";
		$propertyavailability_id = (isset($processed_data['property_id'])) ? $processed_data['property_id'] : "";
		$price = (isset($processed_data['price'])) ? $processed_data['price'] : "";
		$rooms = (isset($processed_data['rooms'])) ? $processed_data['rooms'] : "";
		//$idtotalrooms = (isset($processed_data['idtotalrooms'])) ? $processed_data['idtotalrooms'] : "";

		if(USER_ID==null){
			echo "LoginNo";
		}
		else{
			$get_validdate = $db->rawQuery("SELECT property_id FROM propertyreservation WHERE property_id=$propertyavailability_id 
			and (validdatestart BETWEEN '$validdatestart' and '$validdateend') or 
			(validdateend BETWEEN '$validdatestart' and '$validdateend') or ('$validdatestart' >=validdatestart and '$validdateend'<=validdateend)");
			if(count($get_validdate)==1){
		$db->insert('propertyreservation',array('validdateend'=>explode ("-", $validdate)[1],'validdatestart'=>explode ("-", $validdate)[0],
		'property_id'=>$property_id,'propertyavailability_id'=>$propertyavailability_id,'price'=>$price,'rooms'=>$rooms,'user_id'=>USER_ID));

		$email = USER_EMAIL;
		$verify_link=SITE_ADDR."#myreservation";
		$mailtitle="New Booking";
		$sitename=SITE_NAME;
		$bodymessage = "You just made a booking, please proceed to make your payment";
		
		$mailbody=file_get_contents(PAGES_DIR . "index/emailpush_template.html");
		
		$mailbody=str_ireplace("{{username}}",$email,$mailbody);
		$mailbody=str_ireplace("{{link}}",$verify_link,$mailbody);
		$mailbody=str_ireplace("{{sitename}}",$sitename,$mailbody);
		$mailbody=str_ireplace("{{subject}}",$mailtitle,$mailbody);
		$mailbody=str_ireplace("{{body}}",$bodymessage,$mailbody);
		
		
		$mailer=new Mailer;
		$mailer->send_mail($email,$mailtitle,$mailbody);

			}
			else{
				echo "invaliddate - ".$get_validdate[0]['property_id']." ".$validdatestart." ".$validdateend;
			}
		//$db->where('id' , $property_id);
		//$bool = $db->update('propertyavailability',array('rooms'=> (int)$idtotalrooms - (int)$rooms));
		
		render_json("#/myreservation");
		}
		
	}
	function rejectBooking($id){
		$db = $this->GetModel();

		$db->where('id' , $id);
		$record = $db->getOne( 'propertyreservation');

		$db->where('id' , $id);
		$bool = $db->update('propertyreservation',array('status'=> 2));

		$db->where('id' , $record['propertyavailability_id']);
		$record2 = $db->getOne( 'propertyavailability');

		$db->where('id' , $record['propertyavailability_id']);
		$db->update('propertyavailability',array('rooms'=> (int)$record2['rooms']+1));
		
		render_json("#/bookings");
	}
}
