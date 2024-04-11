<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'hr');
		$this->load->model('Login_model', 'login');

		$this->zone = date_default_timezone_set('Asia/Manila');
		$this->load->library('session');
		$this->load->helper('url');
	}


	// public function loginUI()
	// {

	// 		$data['title'] = 'Login';
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('pages/login');
	// 		$this->load->view('templates/footer');
	// }
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			// If the user is already logged in, redirect them to a different page
			if(strtolower($_SESSION['department']) == 'hr'){
				redirect(base_url('hr/dashboard')); // Change 'dashboard' to the appropriate page
			}else if(strtolower($_SESSION['department']) == 'sys-at'){

			}else{
				redirect(base_url('employee/dashboard')); // Change 'dashboard' to the appropriate page

			}
		} else {
			// If the user is not logged in, load the login page
			$data['title'] = 'Login';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/login');
			$this->load->view('templates/footer');
		}
	}

	public function logout()
	{
		// Assuming you have loaded the session library in your autoload.php or controller constructor
		$this->session->sess_destroy();
		// Redirect the user to the login page or any other desired page after logout
		redirect('welcome');
	}


	public function login()
{
    $response = array();
    $username = $this->input->post('email', TRUE);
    $password = md5($this->input->post('password', TRUE));
    $validate = $this->login->authenticate($username, $password); // Call authenticate directly, as the model is not initialized

	if ($validate->num_rows() > 0) {
    $data = $validate->row_array();
    $emp_id1 = $data['id'];
	$emp_id2 = $data['employee_id'];
    $fullname = $data['fname'].' '.$data['lname'];
    $role = $data['emp_role'];
    $department = $data['department'];
    $acrodept = $data['acro_dept'];
    $pfp = $data['pfp'];


    $response['status'] = 1;
    $response['message'] = "Welcome to FamCO HR System";
    $response['acro_dept'] = $acrodept;


    $session_data = array(
      'id' => $emp_id1,
	  'id2' => $emp_id2,
      'fullname' => $fullname,
      'pfp' => $pfp,
      'role' => $role,
      'department' => $department,
      'acro' => $acrodept,
      'logged_in' => TRUE
    );
    $this->session->set_userdata($session_data);
	}else{
    $response['status'] = 0;
    $response['message'] = 'Unable To Access!';
  }
  echo json_encode($response);
}

	
}
