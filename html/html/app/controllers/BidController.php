<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class BidController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		//$modeldata=transform_request_data($_GET);
		//var_dump($modeldata);
		$db = $this->GetModel();
		//$user = null;
		$user_points = "0";
		$user = "234700";

		/*if($fieldvalue!=null){
			$fieldvalue = preg_replace('/^(0)/', "234", trim($fieldvalue));
			//session_destroy();
			//clear_cookie("login_session_key");
			set_session('user_data',$fieldvalue);
			$user=$fieldvalue;
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
			
		}
		else if(!empty(get_session('user_data'))){
			$user = get_session('user_data');	
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
			
		}
		else{
			//render_error("Unauthorized" , 401);
			$user = "234700";
		}*/
		$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points,
		SUM(c4.total_points) bid_winner_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		LEFT JOIN carrygo_bid_winners AS c4 ON c1.id=c4.bidid
		where c1.status = 0 GROUP BY c1.id ORDER BY c1.id DESC";

		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = array("bid_info"=>$db->query($sql, $limit ), "user_points"=>$user_points);
		$data=new stdClass;
		$data->records = $records;
		$data->record_count = count( $records );
		$data->total_records = intval( $tc->totalCount );
		//$this->view->render("#propertysearch" ,$data,"main_layout.php");
		render_json( $data );
	}
}
