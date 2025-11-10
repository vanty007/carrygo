<?php 
/**
 * Propertylist Page Controller
 * @category  Controller
 */
class PropertylistController extends SecureController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		$sqltext = "";
		
			$sqltext = "SELECT count(p.landmark) as listing,p.state, p.landmark,q.thumbnail FROM propertylist p, propertyavailability q WHERE p.id=q.property_id group by p.landmark";
		
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('listing', ORDER_TYPE);
		}
		$limit = 10;
		//$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query( $sqltext, $limit );
		$data=new stdClass;
		$data->records = $records;
		$data->record_count = count( $records );
		$data->total_records = intval( $tc->totalCount );
		render_json( $data );
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$sqltext = "";
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p.id, p2.price,p2.type,p2.rooms, p.name, p.address, 
			p.landmark, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname,p2.invalidfrom,p2.invalidto,
			p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description,p2.service_charge, p2.thumbnail,p2.facilities,p.user_id as auth_id
			FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			where p.status=0 and p2.status=0 and p.id = $rec_id";
		$record = $db->query( $sqltext);
		if(!empty($record)){
		//Email Notification
		/*$time = datetime_now();
		$site_addr = SITE_ADDR;
		$mailtitle = "Propertylist Record Viewed";
		$mailbody = "Hi Admin, New Propertylist record has been viewed .
			Link : <a href='$site_addr#/propertylist/view/$rec_id'>$rec_id</a>
			Date viewed : $time";
		$rec_email = DEFAULT_EMAIL;
		$mailer = new Mailer;
		$mailer->send_mail($rec_email , $mailtitle , $mailbody);*/
		
		$str_arr_pictures = explode (",", $record[0]["pictures"]); 
		$db->where('property_id' , $rec_id);
		$facility = explode (",", $record[0]["facilities"]); 
		$db->where('property_id' , $rec_id);
		$propertyreservation = $db->get( 'propertyreservation');	
		$sql_rating_count = "SELECT AVG(rate) as rate FROM rating WHERE propertylist_id=$rec_id";
		$db->where('rating.propertylist_id' , $rec_id);
		$db->join("user","rating.user_id = user.auth_id","INNER");  
		//$field1s = array( 'rating.title_rate','rating.rate','rating.review','rating.created_at','user.title','user.firstname','user.lastname');
		$rating = $db->get( 'rating');	

		$data = new stdClass;
		$data->records = $record[0];
		$data->facility = $facility;

		if(count($propertyreservation)==1){
		$data->propertyreservation = $record[0]["invalidto"].','.$propertyreservation[0]['validdatestart'].'-'.$propertyreservation[0]['validdateend'];
		}
		else if(count($propertyreservation)>1){
		$str_join = $record[0]["invalidto"];
		for($i=0;$i<count($propertyreservation);$i++){
		$str_join = $str_join.','.$propertyreservation[$i]['validdatestart'].'-'.$propertyreservation[$i]['validdateend'];
		}
		$data->propertyreservation = $str_join;
		}
		else{
			$data->propertyreservation = '0';	
		}
		
		$data->pictures = $str_arr_pictures;
		$data->rating_count = $db->query( $sql_rating_count)[0];
		$data->rating = $rating;

			render_json($data);
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
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$rules_array = array(
				'propertytype_id' => 'required|numeric',
				'name' => 'required',
				'chargetype_id' => 'required|numeric',
				'rating_id' => 'required|numeric',
				'address' => 'required',
				'location_id' => 'required|numeric',
				'landmark' => 'required',
				'longitude' => 'required',
				'latitude' => 'required',
				'status' => 'required',
				'user_id' => 'required|numeric',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('propertylist',$modeldata);
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
	/**
     * Edit Record Action 
     * If Not $_POST Request, Display Edit Record Form View
     * @return View
     */
	function edit($rec_id=null){
		$db = $this->GetModel();
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$db->where('id' , $rec_id);
			$bool = $db->update('propertylist',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','propertytype_id','name','chargetype_id','rating_id','address','location_id','landmark','longitude','latitude','status','user_id');
			$db->where('id' , $rec_id);
			$data = $db->getOne('propertylist',$fields);
			if(!empty($data)){
				render_json($data);
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
	/**
     * Delete Record Action 
     * @return View
     */
	function delete( $rec_ids = null ){
		$db = $this->GetModel();
		$arr_id = explode( ',', $rec_ids );
		foreach( $arr_id as $rec_id ){
			$db->where('id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'propertylist' );
		if($bool){
			render_json( $bool );
		}
		else{
			if($db->getLastError()){
				render_error($db->getLastError());
			}
			else{
				render_error("Error deleting the record. please make sure that the record exit");
			}
		}
	}
}
