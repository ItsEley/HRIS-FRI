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
    $data['title'] = 'Login';

    $this->load->view('templates/header', $data);
    // $data['news'] = $this->news_model->get_news();
    $this->load->view('pages/login');
    $this->load->view('templates/footer', $data);

  }

  public function about()
  {
    $this->load->view('pages/about');
  }

  public function index()
  {
    $this->load->view('Pages/index');
  }


// kljkljljlkjlk
}
