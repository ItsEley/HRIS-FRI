<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatablec extends CI_Controller
{

    public function index()
    {
        $this->load->view('datatable_view');
    }



    public function calendar_get()
    {
        $query = $this->db->query('SELECT * FROM `sys_holidays`');

        foreach ($query->result() as $row) {
          echo '{';
          echo "id : '$row->id',";
          echo "title : '$row->holiday_name',";
          echo "start : '$row->date_start',";
          echo "end : '$row->date_end'";
          echo '},';
        }
        // Return the result as JSON
        echo json_encode($query->result());
    }




    public function calendar_set()
    {
        $response = array();
        $event = $this->input->post('title');
        $date_start = $this->input->post('start');
        $date_end = $this->input->post('end');

        echo $date_start;

        $data = array(
            /*column name*/
            'holiday_name' => $event,
            'date_start' => $date_start,
            'date_end' => $date_end


        );

        print_r($data);

        $sql = $this->db->insert('sys_holidays', $data);
        if ($sql) {
            $response['status'] = 1;
            $response['msg'] = 'Done';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Error';
        }

        echo json_encode($response);
    }



    public function calendar_update()
    {
        $response = array();
        $event = $this->input->post('title');
        $date_start = $this->input->post('start');
        $date_end = $this->input->post('end');

        // Retrieve emp_id from POST data
        $id = $this->input->post('id');

        // Define data to be updated
        $data = array(
            /*column name*/
            'holiday_name' => $event,
            'date_start' => $date_start,
            'date_end' => $date_end
        );

        // Update the employee record
        $this->db->where('id', $id);
        $sql = $this->db->update('sys_holidays', $data);

        // Prepare response
        $response = array();
        if ($sql) {

            $response['status'] = 1;
            $response['msg'] = 'Leave data updated successfully';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Failed to update Leave data';
        }


        echo json_encode($response);
    }
}


