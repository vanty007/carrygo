<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class DailybreakdownController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$sql = "";

		if($fieldname=='1'){
			$sql = $db->rawQuery("SELECT count(*) sub_count,status, DATE(session_date) created_date FROM carrygo_session_log GROUP BY created_date,status order by created_date desc limit 20");
		}
		else if($fieldname=='2'){
			$sql = $db->rawQuery("SELECT sum(amount) amount,status, DATE(session_date) created_date FROM carrygo_session_log GROUP BY created_date,status order by created_date desc limit 20");
		}
		else if($fieldname=='3'){
			$sql = $db->rawQuery("SELECT sum(points) points, DATE(created_at) created_date FROM carrygo_bid_entry GROUP BY created_date order by created_date desc limit 20");
		}
		else if($fieldname=='4'){
			$sql = $db->rawQuery("SELECT count(*) sub_count,status, DATE(session_date) created_date FROM session_log GROUP BY created_date,status order by created_date desc limit 20");
		}
		else if($fieldname=='5'){
			$sql = $db->rawQuery("SELECT sum(amount) amount,status, DATE(session_date) created_date FROM session_log GROUP BY created_date,status order by created_date desc limit 20");
		}
		else if($fieldname=='6'){
			$sql = $db->rawQuery("SELECT count(*) sub_count,status, DATE(entrie_date) created_date FROM entries_log GROUP BY created_date,status order by created_date desc limit 20");
		}
		
		$tc = $db->withTotalCount();
		$records = $sql;
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = 10;
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
}
