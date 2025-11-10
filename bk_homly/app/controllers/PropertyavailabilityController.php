<?php 
/**
 * Propertyavailability Page Controller
 * @category  Controller
 */
class PropertyavailabilityController extends SecureController{
	/**
     * Load Record Action 
     * $arg1 Field Name
     * $arg2 Field Value 
     * $param $arg1 string
     * $param $arg1 string
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$fields = array('propertyavailability.id', 	'property_id', 	'type', 'pictures','thumbnail','invalidfrom','invalidto',	'quantity', 	'price', 	'rooms', 	'description', 	'propertyavailability.updated_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('property_id',"%$text%",'LIKE');
			$db->orWhere('type',"%$text%",'LIKE');
			$db->orWhere('quantity',"%$text%",'LIKE');
			$db->orWhere('price',"%$text%",'LIKE');
			$db->orWhere('rooms',"%$text%",'LIKE');
			$db->orWhere('description',"%$text%",'LIKE');
			$db->orWhere('updated_at',"%$text%",'LIKE');
		}
		$db->join("propertylist","propertylist.id = propertyavailability.property_id","INNER");
		$db->join("auth","propertylist.user_id = auth.id","INNER");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id', ORDER_TYPE);
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$db->where('propertylist.user_id' , USER_ID)->where('auth.role_id' , 'administrator');
		$tc = $db->withTotalCount();
		$records = $db->get('propertyavailability', $limit, $fields);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = count($records);
		$data->total_records = intval($tc->totalCount);
		render_json($data);
	}
	/**
     * Load csv|json data
     * @return data
     */
	function import_data(){
		if(!empty($_FILES['file'])){
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if(!in_array($ext , array('csv','json'))){
				render_error("File format not supported");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if(!empty($file_path)){
				$db = $this->GetModel();
				if($ext == 'csv'){
					$options = array('table' => 'propertyavailability', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'propertyavailability' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					render_json($data);
				}
			}
			else{
				render_error(html-lang-0047);
			}
		}
	}
	/**
     * View Record Action 
     * @return View
     */
	function view( $rec_id = null , $value = null){
		$db = $this->GetModel();
		$sqltext = "";
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p.id,p4.location_name, p2.price,p2.type,p2.rooms, p.name, p.address, 
			p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname,p2.invalidfrom,p2.invalidto,
			p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, p2.thumbnail,p2.facilities
			FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN propertylocations AS p4 ON p4.id=p.location_id where p.id = $rec_id";
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
		$part = $db->get( 'propertypart');	
		$sql_rating_count = "SELECT AVG(rate) as rate FROM rating WHERE propertylist_id=$rec_id";
		$db->where('rating.propertylist_id' , $rec_id);
		$db->join("user","rating.user_id = user.auth_id","INNER");  
		//$field1s = array( 'rating.title_rate','rating.rate','rating.review','rating.created_at','user.title','user.firstname','user.lastname');
		$rating = $db->get( 'rating');	

		$data = new stdClass;
		$data->records = $record[0];
		$data->facility = $facility;
		$data->part = $part;
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
			//_dump($modeldata);
			$rules_array = array(
				'name' => 'required',
				'landmark' => 'required',
				'type' => 'required',
				//'quantity' => 'required|numeric',
				'price' => 'required|numeric',
				'rooms' => 'required',
				'description' => 'required',
				'location_name' => 'required',
				'city' => 'required',
				'country' => 'required',
				'state' => 'required',
			);
			$name = $modeldata['name'];
			$address = $modeldata['address'];
			$landmark = $modeldata['landmark'];
			$contactphone = $modeldata['contactphone'];
			$contactemail = $modeldata['contactemail'];
			$contactname = $modeldata['contactname'];
			$property_id = $modeldata['property_id'];
			$type = $modeldata['type'];
			$quantity = $modeldata['quantity'];
			$price = $modeldata['price'];
			$rooms = $modeldata['rooms'];
			$description = $modeldata['description'];
			$pictures = $modeldata['pictures'];
			$thumbnail = $modeldata['thumbnail'];
			$city = $modeldata['city'];
			$country = $modeldata['country'];
			$state = $modeldata['state'];
			$invalidfrom = $modeldata['invalidfrom'];
			$service_charge = $modeldata['service_charge'];
			/*if(isset($modeldata['invalidfrom'])){
			$invalidfrom = $modeldata['invalidfrom'];
			}*/
			$facilities = $modeldata['facilities'];
			$invalidto = $modeldata['invalidto'];


			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$modeldata['user_id'] = USER_ID;

			unset($modeldata['property_id']);
			unset($modeldata['type']);
			unset($modeldata['quantity']);
			unset($modeldata['price']);
			unset($modeldata['rooms']);
			unset($modeldata['description']);
			unset($modeldata['pictures']);
			unset($modeldata['thumbnail']);
			unset($modeldata['facilities']);
			unset($modeldata['invalidfrom']);
			unset($modeldata['invalidto']);
			unset($modeldata['service_charge']);
			/*if(isset($modeldata['invalidfrom'])){
			unset($modeldata['invalidfrom']);
			}*/

			$rec_id = $db->insert('propertylist',$modeldata);
			if(!empty($rec_id)){
				$modeldata['property_id'] = $rec_id;
				$modeldata['type'] = $type;
				$modeldata['price'] = $price;
				$modeldata['rooms'] = $rooms;
				$modeldata['description'] = $description;
				$modeldata['pictures'] = $pictures;
				$modeldata['thumbnail'] = $thumbnail;
				$modeldata['facilities'] = $facilities;
				$modeldata['invalidfrom'] = $invalidfrom;
				$modeldata['invalidto'] = $invalidto;
				$modeldata['service_charge'] = $service_charge;
				/*if(isset($modeldata['invalidfrom'])){
				$modeldata['invalidfrom'] = explode("-",$invalidfrom)[0];
				$modeldata['invalidto'] = explode("-",$invalidfrom)[1];
				}*/

				unset($modeldata['name']);
				unset($modeldata['user_id']);
				unset($modeldata['address']);
				unset($modeldata['landmark']);
				unset($modeldata['contactphone']);
				unset($modeldata['contactemail']);
				unset($modeldata['contactname']);
				unset($modeldata['city']);
				unset($modeldata['country']);
				unset($modeldata['state']);
				//unset($modeldata['invalidto']);

				$db->insert('propertyavailability',$modeldata);
				
				render_json("#/propertyavailability/list");
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

			$name = $modeldata['name'];
			$address = $modeldata['address'];
			$landmark = $modeldata['landmark'];
			$contactphone = $modeldata['contactphone'];
			$contactemail = $modeldata['contactemail'];
			$contactname = $modeldata['contactname'];
			$type = $modeldata['type'];
			$quantity = $modeldata['quantity'];
			$price = $modeldata['price'];
			$rooms = $modeldata['rooms'];
			$description = $modeldata['description'];
			$pictures = $modeldata['pictures'];
			$thumbnail = $modeldata['thumbnail'];
			$city = $modeldata['city'];
			$country = $modeldata['country'];
			$state = $modeldata['state'];
			$facilities = $modeldata['facilities'];
			$invalidfrom = $modeldata['invalidfrom'];
			$invalidto = $modeldata['invalidto'];
			$service_charge = $modeldata['service_charge'];
			/*if(isset($modeldata['invalidfrom'])){
			$invalidfrom = $modeldata['invalidfrom'];
			}*/

			unset($modeldata['type']);
			unset($modeldata['quantity']);
			unset($modeldata['price']);
			unset($modeldata['rooms']);
			unset($modeldata['description']);
			unset($modeldata['pictures']);
			unset($modeldata['thumbnail']);
			unset($modeldata['facilities']);
			unset($modeldata['invalidfrom']);
			unset($modeldata['invalidto']);
			unset($modeldata['service_charge']);
			/*if(isset($modeldata['invalidfrom'])){
			unset($modeldata['invalidfrom']);
			}*/

			$db->where('id' , $rec_id);
			$db->update('propertylist',$modeldata);

			$modeldata['type'] = $type;
			$modeldata['price'] = $price;
			$modeldata['rooms'] = $rooms;
			$modeldata['description'] = $description;
			$modeldata['pictures'] = $pictures;
			$modeldata['thumbnail'] = $thumbnail;
			$modeldata['facilities'] = $facilities;
			$modeldata['invalidfrom'] = $invalidfrom;
			$modeldata['invalidto'] = $invalidto;
			$modeldata['service_charge'] = $service_charge;
			/*if(isset($modeldata['invalidfrom'])){
			$modeldata['invalidfrom'] = explode("-",$invalidfrom)[0];
			$modeldata['invalidto'] = explode("-",$invalidfrom)[1];
			}*/

			unset($modeldata['name']);
			unset($modeldata['address']);
			unset($modeldata['landmark']);
			unset($modeldata['contactphone']);
			unset($modeldata['contactemail']);
			unset($modeldata['contactname']);
			unset($modeldata['city']);
			unset($modeldata['country']);
			unset($modeldata['state']);
			$db->where('property_id' , $rec_id);
			$bool = $db->update('propertyavailability',$modeldata);
			if($bool){
				render_json("#/propertyavailability/list");
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$sqltext = "";

			$sqltext = "SELECT SQL_CALC_FOUND_ROWS p.id, p2.price,p2.type,p2.rooms, p.name, p.address, 
			p.landmark, p.contactphone, p.contactemail, p.contactname,p2.invalidfrom,p2.invalidto,
			p2.pictures, p2.description, p2.thumbnail, p2.quantity,p.city,p.country,p.state,p2.facilities,p2.service_charge
			FROM propertylist AS p INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id where p.id=$rec_id";
			$data = $db->query( $sqltext);
			if(!empty($data)){
				render_json($data[0]);
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
			$db->where('property_id' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'propertyavailability' );
		if($bool){
			$db->where('id' , $rec_id);
			$db->delete( 'propertylist' );
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
