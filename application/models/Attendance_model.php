<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model
{
	
	public function __construct() 
	{
		parent:: __construct();
		// $this->zone 	= date_default_timezone_set('Asia/Manila');
		// $this->datetime = date('Y-m-d H:i:s', time());
		// $this->date 	= date('Y-m-d', time());
	}

	public function getAttendance($empID)
	{
		$query = $this->db->where('employee_id', $empID)->get('employee');
    return $query->result();
	}
}