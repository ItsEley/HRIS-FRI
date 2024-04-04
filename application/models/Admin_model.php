<?php

class Admin_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->zone 	= date_default_timezone_set('Asia/Manila');
		// $this->datetime = date('Y-m-d H:i:s', time());
		// $this->date 	= date('Y-m-d', time());


	}

	public function authentication($email, $password)
	{
		$response = array();
		$status ='';
		$code = '';
		$message = '';

		// echo 'eee'. $email.'pass'.$password;

		//check if provided $email is an 'email' or 'emp_id'

		$this->db->where('email', $email);
		$query = $this->db->get('employee');

		if ($query->num_rows() > 0) {
			// User with provided email exists
			$col = "email";
		} else {
			// No user found with provided email
			// Let's check if the provided email is actually an employee ID
			$this->db->where('id', $email);
			$query = $this->db->get('employee');

			if ($query->num_rows() > 0) {
				$col = "id";
		
			} else {
				// No user found with provided email or ID 
				// return "Login failed. Please check your credentials and try again.";

				$status = 'failed';
				$code = 'E-0';
				$message = 'Login failed. Please check your credentials and try again.e:'.$email.';p:'.$password;
		

				array_push($response,$status,$code,$message);

				echo json_encode($response);
				exit(); // Exit the script after sending the response
			
			}
		}
		// return $response;


		//once found, retrieve password and verify
		$this->db->select('password');
		$this->db->from('employee');
		$this->db->where($col, $email);

		$query = $this->db->get();

		if ($query) {
			// Check if the query was successful
			if ($query->num_rows() > 0) {
				// Fetch the hashed password from the query result
				$hashed_pass = $query->row()->password;
				// return $hashed_pass;
			} else {
				// No rows found with the provided email address or column value
				return null; // Or handle accordingly
			}
		}else{
			// Database query failed, handle the error
			$error_message = $this->db->error()['message'];
			return "Database Error: " . $error_message;
		}

		//verify the password
		$pass_verify = verify($password, $hashed_pass);

		if($pass_verify == 1){
			//get user id
			$this->db->select('id');
			$this->db->from('employee');
			$this->db->where($col, $email);
	
			$query = $this->db->get();
			// Check if the query was successful
			if ($query->num_rows() > 0) {
				// Fetch the hashed password from the query result
				$query = $query->row();
				return $query;
				// return $hashed_pass;
			} else {
				// No rows found with the provided email address or column value
				return null; // Or handle accordingly
			}

		
		}else{
			return "Password Incorrect. Please try again.";
		}



	}





};
