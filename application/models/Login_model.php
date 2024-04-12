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
    $query = $this->db->query("SELECT t1.id as `emp_id_1`,t1.employee_id as `emp_id_2`,t1.fname,t1.mname,
    t1.lname,t1.nickn,t1.contact_no,t1.current_add,t1.perm_add,t1.dob,t1.age,t1.religion,
    t1.sex,t1.civil_status,t1.pob,t1.email,t1.password,t1.pfp,t1.date_created,t1.department,t1.role,t1.shift,
    t2.id as `role_id` ,t2.roles,t2.department,t2.salary,t2.salary_type,
    t3.id as `department_id`,t3.department,t3.acro_dept,
    t2.roles as `emp_role`

    FROM employee as t1
    INNER JOIN department_roles as t2 
    ON t1.role = t2.id
    INNER JOIN department as t3
    ON t1.department = t3.id
    WHERE t1.employee_id = '$username' OR t1.email = '$username' AND t1.password = '$password'");  
    return $query;
    // look for id or email
    
}

}