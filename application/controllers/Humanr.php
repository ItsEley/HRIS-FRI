<?php defined('BASEPATH') or exit('No direct script access allowed');

class Humanr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'hr');
		$this->zone = date_default_timezone_set('Asia/Manila');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function deleteEmployee()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emp_id')) {
			$empId = $this->input->post('emp_id');

			// Check if there are related records in department_roles table
			$this->db->where('assigned_emp', $empId);
			$query = $this->db->get('department_roles');
			$numRows = $query->num_rows();

			if ($numRows > 0) {
				// Delete related records in department_roles table first
				$this->db->where('assigned_emp', $empId);
				$this->db->delete('department_roles');
			}

			// Proceed with deleting the employee record
			$this->db->where('id', $empId);
			$this->db->delete('employee');

			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to delete employee']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
		}
	}

	public function C_hr_dashboard()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Dashboard';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_dashboard');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_assets()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Assets';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_assets');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_profile()
	{


		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Profile';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_profile');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_settings()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Settings';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_settings');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_announcement()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Announcement';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_announcement');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}



	public function C_hr_employees()
	{

		
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees');
			$this->load->view('templates/footer');
		
	}

	public function C_hr_employees_list()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_list');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_departments()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Departments';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_departments');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_emp_attendace()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Attendance';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_attendance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_shifts()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_shift');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_leaves()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employee_leaves');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_formshistory()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Request History';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/employee/form_request_history');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function adduser()
	{
		$response = array();
		// Extract data from POST request
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$mname = $this->input->post('mname');
		$nickn = $this->input->post('nickn');
		$current_add = $this->input->post('current_address');
		$perm_add = $this->input->post('perm_add');
		$dob = $this->input->post('dob');
		$pob = $this->input->post('pob');
		$religion = $this->input->post('religion');
		$sex = $this->input->post('sex');
		$civil_status = $this->input->post('civil_status');
		$email = $this->input->post('email');

		$password = hashPassword($this->input->post('password'));

		// Handle image upload
		if (isset($_FILES['capturedImage']) && $_FILES['capturedImage']['error'] == UPLOAD_ERR_OK) {
			// Process the uploaded image
			$image_data = file_get_contents($_FILES['capturedImage']['tmp_name']);
			// Add image data to the data array
			$pfp = $image_data;
		}
		$full_name = $fname . ' ' . $mname . ' ' . $lname;

		// Add other form data to the data array
		$data = array(
			'id' => generateEmployeeCode($full_name),
			'fname' => ucwords($fname),
			'mname' => ucwords($mname),
			'lname' => ucwords($lname),
			'nickn' => ucwords($nickn),
			'current_add' => ucwords($current_add),
			'perm_add' => ucwords($perm_add),
			'dob' => $dob,
			'pob' => ucwords($pob),
			'religion' => ucwords($religion),
			'sex' => ucwords($sex),
			'civil_status' => ucwords($civil_status),
			'email' => $email,
			'password' => $password,
			'pfp' => $pfp,

		);

		// Insert data into the database
		$sql = $this->db->insert('employee', $data);

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

	public function delete()
	{
		$emp_id = $this->input->post('emp_id');

		// Load the database library
		$this->load->database();

		// Execute the SQL query to delete the employee
		$this->db->where('emp_id', $emp_id);
		$result = $this->db->delete('employee');

		if ($result) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Failed to delete employee.'));
		}
	}


	public function showUserdetails()
	{

		try {
			// Retrieve emp_id from the query parameter using CodeIgniter's input library
			$emp_id = $this->input->post('emp_id');

			// Log emp_id to ensure it's correctly retrieved
			log_message('debug', 'Employee ID: ' . $emp_id);

			// Fetch employee details based on emp_id using the loaded model
			// array('department' => $row_department->department)
			$employee = $this->db->get_where('employee', array('id' => $emp_id));

			if ($employee->num_rows() > 0) {
				$data = array(); // Initialize an array to store all the data

				$data['status'] = "success";

				foreach ($employee->result() as $row) {
					// Add each row data to the array
					$row_data = array(
						'id' => $row->id,
						'fname' => $row->fname,
						'mname' => $row->mname,
						'lname' => $row->lname,
						'nickn' => $row->nickn,
						'current_add' => $row->current_add,
						'perm_add' => $row->perm_add,
						'dob' => $row->dob,
						'religion' => $row->religion,
						'sex' => $row->sex,
						'civil_status' => $row->civil_status,
						'pob' => $row->pob,
						'email' => $row->email
					);

					// Add the row data array to the main data array
					$data['data'] = $row_data;
				}

				// Encode the array to JSON and echo it
				echo json_encode($data);
			} else {
				$data['status'] = "failed";
				$data['detail'] = "Employee ID not found.";
				echo json_encode($data);
			}
		} catch (\Throwable $th) {
			$data['status'] = "error";
			$data['detail'] = $th;
			echo json_encode($data);
			// throw $th;
		}
	}

	public function updateUser()
	{
		// Retrieve emp_id from POST data
		$emp_id = $this->input->post('emp_id');

		// Define data to be updated
		$data = array(
			'fname' => ucwords($this->input->post('fname')),
			'mname' => ucwords($this->input->post('mname')),
			'lname' => ucwords($this->input->post('lname')),
			'nickn' => ucwords($this->input->post('nickn')),
			'current_add' => ucwords($this->input->post('current_add')),
			'perm_add' => ucwords($this->input->post('perm_add')),
			'dob' => $this->input->post('dob'),
			'religion' => ucwords($this->input->post('religion')),
			'sex' => ucwords($this->input->post('sex')),
			'civil_status' => ucwords($this->input->post('civil_status')),
			'pob' => ucwords($this->input->post('pob')),
			'contact_no' => $this->input->post('contact_no'),
			'email' => $this->input->post('email'),
			// 'password' => $this->input->post('password')
		);

		// Update the employee record
		$this->db->where('id', $emp_id);
		$sql = $this->db->update('employee', $data);

		// Prepare response
		$response = array();
		if ($sql) {
			// Update session data if necessary
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
			$response['status'] = 1;
			$response['msg'] = 'Employee data updated successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update employee data';
		}

		// Echo JSON response
		echo json_encode($response);
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



	//add 
	public function addroles()
	{
		// Initialize response array
		$response = array();

		// Get input data
		$department = $this->input->post('department_id');
		$role_name = $this->input->post('role_name');
		$salary = $this->input->post('salary');
		$salary_type = $this->input->post('salary_type');

		// Prepare data for insertion
		$data = array(
			'department' => $department,
			'roles' => $role_name,
			'salary' => $salary,
			'salary_type' => $salary_type
		);

		// Insert data using Query Builder to prevent SQL injection
		$inserted = $this->db->insert('department_roles', $data);

		// Check if insertion was successful
		if ($inserted) {
			$response['status'] = 1;
			$response['msg'] = 'Role added successfully';
			http_response_code(200); // OK
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add role';
			http_response_code(500); // Internal Server Error
		}

		// Return JSON response
		echo json_encode($response);
	}



	public function add_assets()
	{
		$response = array();

		$asset_name = $this->input->post('assetname');
		$purchase_date = $this->input->post('purchdate');
		$model = $this->input->post('model');
		$serial_number = $this->input->post('serial');
		$assetcondition = $this->input->post('condition');
		$warranty_start = $this->input->post('warranty');
		$amount = $this->input->post('amount');


		$data = array(
			/*column name*/
			
		
			'asset_name' => $asset_name,
			'purchase_date' => $purchase_date,
			'warranty_start' => $warranty_start,
			'amount' => $amount,
			'assetCondition' => $assetcondition,
			'model' => $model,
			'serial_number' => $serial_number
			
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






	public function getUserCount()
	{
		// Load the model for accessing the database
		$this->load->model('hr');

		// Get the count of users from the model
		$userCount = $this->User_model->getUserCount();

		// Send the count as JSON response
		echo json_encode(['userCount' => $userCount]);
	}

	public function pending_req()
	{
		$data['title'] = 'HR | Pendings';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/request_pending');
		$this->load->view('templates/footer');
	}
}


function generateEmployeeCode($name)
{
	// Split the name into parts
	$nameParts = explode(' ', $name);

	// Extract the first letter of the first name, middle name, and last name
	$fnameInitial = strtoupper(substr($nameParts[0], 0, 1));
	$mnameInitial = isset($nameParts[1]) ? strtoupper(substr($nameParts[1], 0, 1)) : '';
	$lnameInitial = strtoupper(substr(end($nameParts), 0, 1));

	// Generate a random 5-digit number
	$randomDigits = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);

	// Construct the employee code
	$employeeCode = "FC{$fnameInitial}{$mnameInitial}{$lnameInitial}-{$randomDigits}";

	return $employeeCode;
}

