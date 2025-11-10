<?php 
/**
 * Pendingpickups Page Controller
 * @category  Controller
 */
class PendingpickupsController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$sqltext = "SELECT SQL_CALC_FOUND_ROWS   pr.receiver_name, pr.receiver_phoneno, pr.receiver_email, pr.pickup_address, pr.pickup_city, pr.pickup_state, pr.receiver_address, pr.receiver_city, pr.receiver_state, pr.picture, pr.totalamount, pr.created_at, pr.pickup_status FROM pickup_request AS pr WHERE  (pr.pickup_status  =0 )";
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('receiver_name', ORDER_TYPE);
		}
		if(!empty($this->groupby)){
			$db->groupBy($this->groupby);
		}
		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query( $sqltext, $limit );
		$data=new stdClass;
		$data->records = $records;
		$data->record_count = count( $records );
		$data->total_records = intval( $tc->totalCount );
		render_json( $data );
	}
}
