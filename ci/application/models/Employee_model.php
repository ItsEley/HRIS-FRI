<?php
class Employee_model extends CI_Model {
    public function getEmployees() {
        $query = $this->db->get('person');
        return $query->result();
    }
}
?>

