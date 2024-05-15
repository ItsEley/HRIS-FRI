<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->zone = date_default_timezone_set('Asia/Manila');
		$this->datetime = date('Y-m-d H:i:s', time());
		$this->date 	= date('Y-m-d', time());

		$this->load->model('Admin_model', 'hr');
		$this->load->model('Login_model', 'login');
		$this->load->model('Attendance_model', 'getAttendance');
	}


	// new function
	public function attendanceUi()
	{
		$data['title'] = 'Employee | Biometrics';
		$this->load->view('templates/header', $data);
		$this->load->view('welcome_message');
		$this->load->view('templates/footer');
	}


	public function attendance()
	{
		if ($this->input->post('employee')) {
			$output = array('error' => false);
			$output1 = '';

			$employee = $this->input->post('employee');
			$status = $this->input->post('status');

			$sql = "SELECT * FROM employee WHERE employee_id = '$employee'";
			$query = $this->db->query($sql);

			if ($query->num_rows() > 0) {
				$row = $query->row();
				$id = $row->employee_id;

				// current date
				$date_now = date('Y-m-d');

				if ($status == 'in') {
					$sql = "SELECT * FROM attendance WHERE emp_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$output['error'] = true;
						$output['message'] = 'You have timed in for today';
					} else {
						$date_now = date('Y-m-d');
						//updates
						$sched = $row->shift;
						$lognow = date('H:i:s');
						$sql = "SELECT * FROM sys_shifts WHERE id = '$sched'";
						$squery = $this->db->query($sql);
						$srow = $squery->row();
						$logstatus = ($lognow > $srow->time_from) ? 0 : 1;

						// if ($lognow > $srow->time_from) {
						// 	$lateMinutes = 0;
						// 	$sql_sched = $this->db->query("SELECT * FROM employee e inner join sys_shifts sf on e.shift = sf.id inner join attendance at on e.employee_id = at.emp_id WHERE at.date = '$date_now' and at.emp_id = '$id'");

						// 		$lrow = $sql_sched->row();
						// 		if ($sql_sched->num_rows() > 0) {
						// 			// code...
						// 		}
						// 		$expectedArrival = $lrow->time_from;
						// 		// actual time 
						// 		$actualArrival = $lrow->time_in;

						// 		// Convert expected and actual arrival times to UNIX timestamps
						// 		$expectedTimestamp = strtotime($expectedArrival);
						// 		$actualTimestamp = strtotime($actualArrival);

						// 		// Calculate the difference in seconds
						// 		$lateSeconds = $actualTimestamp - $expectedTimestamp;

						// 		// Convert the difference to minutes
						// 		$lateMinutes = round($lateSeconds / 60);
						// }else {
						// 	$lateMinutes = 0;
						// }


						$data = array(
							'emp_id' => $id,
							'date' => $date_now,
							'time_in' => date('H:i'),
							'status' => $logstatus
						);
						$sqlinsert_ = $this->db->insert('attendance', $data);

						if ($sqlinsert_) {
							$date = date('Y-m-d');
							$sql = "SELECT * FROM employee t1 inner join attendance t2 on t1.id = t2.emp_id WHERE employee_id = '$employee' and t2.date = '$date'";
							$res = $this->db->query($sql);

							// if ($res->num_rows() > 0) {
							$output['data'] = '';
							$output['img'] = '';

							foreach ($res->result() as $row) {
								$output['data'] .= "<tr>
																			<td>" . $row->fname . " " . $row->lname . "</td>
																			<td>" . $row->department . "</td>
																			<td>" . $row->date . "</td>
																		</tr>";
								$output['img'] = $row->pfp;
							}
							$output['message'] = 'Time in: ' . $row->fname . ' ' . $row->lname;
							// }else{
							// 	$output['message'] = 'No data found for employee ID: '.$employee;
							// }

						} else {
							$output['error'] = true;
							$output['message'] = $this->db->error;
						}
					}
				} else {
					$sql = "SELECT *, attendance.attendance_id AS uid FROM attendance LEFT JOIN employee ON employee.id=attendance.emp_id WHERE attendance.emp_id = '$id' AND date = '$date_now'";
					$query = $this->db->query($sql);
					$row = $query->row();
					if ($query->num_rows() < 1) {
						$output['error'] = true;
						$output['message'] = 'Cannot Timeout. No time in.';
					} else {
						if ($row->time_out != '00:00:00') {
							$output['error'] = true;
							$output['message'] = 'You have timed out for today';
						} else {


							$sql = "UPDATE attendance SET time_out = NOW() WHERE attendance_id = '" . $row->uid . "'";
							$upsql = $this->db->query($sql);
							if ($upsql) {
								$date = date('Y-m-d');
								$sql = "SELECT * FROM employee t1 inner join attendance t2 on t1.id = t2.emp_id WHERE emp_id = '$employee' and t2.date = '$date'";
								$res = $this->db->query($sql)->result();

								// if (!empty($res)) {
								$output['data'] = '';
								$output['img'] = '';

								foreach ($res as $row) {
									$output['data'] .= "<tr>
																				<td>" . $row->fname . "</td>
																				<td>" . $row->department . "</td>
																				<td>" . $row->date . "</td>
																			</tr>";
									$output['img'] = $row->pfp;
								}
								$output['message'] = 'Time out: ' . $row->fname;
								// }else{
								// 	$output['message'] = 'No data found for employee ID: '.$employee;
								// }


								$sql = "SELECT *, attendance.emp_id AS uid FROM attendance LEFT JOIN employee ON employee.employee_id=attendance.emp_id WHERE attendance.emp_id = '$id' AND attendance.date = '$date_now'";
								$query = $this->db->query($sql);
								$row = $query->row();


								$sql = "SELECT * FROM attendance WHERE emp_id = '$row->uid' and date = '$date_now'";
								$query = $this->db->query($sql);
								$urow = $query->row();

								$time_in = $row->time_in;
								$time_out = $row->time_out;


								$sql = "SELECT * FROM employee LEFT JOIN sys_shifts ON sys_shifts.id=employee.shift WHERE employee.employee_id = '$id'";
								$query = $this->db->query($sql);
								$srow = $query->row();


								// Convert start and end times to DateTime objects
								$startDateTime = new DateTime($time_in);
								$endDateTime = new DateTime($time_out);

								// Calculate the difference between start and end times
								$interval = $startDateTime->diff($endDateTime);

								// Get the total hours worked
								$totalHours = $interval->format('%h');

								// Get the total minutes worked
								$totalMinutes = $interval->format('%i');
								$mins = $totalMinutes / 60;
								$int = $totalHours + $mins;
								if ($int > 4) {
									$int = $int - 1;
								}

								$sql = "UPDATE attendance SET num_hr = '$int' WHERE emp_id = '$row->uid' and date = '$date_now'";
								$this->db->query($sql);
							} else {
								$output['error'] = true;
								$output['message'] = $this->db->error();
							}
						}
					}
				}
			} else {
				$output['error'] = true;
				$output['message'] = 'Employee ID not found';
			}
		}
		echo json_encode($output);
		echo $output1;
	}


	public function insert_attendance()
	{
		$response = array();
		$empID = $this->input->post('empid');
		$logtype = $this->input->post('logtype');

		$validate = $this->db->where('emp_id', $empID)->get('attendance');
		$row = $validate->row();

		if ($empID === $row->emp_id && $row->date_created === date('Y-m-d')) {
			$response['status'] = 1;
			$response['msg'] = "Already Time In";
		} else {
			$data = array(
				'emp_id' => $empID,
				'time_in' => date('H:i'),
				'date_created' => date('Y-m-d')
			);

			$sql = $this->db->insert('attendance', $data);
			if ($sql) {
				$response['status'] = 0;
				$response['msg'] = "Success!";
			}
		}
		echo json_encode($response);
	}

	public function get_timesheet()
	{
		$response = array();
		$output = '';
		$status = '';
		$date = date('Y-m-d');
		$sql = $this->db->query("SELECT *,d.department as company_dept, DATE_FORMAT(t2.time_in, '%H:%i') as time_in, DATE_FORMAT(t2.time_out, '%H:%i') as time_out  FROM employee t1 inner join attendance t2 on t1.employee_id = t2.emp_id inner join department d on t1.department = d.id inner join department_roles dr on t1.role = dr.id WHERE date = '$date'");
		if ($sql->num_rows() > 0) {
			foreach ($sql->result() as $row) {
				if ($row->status == 1) {
					$status = "<div style=' font-size: 10px; color: green'>On Time</div>";
				} else {
					$status = "<div class='badge badge-danger' style=' font-size: 10px'>Late</div>";
				}
				$output .= "<tr>
									<td>" . date("F j, Y", strtotime($row->date)) . "</td>
									<td>" . $row->fname . " " . $row->lname . " (" . $row->roles . ")</td>
									<td>" . $row->company_dept . "</td>
									<td>" . date('h:i A',  strtotime($row->time_in)) . ' ' . $status . "</td>";
				if ($row->time_out != "00:00:00") {
					$output .= "<td>" . $row->time_out . "</td>";
				} else {
					$output .= "<td>" . $row->time_out . "</td>";
				}
				$output .= "<td>" . round($row->num_hr, 2) . "</td>
									</tr>";
			}
		} else {
			$output .= "<tr>
									<td colspan='12'><center>No Data Found!</center></td>
								</tr>";
		}
		echo json_encode($output);
	}



	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			// If the user is already logged in, redirect them to a different page
			if (strtolower($_SESSION['department']) == 'hr') {
				redirect(base_url('hr/dashboard')); // Change 'dashboard' to the appropriate page
			} else if (strtolower($_SESSION['department']) == 'sys-at') {
			} else {
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
			$emp_id1 = $data['emp_id_1'];
			$emp_id2 = $data['emp_id_2'];
			$fullname = $data['fname'] . ' ' . $data['lname'];
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
		} else {
			$response['status'] = 0;
			$response['message'] = 'Unable To Access!';
		}
		echo json_encode($response);
	}
}
