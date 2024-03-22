<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatablec extends CI_Controller {

    public function index()
    {
        $this->load->view('datatable_view');
    }

    

    public function ajax_get_data()
    {
        $this->load->database();
        
        // Select data from the employees table
        $query = $this->db->select('id, fname, age, sex')
                          ->get('employee');

        // Return the result as JSON
        echo json_encode($query->result());
    }


    
    public function mpdf_generate()
    {
        $this->load->database();
        
     
    }



}
