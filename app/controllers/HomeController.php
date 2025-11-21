<?php

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController
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
		$user = null;
		$user_points = "0";
		$strQuery = "";

		//$user = "234700";

		if ($fieldvalue != null) {
			$fieldvalue = preg_replace('/^(0)/', "234", trim($fieldvalue));
			//session_destroy();
			//clear_cookie("login_session_key");
			$db->where("msisdn", $fieldvalue);
			$user_session = $db->getOne('carrygo_active_points');
			set_session('user_bid', $user_session);
			$user = $fieldvalue;
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
		} else if (!empty(get_session('user_bid'))) {
			$user = get_session('user_bid')['msisdn'];
			$user_points = $db->rawQueryOne("SELECT points FROM carrygo_active_points where msisdn='$user' order by id desc limit 1");
			$user_points = $user_points['points'];
		} else {
			//render_error("Unauthorized" , 401);
			$user = "234700";
		}

		if (strlen($this->what_property) > 1) {
			$strQuery = $this->what_property;
			$strQuery = "category ='$strQuery'";

			if ($this->what_property == "all") {
				$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.rating,c1.open_date,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		where c1.status = 0 GROUP BY c1.id ORDER BY c1.id DESC";
			} else {
				$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.open_points,c1.rating,c1.open_date,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		where c1.status = 0 and $strQuery GROUP BY c1.id ORDER BY c1.id DESC";
			}
		}
		//else if(strlen($this->where_property)>1 ){
		else if (isset($this->where_property)) {
			$strQuery = $this->where_property;
			//$strQuery="category ='$strQuery'";
			$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.rating,c1.open_points,c1.open_date,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		where c1.status = 0 and (c1.name like '%$strQuery%' or c1.price like '%$strQuery%' or c1.open_points like '%$strQuery%') GROUP BY c1.id ORDER BY c1.id DESC";
		} else {
			$sql = "SELECT c1.id,c1.name,c1.image,c1.url,c1.price,c1.rating,c1.open_points,c1.open_date,c1.status,SUM(c2.points) bid_entry_points,SUM(c3.points) bid_active_points
		 FROM carrygo_bid as c1 
		LEFT JOIN carrygo_bid_entry AS c2 ON c1.id=c2.bidid
		LEFT JOIN carrygo_bid_active AS c3 ON c1.id=c3.bidid
		where c1.status = 0 GROUP BY c1.id ORDER BY c1.id DESC";
		}

		$sql_winner = "SELECT c1.id,c1.name,c1.image,c1.url,c1.rating,c1.price,c1.open_points,c1.open_date,c1.status, c4.total_points as bid_winner_points,c4.created_at,c4.msisdn,c4.id w_id 
		FROM carrygo_bid as c1 
		RIGHT JOIN carrygo_bid_winners AS c4 ON c1.id=c4.bidid 
		where c1.status = 2 GROUP BY c1.id,c4.total_points,c4.msisdn,c4.id ORDER BY c4.id DESC";

		$limit = $this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query($sql, $limit);
		$records2 = array("user_points" => $user_points, "user" => $user);
		$data = new stdClass;
		$data->records = $records;
		$data->records2 = $records2;
		$data->records3 = $db->rawQuery($sql_winner);
		$data->record_count = count($records);
		$data->total_records = count($db->get('carrygo_bid'));
		//$this->view->render("#propertysearch" ,$data,"main_layout.php");
		render_json($data);
	}

	private function postbid($msisdn, $points, $bidid, $open_points, $open_date)
	{
		$db = $this->GetModel();
		$hours = "";
		$active_bid_timer = "";
		$db->where("msisdn", $msisdn);
		$user = $db->getOne('carrygo_active_points');

		if ($points <= 0) {
			render_error("You cannot bid with 0 points", 400);
		} else {
			if (!empty($user)) {
				//KNOW WEATHER USER DOES NOT HAVE ENOUGH POINTS
				if ($points > $user['points']) {
					render_error("EXxhausted Points", 400);
				} else {
					//UPDATE USER POINTS AND ADD POINTS ENTRY FOR AUDIT
					$new_points = $user['points'] - $points;
					$db->where('msisdn', $msisdn);
					$db->update('carrygo_active_points', array("points" => $new_points));
					$db->insert('carrygo_points', array("msisdn" => $msisdn, "description" => "debit|Bidded with " . $points, "points" => $points));

					//KNOW IF THE BBID IS ACTIVATED
					$db->where("bidid", $bidid)->orderBy('id', 'DESC');;
					$carrygo_bid_active = $db->getOne('carrygo_bid_active');
					//BID IS ACTIVE, INSERT ENTRY AND UPDATE ACTIVE BID
					if ($carrygo_bid_active) {
						$update_active_bidpoints = $carrygo_bid_active['points'] + $points;
						//Determine if the bid is declared winner

						$dayinpass = strtotime($carrygo_bid_active['created_at']);
						//$today = time();
						$today = strtotime(date('Y-m-d H:i:s'));

						/*$active_bid_timer = abs(date("Y-m-d h:i:s") - $carrygo_bid_active['created_at']);
			$hours = floor(($active_bid_timer % 86400) / 3600);*/
						$active_bid_timer = (floor(abs($today - $dayinpass) / 60 / 60));

						//if((round(abs($today-$dayinpass)/60/60)-1)>=$open_date && $carrygo_bid_active['status']==0){
						if ((round(abs($today - $dayinpass) / 60 / 60)) >= $open_date && $carrygo_bid_active['status'] == 0) {
							//echo 60-round(abs($today-$dayinpass)/60);
							$db->insert('carrygo_bid_winners', array("msisdn" => $msisdn, "bidid" => $bidid, "total_points" => $update_active_bidpoints));
							$db->where('id', $bidid);
							$db->update('carrygo_bid', array("status" => 2));
							//update active bid
							$db->where('bidid', $bidid);
							$db->update('carrygo_bid_active', array("points" => $update_active_bidpoints, "status" => 1));
						} else {
							$db->where('bidid', $bidid);
							$db->update('carrygo_bid_active', array("points" => $update_active_bidpoints));
						}

						$db->insert('carrygo_bid_entry', array("msisdn" => $msisdn, "bidid" => $bidid, "points" => $points));
					} else {
						$db->insert('carrygo_bid_entry', array("msisdn" => $msisdn, "bidid" => $bidid, "points" => $points));

						$carrygo_bid_entry = $db->rawQueryOne("SELECT sum(points) as points FROM carrygo_bid_entry where bidid='$bidid'");
						if (!empty($carrygo_bid_entry) && $carrygo_bid_entry['points'] >= $open_points) {
							$db->insert('carrygo_bid_active', array("msisdn" => $msisdn, "bidid" => $bidid, "points" => $carrygo_bid_entry['points']));
						}
					}
					$db->where("msisdn", $msisdn);
					$user_session = $db->getOne('carrygo_active_points');
					set_session('user_bid', $user_session);

					render_json('msisdn: ' . $msisdn . ' points: ' . $points . ' bidid: ' . $bidid . ' open_points: ' . $open_points . ' open_date: ' . $open_date . ' hours: ' . $hours . ' active_bid_timer: ' . $active_bid_timer);
				}
			} else {
				render_error("User does not have active points", 400);
			}
		}
	}

	function postbid_info()
	{
		if (is_post_request()) {

			$form_collection = $_POST;
			$msisdn = trim($form_collection['msisdn']);
			$points = $form_collection['points'];
			$bidid = $form_collection['bidid'];
			$open_points = $form_collection['open_points'];
			$open_date = $form_collection['open_date'];

			$this->postbid($msisdn, $points, $bidid, $open_points, $open_date);
		} else {
			render_error("Invalid request");
		}
	}
}
