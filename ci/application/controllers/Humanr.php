<?php defined('BASEPATH') or exit('No direct script access allowed');

class Humanr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'hr');
		$this->zone = date_default_timezone_set('Asia/Manila');
	}


	public function C_hr_dashboard()
	{
		$data['title'] = 'HR | Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_dashboard');
		$this->load->view('templates/footer');
	}

	public function C_hr_assets()
	{
		$data['title'] = 'HR | Assets';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_assets');
		$this->load->view('templates/footer');
	}

	public function C_hr_profile()
	{
		$data['title'] = 'HR | Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_profile');
		$this->load->view('templates/footer');
	}
	public function C_hr_settings()
	{
		$data['title'] = 'HR | Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_settings');
		$this->load->view('templates/footer');
	}


	public function C_hr_announcement()
	{
		$data['title'] = 'HR | Announcement';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_announcement');
		$this->load->view('templates/footer');
	}



	public function C_hr_employees()
	{
		$data['title'] = 'HR | Employees';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_employees');
		$this->load->view('templates/footer');
	}


	public function C_hr_departments()
	{
		$data['title'] = 'HR | Departments';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_departments');
		$this->load->view('templates/footer');
	}




	public function C_hr_emp_attendace()
	{
		$data['title'] = 'Employee | Attendance';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_attendance');
		$this->load->view('templates/footer');
	}



	public function C_hr_emp_shifts()
	{
		$data['title'] = 'HR | Employees';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_employees_shift');
		$this->load->view('templates/footer');
	}



	public function C_formshistory()
	{
		$data['title'] = 'Employee | Request History';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/form_request_history');
		$this->load->view('templates/footer');
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


		$full_name = $fname .' '.$mname.' '.$lname;
		

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
        'fname' => $this->input->post('fname'),
        'mname' => $this->input->post('mname'),
        'lname' => $this->input->post('lname'),
        'dob' => $this->input->post('dob'),
        'current_add' => $this->input->post('current_add'),
        'sex' => $this->input->post('sex'),
        'perm_add' => $this->input->post('perm_add'),
        'contact_no' => $this->input->post('contact_no'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password')
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

// // Example usage
// $name = "Jake Sebastian S. Forbes";
// $name = "Lorenz Angelo T. Guillero";
// $employeeId = generateEmployeeCode($name);
// echo "Employee ID: " . $employeeId;
