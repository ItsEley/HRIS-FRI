<?php defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'hr');
		$this->zone = date_default_timezone_set('Asia/Manila');
	}

	public function emphome()
	{
		$data['title'] = 'Employee | Home';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_home');
		$this->load->view('templates/footer');
	}

	public function emp_profile()
	{
		$data['title'] = 'Employee | Profile';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_profile');
		$this->load->view('templates/footer');
	}


	
	public function emp_setting()
	{
		$data['title'] = 'Employee | Setting';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_setting');
		$this->load->view('templates/footer');
	}



	public function emp_report_attendance()
	{
		$data['title'] = 'Reports | Attendance';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_report_attendance');
		$this->load->view('templates/footer');
	}


	
	public function emp_report_payslip()
	{
		$data['title'] = 'Reports | Payslip';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/employee_payslip');
		$this->load->view('templates/footer');
	}


	public function forms()
	{
		$data['title'] = 'Employee | Forms';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/public/forms');
		$this->load->view('templates/footer');
	}

	public function head_announcement()
	{
		$data['title'] = 'Head | Announcements';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/employee/head_announcement');
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
	public function C_leave()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$leaveType = $this->input->post('leaveType');
		$reason = $this->input->post('reason');
		$empid = $this->input->post('emp_id');
		$department = $_SESSION['department'];
		$session_role = $_SESSION['role'];
	
		// Check if there are any pending leave requests for the employee
		$this->db->where('emp_id', $empid);
		$this->db->where('head_status', 'pending');
		$query_pending_leave = $this->db->get('f_leaves');
	
		if ($query_pending_leave->num_rows() > 0) {
			// There are pending leave requests for the employee
			$response['status'] = 0;
			$response['msg'] = 'You have a pending leave request. Please wait for approval before submitting a new request.';
		} else {
			// No pending leave requests, proceed with inserting the new leave request
	
			$this->db->select('id');
			$this->db->where('department', $department);
			$query_department = $this->db->get('department');
			$department_row = $query_department->row();
	
			if ($department_row) {
				$department_id = $department_row->id;
				$this->db->select('id, roles');
				$this->db->where('roles', 'Head');
				$query_roles = $this->db->get('department_roles');
				$roles_rows = $query_roles->result();
	
				if ($roles_rows) {
					foreach ($roles_rows as $roles_row) {
						$roles = $roles_row->roles;
						$role_id = $roles_row->id;
	
						$session_role = $_SESSION['role'];
						$session_emp = $_SESSION['id'];
						$head_status = ($session_role == "Head") ? 'approved' : 'pending';
						$head_id = ($session_role == "Head") ? $session_emp : null;
	
						error_log("Role ID: $role_id, Session Role: $session_role, Head Status: $head_status");
	
						$data = array(
							'date_from' => $from_date,
							'date_to' => $to_date,
							'type_of_leave' => $leaveType,
							'reason' => $reason,
							'date_filled' => $date_filled,
							'emp_id' => $empid,
							'department' => $department_id,
							'head_status' => $head_status,
						);
						$sql = $this->db->insert('f_leaves', $data);
						if ($sql) {
							$response['status'] = 1;
							$response['msg'] = 'Leave request submitted successfully.';
							$response['session_role'] = $session_role;
							$response['role_id'] = $role_id;
							break;
						} else {
							$response['status'] = 0;
							$response['msg'] = 'Error';
							$response['session_role'] = $session_role;
							$response['role_id'] = $role_id;
						}
						$response['role_id'] = $role_id;
						$response['session_role'] = $session_role;
						$response['role_id'] = $role_id;
					}
				} else {
					$response['status'] = 0;
					$response['msg'] = 'Role not found';
				}
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Department not found';
			}
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
		$department_name = $_SESSION['department'];
	
		// Check if there are any pending off business requests for the employee
		$this->db->where('emp_id', $empid);
		$this->db->where('head_status', 'pending');
		$query_pending_off_buss = $this->db->get('f_off_bussiness');
	
		if ($query_pending_off_buss->num_rows() > 0) {
			// There are pending off business requests for the employee
			$response['status'] = 0;
			$response['msg'] = 'You have a pending off business request. Please wait for approval before submitting a new request.';
		} else {
			// No pending off business requests, proceed with inserting the new off business request
	
			$this->db->select('id');
			$this->db->where('department', $department_name);
			$query = $this->db->get('department');
			$department_row = $query->row();
	
			if ($department_row) {
				$department_id = $department_row->id;
				$session_role = $_SESSION['role'];
				$session_emp = $_SESSION['id'];
				$head_status = ($session_role == "Head") ? 'approved' : 'pending';
				$head_id = ($session_role == "Head") ? $session_emp : null;
	
				$data = array(
					'destin_from' => $destin_from,
					'destin_to' => $destin_to,
					'time_from' => $time_from,
					'time_to' => $time_to,
					'date' => $outgoing_pass_date,
					'date_filled' => $date_filled,
					'reason' => $reason,
					'emp_id' => $empid,
					'department' => $department_id,
					'head_status' => $head_status
				);
	
				$sql = $this->db->insert('f_off_bussiness', $data);
	
				if ($sql) {
					$response['status'] = 1;
					$response['msg'] = 'Off business request submitted successfully.';
				} else {
					$response['status'] = 0;
					$response['msg'] = 'Error';
				}
			} else {
				$response['status'] = 0;
				$response['msg'] = 'Department not found';
			}
		}
		echo json_encode($response);
	}
	

	public function C_off_buss1()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$outgoing_pass_date = $this->input->post('outgoing_pass_date');
		$destin_from = $this->input->post('destin_from');
		$destin_to = $this->input->post('destin_to');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$empid = $this->input->post('emp_id');
		$status = $this->input->post('status');

		$data = array(
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
    $department_name = $_SESSION['department'];

    // Check if there are any pending outgoing requests for the employee
    $this->db->where('emp_id', $empid);
    $this->db->where('head_status', 'pending');
    $query_pending_outgoing = $this->db->get('f_outgoing');

    if ($query_pending_outgoing->num_rows() > 0) {
        // There are pending outgoing requests for the employee
        $response['status'] = 0;
        $response['msg'] = 'You have a pending outgoing request. Please wait for approval before submitting a new request.';
    } else {
        // No pending outgoing requests, proceed with inserting the new outgoing request

        $this->db->select('id');
        $this->db->where('department', $department_name);
        $query = $this->db->get('department');
        $department_row = $query->row();

        if ($department_row) {
            $department_id = $department_row->id;
            $session_role = $_SESSION['role'];
            $session_emp = $_SESSION['id'];
            $head_status = ($session_role == "Head") ? 'approved' : 'pending';
            $head_id = ($session_role == "Head") ? $session_emp : null;

            $data = array(
                'date_filled' => $outgoing_date,
                'time_from' => $time_from,
                'time_to' => $time_to,
                'going_to' => $destination,
                'reason' => $reason,
                'department' => $department_id,
                'emp_id' => $empid,
                'head_status' => $head_status,
            );
            $sql = $this->db->insert('f_outgoing', $data);

            if ($sql) {
                $response['status'] = 1;
                $response['msg'] = 'Outgoing request submitted successfully.';
            } else {
                $response['status'] = 0;
                $response['msg'] = 'Error';
            }
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Department not found';
        }
    }
    echo json_encode($response);
}



public function C_undertime()
{
    $response = array();
    $undertime_date = $this->input->post('undertime_date');
    $time_in = $this->input->post('time_in');
    $time_out = $this->input->post('time_out');
    $reason = $this->input->post('reason');
    $empid = $this->input->post('emp_id');
    $department_name = $_SESSION['department'];

    // Check if there are any pending undertime requests for the employee
    $this->db->where('emp_id', $empid);
    $this->db->where('head_status', 'pending');
    $query_pending_undertime = $this->db->get('f_undertime');

    if ($query_pending_undertime->num_rows() > 0) {
        // There are pending undertime requests for the employee
        $response['status'] = 0;
        $response['msg'] = 'You have a pending undertime request. Please wait for approval before submitting a new request.';
    } else {
        // No pending undertime requests, proceed with inserting the new undertime request

        $this->db->select('id');
        $this->db->where('department', $department_name);
        $query = $this->db->get('department');
        $department_row = $query->row();

        if ($department_row) {
            $department_id = $department_row->id;
            $session_role = $_SESSION['role'];
            $session_emp = $_SESSION['id'];
            $head_status = ($session_role == "Head") ? 'approved' : 'pending';
            $head_id = ($session_role == "Head") ? $session_emp : null;

            $data = array(
                'date_filled' => $undertime_date,
                'date_of_undertime' => $undertime_date,
                'time_in' => $time_in,
                'time_out' => $time_out,
                'reason' => $reason,
                'emp_id' => $empid,
                'department' => $department_id,
                'head_status' => $head_status,
            );
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
    }

    echo json_encode($response);
}


public function C_overtime()
{
    $response = array();
    $date_filled = date('Y-m-d H:i:s', time());
    $ot_date = $this->input->post('ot_date');
    $time_in = $this->input->post('from_time');
    $time_out = $this->input->post('to_time');
    $reason = $this->input->post('reason');
    $empid = $this->input->post('emp_id');
    $department_name = $_SESSION['department'];

    // Check if there are any pending overtime requests for the employee
    $this->db->where('emp_id', $empid);
    $this->db->where('head_status', 'pending');
    $query_pending_overtime = $this->db->get('f_overtime');

    if ($query_pending_overtime->num_rows() > 0) {
        // There are pending overtime requests for the employee
        $response['status'] = 0;
        $response['msg'] = 'You have a pending overtime request. Please wait for approval before submitting a new request.';
    } else {
        // No pending overtime requests, proceed with inserting the new overtime request

        $this->db->select('id');
        $this->db->where('department', $department_name);
        $query = $this->db->get('department');
        $department_row = $query->row();

        if ($department_row) {
            $department_id = $department_row->id;

            $session_role = $_SESSION['role'];
            $session_emp = $_SESSION['id'];
            $head_status = ($session_role == "Head") ? 'approved' : 'pending';
            $head_id = ($session_role == "Head") ? $session_emp : null;

            $data = array(
                'date_filled' => $date_filled,
                'date_ot' => $ot_date,
                'time_in' => $time_in,
                'time_out' => $time_out,
                'reason' => $reason,
                'emp_id' => $empid,
                'department' => $department_id,
                'head_status' => $head_status,
            );
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
    }

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
		$department_name = $_SESSION['department'];

		$this->db->select('id');
		$this->db->where('department', $department_name);
		$query = $this->db->get('department');
		$department_row = $query->row();

		if ($department_row) {
			$department_id = $department_row->id;
			$session_role = $_SESSION['role'];
			$session_emp = $_SESSION['id'];
			$head_status = ($session_role == "Head") ? 'approved' : 'pending';
			$head_id = ($session_role == "Head") ? $session_emp : null;

			$data = array(
				'date_filled' => $date_filled,
				'change_day_from' => $change_day_from,
				'change_day_to' => $change_day_to,
				'change_time_from' => $change_time_from,
				'change_time_to' => $change_time_to,
				'reason' => $reason,
				'status' => $status,
				'emp_id' => $empid,
				'department' => $department_id
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
