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
        // Check if the required POST data is set
        if (!$this->input->post('from_') || (!$this->input->post('to_') && !$this->input->post('to_group'))) {
            // Return an error response if the required data is not set
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Missing POST data')));
            return;
        }


        // Get POST data
        $from = $this->input->post('from_');
        $to = $this->input->post('to_');
        $to_group = $this->input->post('to_group');
        $limit = $this->input->post('limit');


        // Construct WHERE clause based on the provided parameters
        $query = '';
        if ($to) {
            $query = $this->db->query("
            SELECT `id`, `message`, `file`, `from_`, `to_`, `timestamp`, `is_read`, `status`
            FROM `chat_messages`
            WHERE (`from_` = $from AND `to_` = $to) OR (`from_` = $to AND `to_` = $from)
            ORDER BY timestamp DESC LIMIT $limit
        ");
        } elseif ($to_group) {

            $query = $this->db->query("
            SELECT cm.id, cm.message, cm.file, cm.from_, cm.to_, cm.to_group, cm.timestamp, cm.is_read, cm.status
            FROM chat_messages cm
            JOIN chat_group cg ON cm.to_group = cg.id
            WHERE cm.to_group = '$to_group'
            ORDER BY timestamp DESC LIMIT $limit

            
        ");
        } else {
            // Return an error response if neither `to_` nor `to_group` is provided
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Missing receiver ID')));
            return;
        }



        // Check if the query was successful
        if (!$query) {
            // Return an error response if the query failed
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => $this->db->error())));
            return;
        }

        // Store messages in an array
        $messages = $query->result_array();

        // Return messages as JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($messages));
    }





    public function send_message()
    {
        $data = array();

        // Check if the message data has been received via POST
        if ($this->input->server("REQUEST_METHOD") == "POST" && $this->input->post('chat_message_input') !== null) {
            // Sanitize and escape the message to prevent SQL injection
            $data['message'] = $this->db->escape_str($this->input->post('chat_message_input'));
            $data['from_'] = $this->db->escape_str($this->input->post('from_'));

            if ($this->input->post('to_group') !== null) {
                $data['to_group'] = $this->db->escape_str($this->input->post('to_group'));
            } else {
                $data['to_'] = $this->db->escape_str($this->input->post('to_'));
            }

            $this->db->insert('chat_messages', $data);

            if ($this->db->affected_rows() > 0) {
                // If the message was successfully inserted, return a success message
                echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully.'));
            } else {
                // If an error occurred while inserting the message, return an error message
                echo json_encode(array('status' => 'error', 'message' => 'Error sending message.'));
            }
        } else {
            // If the message data was not received or the request method is not POST, return an error message
            echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
        }
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
                    // 'pfp' => base64_encode($row->pfp),
                    'attendance_records' => array()
                );


                // Check if pfp is empty
                if (!empty($row->pfp)) {
                    $emp_record['pfp'] = base64_encode($row->pfp);
                } else {
                    // Handle empty pfp
                    $emp_record['pfp'] = null; // Or any default value you prefer
                }


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
                        } else {
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
        // Generate the table row for thead
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

        // Loop through each employee record
        foreach ($attendance_data as $emp_record) {
            $response['table_row'] .= '<tr>';
            $response['table_row'] .= '<td>' . $emp_record['full_name'] . '</td>';

            // Loop through each day of the month
            for ($day = 1; $day <= $num_days; $day++) {
                $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
                $attendance_found = false;

                // Check if attendance records exist for the current day
                foreach ($emp_record['attendance_records'] as $attendance_record) {
                    if ($attendance_record['date'] === $date) {
                        $attendance_found = true;
                        // Display relevant information for the day
                        $response['table_row'] .= "<td>{$attendance_record['status']}</td>";
                        break;
                    }
                }

                // If no attendance record found for the day, display a cross FontAwesome icon
                if (!$attendance_found) {
                    // Use FontAwesome cross icon
                    $response['table_row'] .= "<td><i class='fas fa-times fa-fw text-danger'></i></td>";
                }
            }

            $response['table_row'] .= '<td></td>';
            $response['table_row'] .= '</tr>';
        }

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
                    CONCAT(e.fname, ' ', e.lname) AS emp_name,
                    e.pfp AS profile_picture
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

                // Initialize an empty array to store HTML elements
                $html_elements = array();

                // Iterate through the retrieved people
                foreach ($new_people as $person) {
                    // Encode profile picture to base64
                    $profile_picture = base64_encode($person['profile_picture']);

                    // Construct HTML for each person
                    $html = "<li data-emp-id = '" . $person['employee_id'] . "' class = 'new-message-person'>" .
                        "<div class='chat-block d-flex'>" .
                        "<span class='avatar align-self-center flex-shrink-0'>" .
                        "<img src='data:image/jpeg;base64," . $profile_picture . "' alt='User Image' class = 'img-pfp'>" .
                        "</span>" .
                        "<div class='media-body align-self-center text-nowrap flex-grow-1'>" .
                        "<div class='user-name message-author'>" . $person['emp_name'] . "</div>" .
                        "<span class='designation'>Team Leader</span>" .
                        "</div>" .
                        "<div class='text-nowrap align-self-center'>" .
                        "<div class='online-date'></div>" .
                        "</div>" .
                        "</div>" .
                        "</li>";

                    // Add the HTML to the array
                    $html_elements[] = $html;
                }

                // Return the HTML elements array along with success status
                $response = array('success' => true, 'html_elements' => $html_elements);
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



    public function get_day_timesheet() {
        // Retrieve date, month, and year from POST data
         // Retrieve the posted date, month, and year
    $date = str_pad($this->input->post('date'), 2, '0', STR_PAD_LEFT);
    
    $month =str_pad($this->input->post('month'), 2, '0', STR_PAD_LEFT);
    $year = $this->input->post('year');
    $hide = $this->input->post('hide');


    // Construct the full date from the provided parts
    $full_date = "$year-$month-$date";

    
    // Query to retrieve data from the attendance table for the specified date
    $sql_attendance = "SELECT a.attendance_id, a.date, e.famco_id as emp_id, a.time_in, a.time_out,
     a.status, a.num_hr, e.pfp, e.fname, e.lname FROM employee e LEFT JOIN attendance a 
     ON a.emp_id = e.famco_id AND DATE(a.date) = ?";

    
      // Execute the query using CodeIgniter's query builder
    $attendance_data = $this->db->query($sql_attendance, array($full_date))->result();


    
        // Start HTML output buffer
        ob_start();
    
        // Check if there are any rows returned
        if (!empty($attendance_data)) {

            echo "success! date : $full_date | hide : $hide";
            // Loop through each row of data
            foreach ($attendance_data as $row) {
                // Assign variables for readability
        

                $emp_id = $row->emp_id;
                $fname = $row->fname;
                $profile_pic = $row->pfp;
                $lname = $row->lname;
                $date = $row->date;
                $time_in = $row->time_in;
                $time_out = $row->time_out;
                $status = $row->status;
                $num_hr = $row->num_hr;
                $att_id = $row->attendance_id;
    
                // Start HTML row
                if ($time_in !== null && $time_out !== null) {
                    echo '<tr class="hoverable-row text-center " >';

                }else{
                    if($hide == "true"){
                        echo '<tr class="hoverable-row text-center timesheet-absent active" >';

                    }else{
                        echo '<tr class="hoverable-row text-center timesheet-absent" >';

                    }

                }
                echo '<td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" class = "famco-id" hidden>' . $emp_id . '</td>';
     
             


                echo '<td style="max-width: 250px; max-height: 100px; overflow: hidden; display: flex; align-items: center; text-align: left;">';
                echo '<span class="text-center " style="margin-right: 10px; width:35px">';
                
                if (!empty($profile_pic)) {
                    $image_data = base64_encode($profile_pic); // Convert blob data to base64 encoded string
                    $image_src = 'data:image/jpeg;base64,' . $image_data; // Create image source
                    echo '<img src="' . $image_src . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%;">'; // Display image
                } else {
                    echo '<p class="no-profile-picture" title="No profile picture" style="display: flex; align-items: center; justify-content: center; height: 30px; width: 30px; margin: 0;">-</p>                    '; // Display if no profile picture is available
                }


                echo '</span>';
                echo '<div class="ellipsis emp-fullname" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">';
                echo $fname . ' ' . $lname ;
                echo '</div>';
                echo '</td>';


                // Check if time in and time out are not null
                if ($time_in !== null && $time_out !== null) {
                    // Convert time in and time out strings to Unix timestamps
                    $time_in_timestamp = strtotime($time_in);
                    $time_out_timestamp = strtotime($time_out);
    
                    // Define the start of the working day (8:00 AM)
                    $start_of_day = strtotime('8:00 AM');
    
                    // If time in is before the start of the day, set it to the start of the day
                    if ($time_in_timestamp < $start_of_day) {
                        $time_in_timestamp = $start_of_day;
                    }
    
                    // Calculate the difference in seconds between time out and adjusted time in
                    $time_diff_seconds = $time_out_timestamp - $time_in_timestamp;
    
                    // Convert the difference to hours and minutes
                    $hours = floor($time_diff_seconds / 3600);
                    $minutes = floor(($time_diff_seconds % 3600) / 60);
    
                    // Subtract 1 hour
                    $hours -= 1;
    
                    // If the result is negative, set it to 0
                    if ($hours < 0) {
                        $hours = 0;
                        $minutes = 0;
                    }
                    $total_working_time = $hours + ($minutes / 60);
    
                    // Determine remarks based on total working time
                    if ($total_working_time > 8) {
                        $remarks = 'NICE';
                        $icon_class = 'fas fa-check';
                        $icon_color = 'green';
                    } else {
                        $remarks = 'INC';
                        $icon_class = 'fas fa-times';
                        $icon_color = 'red';
                    }
    
                    // Determine the background color based on the time in
                    $background_color = ($time_in_timestamp > $start_of_day) ? 'red' : 'none';
    
                    // Format the time in and time out
                    $time_in_formatted = date("g:i A", $time_in_timestamp);
                    $time_out_formatted = date("g:i A", $time_out_timestamp);
    
                    // Output the time in, time out, and total working time
                    echo '<td><span style="background-color: ' . $background_color . '; padding: 5px; border-radius: 5px; color: ' . (($background_color == 'red') ? 'white' : 'black') . ';">' . $time_in_formatted . '</span></td>';
                    echo '<td>' . $time_out_formatted . '</td>';
                    echo '<td>' . $hours . ' hrs ' . $minutes . ' mins</td>';
                    echo '<td><i class="' . $icon_class . '" style="color: ' . $icon_color . ';"></i> ' . $remarks . '</td>';
                    echo '<td style = "min-width:200px">';
                    echo '<button type="button" class="edit-timesheet modal-trigger btn btn-rounded btn-primary p-1 px-2" 
                    style="margin-right:10px; font-size:10px" data-bs-toggle="modal"
                    data-bs-target="#modal_edit_timesheet"  data-att-id="' . $att_id . '" 
                    data-time-in="' . $row->time_in . '"  data-time-out="' . $row->time_out . '" 
                    data-emp-name = "'.$fname . ' ' . $lname .'" data-date="'.$date.'">
                    <i class="fas fa-pencil m-r-5"></i>Edit
                </button>';
                    echo '<button type="button" class="delete-timesheet modal-trigger btn btn-rounded btn-danger p-1 px-2"
                            style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_delete_timesheet" 
                            data-att-id="' . $att_id . '" data-emp-name = "'.$fname . ' ' . $lname .'" data-date="'.$date.'"><i class="fas fa-trash m-r-5"></i>Delete</button>';
                    echo '</td>';
                } else {
                    // Display 'X' for time in and time out and set remarks to 'Absent'
                    echo '<td><i class="fas fa-times fa-2x" style="color: red;"></i></td>';
                    echo '<td><i class="fas fa-times fa-2x" style="color: red;"></i></td>';
                    echo '<td>0 hrs 0 mins</td>';
                    echo '<td>No record/Absent</td>';
                    echo '<td style = "max-width:200px">';
                    echo '<button type="button" class="a-shift modal-trigger btn btn-rounded btn-success p-1 px-2 create-timesheet"
                     style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_create_timesheet"
                      data-famco-id="' . $emp_id . '" >
                      <i class="fas fa-plus m-r-5"></i>Add'.$emp_id;'</button>';
                    echo "$row->date";
                   echo  '</td>';
                }
                echo '</tr>';
            }
        } else {
            // If no attendance records found
            echo '<tr><td colspan="7">No attendance records found for today.</td></tr>';
        }
    
        // Get the content of the output buffer and clean it
        $html = ob_get_clean();
    
        // Return the result as a response
        echo $html;
    }
    
















} // end class

