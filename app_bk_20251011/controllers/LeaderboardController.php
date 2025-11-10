<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class LeaderboardController extends SecureController{
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
		
		$sql = "SELECT c1.id, c1.name, c1.image, c1.url, c1.price, c1.open_points, c1.open_date, c1.status, t.max_points AS bid_entry_points, 
		t.msisdn FROM carrygo_bid AS c1 JOIN (SELECT c2.bidid, c2.msisdn, SUM(c2.points) AS max_points FROM carrygo_bid_entry AS c2
		 GROUP BY c2.bidid, c2.msisdn ) AS t ON c1.id = t.bidid JOIN 
		 (SELECT bidid, MAX(total_points) AS max_points FROM 
		 (SELECT bidid, msisdn, SUM(points) AS total_points FROM carrygo_bid_entry GROUP BY bidid, msisdn) AS x 
		 GROUP BY bidid ) AS m ON m.bidid = t.bidid AND m.max_points = t.max_points WHERE c1.status = 0 ORDER BY bid_entry_points DESC";	
		
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
