<?php
class Login_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login_model');
        $this->load->library('session');
        $this->load->helper('url');
    }



    public function authenticate($username, $password)
{
    $query = $this->db->query("SELECT *, dr.roles as emp_role FROM employee e inner join department_roles dr on e.role = dr.id 
                               inner join department d on e.department = d.id WHERE e.id = '$username' 
                               OR e.email = '$username' AND e.password = '$password'");  
    return $query;
    // look for id or email
}

}