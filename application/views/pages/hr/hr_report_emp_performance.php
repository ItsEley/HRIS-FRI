<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Performance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Employee Performance</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->



            <!-- data table -->
            <div class="row timeline-panel">
                <table id="dt_emp_performance" class="datatable table-striped custom-table mb-0">
                    <thead>
                        <tr class="text-center">
                            <th hidden>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Date Joined</th>
                            <th>Last Evaluation</th>
                            <th>Performance Rating</th>
                            <th>Remarks</th>
                            <th>Action</th>


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
                        department_roles dr ON e.role = dr.id;
                    ");

                        foreach ($query->result() as $row) {

                        ?>
                            <tr class="hoverable-row text-center">
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" hidden>
                                    <?php echo $data['emp_id'] = $row->employee_id; ?>
                                </td>
                                <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                    <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                        <?php echo $data['emp_name'] = $row->full_name; ?>
                                    </div>
                                </td>

                                <td name="emp_dept_id" data-dept-id="<?php echo $row->department_id ?>">
                                    <?php echo $row->department ?>
                                </td>
                                <td name="emp_role_id" data-role-id="<?php echo $row->role_id ?>">
                                    <?php echo $row->role; ?>
                                </td>

                                <td>
                                    <?php
                                    $query = $this->db->query("
  SELECT `date_created` FROM `employee` WHERE id = '$row->employee_id';
  ");

                                    foreach ($query->result() as $row) {
                                        echo formatDateOnly($row->date_created);
                                    }

                                    ?>

                                </td>

                                <td>
                                    <?php

                                    if (rand(0, 1) == 1) {
                                        echo "--";
                                    } else {
                                        // Define the range for the date (start and end dates)
                                        $start_date = new DateTime('2024-01-01');
                                        $end_date = new DateTime('2024-12-31');

                                        // Generate a random timestamp within the range
                                        $random_timestamp = mt_rand($start_date->getTimestamp(), $end_date->getTimestamp());

                                        // Create a DateTime object from the random timestamp
                                        $random_date = new DateTime();
                                        $random_date->setTimestamp($random_timestamp);

                                        // Format the random date as desired
                                        $formatted_random_date = $random_date->format('Y-m-d');

                                        echo formatDateOnly($formatted_random_date);
                                    }


                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $rating = rand(22, 100);
                                    echo $rating . "%";
                                    ?>

                                </td>

                                <td>
                                    <?php

                                    if ($rating >= 22 & $rating <= 34) {
                                        echo "Unfit";
                                    } else if ($rating >= 35 & $rating <= 50) {
                                        echo "Unsatisfactory";
                                    } else if ($rating >= 51 & $rating <= 60) {
                                        echo "No Improvement";
                                    } else if ($rating >= 61 & $rating <= 71) {
                                        echo "Needs Improvement";
                                    } else if ($rating >= 72 & $rating <= 80) {
                                        echo "Satisfactory";
                                    } else if ($rating >= 81 & $rating <= 88) {
                                        echo "Exceeds Expectation";
                                    } else if ($rating >= 89 & $rating <= 94) {
                                        echo "Exceptional";
                                    } else if ($rating >= 95 & $rating <= 100) {
                                        echo "Excemplary";
                                    }

                                    ?>


                                </td>

                                <td>
                                <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" >
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>


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

<!-- jQuery -->




<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("li > a[href='<?= base_url('hr/reports/employee_performance') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/reports/employee_performance') ?>']").parent().parent().css("display", "block")

        $('#dt_emp_performance').DataTable();


    })
</script>