<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class MybidswonController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		//$modeldata=transform_request_data($_GET);
		//var_dump($modeldata);
		$db = $this->GetModel();
		$user = "0";
		$user_points = "0";
		

		if(!empty(get_session('user_bid'))){
			$user = get_session('user_bid')['msisdn'];		
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
			
		}
		else{
			render_error("Unauthorized" , 401);
		}
		/*$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.open_date,c1.status,SUM(c2.points) points,SUM(c3.points) bid_active_points,
		SUM(c4.total_points) bid_winner_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		LEFT JOIN carrygo_bid_winners AS c4 ON c1.id=c4.bidid
		where c1.status = 0 and c2.msisdn='$user'  GROUP BY c1.id ORDER BY c1.id DESC";*/

		$sql = "SELECT c1.id,c1.rating,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.open_date,c1.status,c2.total_points FROM 
		carrygo_bid_winners c2, carrygo_bid c1 where c1.id=c2.bidid and c2.msisdn='$user' ORDER BY c2.id DESC";
		
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query($sql, $limit );
		$records2 = array("user_points"=>$user_points, "user"=>$user);
		$data=new stdClass;
		$data->records = $records;
		$data->records2 = $records2;
		$data->record_count = count( $records );
		$data->total_records = count($db->query($sql));
		render_json( $data );
	}

	private function postbid($msisdn , $points,$bidid,$open_points,$open_date){
		$db = $this->GetModel();
		$db->where("msisdn", $msisdn);
		$user = $db->getOne('carrygo_active_points');
		
		if(!empty($user)){
			if($points>$user['points']){
				render_error("EXxhausted Points" , 400);
			}
			else{
			$new_points = $user['points'] - $points;
			$db->where('msisdn' , $msisdn);
			$db->update('carrygo_active_points' , array("points"=>$new_points));
			$db->insert('carrygo_points',array("msisdn"=>$msisdn,"description"=>"debit|Bidded with ".$points,"points"=>$points));
			//get bidded points
			$db->where("bidid", $bidid);
			$carrygo_bid_active = $db->getOne('carrygo_bid_active');
			if(!empty($carrygo_bid_active)){
			$db->insert('carrygo_bid_active',array("msisdn"=>$msisdn,"bidid"=>$bidid,"points"=>$points));
			$db->insert('carrygo_bid_entry',array("msisdn"=>$msisdn,"bidid"=>$bidid,"points"=>$points));
			}
			else{
			$db->insert('carrygo_bid_entry',array("msisdn"=>$msisdn,"bidid"=>$bidid,"points"=>$points));
			
			$carrygo_bid_entry =$db->rawQueryOne("SELECT sum(points) as points FROM carrygo_bid_entry where bidid='$bidid'");
			if(!empty($carrygo_bid_entry) && $carrygo_bid_entry['points']>=$open_points){
			$db->insert('carrygo_bid_active',array("msisdn"=>$msisdn,"bidid"=>$bidid,"points"=>$points));
			}
			}
			//echo "ok";
			render_json('');
			}
			}
			else{
				render_error("User does not have active points" , 400);
			}
	}

	function postbid_info(){
		if(is_post_request()){
			
			$form_collection=$_POST;
			$msisdn=trim($form_collection['msisdn']);
			$points=$form_collection['points'];
			$bidid=$form_collection['bidid'];
			$open_points=$form_collection['open_points'];
			$open_date=$form_collection['open_date'];
			
			$this->postbid($msisdn , $points,$bidid,$open_points,$open_date);
			
		}
		else{
			render_error("Invalid request");
		}
	}
}
