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
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_dashboard');
      $this->load->view('templates/footer');

    }

	public function C_hr_assets()
    {
      $data['title'] = 'HR | Assets';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_assets');
      $this->load->view('templates/footer');

    }

	public function C_hr_profile()
    {
      $data['title'] = 'HR | Profile';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_profile');
      $this->load->view('templates/footer');
    }
	public function C_hr_settings()
    {
      $data['title'] = 'HR | Profile';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_settings');
      $this->load->view('templates/footer');
    }


    public function C_hr_announcement()
    {
      $data['title'] = 'HR | Announcement';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_announcement');
      $this->load->view('templates/footer');

    }



	public function C_hr_employees()
    {
      $data['title'] = 'HR | Employees';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_employees');
      $this->load->view('templates/footer');

    }
  

    public function C_hr_departments()
    {
      $data['title'] = 'HR | Departments';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_departments');
      $this->load->view('templates/footer');
    }
	

 

    public function C_hr_emp_attendace()
    {
      $data['title'] = 'Employee | Attendance';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_attendance');
      $this->load->view('templates/footer');
    }


	
	public function C_hr_emp_shifts()
    {
      $data['title'] = 'HR | Employees';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_employees_shift');
      $this->load->view('templates/footer');

    }
  

	
    public function C_formshistory()
    {
      $data['title'] = 'Employee | Request History';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/employee/form_request_history');
      $this->load->view('templates/footer');
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
    // Retrieve emp_id from the query parameter using CodeIgniter's input library
    $emp_id = $this->input->get('emp_id');
    
    // Log emp_id to ensure it's correctly retrieved
    log_message('debug', 'Employee ID: ' . $emp_id);

    // Fetch employee details based on emp_id using the loaded model
    $employee = $this->db->get_where('employee', array('id' => $emp_id));

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($employee);
}

	public function updateUser()
	{
		$response = array();
		// $id = $_SESSION['id'];
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

		$this->db->where('id', $emp_id);
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
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/request_pending');
      $this->load->view('templates/footer');
    }


}
