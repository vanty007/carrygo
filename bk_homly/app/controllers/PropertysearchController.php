<?php 
/**
 * Propertysearch Page Controller
 * @category  Controller
 */
class PropertysearchController extends SecureController{
	/**
     * Custom Load Record Action 
     * @return View
     */
	function index($fieldname = null , $fieldvalue = null){
		$db = $this->GetModel();
		$sqltext = "";

		$g=get_session('user_data');
		if(empty($g)){
		$strQuery_fav="";
		$strQuery_fav_id="-1 as f_id, ";
		}
		else{
		$strQuery_fav="LEFT JOIN myfavourite AS p4 ON p2.id=p4.propertyavailbility_id";
		$strQuery_fav_id="p4.id as f_id, ";
		}

		if(!empty($fieldname) && (strlen($this->what_property)==1 && strlen($this->where_property)==1) ){
			$queryvalue = urldecode($fieldvalue);
			$queryvalue_count = count(explode(',',$queryvalue));

			if($queryvalue_count == 1){
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and (p.landmark like '%$queryvalue%' or p2.type like '%$queryvalue%') GROUP BY p2.id";	
			}
			else{
				$where_property = explode(',',$queryvalue)[0];
				$what_property = explode(',',$queryvalue)[1];
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and (p.landmark like '%$where_property%' or p2.type like '%$what_property%') GROUP BY p2.id";		
			}

			//$db->where($fieldname , urldecode($fieldvalue));
			/*$sqltext = "SELECT SQL_CALC_FOUND_ROWS p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
			where p.status=0 and p2.status=0 and $fieldname like '%$queryvalue%' GROUP BY p2.id,p3.rate,p3.review";*/
		}
		else if((!empty($fieldname) || empty($fieldname)) && strlen($this->facilities_property)==1 && (strlen($this->what_property)==1 && strlen($this->where_property)==1 
		) && (strlen($this->price_slider_min)==1 || strlen($this->price_slider_max)==1)){
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
			$strQuery_fav
			where p.status=0 and p2.status=0 GROUP BY p2.id";
		}
		else{
			$strQuery="";
			if(strlen($this->what_property)>1){
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and p2.type like '%$this->what_property%' GROUP BY p2.id";				
			}
			else if(strlen($this->where_property)>1){
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and p.landmark like '%$this->where_property%' GROUP BY p2.id";				
			}
			else if((strlen($this->what_property)>1 && strlen($this->where_property)>1)){
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and (p.landmark like '%$this->where_property%' and p2.type like '%$this->what_property%') GROUP BY p2.id";
			}
			else if(strlen($this->facilities_property)>1){
					$str_arr = preg_split ("/\,/", $this->facilities_property); 
					$strQuery="facilities="."'$str_arr[0]'";
					for($i=1;$i<count($str_arr);$i++){
						$text=$str_arr[$i];
						$strQuery=$strQuery." or facilities="."'$text'";
					}
					
				$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
				p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
				INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
				LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
				$strQuery_fav
				where p.status=0 and p2.status=0 and ($strQuery) GROUP BY p2.id";				
			}
			else if(strlen($this->facilities_property)>1 && (strlen($this->what_property)>1 || strlen($this->where_property)>1)){
				$str_arr = preg_split ("/\,/", $this->facilities_property); 
				$strQuery="facilities="."'$str_arr[0]'";
				for($i=1;$i<count($str_arr);$i++){
					$text=$str_arr[$i];
					$strQuery=$strQuery." or facilities="."'$text'";
				}
				
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
			$strQuery_fav
			where p.status=0 and p2.status=0 and (p.landmark like '%$this->where_property%' or p2.type like '%$this->what_property%') and ($strQuery) GROUP BY p2.id";				
		}
		else if(strlen($this->price_slider_min)>1 && strlen($this->price_slider_max)>1){
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
			$strQuery_fav
			where p.status=0 and p2.status=0 and (p2.price BETWEEN '$this->price_slider_min' and '$this->price_slider_max') GROUP BY p2.id";				
		}
		else if((strlen($this->price_slider_min)>1 && strlen($this->price_slider_max)>1) && (strlen($this->what_property)>1 || strlen($this->where_property)>1)){	
		$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
		p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
		INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
		LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
		$strQuery_fav
		where p.status=0 and p2.status=0 and (p.landmark like '%$this->where_property%' or p2.type like '%$this->what_property%') and 
		(p2.price BETWEEN '$this->price_slider_min' and '$this->price_slider_max')  GROUP BY p2.id";				
	}
	else{
			$sqltext = "SELECT SQL_CALC_FOUND_ROWS $strQuery_fav_id p2.invalidfrom, p2.invalidto, p.id, p2.price,p2.type,p2.rooms, p.name, p.address, p.landmark, p.longitude, p.latitude, p2.status, p.created_at, p.contactphone, p.contactemail, p.contactname, p.checkin, p.checkout, p.cancellation, p.pets, p.views, p2.pictures, p2.description, 
			p2.thumbnail,AVG(p3.rate) avg_of_rate,COUNT(p3.review) count_of_review FROM propertylist AS p 
			INNER JOIN propertyavailability AS p2 ON p.id=p2.property_id 
			LEFT JOIN rating AS p3 ON p2.id=p3.propertylist_id
			$strQuery_fav
			where p.status=0 and p2.status=0 and (p.landmark like '%$this->where_property%' and p2.type like '%$this->what_property%') 
			and (p2.price BETWEEN '$this->price_slider_min' and '$this->price_slider_max') GROUP BY p2.id";
	}
}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('p.id', ORDER_TYPE);
		}
		$limit = null;
		$limit=$this->get_page_limit(MAX_RECORD_COUNT); //Get sql limit from url if not set on the sql command text
		$tc = $db->withTotalCount();
		$records = $db->query( $sqltext, $limit );
		$data=new stdClass;
		$data->records = $records;
		$data->record_count = count( $records );
		$data->total_records = intval( $tc->totalCount );
		//$this->view->render("#propertysearch" ,$data,"main_layout.php");
		render_json( $data );
	}
}
