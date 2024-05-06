<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>


    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Reports</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Timesheet</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <!-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a> -->
                        <div class="view-icons">

                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">Tab 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">Tab 2</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">

                    <div class="row timeline-panel">
                        <table id="dt_report_timesheet" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>ID</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time-in</th>
                                    <th>Time-out</th>
                                    <th>Total Hours Worked</th>
                                    <th>Remarks</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to retrieve data from the attendance table for the current date
                                $sql_attendance = "SELECT a.attendance_id, a.emp_id, a.time_in, a.time_out, a.status, a.num_hr,e.pfp, e.fname, e.lname
                   FROM attendance a
                   INNER JOIN employee e ON a.emp_id = e.id
                   WHERE DATE(a.date) = CURDATE()";

                                // Execute the query using CodeIgniter's query builder
                                $attendance_data = $this->db->query($sql_attendance)->result();

                                // Check if there are any rows returned
                                if (!empty($attendance_data)) {
                                    // Loop through each row of data
                                    foreach ($attendance_data as $row) {
                                        // Assign variables for readability
                                        $emp_id = $row->emp_id;
                                        $fname = $row->fname;
                                        $profile_pic = $row->pfp;

                                        $lname = $row->lname;
                                        $time_in = $row->time_in;
                                        $time_out = $row->time_out;

                                        $status = $row->status;
                                        $num_hr = $row->num_hr;

                                        // Start HTML row
                                ?>
                                        <tr class="hoverable-row text-center">
                                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" hidden><?= $emp_id ?></td>
                                            <td class="text-align:right" style="width: 50px;">
                                                <?php
                                                if (!empty($profile_pic)) {
                                                    $image_data = base64_encode($profile_pic); // Convert blob data to base64 encoded string
                                                    $image_src = 'data:image/jpeg;base64,' . $image_data; // Create image source
                                                    echo '<img src="' . $image_src . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%;">'; // Display image
                                                } else {
                                                    echo 'No Profile Picture'; // Display if no profile picture is available
                                                }
                                                ?>
                                            </td>
                                            <td style="max-width: 200px; max-height: 100px; overflow: hidden; text-align: left;">
                                                <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;"><?= $fname ?> <?= $lname ?></div>
                                            </td>
                                            <td><?= date("F j, Y") ?></td>
                                            <?php
                                            // $time_in_timestamp = '7:59 AM';
                                            // Convert time in string to Unix timestamp
                                            $time_in_timestamp = strtotime($time_in);

                                            // Define the start of the working day (8:00 AM)
                                            $start_of_day = strtotime('8:00 AM');

                                            // Determine the background color based on the time in
                                            $background_color = ($time_in_timestamp > $start_of_day) ? 'red' : 'none';

                                            // Format the time in
                                            $time_in_formatted = date("g:i A", strtotime($time_in));
                                            ?>

                                            <td>
                                                <span style="background-color: <?= $background_color ?>; padding: 5px; border-radius: 5px; color: <?= ($background_color == 'red') ? 'white' : 'black'; ?>;"><?= $time_in_formatted ?></span>
                                            </td>


                                            <td><?= date("g:i A", strtotime($time_out)) ?></td>
                                            <?php
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

                                            ?>




                                            <td><?= $hours . " hrs " . $minutes . " mins" ?></td>
                                            <td>
                                                <i class="<?= $icon_class ?>" style="color: <?= $icon_color ?>;"></i> <?= $remarks ?>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // If no attendance records found
                                    ?>
                                    <tr>
                                        <td colspan="7">No attendance records found for today.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>



                        </table>
                    </div>

                </div>
                <div class="tab-pane show" id="solid-tab2">

                    <div class="row timeline-panel">
                        <table id="dt_report_timesheet_absent" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th hidden>ID</th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time-in</th>
                                    <th>Time-out</th>
                                    <th>Total Hours Worked</th>
                                    <th>Remarks</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to retrieve data from the attendance table for the current date
                                $sql_attendance = "SELECT a.attendance_id, a.emp_id, a.time_in, a.time_out, a.status, a.num_hr, e.pfp, e.fname, e.lname
                   FROM attendance a
                   INNER JOIN employee e ON a.emp_id = e.id
                   WHERE DATE(a.date) = CURDATE()";

                                // Execute the query using CodeIgniter's query builder
                                $attendance_data = $this->db->query($sql_attendance)->result();

                                // Check if there are any rows returned
                                if (!empty($attendance_data)) {
                                    // Loop through each row of data
                                    foreach ($attendance_data as $row) {
                                        // Assign variables for readability
                                        $emp_id = $row->emp_id;
                                        $fname = $row->fname;
                                        $profile_pic = $row->pfp;
                                        $lname = $row->lname;
                                        $time_in = $row->time_in;
                                        $time_out = $row->time_out;
                                        $status = $row->status;
                                        $num_hr = $row->num_hr;

                                        // Your existing code for processing the retrieved data goes here...


                                        // Query to retrieve all emp_id values from the employee table
                                        $sql_all_emp_ids = "SELECT id, fname, lname FROM employee";

                                        // Execute the query to get all emp_id values and their corresponding fname and lname
                                        $all_emp_ids_result = $this->db->query($sql_all_emp_ids)->result();

                                        // Extract the emp_id values from the result
                                        $all_emp_ids = array_map(function ($row) {
                                            return $row->id;
                                        }, $all_emp_ids_result);

                                        // Extract the emp_id values returned by the initial query
                                        $existing_emp_ids = array_map(function ($row) {
                                            return $row->emp_id;
                                        }, $attendance_data);

                                        // Find emp_id values that are present in all_emp_ids but not in existing_emp_ids
                                        $missing_emp_ids = array_diff($all_emp_ids, $existing_emp_ids);

                                        // Now $missing_emp_ids contains emp_id values that are not returned by the initial query

                                        // Initialize arrays to store missing employee data
                                        $missing_employee_data = array();

                                        // Loop through each missing emp_id and retrieve fname and lname
                                        foreach ($missing_emp_ids as $missing_emp_id) {
                                            // Find the corresponding fname and lname from $all_emp_ids_result
                                            foreach ($all_emp_ids_result as $employee) {
                                                if ($employee->id == $missing_emp_id) {
                                                    $missing_employee_data[] = array(
                                                        'id' => $missing_emp_id,
                                                        'fname' => $employee->fname,
                                                        'lname' => $employee->lname
                                                    );
                                                    break;
                                                }
                                            }
                                        }

                                        // Now $missing_employee_data contains the emp_id, fname, and lname of employees with missing emp_id values
                                ?>


                                        <tr class="hoverable-row text-center">
                                            <!-- <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" hidden><?= $emp_id ?></td>
                                            <td class="text-align:right" style="width: 50px;">
                                                <?php
                                                if (!empty($profile_pic)) {
                                                    $image_data = base64_encode($profile_pic); // Convert blob data to base64 encoded string
                                                    $image_src = 'data:image/jpeg;base64,' . $image_data; // Create image source
                                                    echo '<img src="' . $image_src . '" alt="Profile Picture" style="width: 30px; height: 30px; border-radius: 50%;">'; // Display image
                                                } else {
                                                    echo 'No Profile Picture'; // Display if no profile picture is available
                                                }
                                                ?>
                                            </td> -->
                                            <td style="max-width: 200px; max-height: 100px; overflow: hidden; text-align: left;">
                                                <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                    <?php
                                                    // Check if $missing_employee_data is not empty
                                                    if (!empty($missing_employee_data)) {
                                                        // Loop through each missing employee data
                                                        foreach ($missing_employee_data as $missing_employee) {
                                                            // Display fname and lname
                                                            echo $missing_employee['fname'] . ' ' . $missing_employee['lname'];
                                                            echo '<br>'; // Add a line break for each employee
                                                        }
                                                    } else {
                                                        // If no missing employee data, display a message
                                                        echo "No missing employee data found.";
                                                    }
                                                    ?>
                                                </div>
                                            </td>

                                            <td><?= date("F j, Y") ?></td>
                                            <?php
                                            // $time_in_timestamp = '7:59 AM';
                                            // Convert time in string to Unix timestamp
                                            $time_in_timestamp = strtotime($time_in);

                                            // Define the start of the working day (8:00 AM)
                                            $start_of_day = strtotime('8:00 AM');

                                            // Determine the background color based on the time in
                                            $background_color = ($time_in_timestamp > $start_of_day) ? 'red' : 'none';

                                            // Format the time in
                                            $time_in_formatted = date("g:i A", strtotime($time_in));
                                            ?>

                                            <td>
                                                <span style="background-color: <?= $background_color ?>; padding: 5px; border-radius: 5px; color: <?= ($background_color == 'red') ? 'white' : 'black'; ?>;"><?= $time_in_formatted ?></span>
                                            </td>


                                            <td><?= date("g:i A", strtotime($time_out)) ?></td>
                                            <?php
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

                                            ?>




                                            <td><?= $hours . " hrs " . $minutes . " mins" ?></td>
                                            <td>
                                                <i class="<?= $icon_class ?>" style="color: <?= $icon_color ?>;"></i> <?= $remarks ?>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    // If no attendance records found
                                    ?>
                                    <tr>
                                        <td colspan="7">No attendance records found for today.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>



                        </table>
                    </div>

                </div>

            </div>
            <!-- /data table -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<!-- id, name, age, department -->
<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/reports/timesheet') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/reports/timesheet') ?>']").parent().parent().css("display", "block")



        $('#dt_report_timesheet').DataTable();
        $('#dt_report_timesheet_absent').DataTable();


    });
</script>