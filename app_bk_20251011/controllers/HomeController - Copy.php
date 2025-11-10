<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		$db = $this->GetModel();
		
		$data=new stdClass;

		$data->records = array('messages'=>"");
		
		$data->record_count = 0;
		$data->total_records = 0;

		render_json( $data );
	}
}
