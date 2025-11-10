<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class WinnersbidController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		//$modeldata=transform_request_data($_GET);
		//var_dump($modeldata);
		$db = $this->GetModel();
		$user = null;
		$user_points = "0";

		if(!empty(get_session('user_bid'))){
			$user = get_session('user_bid')['msisdn'];		
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
			
		}
		else{
			render_error("Unauthorized" , 401);
		}
		
		$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.open_date,c1.status,SUM(c2.points) bid_entry_points, 
		c4.total_points as bid_winner_points,c4.msisdn,c4.id 
		FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid 
		RIGHT JOIN carrygo_bid_winners AS c4 ON c1.id=c4.bidid 
		where c1.status = 2 GROUP BY c1.id,c4.total_points,c4.msisdn,c4.id ORDER BY c4.id DESC";	
		
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

}
