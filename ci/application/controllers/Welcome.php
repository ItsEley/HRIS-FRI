<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
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
	public function login()
    {
      $data['title'] = 'Login Page';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/login');
      $this->load->view('templates/footer');
    }
	public function logout()
	{
		// Assuming you have loaded the session library in your autoload.php or controller constructor
		$this->session->sess_destroy();
		
		// Redirect the user to the login page or any other desired page after logout
		redirect('login');
	}

	public function auth_form()
	{
		$response = array();
		$email = $this->input->post('email', TRUE);
		$password = $this->input->post('password', TRUE);
		$validate = $this->hr->authentication($email, $password);

	
		// print_r($validate->id);

		$this->db->select('emp_id,full_name,acro_dept');
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
			$department = $data['acro_dept'];


			$session_data = array(
		
				'id' => $id,			
				'name' => $name,
				'department' => $department,	
				'logged_in' => TRUE
			);

			$this->session->set_userdata($session_data);
			
			$response['status']='success';
			$response['message']='Login success!';
			$response['user_id']= $id;
			$response['user_name']= $name;
			$response['department']= $department;
		
		}
		else 
		{
			 $response['status']='error';
			 $response['message']='Ops! Invalid username Or password';
		}

		print_r(json_encode($response));

		// return json_encode($response);

		// print_r($session_data);
		

	}


	
    public function hr_departments()
    {
      $data['title'] = 'Departments';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_departments');
      $this->load->view('templates/footer');
    }

    public function hr_employees()
    {
      $data['title'] = 'HR Employees';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_employees');
      $this->load->view('templates/footer');
	}


    public function C_hr_announcement()
    {
      $data['title'] = 'HR Announcement';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr/hr_announcement');
      $this->load->view('templates/footer');

    }


    public function dashboard_ng_hr()
    {
      $data['title'] = 'HR Announcement';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_home');
      $this->load->view('templates/footer');

    }

}
