<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->load->model('Admin_model', 'hr');
		$this->zone = date_default_timezone_set('Asia/Manila');
	}


	public function loginUI()
	{
		$data['title'] = 'Login';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/login');
		$this->load->view('templates/footer');
	}


	public function auth_form()
	{
		$response = array();
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);
		$validate = $this->hr->authentication($email, $password);

	
		// print_r($validate->id);

		$this->db->select('emp_id,full_name,department');
		$this->db->from('vw_emp_designation');
		$this->db->where('emp_id',$validate->id);

		$query = $this->db->get();
		// Check if the query was successful
		// if ($query->num_rows() > 0) {
		// 	// Fetch the hashed password from the query result
		// 	$query = $query->row();
		// 	return $query;
		// 	// return $hashed_pass;
		// } else {
		// 	// No rows found with the provided email address or column value
		// 	return null; // Or handle accordingly
		// }



		// if ($query->num_rows() > 0) {
		// 	$data = $query->row_array();
		// 	print_r($data);

		// }

		if ($query->num_rows() > 0) 
		{
			$data = $query->row_array();
			$id = $data['emp_id'];
			$name = $data['full_name'];
			$department = $data['department'];


			$session_data = array(
		
				'id' => $id,			
				'name' => $name,
				'department' => $department,	
				'logged_in' => TRUE
			);

			$this->session->set_userdata($session_data);
			// redirect('hr_profile');
			$response['status']='success';
			$response['message']='Login success!';
		
		}
		else 
		{
			 $response['status']='error';
			 $response['message']='Ops! Invalid username Or password';
		}

		print_r($response);

		return json_encode($response);

		// print_r($session_data);
		

	}

	public function adduser()
	{
		$response = array();

		// Extract data from POST request
		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$nickn = $this->input->post('nickn'); // Assuming nickn is a field in the form
		$contact_no = $this->input->post('contact_no');
		$current_add = $this->input->post('current_add');
		$perm_add = $this->input->post('perm_add');
		$dob = $this->input->post('dob');
		$age = $this->input->post('age');
		$religion = $this->input->post('religion');
		$sex = $this->input->post('sex');
		$civil_status = $this->input->post('civil_status');
		$pob = $this->input->post('pob');
		$email = $this->input->post('email');
		$ins_id = $this->input->post('ins_id');
		$password = $this->input->post('password');
		$pfp = $this->input->post('pfp');
		$user_type = $this->input->post('user_type');
		$department = $this->input->post('department');

		// Create data array for insertion
		$data = array(
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'nickn' => $nickn,
			'contact_no' => $contact_no,
			'current_add' => $current_add,
			'perm_add' => $perm_add,
			'dob' => $dob,
			'age' => $age,
			'religion' => $religion,
			'sex' => $sex,
			'civil_status' => $civil_status,
			'pob' => $pob,
			'email' => $email,
			'ins_id' => $ins_id,
			'password' => $password,
			'pfp' => $pfp,
			'user_type' => $user_type,
			'department' => $department
		);

		// Insert data into the database
		$sql = $this->db->insert('employees', $data);

		// Check if insertion was successful
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'User added successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add user';
		}

		// Return response as JSON
		echo json_encode($response);
	}


	public function showUserdetails()
	{
		// Retrieve emp_id from the query parameter
		$emp_id = $this->input->get('emp_id');

		// Fetch employee details based on emp_id using the loaded model
		$employee = $this->hr->getEmployeeDetails($emp_id);

		// Return JSON response
		header('Content-Type: application/json');
		echo json_encode($employee);
	}

	public function updateUser()
	{
		$response = array();

		$id = $_SESSION['id'];

		$data = array(
			'fname' => $this->input->post('fname'),
			'mname' => $this->input->post('mname'),
			'lname' => $this->input->post('lname'),
			'dob' => $this->input->post('dob'),
			'current_add' => $this->input->post('current_add'),
			'sex' => $this->input->post('sex'),
			'perm_add' => $this->input->post('perm_add'),
			'role' => $this->input->post('role'),
			'department' => $this->input->post('department'),
			'contact_no' => $this->input->post('contact_no'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'pfp' => $this->input->post('pfp')
		);

		$this->db->where('id', $id);
		$sql = $this->db->update('employees', $data);

		if ($sql) {
			// Update session data
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);

		redirect('pages/hr_profile');
	}

	public function dash()
	{
		if ($this->session->userdata('logged_in') === TRUE) {
			$data['title'] = 'TItle';

			$this->load->view('pages/hr_home');
		} else {
			redirect('pages/login');
		}
	}



	public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages/login');
	}


	public function add_announce()
	{
		$datetime = date('Y-m-d H:i:s', time());
		$response = array();

		$author = $this->input->post('author');
		$title = $this->input->post('title');
		$department = $this->input->post('department');
		$content = $this->input->post('content');
		$postdate = $this->input->post('postdate');

		$data = array(
			/*column name*/
			'author' => $author,
			'title' => $title,
			'to_all' => $department,
			'content' => $content,
			'date_created' => $postdate
		);

		$sql = $this->db->insert('announcement', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);

		// $result = $this->hr->addUser($fname,$mname,$lname,$nickn,$current_add,
		// $perm_add,$dob,$age,$religion,$sex,$civil_status,$pob,$email,$password,$department,$role);
		// echo json_encode($result);
	}

	public function leaverequestzz()
	{
		$response = array();

		$name = $this->input->post('name');
		$date_filled = date('Y-m-d H:i:s', time());
		$department = $this->input->post('department');

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$leaveType = $this->input->post('leaveType');

		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'date_from' => $from_date,
			'date_to' => $to_date,
			'type_of_leave' => $leaveType,
			'reason' => $reason,
			'status' => $status,
			'date_filled' => $date_filled,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_leaves', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}


	public function ob_requestzz()
	{
		$response = array();
		$name = $this->input->post('name');
		$date_filled = date('Y-m-d H:i:s', time());
		$department = $this->input->post('department');
		$outgoing_pass_date = $this->input->post('outgoing_pass_date');
		$destin_from = $this->input->post('destin_from');
		$destin_to = $this->input->post('destin_to');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'destin_from' => $destin_from,
			'destin_to' => $destin_to,
			'time_from' => $time_from,
			'time_to' => $time_to,
			'outgoing_pass_date' => $outgoing_pass_date,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_off_business', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function outgoingrequestzz()
	{
		$response = array();
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$outgoing_date = $this->input->post('outgoing_date');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$destination = $this->input->post('destination');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'type' => $type,
			'date_filled' => $outgoing_date,
			'time_from' => $time_from,
			'time_to' => $time_to,
			'going_to' => $destination,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_outgoing', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function undertimerequestzz()
	{
		$response = array();

		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$undertime_date = $this->input->post('undertime_date');
		$time_in = $this->input->post('time_in');
		$time_out = $this->input->post('time_out');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'date_filled' => $undertime_date,
			'date_of_undertime' => $undertime_date,
			'time_in' => $time_in,
			'time_out' => $time_out,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name

		);

		$sql = $this->db->insert('f_undertime', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function overtimerequestzz()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$ot_date = $this->input->post('ot_date');
		$time_in = $this->input->post('from_time');
		$time_out = $this->input->post('to_time');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/

			'date_filled' => $date_filled,
			'date_ot' => $ot_date,
			'time_in' => $time_in,
			'time_out' => $time_out,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_overtime', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}

	public function workschedadjustzz()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$change_day_from = $this->input->post('date_from');
		$change_day_to = $this->input->post('date_to');
		$change_time_from = $this->input->post('time_from');
		$change_time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'date_filled' => $date_filled,
			'change_day_from' => $change_day_from,
			'change_day_to' => $change_day_to,
			'change_time_from' => $change_time_from,
			'change_time_to' => $change_time_to,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('work_schedule_adjustment_table', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}


	public function add_dept()
	{
		$response = array();
		$department = $this->input->post('dept_name');
		$data = array(
			/*column name*/
			'department' => $department
		);

		$sql = $this->db->insert('department', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}

	public function add_assets()
	{
		$response = array();

		$asset_user = $this->input->post('asset_user');
		$department = $this->input->post('department');
		$asset_name = $this->input->post('asset_name');
		$purchase_date = $this->input->post('purchase_date');
		$warranty_start = $this->input->post('warranty_start');
		$warranty_end = $this->input->post('warranty_end');
		$amount = $this->input->post('amount');
		$status = $this->input->post('status');
		$assetcondition = $this->input->post('assetcondition');
		$manufacturer = $this->input->post('manufacturer');
		$model = $this->input->post('model');
		$serial_number = $this->input->post('serial_number');
		$description = $this->input->post('description');

		$data = array(
			/*column name*/
			'asset_user' => $asset_user,
			'department' => $department,
			'asset_name' => $asset_name,
			'purchase_date' => $purchase_date,
			'warranty_start' => $warranty_start,
			'warranty_end' => $warranty_end,
			'amount' => $amount,
			'status' => $status,
			'assetCondition' => $assetcondition,
			'manufacturer' => $manufacturer,
			'model' => $model,
			'serial_number' => $serial_number,
			'description' => $description,
		);

		$sql = $this->db->insert('assets', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}


	public function search_name()
	{
		$search_query = $this->input->get('employee_name'); // Retrieve search query from GET parameter

		// Perform search query on both 'leave' and 'ot_request' tables
		$this->db->select('*');
		$this->db->from('leave');
		$this->db->where("CONCAT(fname, ' ', mname, ' ', lname) LIKE '%$search_query%'");
		$leave_results = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->from('ot_request');
		$this->db->where("CONCAT(fname, ' ', mname, ' ', lname) LIKE '%$search_query%'");
		$ot_results = $this->db->get()->result_array();

		// Combine and return search results
		$search_results = array_merge($leave_results, $ot_results);

		// Convert search results to HTML table rows
		$output = '';
		foreach ($search_results as $row) {
			$output .= "<tr>";
			$output .= "<td>" . $row['fname'] . " " . $row['mname'] . " " . $row['lname'] . "</td>";
			// Add more columns as needed
			$output .= "</tr>";
		}

		echo $output;
	}



	public function getUserCount()
	{
		// Load the model for accessing the database
		$this->load->model('hr');

		// Get the count of users from the model
		$userCount = $this->User_model->getUserCount();

		// Send the count as JSON response
		echo json_encode(['userCount' => $userCount]);
	}
}
