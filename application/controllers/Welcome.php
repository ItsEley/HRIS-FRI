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
		$validate = $this->login->authenticate($username, $password);

		
			// print_r($validate);

		if ($validate['status'] == 1) {

			// echo 'login()-status : ' . $validate['status'] . "--";

			$emp_id = $validate['emp_id'];

			$query = $this->db->query("SELECT emp_id,acro_dept,full_name,roles FROM `vw_emp_designation`
										WHERE emp_id = '$emp_id'");

			if ($query->num_rows() > 0) {
				// print_r($query->row_array());
				$data = $query->row_array();
		
				$response = array(
					'status' => $validate['status'],
					'emp_id' => $validate['emp_id'],
					'name' => $data['full_name'],
					'department' => $data['acro_dept'],
					'roles' => $data['roles'],
					'logged_in' => TRUE
				);

				$this->session->set_userdata($response);
	
			}
			// echo "responseee";
			echo json_encode($response);
		} else {
			// echo "status 00";

			echo json_encode($validate);
		}

	}
}
