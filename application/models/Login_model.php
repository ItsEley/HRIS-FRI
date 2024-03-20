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

        // look for id or email
        $query = $this->db->query("
        SELECT id, password 
        FROM employee
        WHERE id = '$username' or email = '$username'
        ");

        if ($query->num_rows() > 0) {  //if email exists

            $data = $query->row_array();
            $emp_id = $data['id'];
            $hashed_pass = $data['password'];

            if ($password == $hashed_pass) { //  if the password is CORRECT
                $status = 1;
                $message = "Logged in";

                $response = array(
                    'status' => $status,
                    'message' => $message,
                    'emp_id' => $emp_id
                );

            } else { // if the password is wrong
                $status = 0;
                $message = "Wrong password. Please check your credentials again.";


                $response = array(
                    'status' => $status,
                    'message' => $message,
                    'username' => $username
                );
                
            }
        } else {  //  if email does NOT exists
            $status = 0;
            $message = "Email is not registered to the system. Please check your credentials again.";

            $response = array(
                'status' => $status,
                'message' => $message
            );
        }



        // return to welcome/login
        return $response;
    }
}
