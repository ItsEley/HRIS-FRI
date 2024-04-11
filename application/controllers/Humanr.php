<?php defined('BASEPATH') or exit('No direct script access allowed');

class Humanr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Admin_model', 'hr');
		// $this->zone = date_default_timezone_set('Asia/Manila');
		// $this->load->library('session');
		// $this->load->helper('url');
	}

	// public function hrapprove() {
	// 	$rowId = $this->input->post('rowId');
	// 	$session_emp_id = $this->session->userdata('id2');
	
	// 	$this->db->set('status', 'approved');
	// 	$this->db->set('hr_id', $session_emp_id);
	// 	$this->db->where('id', $rowId);
	// 	$this->db->update('f_leaves');
	// 	if ($this->db->affected_rows() > 0) {
	// 		echo 'Leave approved successfully';
	// 	} else {
	// 		echo 'Error: Leave not approved';
	// 	}
	// }
	
	public function hrapprove() {
		$rowId = $this->input->post('row_id');
		$hr_Id = $this->session->userdata('id2');
		
		$source = $this->input->post('source');
		
		$validSources = array(
			'og_approveButtonHr' => 'f_outgoing',
			'leave_approveButtonHr' => 'f_leaves',
			'ot_approveButtonHr' => 'f_overtime',
			'ut_approveButtonHr' => 'f_undertime',
			'ob_approveButtonHr' => 'f_off_bussiness',
			'og_denyButtonHr' => 'f_outgoing',
			'leave_denyButtonHr' => 'f_leaves',
			'ot_denyButtonHr' => 'f_overtime',
			'ut_denyButtonHr' => 'f_undertime',
			'ob_denyButtonHr' => 'f_off_bussiness'
		);
	
		if (isset($validSources[$source])) {
			$tableName = $validSources[$source];
	
			if (strpos($source, '_denyButtonHr') !== false) {
				$this->db->set('status', 'denied');
			} else {
				$this->db->set('status', 'approved');
			}
	
			$this->db->set('hr_id', $hr_Id);
			$this->db->set('hr_status_date', 'CURDATE()', false);
			$this->db->where('id', $rowId);
			$this->db->update($tableName);
	
			echo 'Operation successful. Row ID: ' . $rowId . ', Table Name: ' . $tableName . ', Employee ID: ' . $hr_Id;
		} else {
			echo 'Failed: Invalid source';
		}
	}
	public function headapprovez() {
	
		$rowId = $this->input->post('rowId');
		$session_emp_id = $this->session->userdata('id2');
	
		$this->db->set('head_status', 'approved');
		$this->db->set('head_id', $session_emp_id);
		$this->db->where('id', $rowId);
		$this->db->update('f_leaves');
	
		echo 'Leave approved successfully';
	}
	
	public function headapprove() {
		$rowId = $this->input->post('row_id');
		$head_Id = $this->session->userdata('id2');
		
		$source = $this->input->post('source');
		
		$validSources = array(
			'og_approveButton' => 'f_outgoing',
			'leave_approveButton' => 'f_leaves',
			'ot_approveButton' => 'f_overtime',
			'ut_approveButton' => 'f_undertime',
			'ob_approveButton' => 'f_off_bussiness',
			'og_denyButton' => 'f_outgoing',
			'leave_denyButton' => 'f_leaves',
			'ot_denyButton' => 'f_overtime',
			'ut_denyButton' => 'f_undertime',
			'ob_denyButton' => 'f_off_bussiness'
		);
	
		if (isset($validSources[$source])) {
			$tableName = $validSources[$source];
	
			if (strpos($source, '_denyButton') !== false) {
				$this->db->set('head_status', 'denied');
			} else {
				$this->db->set('head_status', 'approved');
			}
	
			$this->db->set('head_id', $head_Id);
			$this->db->set('head_status_date', 'CURDATE()', false);
			$this->db->where('id', $rowId);
			$this->db->update($tableName);
	
			echo 'Operation successful. Row ID: ' . $rowId . ', Table Name: ' . $tableName . ', Employee ID: ' . $head_Id;
		} else {
			echo 'Failed: Invalid source';
		}
	}
	
	

	public function barchart() {
		
		$query = $this->db->query("SELECT d.acro_dept as dept, COUNT(dr.department) as count FROM department_roles dr inner join department d on dr.department = d.id GROUP BY d.department");
		$result = $query->result();
	
		$data['labels'] = [];
		$data['counts'] = [];
	
		foreach ($result as $row) {
			$data['labels'][] = $row->dept;
			$data['counts'][] = $row->count;
		}
	
		echo json_encode($data);
	  }
	
	
	  // new code for attendance status
	  public function attendance_status()
	  {
		$query = $this->db->query("SELECT MONTH(date) as month, 
									   SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) as late_count,
									   SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) as ontime_count
									   FROM attendance
									   GROUP BY MONTH(date)");
	
			$data['labels'] = [];
			$data['lateCounts'] = [];
			$data['ontimeCounts'] = [];
	
			for ($i = 1; $i <= 12; $i++) {
				$data['labels'][] = date('M', mktime(0, 0, 0, $i, 1));
				$data['lateCounts'][] = 0;
				$data['ontimeCounts'][] = 0;
			}
	
			foreach ($query->result() as $row) {
				$month = $row->month;
				$data['lateCounts'][$month - 1] = $row->late_count;
				$data['ontimeCounts'][$month - 1] = $row->ontime_count;
			}
	
			echo json_encode($data);
	
	  }

	public function deleteEmployee()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emp_id')) {
			$empId = $this->input->post('emp_id');

			// Check if there are related records in department_roles table
			$this->db->where('assigned_emp', $empId);
			$query = $this->db->get('department_roles');
			$numRows = $query->num_rows();

			if ($numRows > 0) {
				// Delete related records in department_roles table first
				$this->db->where('assigned_emp', $empId);
				$this->db->delete('department_roles');
			}

			// Proceed with deleting the employee record
			$this->db->where('id', $empId);
			$this->db->delete('employee');

			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to delete employee']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
		}
	}

	public function C_hr_dashboard()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Dashboard';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_dashboard');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_assets()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Assets';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_assets');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_profile()
	{


		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Profile';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_profile');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_settings()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Settings';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_settings');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_announcement()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Announcements';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_announcement');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}



	public function C_hr_employees()
	{


		$data['title'] = 'HR | Employees';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_employees');
		$this->load->view('templates/footer');
	}

	
	public function C_hr_departments()
	{


		$data['title'] = 'HR | Departments';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_departments');
		$this->load->view('templates/footer');
	}


	public function import()
	{
		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			if ($_FILES["file"]["size"] > 0) {
				$file = fopen($path, "r");
				$firstRowSkipped = false;
				while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
					if (!$firstRowSkipped) {
						$firstRowSkipped = true;
						continue; // Skip the first row
					}

					// Modify the data mapping according to your CSV structure
					$data = array(
						'id' => generateEmployeeCode($getData[0] . ' ' . $getData[1] . ' ' . $getData[2]), // Assuming employee ID is in column index 0
						'fname' => $getData[0], // First name
						'mname' => $getData[1], // Middle name
						'lname' => $getData[2], // Last name
						'nickn' => $getData[3], // Nickname (assuming it's in column index 3)
						'contact_no' => $getData[4], // Contact number (assuming it's in column index 4)
						'current_add' => $getData[5], // Current address (assuming it's in column index 5)
						'perm_add' => $getData[6], // Permanent address (assuming it's in column index 6)
						'dob' => $getData[7], // Date of birth (assuming it's in column index 7)
						'age' => $getData[8], // Age (assuming it's in column index 8)
						'religion' => $getData[9], // Religion (assuming it's in column index 9)
						'sex' => $getData[10], // Sex (assuming it's in column index 10)
						'civil_status' => $getData[11], // Civil status (assuming it's in column index 11)
						'pob' => $getData[12], // Place of birth (assuming it's in column index 12)
						'email' => $getData[13]
						
					);

					// Insert data into the database
					$this->db->insert('employee', $data);
				}
				fclose($file);
				echo "CSV File has been successfully Imported.";
			} else {
				echo "Invalid File: Please Upload CSV File.";
			}
		}
	}


	public function export_csv()
	{
		// Select all columns from the database
		$employees = $this->db->get('employee')->result_array();

		// Set CSV headers
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment;filename="employee_data.csv"');
		header('Cache-Control: max-age=0');

		// Open output stream
		$output = fopen('php://output', 'w');
		fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM

		// Write CSV headers
		fputcsv($output, array('ID', 'First Name', 'Middle Name', 'Last Name', 'Nickname', 'Contact No', 'Current Address', 'Permanent Address', 'Date of Birth', 'Age', 'Religion', 'Sex', 'Civil Status', 'Place of Birth', 'Email', 'Date Created'));

		// Write employee data to CSV
		foreach ($employees as $employee) {
			// Map the database column names to CSV column order
			$csvData = array(
				$employee['id'],
				$employee['fname'],
				$employee['mname'],
				$employee['lname'],
				$employee['nickn'],
				$employee['contact_no'],
				$employee['current_add'],
				$employee['perm_add'],
				$employee['dob'],
				$employee['age'],
				$employee['religion'],
				$employee['sex'],
				$employee['civil_status'],
				$employee['pob'],
				$employee['email'],
				$employee['date_created']
			);
			fputcsv($output, $csvData);
		}

		// Close output stream
		fclose($output);
	}





	public function import_csv()
	{


		$data['title'] = 'HR | Importing';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/import_csv');
		$this->load->view('templates/footer');
	}

	public function C_hr_employees_list()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_list');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_employees_designation()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Departments';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_designation');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_emp_attendace()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Attendance';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_attendance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_shifts()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Shifts';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_shift');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_performance_evaluation()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Performance Evaluation';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_performance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_leaves()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Leaves';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employee_leaves');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_calendar()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Calendar';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_calendar');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_shifts()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Shifts';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_shifts');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_leaves()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Leaves';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_leaves');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_timesheet()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Timesheet';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_timesheet');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_emp_performance()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Employee Performance';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_emp_performance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_salary()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_salary');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_rate()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_salary_rate');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_bonus()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_bonuses');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_deduction()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_deductions');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_formshistory()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Request History';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/employee/form_request_history');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function adduser()
	{
		$response = array();
		// Extract data from POST request
		$fname = format_text($this->input->post('fname'));
		$lname = format_text($this->input->post('lname'));
		$mname = format_text($this->input->post('mname'));
		$nickn = format_text($this->input->post('nickn'));
		$current_add = format_text($this->input->post('current_address'));
		$perm_add = format_text($this->input->post('perm_add'));
		$dob = $this->input->post('dob');
		$pob = format_text($this->input->post('pob'));
		$religion = format_text($this->input->post('religion'));
		$sex = format_text($this->input->post('sex'));
		$civil_status = format_text($this->input->post('civil_status'));
		$email = $this->input->post('email');

		$password = md5($this->input->post('password'));

		// Handle image upload
		if (isset($_FILES['capturedImage']) && $_FILES['capturedImage']['error'] == UPLOAD_ERR_OK) {
			// Process the uploaded image
			$image_data = file_get_contents($_FILES['capturedImage']['tmp_name']);
			// Add image data to the data array
			$pfp = $image_data;
		}
		$full_name = $fname . ' ' . $mname . ' ' . $lname;

		// Add other form data to the data array
		$data = array(
			'id' => generateEmployeeCode($full_name),
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'nickn' => $nickn,
			'current_add' => $current_add,
			'perm_add' => $perm_add,
			'dob' => $dob,
			'pob' => $pob,
			'religion' => $religion,
			'sex' => $sex,
			'civil_status' => $civil_status,
			'email' => $email,
			'password' => $password,
			'pfp' => $pfp,

		);

		$sql = $this->db->insert('employee', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'User added successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add user';
		}
		echo json_encode($response);
	}

	public function delete()
	{
		$emp_id = $this->input->post('emp_id');
		$this->load->database();
		$this->db->where('emp_id', $emp_id);
		$result = $this->db->delete('employee');

		if ($result) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Failed to delete employee.'));
		}
	}

	public function showUserdetails()
	{
		try {
			$emp_id = $this->input->post('emp_id');
			log_message('debug', 'Employee ID: ' . $emp_id);
			$employee = $this->db->get_where('employee', array('id' => $emp_id));

			if ($employee->num_rows() > 0) {
				$data = array();
				$data['status'] = "success";

				foreach ($employee->result() as $row) {
					$row_data = array(
						'id' => $row->id,
						'fname' => $row->fname,
						'mname' => $row->mname,
						'lname' => $row->lname,
						'nickn' => $row->nickn,
						'current_add' => $row->current_add,
						'perm_add' => $row->perm_add,
						'dob' => $row->dob,
						'religion' => $row->religion,
						'sex' => $row->sex,
						'civil_status' => $row->civil_status,
						'pob' => $row->pob,
						'email' => $row->email,
						'contact_no' => $row->contact_no

					);
					$data['data'] = $row_data;
				}

				echo json_encode($data);
			} else {
				$data['status'] = "failed";
				$data['detail'] = "Employee ID not found.";
				echo json_encode($data);
			}
		} catch (\Throwable $th) {
			$data['status'] = "error";
			$data['detail'] = $th;
			echo json_encode($data);
			// throw $th;
		}
	}

	public function updateUser()
	{
		$emp_id = $this->input->post('emp_id');
		$data = array(
			'fname' => format_text($this->input->post('fname')),
			'mname' => format_text($this->input->post('mname')),
			'lname' => format_text($this->input->post('lname')),
			'nickn' => format_text($this->input->post('nickn')),
			'current_add' => format_text($this->input->post('current_add')),
			'perm_add' => format_text($this->input->post('perm_add')),
			'dob' => $this->input->post('dob'),
			'religion' => format_text($this->input->post('religion')),
			'sex' => format_text($this->input->post('sex')),
			'civil_status' => format_text($this->input->post('civil_status')),
			'pob' => format_text($this->input->post('pob')),
			'contact_no' => $this->input->post('contact_no'),
			'email' => $this->input->post('email'),
			// 'password' => $this->input->post('password')
		);
		$this->db->where('id', $emp_id);
		$sql = $this->db->update('employee', $data);
		$response = array();
		if ($sql) {
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
			$response['status'] = 1;
			$response['msg'] = 'Employee data updated successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update employee data';
		}
		echo json_encode($response);
	}

	public function dash()
	{
		if ($this->session->userdata('logged_in') === TRUE) {
			$data['title'] = 'TItle';

			$this->load->view('pages/hr_home');
		} else {
			redirect('pages/login');
		}
	}

	public function add_announce()
{
    $datetime = date('Y-m-d H:i:s', time());
    $response = array();

    // Retrieve selected departments
    $selected_departments = explode(',', $this->input->post('selected_dept'));

    // Check if "all" is selected
    $to_all = (in_array('all', $selected_departments)) ? 1 : 0;

    // Prepare data for announcement table
    $announcement_data = array(
        'author' => $this->input->post('author'),
        'title' => $this->input->post('title'),
        'to_all' => $to_all,
        'content' => $this->input->post('editor_content'),
        'date_created' => $this->input->post('postdate')
    );

    // Insert data into announcement table
    $announcement_insert = $this->db->insert('announcement', $announcement_data);

    if ($announcement_insert) {
        // Get the ID of the inserted announcement
        $announcement_id = $this->db->insert_id();

        if (!$to_all) {
            // Prepare data for announce_to table only if "all" is not selected
            $announce_to_data = array();
            foreach ($selected_departments as $dept_id) {
                $announce_to_data[] = array(
                    'ann_id' => $announcement_id,
                    'dept_id' => $dept_id
                );
            }

            // Insert data into announce_to table
            $announce_to_insert = $this->db->insert_batch('announce_to', $announce_to_data);

            if (!$announce_to_insert) {
                // Rollback if insert into announce_to fails
                $this->db->delete('announcement', array('id' => $announcement_id));
                $response['status'] = 0;
                $response['msg'] = 'Error inserting departments.';
                echo json_encode($response);
                return;
            }
        }

        $response['status'] = 1;
        $response['inserted_id'] = $announcement_id;
        $response['msg'] = 'Announcement inserted successfully.';
    } else {
        $response['status'] = 0;
        $response['msg'] = 'Error inserting announcement.';
    }

    echo json_encode($response);
}





	public function add_dept()
	{
		$response = array();
		$department = $this->input->post('dept_name');
		$data = array(
			/*column name*/
			'department' => $department
		);

		$sql = $this->db->insert('department', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}



	//add 
	public function addroles()
	{
		// Initialize response array
		$response = array();

		// Get input data
		$department = $this->input->post('department_id');
		$role_name = $this->input->post('role_name');
		$salary = $this->input->post('salary');
		$salary_type = $this->input->post('salary_type');

		// Prepare data for insertion
		$data = array(
			'department' => $department,
			'roles' => $role_name,
			'salary' => $salary,
			'salary_type' => $salary_type
		);

		// Insert data using Query Builder to prevent SQL injection
		$inserted = $this->db->insert('department_roles', $data);

		// Check if insertion was successful
		if ($inserted) {
			$response['status'] = 1;
			$response['msg'] = 'Role added successfully';
			http_response_code(200); // OK
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add role';
			http_response_code(500); // Internal Server Error
		}

		// Return JSON response
		echo json_encode($response);
	}



	public function add_assets()
	{
		$response = array();

		$asset_name = $this->input->post('assetname');
		$purchase_date = $this->input->post('purchdate');
		$model = $this->input->post('model');
		$serial_number = $this->input->post('serial');
		$assetcondition = $this->input->post('condition');
		$warranty_start = $this->input->post('warranty');
		$amount = $this->input->post('amount');


		$data = array(

			'asset_name' => $asset_name,
			'purchase_date' => $purchase_date,
			'warranty_start' => $warranty_start,
			'amount' => $amount,
			'assetCondition' => $assetcondition,
			'model' => $model,
			'serial_number' => $serial_number

		);

		$sql = $this->db->insert('assets', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}

	public function getUserCount()
	{
		// Load the model for accessing the database
		$this->load->model('hr');

		// Get the count of users from the model
		$userCount = $this->User_model->getUserCount();

		// Send the count as JSON response
		echo json_encode(['userCount' => $userCount]);
	}

	public function pending_req()
	{
		$data['title'] = 'HR | Pendings';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/request_pending');
		$this->load->view('templates/footer');
	}

	public function history_req()
	{
		$data['title'] = 'HR | History';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_req_history');
		$this->load->view('templates/footer');
	}
	public function modal1()
	{

		$this->load->view('templates/header');
		$this->load->view('modal_view');
		$this->load->view('templates/footer');
	}

	public function update_leave_status()
	{
		// Retrieve emp_id from POST data
		$leave_id = $this->input->post('vq_leave_id');

		// Define data to be updated
		$data = array(
			// 'id' => ucwords($this->input->post('vq_leave_id')),
			'status' => ucwords($this->input->post('vq_leave_status'))

		);

		// Update the employee record
		$this->db->where('id', $leave_id);
		$sql = $this->db->update('f_leaves', $data);

		// Prepare response
		$response = array();
		if ($sql) {

			$response['status'] = 1;
			$response['msg'] = 'Leave data updated successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update Leave data';
		}

		// Echo JSON response
		echo json_encode($response);
	}

	public function fetch_data()
	{
		// Handle AJAX request to fetch data
		$requestType = $this->input->post('requestType');
		$id = $this->input->post('id');

		// Perform query based on request type
		if ($requestType === 'LEAVE REQUEST') {
			$query = $this->db->get_where('f_leaves', array('id' => $id));
		} elseif ($requestType === 'offbusiness') {
			$query = $this->db->get_where('offbusiness_table', array('id' => $id));
		} else {
			// Handle invalid request type
			echo "Invalid request type humanr";
			return;
		}

		// Check if query was successful
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row_array();
			$data['requestType'] = $requestType; // Pass request type to the view
			// Load the view and pass fetched data
			$this->load->view('modal_view', $data);
		} else {
			echo "No data found";
		}
	}
}
