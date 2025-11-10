<?php 
/**
 * Myreservation Page Controller
 * @category  Controller
 */
class ReviewController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$user_id = USER_ID;
		$sqltext = "SELECT u.title,u.lastname,u.firstname,u.profile_pics, r.review,r.rate,r.created_at,p.id, p.name from rating r, propertylist p, user u where r.propertylist_id = p.id and 
		p.user_id=u.auth_id and p.user_id=$user_id";
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('r.id', ORDER_TYPE);
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
