<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>


    <div class="page-wrapper w-100">

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
                        <table id="dt_emp_shift" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Deparment</th>
                                    <th>Day-off</th>
                                    <th>Next day-off</th>
                                    <th>Shift</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('
                                SELECT
                                *
                            FROM
                                vw_emp_designation
                            WHERE
                                vw_emp_designation.emp_id IS NOT NULL
                            ORDER BY
                                vw_emp_designation.emp_id ASC,
                                vw_emp_designation.full_name;
                            
                                ');

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row">
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $data['emp_id'] = $row->emp_id; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $data['emp_name'] = $row->full_name;; ?>
                                            </div>
                                        </td>

                                        <td><?php ?></td>
                                        <td><?php //echo $department; 
                                            ?> {not implemented yet}</td>
                                        <td><?php echo $data['role'] = $row->roles; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                    <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->id; ?>">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div> -->
                                            </div>

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
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").parent().parent().css("display", "block")


        

    });
</script>