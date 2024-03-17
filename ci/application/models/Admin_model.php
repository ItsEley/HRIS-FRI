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





	// public function getUserCount()
	// {
	// 	// Execute SQL query to count rows in the users table
	// 	$query = $this->db->count_all('users');

	// 	// Return the count
	// 	return $query;
	// }

	// public function updateUser($data, $id)
	// {
	// 	$updateData = array(
	// 		'fname' => $data['fname'],
	// 		'mname' => $data['mname'],
	// 		'lname' => $data['lname'],
	// 		'sex' => $data['sex'],
	// 		'current_add' => $data['current_add'],

	// 		'email' => $data['email'],
	// 		'password' => $data['password'],
	// 		'role' => $data['role'],
	// 		'perm_add' => $data['perm_add'],
	// 		'contact_no' => $data['contact_no'],
	// 		'dob' => $data['dob']
	// 	);

	// 	if (!empty($_FILES['pfp']['name'])) {
	// 		// Handle file upload
	// 		$config['upload_path'] = 'path/to/upload/directory/';
	// 		$config['allowed_types'] = 'gif|jpg|png'; // Adjust allowed image types as needed
	// 		$config['max_size'] = 1024; // Maximum file size in kilobytes
	// 		// Load CodeIgniter's upload library
	// 		$this->load->library('upload', $config);

	// 		if ($this->upload->do_upload('pfp')) {
	// 			$uploadData = $this->upload->data();
	// 			$updateData['pfp'] = $uploadData['file_name'];
	// 		} else {
	// 			// Handle file upload error
	// 			$error = $this->upload->display_errors();
	// 			return "error: $error";
	// 		}
	// 	}

	// 	$this->db->where('id', $id);
	// 	$this->db->update('employee', $updateData);

	// 	// Check if update was successful
	// 	if ($this->db->affected_rows() > 0) {
	// 		return "success";
	// 	} else {
	// 		return "error";
	// 	}
	// }


	// public function getEmployeeDetails($emp_id)
	// {
	// 	log_message('debug', 'getEmployeeDetails function called for emp_id: ' . $emp_id);

	// 	// Escape the emp_id parameter to prevent SQL injection
	// 	$emp_id = $this->db->escape_str($emp_id);
	
	// 	// Fetch employee details from the database based on emp_id
	// 	$query = $this->db->get_where('employee', array('id' => $emp_id));
	
	// 	// Log the generated SQL query
	// 	log_message('debug', 'SQL Query: ' . $this->db->last_query());
	
	// 	if ($query->num_rows() > 0) {
	// 		// Log the fetched employee details
	// 		log_message('debug', 'Employee details: ' . print_r($query->row_array(), true));
			
	// 		return $query->row_array(); // Return the fetched employee details as an associative array
	// 	} else {
	// 		// Log that employee details were not found
	// 		log_message('debug', 'Employee details not found for emp_id: ' . $emp_id);
			
	// 		return null; // Return null if employee not found
	// 	}
	// }
	





	// public function addUser($fname, $mname, $lname, $nickn, $current_add, $perm_add, $dob, $age, $religion, $sex, $civil_status, $pob, $email, $password, $role)
	// {




	// 	$addUserQuery = "INSERT INTO `employee`(`fname`, `mname`, `lname`,`nickn`, 
	// 	`current_add`, `perm_add`, `dob`, `age`, `religion`,`sex`,`civil_status`,`pob`,
	// 	`email`,`password`,`role`) 

	// 				       VALUES ('$fname','$mname','$lname','$nickn',
	// 					   '$current_add','$perm_add','$dob','$age','$religion','$sex','$civil_status','$pob',
	// 					   '$email','$password','$role')";

	// 	$this->db->query($addUserQuery);
	// 	echo `<script>
	// 		alert('success!');
	// 		</script>`;
	// }
};
