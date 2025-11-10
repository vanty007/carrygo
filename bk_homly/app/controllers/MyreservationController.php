<?php 
/**
 * Myreservation Page Controller
 * @category  Controller
 */
class MyreservationController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$user_id = USER_ID;
		$sqltext = "SELECT SQL_CALC_FOUND_ROWS   p.user_id,p3.id, p.name, p2.type, p.address, p.landmark, p.status as prop_status,p3.status as booking_status,p3.chargestatus,p5.status as chargestatus1, 
		p2.thumbnail, p2.description, p2.pictures, p3.rooms,p3.price,p3.status,p3.created_at,p4.firstname,p4.auth_id,p4.lastname,p4.profile_pics,p4.title,p3.validdatestart,p3.validdateend
		FROM propertyreservation AS p3 
		INNER JOIN propertyavailability AS p2 ON p3.property_id=p2.property_id 
		LEFT JOIN payments AS p5 ON p3.id=p5.reserve_id
		INNER JOIN propertylist AS p ON p.id=p3.property_id 
		INNER JOIN user AS p4 ON p4.auth_id=p3.user_id where p3.user_id=$user_id";
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id', ORDER_TYPE);
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

	function add(){
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$rules_array = array(
				'property_id' => 'required|numeric',
				'rooms' => 'required',
				'price' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('propertyreservation',$modeldata);
			if(!empty($rec_id)){
				render_json($rec_id);
			}
			else{
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_error("Error inserting record");
				}
			}
		}
		else{
			render_error("Invalid request");
		}
	}

	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$fields = array( 'id','property_id');
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id' , $rec_id);
		}
		$record = $db->getOne( 'propertyreservation', $fields );
		if(!empty($record)){
			render_json($record);
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Record not found",404);
			}
		}
	}
}
