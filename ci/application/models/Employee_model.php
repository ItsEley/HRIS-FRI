<?php
class Employee_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getEmployees() {
        $query = $this->db->get('person');
        if ($query->num_rows() > 0) {
            print_r($query->result());
            return $query->result();
        } else {
            return array(); // Return an empty array if no records found
        }
    }
}
?>
