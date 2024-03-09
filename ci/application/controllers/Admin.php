<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->load->view('templates/header',$data);
		$this->load->view('pages/login');
		$this->load->view('templates/footer');
	}
	

	public function auth_form() {
		$response = array();
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);
		$validate = $this->hr->authentication($email, $password);

		if ($validate->num_rows() > 0) 
		{
			$data = $validate->row_array();
			$id = $data['id'];
			$fname = $data['fname'];
			$mname = $data['mname'];
			$lname = $data['lname'];
			$email = $data['email'];
			$password = $data['password'];
			$department = $data['department'];
			$role = $data['role'];
			$dob = $data['dob'];
			$religion = $data['religion'];
			$civil_status = $data['civil_status'];
			$current_add = $data['current_add'];
			$perm_add = $data['perm_add'];
			$contact_no = $data['contact_no'];
			
			$sex = $data['sex'];
			$pfp = $data['pfp'];
			

			
			$session_data = array(
				'id' => $id,
				'fname' => $fname,
				'mname' => $mname,
				'lname' => $lname,
				'email' => $email,
				'password' => $password,
				'department' => $department,
				'role' => $role,
				'dob' => $dob,
				'religion' => $religion,
				'civil_status' => $civil_status,
				'current_add' => $current_add,	
				'perm_add' => $perm_add,	
				'contact_no' => $contact_no,	
				'sex' => $sex,	
				'pfp' => $pfp,								
				'logged_in' => TRUE
			);

			$this->session->set_userdata($session_data);
		}
		else 
		{
			 $response['status']='error';
       $response['message']='Ops! Invalid username Or password';
		}
		echo json_encode($response);
	}

	public function addUser() {
		$datetime = date('Y-m-d H:i:s', time());
		$response = array();

		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$nickn = $this->input->post('nickn');
		$current_add = $this->input->post('current_add');
		$perm_add = $this->input->post('perm_add');
		$dob = $this->input->post('dob');
		$age = $this->input->post('age');
		$religion = $this->input->post('religion');
		$sex = $this->input->post('sex');
		$civil_status = $this->input->post('civil_status');
		$pob = $this->input->post('pob');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$department = $this->input->post('department');
		$role = $this->input->post('role');
		$contact_no = $this->input->post('contact_no');
		
		// $pfp = $this->input->post('pfp');

		$data = array( 
		/*column name*/'fname' => $fname,
		'mname' => $mname,
		'lname' => $lname,
		'nickn' => $nickn,
		'current_add' => $current_add,
		'perm_add' => $perm_add,
		'dob' => $dob,
		'age' => $age,
		'religion' => $religion,
		'sex' => $sex,
		'civil_status' => $civil_status,
		'pob' => $pob,
		'email' => $email,
		'password' => $password,
		'role' => $role,
		'department' => $department,
		
		'contact_no' => $contact_no
		 /*variable name*/,
		);

		$sql = $this->db->insert('personal_info',$data);

		if($sql){
			$response['status'] = 1;
			$response['msg'] = 'Done';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
		
		// $result = $this->hr->addUser($fname,$mname,$lname,$nickn,$current_add,
		// $perm_add,$dob,$age,$religion,$sex,$civil_status,$pob,$email,$password,$department,$role);
		// echo json_encode($result);
	}


	public function showUserdetails() {
		// Retrieve emp_id from the query parameter
		$emp_id = $this->input->get('emp_id');
		
		// Fetch employee details based on emp_id using the loaded model
		$employee = $this->hr->getEmployeeDetails($emp_id);
		
		// Return JSON response
		header('Content-Type: application/json');
		echo json_encode($employee);
	}
	
	public function updateUser() {
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
		$sql = $this->db->update('personal_info', $data);
	
		if($sql){
			// Update session data
			foreach($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
	
			$response['status'] = 1;
			$response['msg'] = 'Done';
		}else{
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
	
		echo json_encode($response);

		redirect('pages/hr_profile');
	}

	public function dash() {
		if ($this->session->userdata('logged_in') === TRUE) {
			$data['title'] = 'TItle';
			
			$this->load->view('pages/hr_home');
		}else {
			redirect('pages/login');
		}
	}



	public function logout() 
	{
     $this->session->sess_destroy();
     redirect('pages/login');
  }


  public function add_announce() {
	$datetime = date('Y-m-d H:i:s', time());
	$response = array();

	$title = $this->input->post('title');
	$department = $this->input->post('department');
	$content = $this->input->post('content');
	$postdate = $this->input->post('postdate');

	$data = array( 
	/*column name*/'title' => $title,
	'department' => $department,
	'content' => $content,
	'date_created' => $postdate
	);

	$sql = $this->db->insert('announcement',$data);

	if($sql){
		$response['status'] = 1;
		$response['msg'] = 'Done';
	}else{
		$response['status'] = 0;
		$response['msg'] = 'Error';
	}

	echo json_encode($response);
	
	// $result = $this->hr->addUser($fname,$mname,$lname,$nickn,$current_add,
	// $perm_add,$dob,$age,$religion,$sex,$civil_status,$pob,$email,$password,$department,$role);
	// echo json_encode($result);
}

public function leaverequestzz() {
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

	$sql = $this->db->insert('leaves',$data);

	if($sql){
		$response['status'] = 1;
		$response['msg'] = 'Done';
	}else{
		$response['status'] = 0;
		$response['msg'] = 'Error';
	}

	echo json_encode($response);
	
	// $result = $this->hr->addUser($fname,$mname,$lname,$nickn,$current_add,
	// $perm_add,$dob,$age,$religion,$sex,$civil_status,$pob,$email,$password,$department,$role);
	// echo json_encode($result);
}












}
?>