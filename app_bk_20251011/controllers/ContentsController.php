<?php 
/**
 * Contents Page Controller
 * @category  Controller
 */
class ContentsController extends SecureController{
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
		$fields = array('id', 	'vet_id', 	'user_id', 	'subject', 	'contents', 	'category_id', 	'picture', 	'status', 	'created_at');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('id',"%$text%",'LIKE');
			$db->orWhere('vet_id',"%$text%",'LIKE');
			$db->orWhere('user_id',"%$text%",'LIKE');
			$db->orWhere('subject',"%$text%",'LIKE');
			$db->orWhere('contents',"%$text%",'LIKE');
			$db->orWhere('category_id',"%$text%",'LIKE');
			$db->orWhere('picture',"%$text%",'LIKE');
			$db->orWhere('status',"%$text%",'LIKE');
			$db->orWhere('created_at',"%$text%",'LIKE');
		}
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('id', 'ASC');
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('contents', $limit, $fields);
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
					/*$options = array('table' => 'contents', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );*/
					if (($handle = fopen($file_path, "r")) !== false) {
					$lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						for ($i = 0; $i < count($lines); $i++) {
							$row = str_getcsv($lines[$i]); // Convert line into CSV fields
							echo "Row $i: ";
							/*for ($j = 0; $j < count($row); $j++) {
								echo $row[$j] . " | ";*/
								echo $row[1] . " | ".$row[2] . " | ".$row[3];
								echo "\n";
								//$db->insert('contents',array("contents"=>$row[0],"category_id"=>$row[1],"picture"=>$row[2],"created_at"=>$row[3]));
							/*}
							//echo "\n";*/
						}

						}
					else {
						render_error("Error: Unable to open file.");
						}
					}
				else{
					$data = $db->loadJsonData( $file_path, 'contents' , false );
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
		$fields = array( 'id', 	'vet_id', 	'user_id', 	'subject', 	'contents', 	'category_id', 	'picture', 	'status', 	'created_at' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('id' , $rec_id);
		}
		$record = $db->getOne( 'contents', $fields );
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
	/**
     * Add New Record Action 
     * If Not $_POST Request, Display Add Record Form View
     * @return View
     */
	function add(){
		if(is_post_request()){
			$modeldata=transform_request_data($_POST);
			$rules_array = array(
				'vet_id' => 'required|numeric',
				'user_id' => 'required|numeric',
				'subject' => 'required',
				'contents' => 'required',
				'category_id' => 'required|numeric',
				'picture' => 'required',
				'status' => 'required|numeric',
				'created_at' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('contents',$modeldata);
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
			$bool = $db->update('contents',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('id','vet_id','user_id','subject','contents','category_id','picture','status','created_at');
			$db->where('id' , $rec_id);
			$data = $db->getOne('contents',$fields);
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
		$bool = $db->delete( 'contents' );
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
