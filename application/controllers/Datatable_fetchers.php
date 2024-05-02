<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_fetchers extends CI_Controller
{
    public function fetch_shifts()
    {
        // Fetch data from the database
        $query = $this->db->query('SELECT * FROM `sys_shifts`');

        // Check if the query was successful
        if ($query && $query->num_rows() > 0) {
            // Fetch the result rows as an array of objects
            $shifts = $query->result();

            // Output the HTML table rows directly
            foreach ($shifts as $shift) {
                echo '<tr>';
                echo '<td hidden>' . $shift->id . '</td>';
                echo '<td>' . $shift->group_ . '</td>';
                echo '<td>' . ($shift->description ? $shift->description : "No description") . '</td>';
                echo '<td>' . formatTimeOnly($shift->time_from) . '</td>';
                echo '<td>' . formatTimeOnly($shift->time_to) . '</td>';
                echo '<td>
                        <button type="button" class="edit-shift modal-trigger btn btn-rounded btn-primary p-1 px-2"
                            style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_shift"
                            data-shift-id="' . $shift->id . '">
                            <i class="fas fa-pencil m-r-5"></i>Edit
                        </button>
                        <button type="button" class="delete-shift modal-trigger btn btn-rounded btn-danger p-1 px-2"
                            style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_delete_shift"
                            data-shift-id="' . $shift->id . '" data-shift-label="' . $shift->group_ . '">
                            <i class="fas fa-trash m-r-5"></i>Delete
                        </button>
                    </td>';
                echo '</tr>';
            }
        } else {
            // Handle case when no rows are returned
            echo '<tr><td colspan="6">No shifts found.</td></tr>';
        }
    }

    // chatss

    public function fetch_messages()
    {


        // Fetch chat messages from the database
        $query = $this->db->where('from_', $_POST['from_'])
            ->where('to_', $_POST['to_'])
            ->get('chat_messages');


        // Store messages in an array
        $messages = array();
        if ($query->num_rows() > 0) {
            $messages = $query->result_array();
        }

        // Return messages as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($messages));
    }



    public function fetch_attendance()
    {
        // Retrieve month and year from POST data
        $month = $this->input->post('month');
        $year = $this->input->post('year');
    
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
    
        // Prepare the SQL query with placeholders
        $sql = "SELECT DISTINCT(a.emp_id), CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS full_name, e.pfp
                FROM attendance AS a
                INNER JOIN employee AS e ON a.emp_id = e.id 
                WHERE a.date LIKE ?";
    
        // Execute the query with placeholders
        $query = $this->db->query($sql, array("$year-$month%"));
    
        // Initialize an array to store the result
        $attendance_data = array();
    
        // Check if the query was successful
        if ($query->num_rows() > 0) {
            // Fetch the result rows as an array of objects
            $result = $query->result();
    
            // Loop through the result
            foreach ($result as $row) {
                $emp_id = $row->emp_id;
    
                $emp_record = array(
                    'emp_id' => $emp_id,
                    'full_name' => $row->full_name,
                    'pfp' => base64_encode($row->pfp),
                    'attendance_records' => array()
                );
    
                // Your original SQL query
                $sql = "SELECT attendance_id, emp_id, date, time_in, status, time_out, num_hr
                        FROM attendance
                        WHERE emp_id = ? AND date LIKE ?
                        ORDER BY date ASC";
    
                // Execute the query with placeholders
                $query1 = $this->db->query($sql, array($emp_id, "$year-$month%"));
    
                // Check if the query was successful
                if ($query1->num_rows() > 0) {
                    // Get the result as an array of rows
                    $result1 = $query1->result_array();
    
                    // Loop through the result
                    foreach ($result1 as $row1) {
                        if ($row1['num_hr'] > 7) {
                            $class = 'fas fa-check text-success';
                            // If num_hr is greater than 7 hours, set class2 to check
                            $class2 = 'fas fa-check text-success';
                        } elseif ($row1['num_hr'] > 4) {
                            // If num_hr is greater than 4 hours but not greater than 7 hours, set class to check and class2 to cross
                            $class = 'fas fa-check text-success';
                            $class2 = 'fas fa-times fa-fw text-danger';
                        }
                        else{
                            $class = 'fas fa-times fa-fw text-danger';
                            $class2 = 'fas fa-times fa-fw text-danger';
                        }

                        $emp_record['attendance_records'][] = array(
                            'attendance_id' => $row1['attendance_id'],
                            'emp_id' => $row1['emp_id'],
                            'date' => $row1['date'],
                            'time_in' => $row1['time_in'],
                            'status' => $row1['status'],
                            'time_out' => $row1['time_out'],
                            'num_hr' => $row1['num_hr'],
                            'class' => $class,
                            'class2' => $class2
                        );
                    }
                }
    
                $attendance_data[] = $emp_record;
            }
        }
    
        // Add month and year to the response
        $response = array(
            'success' => true,
            'attendance_data' => $attendance_data,
            'month' => $month,
            'year' => $year,
            'table_row' => ''
        );
    
        // Generate the table row for thead
        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $response['table_row'] .= '<tr>';
        $response['table_row'] .= '<th>Employee</th>';
        for ($day = 1; $day <= $num_days; $day++) {
            $day_of_week = date('l', strtotime("$year-$month-$day"));
            if ($day_of_week == 'Sunday') {
                $response['table_row'] .= "<th style='color:red'>$day</th>";
            } else {
                $response['table_row'] .= "<th>$day</th>";
            }
        }
        $response['table_row'] .= '<th></th>';
        $response['table_row'] .= '</tr>';
    
        // Return the result as JSON
        echo json_encode($response);
    }
    
    


    public function get_people_new_message()
    {
        // Get the current user's ID securely from the session
        $current_user_id = $this->session->userdata('id');
    
        // Check if the current user's ID is valid
        if (!$current_user_id) {
            // Return an error response if the user ID is not available
            $response = array('success' => false, 'error' => 'User ID not found in session');
        } else {
            // Execute the query with proper parameter binding to prevent SQL injection
            $query = "SELECT 
                        e.id AS employee_id,
                        CONCAT(e.fname, ' ', e.lname) AS emp_name
                    FROM 
                        employee AS e
                    WHERE 
                        e.id != ?
                        AND NOT EXISTS (
                            SELECT 1
                            FROM chat_messages AS cm 
                            WHERE (cm.from_ = ? AND cm.to_ = e.id) 
                                OR (cm.from_ = e.id AND cm.to_ = ?)
                        )";
    
            $result = $this->db->query($query, array($current_user_id, $current_user_id, $current_user_id));
    
            // Check if the query executed successfully
            if ($result) {
                // Fetch the result set as an associative array
                $new_people = $result->result_array();
    
                // Return the array directly as part of a JSON object
                $response = array('success' => true, 'people' => $new_people);
            } else {
                // Log the database error
                $error = $this->db->error();
                log_message('error', 'Database error: ' . $error['message']);
    
                // Return an error response
                $response = array('success' => false, 'error' => 'Database error');
            }
        }
    
        // Set the appropriate content type
        $this->output->set_content_type('application/json');
    
        // Return the JSON response
        $this->output->set_output(json_encode($response));
    }
    
            
    
    
}
