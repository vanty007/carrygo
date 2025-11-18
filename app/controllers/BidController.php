<?php

/**
 * Home Page Controller
 * @category  Controller
 */
class BidController extends SecureController
{
	/**
	 * Index Action
	 * @return View
	 */
	function index($fieldname = null, $fieldvalue = null)
	{
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
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = array("bid_info" => $db->query($sql, $limit), "user_points" => $user_points);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		//$this->view->render("#propertysearch" ,$data,"main_layout.php");
		render_json($data);
	}
	function view($rec_id = null, $value = null)
	{
		$db = $this->GetModel();

		$user = "0";
		$user_points = "0";
		$timer = "0";
		if (!empty(get_session('user_bid'))) {
			$user = get_session('user_bid')['msisdn'];
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
		} else {
			render_error("Unauthorized", 401);
		}

		$bid_entry_points = $db->rawQueryOne("SELECT SUM(points) bid_entry_points,msisdn FROM carrygo_bid_entry where bidid=$rec_id group by points,msisdn order by bid_entry_points desc limit 1");
		$bid_activepoints = $db->rawQueryOne("SELECT a.bidid, a.created_at,a.status,b.open_date FROM carrygo_bid_active a,carrygo_bid b  where b.id=a.bidid and a.bidid=$rec_id ");

		if ($bid_activepoints) {
			$id = $bid_activepoints['bidid'];

			$dayinpass = strtotime($bid_activepoints['created_at']);
			//$today = time();
			$today = strtotime("Y-m-d H:i:s");
			$timer = $bid_activepoints['open_date'] - floor(abs($today - $dayinpass) / 60 / 60);
			//$timer = (5-(round(abs($today-$dayinpass)/60)));

			if ($timer <= 0 && $bid_activepoints['status'] == 0) {

				$db->insert('carrygo_bid_winners', array("msisdn" => $bid_entry_points['msisdn'], "bidid" => $id, "total_points" => $bid_entry_points['bid_entry_points']));

				$db->where('id', $id);
				$db->update('carrygo_bid', array("status" => 2));

				$bid_entry_points1 = $db->rawQueryOne("SELECT SUM(points) bid_entry_points FROM carrygo_bid_entry where bidid=$rec_id ");
				$db->where('bidid', $id);
				$db->update('carrygo_bid_active', array("points" => $bid_entry_points1['bid_entry_points'], "status" => 1));
				//$timer = 499;

			}
		}

		$sql = "SELECT c1.id,c1.name,c1.open_date,c1.image,c1.url,c1.price,c1.open_points,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points,
		SUM(c4.total_points) bid_winner_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		LEFT JOIN carrygo_bid_winners AS c4 ON c1.id=c4.bidid
		where c1.id='$rec_id' GROUP BY c1.id ORDER BY c1.id DESC";
		$records = $db->rawQuery($sql);

		$arr_story = array();
		for ($i = 0; $i < count($records); $i++) {

			$db->where('bidid', $records[$i]['id']);
			$records_review = $db->get('carrygo_review');

			array_push($arr_story, array("records" => $records[$i], "reviews" => $records_review));
		}

		if ($records) {
			$limit = $this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
			$tc = $db->withTotalCount();
			$records2 = array("user_points" => $user_points, "user" => $user, "timer" => $timer);
			$data = new stdClass;
			$data->records = $arr_story;
			$data->records2 = $records2;
			$data->record_count = count($records);
			$data->total_records = 1;
			//$this->view->render("#propertysearch" ,$data,"main_layout.php");
			render_json($data);
			/*$data = [
            "id" => $record['id'],
            "name" => $record['name'],
			"image" => $record['image'],
			"url" => $record['url'],
			"price" => $record['price'],
			"open_points" => $record['open_points'],
			"status" => $record['status'],
			"bid_entry_points" => $record['bid_entry_points'],
			"bid_active_points" => $record['bid_active_points'],
			"open_date" => $record['open_date'],
			"bid_winner_points" => $record['bid_winner_points'],
			"user_points" => $user_points,
			"user" => $user,
        ];

        	//$encodedData = json_encode($data);
			render_json($data);*/
		} else {
			if ($db->getLastError()) {
				render_error($db->getLastError());
			} else {
				render_error("Record not found", 404);
			}
		}
	}
}
