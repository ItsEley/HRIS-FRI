<?php defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'hr');
		$this->zone = date_default_timezone_set('Asia/Manila');
	}


	public function forms()
	{
		$data['title'] = 'Employee | Forms';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/public/forms');
		$this->load->view('templates/footer');
	}


	public function head_approval()
	{
		$data['title'] = 'Head | Approval';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/head_approval');
		$this->load->view('templates/footer');
	}

	public function head_history()
	{
		$data['title'] = 'Head | History';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/head_history');
		$this->load->view('templates/footer');
	}

	public function pendingrequest()
	{
		$data['title'] = 'Employee | Pendings';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/request_pending');
		$this->load->view('templates/footer');
	}


	public function emphome()
	{
		$data['title'] = 'Employee | Home';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_home');
		$this->load->view('templates/footer');
	}



	public function C_leave()
{
    $response = array();

    $date_filled = date('Y-m-d H:i:s', time());
    $from_date = $this->input->post('from_date');
    $to_date = $this->input->post('to_date');
    $leaveType = $this->input->post('leaveType');
    $reason = $this->input->post('reason');
   
    $empid = $this->input->post('emp_id');

    // Get the department name from session
    $department_name = $_SESSION['department'];

    // Query the department table to get the department ID
    $this->db->select('id');
    $this->db->where('department', $department_name);
    $query = $this->db->get('department');
    $department_row = $query->row();

    if ($department_row) {
        $department_id = $department_row->id;

        // Prepare data for insertion
        $data = array(
            'date_from' => $from_date,
            'date_to' => $to_date,
            'type_of_leave' => $leaveType,
            'reason' => $reason,
         
            'date_filled' => $date_filled,
            'emp_id' => $empid,
            'department' => $department_id, // Use the department ID obtained from the query
        );

        // Insert data into the f_leaves table
        $sql = $this->db->insert('f_leaves', $data);
        if ($sql) {
            $response['status'] = 1;
            $response['msg'] = 'Done';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Error';
        }
    } else {
        $response['status'] = 0;
        $response['msg'] = 'Department not found';
    }

    echo json_encode($response);
}

