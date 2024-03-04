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
    $this->db->where('password', $password);
    $this->db->where('email', $email);
    $query = $this->db->get('person');    
    return $query;
	}
};