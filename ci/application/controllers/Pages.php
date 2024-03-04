<?php
defined('BASEPATH') or exit('No direct script access allowed');


// class Pages extends CI_Controller
// {

//   public function view()
//   {

//     $page = "hr_home";

//     if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
//       show_404();
//     }

//     $data['title'] = $page;

//     $this->load->model('employee_model');
//     // $data['employees'] = $this->employee_model->getEmployees();

//     $this->load->view('templates/header');
//     // $this->load->view('pages/employee_view', $data);

//     $this->load->view('pages/' . $page, $data);
//     $this->load->view('templates/footer');
//   }

 
// }


// class Employee extends CI_Controller
// {
//   public function index()
//   {
//     $this->load->model('employee_model');
//     $data['employees'] = $this->employee_model->getEmployees();
//     $this->load->view('employee_view', $data);
//   }
// }



// defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load any necessary models, libraries, etc.
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
    }


    
  
}

