<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pages extends CI_Controller{

    public function view(){

        $page = "login";

        if (!file_exists(APPPATH.'views/pages/'.$page.'.php')){
            show_404();
        }

        $data['title'] = $page ."--asd";
   
        $this->load->view('templates/header');
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer');
   
      }

      public function index(){

        $this->load->view('index');

      }

}