public function C_off_buss()
{
    $response = array();
    $name = $this->input->post('name');
    $date_filled = date('Y-m-d H:i:s', time());
    $outgoing_pass_date = $this->input->post('outgoing_pass_date');
    $destin_from = $this->input->post('destin_from');
    $destin_to = $this->input->post('destin_to');
    $time_from = $this->input->post('time_from');
    $time_to = $this->input->post('time_to');
    $reason = $this->input->post('reason');
    $empid = $this->input->post('emp_id');
    $status = $this->input->post('status');

    // Get the department name from session
    $department_name = $_SESSION['department'];

    // Query the department table to get the department ID
    $this->db->select('id');
    $this->db->where('department', $department_name);
    $query = $this->db->get('department');
    $department_row = $query->row();

    if ($department_row) {
        $department_id = $department_row->id;

        // Prepare data for insertion
        $data = array(
            'destin_from' => $destin_from,
            'destin_to' => $destin_to,
            'time_from' => $time_from,
            'time_to' => $time_to,
            'date' => $outgoing_pass_date,
            'date_filled' => $date_filled,
            'reason' => $reason,
            'emp_id' => $empid,
            'department' => $department_id, // Add department ID to the data array
        );

        // Insert data into the f_off_bussiness table
        $sql = $this->db->insert('f_off_bussiness', $data);

        if ($sql) {
            $response['status'] = 1;
            $response['msg'] = 'Done';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Error';
        }
    } else {
        $response['status'] = 0;
        $response['msg'] = 'Department not found';
    }

    echo json_encode($response);
}


	public function C_off_buss1()
	{
		$response = array();

		$date_filled = date('Y-m-d H:i:s', time());
		// $department = $this->input->post('department');

		$outgoing_pass_date = $this->input->post('outgoing_pass_date');
		$destin_from = $this->input->post('destin_from');
		$destin_to = $this->input->post('destin_to');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$empid = $this->input->post('emp_id');
		$status = $this->input->post('status');


		$data = array(
			/*column name*/
			'destin_from' => $destin_from,
			'destin_to' => $destin_to,
			'time_from' => $time_from,
			'time_to' => $time_to,
			'date' => $outgoing_pass_date,
			'date_filled' => $date_filled,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
		);

		$sql = $this->db->insert('f_off_bussiness', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}

	public function C_outgoing()
	{
		$response = array();
	
		$outgoing_date = $this->input->post('outgoing_date');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$destination = $this->input->post('destination');
		$reason = $this->input->post('reason');
		$empid = $this->input->post('emp_id');
	
		// Get the department name from session
		$department_name = $_SESSION['department'];
	
		// Query the department table to get the department ID
		$this->db->select('id');
		$this->db->where('department', $department_name);
		$query = $this->db->get('department');
		$department_row = $query->row();
	
		if ($department_row) {
			$department_id = $department_row->id;
	
			// Prepare data for insertion
			$data = array(
				'date_filled' => $outgoing_date,
				'time_from' => $time_from,
				'time_to' => $time_to,
				'going_to' => $destination,
				'reason' => $reason,
				'department' => $department_id, // Use department ID instead of name
				'emp_id' => $empid,
			);
	
			// Insert data into the f_outgoing table
			$sql = $this->db->insert('f_outgoing', $data);
	
			if ($sql) {
				$response['status'] = 1;
				$response['msg'] = 'Done';
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Error';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Department not found';
		}
	
		echo json_encode($response);
	}
	

	public function C_undertime()
	{
		$response = array();
	
		// Get input data
		$undertime_date = $this->input->post('undertime_date');
		$time_in = $this->input->post('time_in');
		$time_out = $this->input->post('time_out');
		$reason = $this->input->post('reason');
		$status = "Pending"; // Set status to "Pending"
		$empid = $this->input->post('emp_id');
	
		// Get the department name from session
		$department_name = $_SESSION['department'];
	
		// Query the department table to get the department ID
		$this->db->select('id');
		$this->db->where('department', $department_name);
		$query = $this->db->get('department');
		$department_row = $query->row();
	
		if ($department_row) {
			$department_id = $department_row->id;
	
			// Prepare data array for insertion
			$data = array(
				'date_filled' => $undertime_date,
				'date_of_undertime' => $undertime_date,
				'time_in' => $time_in,
				'time_out' => $time_out,
				'reason' => $reason,
				'status' => $status, // Use the status variable set above
				'emp_id' => $empid,
				'department' => $department_id // Add department ID to the data array
			);
	
			// Insert data into the database
			$sql = $this->db->insert('f_undertime', $data);
			if ($sql) {
				$response['status'] = 1;
				$response['msg'] = 'Undertime request submitted successfully.';
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Error occurred while submitting the undertime request.';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Department not found';
		}
	
		// Send JSON response
		echo json_encode($response);
	}
	

	public function C_overtime()
	{
		$response = array();
	
		// Get current date and time
		$date_filled = date('Y-m-d H:i:s', time());
	
		// Get input data
		$ot_date = $this->input->post('ot_date');
		$time_in = $this->input->post('from_time');
		$time_out = $this->input->post('to_time');
		$reason = $this->input->post('reason');
		$status = "Pending"; // Set status to "Pending"
		$empid = $this->input->post('emp_id');
	
		// Get the department name from session
		$department_name = $_SESSION['department'];
	
		// Query the department table to get the department ID
		$this->db->select('id');
		$this->db->where('department', $department_name);
		$query = $this->db->get('department');
		$department_row = $query->row();
	
		if ($department_row) {
			$department_id = $department_row->id;
	
			// Prepare data array for insertion
			$data = array(
				'date_filled' => $date_filled,
				'date_ot' => $ot_date,
				'time_in' => $time_in,
				'time_out' => $time_out,
				'reason' => $reason,
				'status' => $status, // Use the status variable set above
				'emp_id' => $empid,
				'department' => $department_id // Add department ID to the data array
			);
	
			// Insert data into the database
			$sql = $this->db->insert('f_overtime', $data);
			if ($sql) {
				$response['status'] = 1;
				$response['msg'] = 'Overtime request submitted successfully.';
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Error occurred while submitting the overtime request.';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Department not found';
		}
	
		// Send JSON response
		echo json_encode($response);
	}
	

	public function C_sched_adjust()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$change_day_from = $this->input->post('date_from');
		$change_day_to = $this->input->post('date_to');
		$change_time_from = $this->input->post('time_from');
		$change_time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('emp_id');
	
		// Get the department name from session
		$department_name = $_SESSION['department'];
	
		// Query the department table to get the department ID
		$this->db->select('id');
		$this->db->where('department', $department_name);
		$query = $this->db->get('department');
		$department_row = $query->row();
	
		if ($department_row) {
			$department_id = $department_row->id;
	
			$data = array(
				/*column name*/
				'date_filled' => $date_filled,
				'change_day_from' => $change_day_from,
				'change_day_to' => $change_day_to,
				'change_time_from' => $change_time_from,
				'change_time_to' => $change_time_to,
				'reason' => $reason,
				'status' => $status,
				'emp_id' => $empid,
				'department' => $department_id // Add department ID to the data array
			);
	
			$sql = $this->db->insert('f_worksched_adj', $data);
			if ($sql) {
				$response['status'] = 1;
				$response['msg'] = 'Done';
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Error';
			}
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Department not found';
		}
	
		echo json_encode($response);
	}
}