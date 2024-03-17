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
      $this->load->view('templates/header',$data);
      $this->load->view('pages/public/forms');
      $this->load->view('templates/footer');
    }


	public function emphome()
    {
      $data['title'] = 'Employee | Home';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/employee/employee_home');
      $this->load->view('templates/footer');
    }

	public function C_leave()
	{
		$response = array();

		$name = $this->input->post('name');
		$date_filled = date('Y-m-d H:i:s', time());
		$department = $this->input->post('department');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$leaveType = $this->input->post('leaveType');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'date_from' => $from_date,
			'date_to' => $to_date,
			'type_of_leave' => $leaveType,
			'reason' => $reason,
			'status' => $status,
			'date_filled' => $date_filled,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_leaves', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function C_offBuis()
	{
		$response = array();
		$name = $this->input->post('name');
		$date_filled = date('Y-m-d H:i:s', time());
		$department = $this->input->post('department');
		$outgoing_pass_date = $this->input->post('outgoing_pass_date');
		$destin_from = $this->input->post('destin_from');
		$destin_to = $this->input->post('destin_to');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'destin_from' => $destin_from,
			'destin_to' => $destin_to,
			'time_from' => $time_from,
			'time_to' => $time_to,
			'outgoing_pass_date' => $outgoing_pass_date,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_off_business', $data);

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
		$type = $this->input->post('type');
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$outgoing_date = $this->input->post('outgoing_date');
		$time_from = $this->input->post('time_from');
		$time_to = $this->input->post('time_to');
		$destination = $this->input->post('destination');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'type' => $type,
			'date_filled' => $outgoing_date,
			'time_from' => $time_from,
			'time_to' => $time_to,
			'going_to' => $destination,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_outgoing', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function C_undertime()
	{
		$response = array();

		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$undertime_date = $this->input->post('undertime_date');
		$time_in = $this->input->post('time_in');
		$time_out = $this->input->post('time_out');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/
			'date_filled' => $undertime_date,
			'date_of_undertime' => $undertime_date,
			'time_in' => $time_in,
			'time_out' => $time_out,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name

		);

		$sql = $this->db->insert('f_undertime', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}


	public function C_overtime()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$ot_date = $this->input->post('ot_date');
		$time_in = $this->input->post('from_time');
		$time_out = $this->input->post('to_time');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

		$data = array(
			/*column name*/

			'date_filled' => $date_filled,
			'date_ot' => $ot_date,
			'time_in' => $time_in,
			'time_out' => $time_out,
			'reason' => $reason,
			'status' => $status,
			'emp_id' => $empid,
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('f_overtime', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}
		echo json_encode($response);
	}

	public function C_schedadj()
	{
		$response = array();
		$date_filled = date('Y-m-d H:i:s', time());
		$name = $this->input->post('name');
		$department = $this->input->post('department');
		$change_day_from = $this->input->post('date_from');
		$change_day_to = $this->input->post('date_to');
		$change_time_from = $this->input->post('time_from');
		$change_time_to = $this->input->post('time_to');
		$reason = $this->input->post('reason');
		$status = $this->input->post('status');
		$empid = $this->input->post('empid');

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
			'department' => $department,
			'name' => $name
		);

		$sql = $this->db->insert('work_schedule_adjustment_table', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}

}
