<?php 
/**
 * Questions_Log Page Controller
 * @category  Controller
 */
class FanscornercontentController extends SecureController{
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
		//$fields = array('story.id', 'story.title', 'story.description', 'story.author', 'story.tags', 'story.rating', 'story.totalEpisodes', 'story.totalReadTime', 
		//'story_episodes','story_isFeatured','story_review.user');
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if(!empty($this->search)){
			$text=$this->search;
			$db->orWhere('story.title',"%$text%",'LIKE');
			$db->orWhere('story.author',"%$text%",'LIKE');
		}
		$db->join("story_episode","story_episode.story_id = story.id","LEFT");
		//$db->join("story_episode","story_episode.story_id = story.id","LEFT");
		if(!empty($this->orderby)){
			$db->orderBy($this->orderby,$this->ordertype);
		}
		else{
			$db->orderBy('story.id', 'ASC');
		}
		if( !empty($fieldname) ){
			$db->where($fieldname , urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('story', $limit);
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
					$options = array('table' => 'story_dump', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData( $file_path , $options , false );
				}
				else{
					$data = $db->loadJsonData( $file_path, 'questions_log' , false );
				}
				if($db->getLastError()){
					render_error($db->getLastError());
				}
				else{
					$get_story_dump = $db->get( 'story_dump');
					if(count($get_story_dump)>0){
						$rec_id_story = $db->insert('story',array("title"=>$get_story_dump[0]['title'],"author"=>$get_story_dump[0]['author'],"description"=>$get_story_dump[0]['description'],
					"category_id"=>$get_story_dump[0]['category_id'],"tags"=>$get_story_dump[0]['tags'],"totalEpisodes"=>count($get_story_dump)));

					for($i=0;$i<count($get_story_dump);$i++){
					$rec_id_episode = $db->insert('story_episode',array("story_id"=>$rec_id_story,"title"=>$get_story_dump[$i]['episode_title'],"content"=>$get_story_dump[$i]['content'],
					"pointsCost"=>$get_story_dump[$i]['pointsCost'],"isPremium"=>$get_story_dump[$i]['isPremium']));	
					}
					}
					$db->rawQuery("TRUNCATE TABLE story_dump");
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
		$fields = array( 'tid', 	'question_category', 	'question', 	'created_date', 	'status', 	'created_by', 	'valid_option', 	'quest_language', 	'wildanswers' );
		if( !empty($value) ){
			$db->where($rec_id, urldecode($value));
		}
		else{
			$db->where('tid' , $rec_id);
		}
		$record = $db->getOne( 'questions_log', $fields );
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
				'question_category' => 'required|numeric',
				'question' => 'required',
				'valid_option' => 'required',
				'quest_language' => 'required|numeric',
				'wildanswers' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('questions_log',$modeldata);
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
			$db->where('tid' , $rec_id);
			$bool = $db->update('questions_log',$modeldata);
			if($bool){
				render_json($rec_id);
			}
			else{
				render_error($db->getLastError());
			}
			return null;
		}
		else{
			$fields=array('tid','question_category','question','valid_option','quest_language','wildanswers');
			$db->where('tid' , $rec_id);
			$data = $db->getOne('questions_log',$fields);
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
			$db->where('tid' , $rec_id,"=",'OR');
		}
		$bool = $db->delete( 'questions_log' );
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
