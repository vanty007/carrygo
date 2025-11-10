<?php 

/**
 * Component Model
 * @category  Model
 */
class ComponentsController extends BaseController{


	function addReview(){
		$db = $this->GetModel();

		$data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', file_get_contents('php://input'));
		$processed_data = json_decode($data, true);
		$rating = isset($processed_data['rating'])?$processed_data['rating']:null;
		$comment = isset($processed_data['comment'])?$processed_data['comment']:null;
		$bidid = isset($processed_data['bidid'])?$processed_data['bidid']:null;

		if(isset($rating) && isset($comment)&& isset($bidid)){

			$rec_id = $rec_id = $db->insert('carrygo_review',array("rating"=>$rating, "comment"=>$comment,"user_id"=>USER_ID,"bidid"=>$bidid));
			if($rec_id){
				$sqltext="SELECT sum(rating) as rating, count(*) as rating_count from carrygo_review where bidid='$bidid'";
				$arr=$db->rawQueryOne($sqltext);

				$rating = $arr['rating']/$arr['rating_count'];
				$db->where('id' , $bidid);
				$bool = $db->update('carrygo_bid',array('rating'=>$rating ));

			render_json('true');
				}
			else{
				render_json('false');
			}
		}
		else{
			render_json('false');
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

}
