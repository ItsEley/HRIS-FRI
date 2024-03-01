<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

  
  public function news()  // call the page {news} -- is the page name
  {
    $this->load->view('news/index'); // navigate to page
  }

  public function login()
  {
    $this->load->view('pages/login');
  }

  public function about()
  {
    $this->load->view('pages/about');
  }


}
