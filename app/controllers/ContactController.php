<?php
/**
 * Info Contoller Class
 * @category  Controller
 */

class ContactController extends BaseController{

	/**
     * Display About us page
     * @return Html View
     */
	function index(){
		$this->view->render("contact/index.php" ,null,"main_layout.php");
	}

}
