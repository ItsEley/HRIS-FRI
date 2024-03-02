<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pages extends CI_Controller
{

  public function view()
  {

    $page = "employee_view";

    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
      show_404();
    }

    $data['title'] = $page . "--asd";

    $this->load->view('templates/header');
    $this->load->view('pages/' . $page, $data);
    $this->load->view('templates/footer');
  }

  public function index()
  {

    $this->load->view('index');
  }
}


class Employee extends CI_Controller
{
  public function index()
  {
    $this->load->model('employee_model');
    $data['employees'] = $this->employee_model->getEmployees();
    $this->load->view('employee_view', $data);
  }
}
