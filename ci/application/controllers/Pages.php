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



    // hr
    public function hr_home()
    {
      $data['title'] = 'HR Home';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/hr_home');
      $this->load->view('templates/footer');

    }



    // employee
    public function emp_home()
    {
      $data['title'] = 'Employee';
      $this->load->view('templates/header',$data);
      $this->load->view('pages/employee_home');
      $this->load->view('templates/footer');

    }






    



    
  
}

