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
            <!-- /Page Header -->


            <!-- data table -->
            <div class="row timeline-panel">
                <table id="dt_report_timesheet" class="datatable table-striped custom-table mb-0">
                    <thead>
                        <tr class = "text-center">
                            <th hidden>ID</th>
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

                        $query = $this->db->query("SELECT 
                        e.employee_id,
                        e.id AS employee_id,
                        CONCAT(e.fname, ' ', e.mname, ' ', e.lname) AS full_name,
                        e.department AS department_id,
                        d.department AS department,
                        e.role AS role_id,
                        dr.roles AS role
                    FROM 
                        employee e
                    JOIN 
                        department d ON e.department = d.id
                    JOIN 
                        department_roles dr ON e.role = dr.id;");

                        foreach ($query->result() as $row) {



                        ?>
                            <tr class="hoverable-row text-center">
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" hidden>
                                    <?php echo $data['emp_id'] = $row->emp_id; ?>
                                </td>
                                <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                    <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                        <?php echo $data['emp_name'] = $row->full_name;; ?>
                                    </div>
                                </td>

                                <td><?php echo "March 26, 2024" ?></td>
                                <td><?php

                                    // Generate random hour between 7 and 8
                                    $hour = rand(7, 8);
                                    // If the hour is 8, generate random minute between 0 and 15, otherwise between 0 and 59
                                    $minute = ($hour == 8) ? rand(0, 15) : rand(0, 59);
                                    // Format the time
                                    $time_in = sprintf('%02d:%02d', $hour, $minute);
                                    // Output the generated time
                                    if($hour >= 8 ){
                                        echo "$time_in - <span class='att-o'></span>";
                                    }else{
                                        echo "$time_in - <span class='att-l'></span>";


                                    }
                                    ?></td>

                                <td><?php

                                    // Generate random hour between 7 and 8
                                    $hour = rand(4, 6);
                                    // If the hour is 8, generate random minute between 0 and 15, otherwise between 0 and 59
                                    $minute = ($hour == 6) ? rand(0, 15) : rand(0, 59);
                                    // Format the time
                                    $time_out = sprintf('%02d:%02d', $hour, $minute);
                                    // Output the generated time
                                    echo $time_out;
                                    ?> </td>

                                <td>
                                    <?php


                                    // Convert time strings to DateTime objects
                                    $time_in_obj = DateTime::createFromFormat('H:i', $time_in);
                                    $time_out_obj = DateTime::createFromFormat('H:i', $time_out);

                                    // Add 12 hours to time_out
                                    $time_out_obj->modify('+11 hours');

                                    // Calculate the time difference
                                    $time_diff = $time_out_obj->diff($time_in_obj);

                                    // Format the result
                                    $total_time_formatted = $time_diff->format('%H:%I');
                               // Calculate total hours
                                    $total_hours = $time_diff->h + ($time_diff->days * 24);

                                    

                                    echo $total_time_formatted;

                                    ?>

                                </td>

                                <td>
                                    <?php
                                    if ($total_hours >= 8) {
                                        echo "✅";
                                    } else {
                                        echo "❌";
                                    }
                                    ?>

                                </td>


                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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

    });
</script>