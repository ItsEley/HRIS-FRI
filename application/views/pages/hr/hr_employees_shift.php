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
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Shifts</li>
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


            
            <div class="row legend timeline-panel" id="emp_att_legend">
                    <div class="d-flex justify-content-between">
                        <!-- <h3>Legend</h3> -->
                        <p class="m-0"><span class="">Group A</span> - 8:00 AM - 5:00 PM (Regular)</p>
                        <p class="m-0"><span class="">Group B</span> - 6:00 AM - 6:00 PM (Dayshift)</p>
                        <p class="m-0"><span class="">Group C</span> - 6:00 PM - 6:00 AM (Nightshift)</p>
                        </div>
                    <div class="col-4"></div>
                </div>

            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_emp_shift" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Name</th>
                                    <th>Deparment</th>
                                    <th>Role</th>
                                    <th>Day-off</th>
                                    <th>Shift Group</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('
                                SELECT emp.full_name, emp.dept_id, emp.department, emp.acro_dept, emp.dept_roles_id, emp.roles,
                                shifts.day_off, shifts.shift_id, shifts.group_, shifts.time_from, shifts.time_to
                         FROM vw_emp_designation AS emp
                         INNER JOIN vw_emp_shifts AS shifts ON emp.emp_id = shifts.emp_id;
                         
                                ');

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row">
                                        <td hidden></td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $row->full_name; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $row->department;; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $row->roles;?></td>
                                        <td><?php echo $row->day_off;?> </td>
                                        <td><?php echo $row->group_;?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_">
                                                    <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>

                                        </td>


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


<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").parent().parent().css("display", "block")


        // $('#dt_emp_shift').DataTable({
        //     "paging": true, // Enable paging
        //     "ordering": true, // Enable sorting
        //     "info": true // Enable table information display
        //     // You can add more options as needed
        // });



    });
</script>