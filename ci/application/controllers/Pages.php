<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary models, libraries, etc.
    }

    // public
    public function index()
    {
      $data['title'] = 'Landing Page';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/index');
    }



    public function about()
    {
      $data['title'] = 'About Page';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/about');
    }

    public function login()
    {
      $data['title'] = 'Login Page';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/login');
      $this->load->view('templates/footer');
    }

    public function forms()
    {
      $data['title'] = 'Resources | Forms';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/forms');
      $this->load->view('templates/footer');
    }

    
    public function forms_history()
    {
      $data['title'] = 'Forms | History';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/form_request_history');
      $this->load->view('templates/footer');
    }


    



    // hr
    public function hr_home()
    {
      $data['title'] = 'HR Home';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_home');
      $this->load->view('templates/footer');

    }

    public function hr_announcement()
    {
      $data['title'] = 'HR Announcement';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_announcement');
      $this->load->view('templates/footer');

    }


    public function hr_employees()
    {
      $data['title'] = 'HR Employees';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_employees');
      $this->load->view('templates/footer');

    }
    public function hr_profile()
    {
      $data['title'] = 'Profile Page';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_profile');
      $this->load->view('templates/footer');
    }


    public function hr_attendance()
    {
      $data['title'] = 'Attendance';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_attendance');
      $this->load->view('templates/footer');
    }


    public function user_profile()
    {
      $data['title'] = 'User Profile';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/user_profile');
      $this->load->view('templates/footer');
    }

    public function forms_pending()
    {
      $data['title'] = 'Forms | Pending';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/forms_pending');
      $this->load->view('templates/footer');
    }
    
    public function leave_pending()
    {
      $data['title'] = 'Requests | Pending';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/request_pending');
      $this->load->view('templates/footer');
    }


    public function departments()
    {
      $data['title'] = 'Departments';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_departments');
      $this->load->view('templates/footer');
    }




    // employee
    public function emp_home()
    {
      $data['title'] = 'Home | Employee';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/employee_home');
      $this->load->view('templates/footer');

    }






    



    
  
}

