<?php

class Admin_model extends CI_Model
{
	
	public function __construct() 
	{
		parent:: __construct();
		// $this->zone 	= date_default_timezone_set('Asia/Manila');
		// $this->datetime = date('Y-m-d H:i:s', time());
		// $this->date 	= date('Y-m-d', time());
	}


	public function authentication($email, $password) {		
    $this->db->where('email', $email);
    $this->db->where('password', $password);
    $query = $this->db->get('personal_info');    
    return $query;
	}

	public function updateUser($data, $id) {
		$updateData = array(
			'fname' => $data['fname'],
			'mname' => $data['mname'],
			'lname' => $data['lname'],
			'sex' => $data['sex'],
			'current_add' => $data['current_add'],
			'department' => $data['department'],
			'email' => $data['email'],
			'password' => $data['password'],
			'role' => $data['role'],
			'perm_add' => $data['perm_add'],
			'contact_no' => $data['contact_no'],
			'dob' => $data['dob']
		);
	
		if (!empty($_FILES['pfp']['name'])) {
			// Handle file upload
			$config['upload_path'] = 'path/to/upload/directory/';
			$config['allowed_types'] = 'gif|jpg|png'; // Adjust allowed image types as needed
			$config['max_size'] = 1024; // Maximum file size in kilobytes
			// Load CodeIgniter's upload library
			$this->load->library('upload', $config);
	
			if ($this->upload->do_upload('pfp')) {
				$uploadData = $this->upload->data();
				$updateData['pfp'] = $uploadData['file_name'];
			} else {
				// Handle file upload error
				$error = $this->upload->display_errors();
				return "error: $error";
			}
		}
	
		$this->db->where('id', $id);
		$this->db->update('personal_info', $updateData);
	
		// Check if update was successful
		if ($this->db->affected_rows() > 0) {
			return "success";
		} else {
			return "error";
		}
	}


	public function getEmployeeDetails($emp_id) {
        // Fetch employee details from the database based on emp_id
        $query = $this->db->get_where('personal_info', array('id' => $emp_id));
        
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the fetched employee details as an associative array
        } else {
            return null; // Return null if employee not found
        }
    }
	
	

	
	public function addUser($fname,$mname,$lname,$nickn,$current_add,$perm_add,$dob,$age,$religion,$sex,$civil_status,$pob,$email,$password,$department,$role) {
		
		


$addUserQuery = "INSERT INTO `personal_info`(`fname`, `mname`, `lname`,`nickn`, 
		`current_add`, `perm_add`, `dob`, `age`, `religion`,`sex`,`civil_status`,`pob`,
		`email`,`password`,`department`,`role`) 

					       VALUES ('$fname','$mname','$lname','$nickn',
						   '$current_add','$perm_add','$dob','$age','$religion','$sex','$civil_status','$pob',
						   '$email','$password','$department','$role')";
		
		$this->db->query($addUserQuery);
			echo `<script>
			alert('success!');
			</script>`;

		
		
		
	}
};