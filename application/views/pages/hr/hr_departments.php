<style>
    label.btn.btn-light.btn-rounded:hover {
        /* background-color: red !important; */
        background-color: #26c769 !important;
        /* color: #fff !important; */


    }

    input[type='checkbox']:checked+label.btn.btn-light.btn-rounded {
        /* Your styles here */

        background-color: #26c769 !important;
        color: #fff !important;

    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="..\assets\text-editor\node_modules\froala-editor\css\froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="..\assets\text-editor\node_modules\froala-editor\js\froala_editor.pkgd.min.js"></script>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->
    <!-- Two Col Sidebar -->

    <!-- /Two Col Sidebar -->
    <!-- Page Wrapper -->
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Departments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">HR Home</a></li>
                            <li class="breadcrumb-item active">Departments</li>
                        </ul>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#con-close-modal">
                            <span class="fa-solid fa-plus"></span> Add Department</button>

                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_announcements" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Acronym</th>
                                    <th>Staff Count</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                echo ' <input type="checkbox" class="btn-check" id="select_all" group="dept_multi" autocomplete="off">
    <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="select_all" style = "font-size:12px;margin:2px">All</label>';

                                //get select-options
                                $query =  $this->db->get('department');
                                $data['query'] = $query;
                                // Check if query executed successfully
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {

                                ?>
                                        <tr class="hoverable-row" data-dept-id="<?php echo $row->id; ?>">
                                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <?php echo $row->department; ?>
                                            </td>

                                            <td>
                                                <?php echo $row->acro_dept; ?>

                                            </td>

                                            <td>
                                                <?php
                                                $this->db->select('department, COUNT(id) as count')
                                                    ->from('department_roles')
                                                    ->where('department', $row->id);

                                                $query = $this->db->get();
                                                $result = $query->result_array();

                                                $staff_count = $result[0]['count'];
                                                echo $staff_count;
                                                ?>
                                            </td>


                                            <td>
                                                <div class = "d-inline-flex">
                                                <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" 
                                                data-bs-target="#edit_employee" data-emp-id="" title = "Edit">
                                                    <i class="fa-solid fa-pencil m-r-5"></i>
                                                </a>

                                                <?php
                                                if($staff_count == 0){
                                                    echo '

                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_approve_" title = "Delete">
                                                       <i class="fa-regular fa-trash-can m-r-5"></i> 
                                                   </a>
                                                    ';
                                                }
                                                
                                                ?>
                                              

                                                </div>
                                              


                                                <!-- <div class="dropdown">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="material-icons">more_vert</i>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="">
                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_">
                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                        </a>
                                                    </div>
                                                </div> -->
                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    // Handle no results from the database
                                    echo '<tr>No departments found</tr>';
                                }
                                ?>

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

<!-- jQuery -->





<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/departments') ?>']").parent().addClass("active");


    })
</script>