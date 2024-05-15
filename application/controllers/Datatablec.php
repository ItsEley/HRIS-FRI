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


    public function shift_select()
    {
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

    public function shift_update()
    {
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



    public function shift_delete()
    {
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

        // print_r($data);

        $sql = $this->db->insert('department', $data);
        if ($sql) {
            $response['status'] = "success";
            $response['message'] = 'Done';
        } else {
            $response['status'] = "fail";
            $response['message'] = 'Error';
        }

        echo json_encode($response);
    }




    public function department_select()
    {
        try {
            // Retrieve emp_id from the query parameter using CodeIgniter's input library
            $department_id = $this->input->post('department_id');

            // Log emp_id to ensure it's correctly retrieved
            log_message('debug', 'Department ID: ' . $department_id);

            // Fetch employee details based on emp_id using the loaded model
            // array('department' => $row_department->department)
            $shift = $this->db->query("SELECT * FROM department WHERE id = '$department_id'");

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
                $data['message'] = "Department details not found. : $department_id";
                echo json_encode($data);
            }
        } catch (\Throwable $th) {
            $data['status'] = "error";
            $data['message'] = $th;
            echo json_encode($data);
            // throw $th;
        }
    }

    public function department_update()
    {
        try {

            $this->db->set('department', $this->input->post('department')); // Replace $group with the new value for 'group_'
            $this->db->set('acro_dept', $this->input->post('acro_dept')); // Replace $description with the new value for 'description'
            $this->db->where('id', $this->input->post('id')); // Assuming you want to update the row where 'id' is 1   
            $this->db->update('department');

            // Check if the update was successful
            if ($this->db->affected_rows() > 0) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Department updated successfully'
                );
            } else {
                $data = array(
                    'status' => 'failed',
                    'message' => 'Department to update shift'
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




    public function department_delete()
    {
        try {
            // Perform deletion
            $this->db->where('id', $this->input->post('delete_department_id'));
            $this->db->delete('department');

            $data['status'] = "success";
            $data['message'] = "Department deleted successfully.";
            echo json_encode($data);
        } catch (Exception $e) {
            $data['status'] = "error";
            $data['message'] = "Error deleting department: " . $e->getMessage();
            echo json_encode($data);
        }
    }



    public function chat_fetch()
    {
        try {
           // Fetch chat messages from the database (assuming your table name is chat_messages)
        $query = $this->db->get('chat_messages');
        $messages = $query->result_array();

        // Return messages as JSON
        $this->output->set_content_type('application/json')->set_output(json_encode($messages));
        } catch (Exception $e) {
            $data['status'] = "ERROR";
            $data['message'] = "Cannot retrieve messages : " . $e->getMessage();
            echo json_encode($data);
        }
    }



    public function chat_send() {
        // Check if the message data has been received via POST
        if ($this->input->server('REQUEST_METHOD') == "POST" && $this->input->post('chat_message_input')) {
            // Sanitize and escape the message to prevent SQL injection
            $message = $this->db->escape_str($this->input->post('chat_message_input'));
            $sender = $this->db->escape_str($this->input->post('sender_id'));
            $receiver = $this->db->escape_str($this->input->post('receiver_id'));

            // Insert the message into the database
            $data = array(
                'message' => $message,
                'from_' => $sender,
                'to_' => $receiver
            );
            $this->db->insert('chat_messages', $data);

            if ($this->db->affected_rows() > 0) {
                // If the message was successfully inserted, return a success message
                echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully.'));
            } else {
                // If an error occurred while inserting the message, return an error message
                echo json_encode(array('status' => 'error', 'message' => 'Error sending message: ' . $this->db->error()));
            }
        } else {
            // If the message data was not received or the request method is not POST, return an error message
            echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
        }
    }


    
    public function timesheet_create()
    {
        $response = array();
    
        // Retrieve input data
        $employee_id = $this->input->post('employee_id');
        $att_date = $this->input->post('att_date');
        $time_in = $this->input->post('create_time_in');
        $time_out = $this->input->post('create_time_out');
    
        // Check if the date is received correctly
        if (!$att_date) {
            $response['status'] = "fail";
            $response['message'] = 'Error: Date not provided.';
            echo json_encode($response);
            return;
        }
    
        // Parse the date using DateTime class
        $date = DateTime::createFromFormat('D M d Y H:i:s e+', $att_date);
    
        // Check if the date parsing was successful
        if (!$date) {
            $response['status'] = "fail";
            $response['message'] = 'Error: Invalid date format.';
            echo json_encode($response);
            return;
        }
    
        // Format the date to YYYY-mm-dd
        $formatted_date = $date->format('Y-m-d');
    
        // Check if emp_id and date combination already exists
        $this->db->where('emp_id', $employee_id);
        $this->db->where('date', $formatted_date);
        $existing_record = $this->db->get('attendance')->row();
    
        if ($existing_record) {
            $response['status'] = "fail";
            $response['message'] = 'Error: Record already exists for employee ' . $employee_id . ' on ' . $formatted_date;
            echo json_encode($response);
            return;
        }
    
        $data = array(
            /*column name*/
            'emp_id' => $employee_id,
            'date' => $formatted_date,
            'time_in' =>  $time_in,
            'time_out' => $time_out,
        );
    
        // Insert data into the database
        $sql = $this->db->insert('attendance', $data);
    
        if ($sql) {
            $response['status'] = "success";
            $response['message'] = 'Done';
            $response['formatted_date'] = $formatted_date; // Include formatted date in the response
        } else {
            $response['status'] = "fail";
            $response['message'] = 'Error date: ' . $att_date;
        }
    
        echo json_encode($response);
    }
    
    
    public function department_role_insert() {
        // Assuming the form data is posted via AJAX
        if ($this->input->is_ajax_request()) {
            $role_title = $this->input->post('create_role_title');
            $description = $this->input->post('create_role_description');
            $department_id = $this->input->post('create_role_department');
            $salary = $this->input->post('create_role_salary');
            $salary_type = $this->input->post('create_role_salary_type');
    
            $data = array(
                /*column name*/
                'roles' => $role_title,
                'description' => $description,
                'department' => $department_id,
                'salary' =>  $salary,
                'salary_type' => $salary_type,
            );
    
            // Insert data into the database
            $sql = $this->db->insert('department_roles', $data);
    
            if ($sql) {
                $response['status'] = "success";
                $response['message'] = 'Done';
            } else {
                $response['status'] = "fail";
            }
    
            echo json_encode($response);
        }
    }
    

    public function department_role_update() {
        // Assuming the form data is posted via AJAX
        if ($this->input->is_ajax_request()) {
            $role_id = $this->input->post('edit_role_id');
            $role_title = $this->input->post('edit_role_title');
            $description = $this->input->post('edit_role_description');
            $department_id = $this->input->post('edit_role_department');
            $salary = $this->input->post('edit_role_salary');
            $salary_type = $this->input->post('edit_role_salary_type');
    
            $data = array(
                /*column name*/
                'roles' => $role_title,
                'description' => $description,
                'department' => $department_id,
                'salary' => $salary,
                'salary_type' => $salary_type,
            );
    
            // Update data in the database
            $this->db->where('id', $role_id);
            $sql = $this->db->update('department_roles', $data);
    
            if ($sql) {
                $response['success'] = true;
                $response['message'] = 'Role updated successfully';
            } else {
                $response['success'] = false;
                $response['message'] = 'Failed to update role';
            }
    
            echo json_encode($response);
        }
    }
    


















}
