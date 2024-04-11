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
        $query = $this->db->query('SELECT * FROM `sys_events`');

        foreach ($query->result() as $row) {
          echo '{';
          echo "id : '$row->id',";
          echo "title : '$row->event_name',";
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
            'event_name' => $event,
            'date_start' => $date_start,
            'date_end' => $date_end


        );

        print_r($data);

        $sql = $this->db->insert('sys_events', $data);
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
            'event_name' => $event,
            'date_start' => $date_start,
            'date_end' => $date_end
        );

        // Update the employee record
        $this->db->where('id', $id);
        $sql = $this->db->update('sys_events', $data);

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


    public function get_announcement_details()
    {
    
        try {
            // Retrieve emp_id from the query parameter using CodeIgniter's input library
            $ann_id = $this->input->post('announcement_id');
    
            // Log emp_id to ensure it's correctly retrieved
            log_message('debug', 'Announcement ID: ' . $ann_id);
    
            // Fetch employee details based on emp_id using the loaded model
            // array('department' => $row_department->department)
            $announcement = $this->db->query("SELECT 
            a.id,  a.type, a.title, 
            a.content, e.id as `emp_id`,
            CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS author,
            a.to_all, a.date_created, 
            GROUP_CONCAT(d.id ORDER BY d.id SEPARATOR ', ') AS department_id,
            GROUP_CONCAT(d.acro_dept ORDER BY d.acro_dept SEPARATOR ', ') AS departments
        FROM 
            announcement a
        LEFT JOIN 
            announce_to t ON a.id = t.ann_id
        LEFT JOIN 
            department d ON t.dept_id = d.id
        LEFT JOIN 
            employee e ON a.author = e.id
        WHERE a.id = '$ann_id'
        GROUP BY a.id
        ORDER BY a.id DESC
   
        ");
    
            if ($announcement->num_rows() > 0) {
                $data = array(); // Initialize an array to store all the data
    
                $data['status'] = "success";
    
                foreach ($announcement->result() as $row) {
                    // Add each row data to the array
                 
                    // Add the row data array to the main data array
                    $data['data'] = $row;
                }
    
                // Encode the array to JSON and echo it
                echo json_encode($data);
            } else {
                $data['status'] = "failed";
                $data['detail'] = "Announcement details not found. : $ann_id";
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            $data['status'] = "error";
            $data['detail'] = $th;
            echo json_encode($data);
            // throw $th;
        }
    }


    public function shift_select(){
        try {
            // Retrieve emp_id from the query parameter using CodeIgniter's input library
            $shift_id = $this->input->post('shift_id');
    
            // Log emp_id to ensure it's correctly retrieved
            log_message('debug', 'Shift ID: ' . $shift_id);
    
            // Fetch employee details based on emp_id using the loaded model
            // array('department' => $row_department->department)
            $shift = $this->db->query("SELECT * FROM sys_shifts WHERE id = '$shift_id'");
    
            if ($shift->num_rows() > 0) {
                $data = array(); // Initialize an array to store all the data
    
                $data['status'] = "success";
    
                foreach ($shift->result() as $row) {
                    // Add each row data to the array
                 
                    // Add the row data array to the main data array
                    $data['data'] = $row;
                }
    
                // Encode the array to JSON and echo it
                echo json_encode($data);
            } else {
                $data['status'] = "failed";
                $data['detail'] = "Shift details not found. : $shift_id";
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            $data['status'] = "error";
            $data['detail'] = $th;
            echo json_encode($data);
            // throw $th;
        }
    }

    public function shift_update() {
        try {
            $this->db->set('id', $this->input->post('id')); // Replace $id with the new value for 'id'
            $this->db->set('group_', $this->input->post('group')); // Replace $group with the new value for 'group_'
            $this->db->set('description', $this->input->post('description')); // Replace $description with the new value for 'description'
            $this->db->set('time_from', $this->input->post('time_from')); // Replace $time_from with the new value for 'time_from'
            $this->db->set('time_to', $this->input->post('time_to')); // Replace $time_to with the new value for 'time_to'
            $this->db->where('id', $this->input->post('id')); // Assuming you want to update the row where 'id' is 1
    
            $this->db->update('sys_shifts');
    
            // Check if the update was successful
            if ($this->db->affected_rows() > 0) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Shift updated successfully'
                );
            } else {
                $data = array(
                    'status' => 'failed',
                    'message' => 'Failed to update shift'
                );
            }
    
            // Encode the data array to JSON and echo it
            echo json_encode($data);
        } catch (Exception $e) {
            $data = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );
    
            // Encode the data array to JSON and echo it
            echo json_encode($data);
        }
    }

    
    public function shift_insert()
    {
        $response = array();
        $event = $this->input->post('create_shift_label');
        $description = $this->input->post('create_shift_description');
        $time_from = $this->input->post('create_shift_time_from');
        $time_to = $this->input->post('create_shift_time_to');


        $data = array(
            /*column name*/
            'group_' => $event,
            'description' => $description,
            'time_from' => $time_from,
            'time_to' => $time_to


        );

        // print_r($data);

        $sql = $this->db->insert('sys_shifts', $data);
        if ($sql) {
            $response['status'] = 1;
            $response['msg'] = 'Done';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Error';
        }

        echo json_encode($response);
    }

    

    public function shift_delete(){
        try {
            // Perform deletion
            $this->db->where('id', $this->input->post('delete_shift_id'));
            $this->db->delete('sys_shifts');
    
            $data['status'] = "success";
            $data['message'] = "Shift deleted successfully.";
            echo json_encode($data);
        } catch (Exception $e) {
            $data['status'] = "error";
            $data['message'] = "Error deleting shift: " . $e->getMessage();
            echo json_encode($data);
        }
    }




    public function department_insert()
    {
        $response = array();
        $event = $this->input->post('department_name');
        $description = $this->input->post('dept_acronym');


        $data = array(
            /*column name*/
            'department' => $event,
            'acro_dept' => $description


        );

        print_r($data);

        $sql = $this->db->insert('department', $data);
        if ($sql) {
            $response['status'] = 1;
            $response['msg'] = 'Done';
        } else {
            $response['status'] = 0;
            $response['msg'] = 'Error';
        }

        echo json_encode($response);
    }









}




