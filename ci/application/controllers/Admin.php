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
			$role = $data['department'];
			
			$session_data = array(
				'id' => $id,
				'fname' => $fname,
				'mname' => $mname,
				'lname' => $lname,
				'email' => $email,
				'password' => $password,
				'department' => $role,			
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

	public function dash() {
		if ($this->session->userdata('logged_in') === TRUE) {
			$data['title'] = 'Administrator';
			
			$this->load->view('pages/about');
		}else {
			redirect('auth');
		}
	}


	public function view_logo() {
		$data = $this->admin->logo();
		echo json_encode($data);
	}
	public function logout() 
	{
     $this->session->sess_destroy();
     redirect('auth');
  }
}
?>