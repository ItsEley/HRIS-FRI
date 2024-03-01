<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

  
  public function news()  // call the page {news} -- is the page name
  {
    $this->load->view('news/index'); // navigate to page
  }

  public function page_filename()
  {
    $this->load->view('wag_pages/home');
  }

  public function page_one()
  {
    $this->load->view('wag_pages/about');
  }


}
