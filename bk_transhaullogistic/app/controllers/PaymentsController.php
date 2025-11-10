<?php

/**
 * Payments Page Controller
 * @category  Controller
 */
class PaymentsController extends SecureController
{
	/**
	 * Load Record Action 
	 * $arg1 Field Name
	 * $arg2 Field Value 
	 * $param $arg1 string
	 * $param $arg1 string
	 * @return View
	 */
	function index($fieldname = null, $fieldvalue = null)
	{
		$db = $this->GetModel();
		$fields = array(
			'user.firstname',
			'user.lastname',
			'user.email',
			'user.phoneno',
			'pickup_request.item_name',
			'pickup_request.tracking_id',
			'pickup_request.payment_status',
			'pickup_request.created_at'
		);
		$limit = $this->get_page_limit(MAX_RECORD_COUNT); // return pagination from BaseModel Class e.g array(5,20)
		if (!empty($this->search)) {
			$text = $this->search;
			$db->orWhere('pickup_request.tracking_id', "%$text%", 'LIKE');
		}
		//$db->join("pickup_request", "pickup_request.id = payments.request_id", "LEFT");
		$db->join("user", "user.id = pickup_request.pickup_userid", "LEFT");

		if (ROLE_ID == "user") {
			$db->where('pickup_request.pickup_userid', USER_ID);
		} else if (ROLE_ID == "driver") {
			$db->where('pickup_request.driver_id', USER_ID);
		}
		if (!empty($this->orderby)) {
			$db->orderBy($this->orderby, $this->ordertype);
		} else {
			$db->orderBy('pickup_request.id', ORDER_TYPE);
		}
		if (!empty($fieldname)) {
			$db->where($fieldname, urldecode($fieldvalue));
		}
		//page filter command
		$tc = $db->withTotalCount();
		$records = $db->get('pickup_request', $limit, $fields);
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
	function import_data()
	{
		if (!empty($_FILES['file'])) {
			$finfo = pathinfo($_FILES['file']['name']);
			$ext = strtolower($finfo['extension']);
			if (!in_array($ext, array('csv', 'json'))) {
				render_error("File format not supported");
			}
			$file_path = $_FILES['file']['tmp_name'];
			if (!empty($file_path)) {
				$db = $this->GetModel();
				if ($ext == 'csv') {
					$options = array('table' => 'payments', 'fields' => '', 'delimiter' => ',', 'quote' => '"');
					$data = $db->loadCsvData($file_path, $options, false);
				} else {
					$data = $db->loadJsonData($file_path, 'payments', false);
				}
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_json($data);
				}
			} else {
				render_error(html - lang - 0047);
			}
		}
	}
	/**
	 * View Record Action 
	 * @return View
	 */
	function view($rec_id = null, $value = null)
	{
		$db = $this->GetModel();
		$fields = array('id', 	'request_id', 	'payer', 	'picture', 	'status', 	'created_at', 	'payment_method');
		if (!empty($value)) {
			$db->where($rec_id, urldecode($value));
		} else {
			$db->where('id', $rec_id);
		}
		$record = $db->getOne('payments', $fields);
		if (!empty($record)) {
			render_json($record);
		} else {
			if ($db->getLastError()) {
				render_error($db->getLastError());
			} else {
				render_error("Record not found", 404);
			}
		}
	}
	/**
	 * Add New Record Action 
	 * If Not $_POST Request, Display Add Record Form View
	 * @return View
	 */
	function add()
	{
		if (is_post_request()) {
			$modeldata = transform_request_data($_POST);
			$rules_array = array(
				'request_id' => 'required|numeric',
				'payer' => 'required',
				'picture' => 'required',
				'payment_method' => 'required',
			);
			$is_valid = GUMP::is_valid($modeldata, $rules_array);
			if ($is_valid != true) {
				render_error($is_valid);
			}
			$db = $this->GetModel();
			$rec_id = $db->insert('payments', $modeldata);
			if (!empty($rec_id)) {
				//$db->where('id' , $modeldata['request_id']);
				//$bool = $db->update('pickup_request',array("payment_status"=>1));
				render_json($rec_id);
			} else {
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_error("Error inserting record");
				}
			}
		} else {
			render_error("Invalid request");
		}
	}
	/**
	 * Edit Record Action 
	 * If Not $_POST Request, Display Edit Record Form View
	 * @return View
	 */
	function edit($rec_id = null)
	{
		$db = $this->GetModel();
		if (is_post_request()) {
			$modeldata = transform_request_data($_POST);
			$db->where('id', $rec_id);
			$bool = $db->update('payments', $modeldata);
			if ($bool) {
				render_json($rec_id);
			} else {
				render_error($db->getLastError());
			}
			return null;
		} else {
			$fields = array('id', 'request_id', 'payer', 'picture', 'payment_method');
			$db->where('id', $rec_id);
			$data = $db->getOne('payments', $fields);
			if (!empty($data)) {
				render_json($data);
			} else {
				if ($db->getLastError()) {
					render_error($db->getLastError());
				} else {
					render_error("Record not found", 404);
				}
			}
		}
	}
	/**
	 * Delete Record Action 
	 * @return View
	 */
	function delete($rec_ids = null)
	{
		$db = $this->GetModel();
		$arr_id = explode(',', $rec_ids);
		foreach ($arr_id as $rec_id) {
			$db->where('id', $rec_id, "=", 'OR');
		}
		$bool = $db->delete('payments');
		if ($bool) {
			render_json($bool);
		} else {
			if ($db->getLastError()) {
				render_error($db->getLastError());
			} else {
				render_error("Error deleting the record. please make sure that the record exit");
			}
		}
	}
}
