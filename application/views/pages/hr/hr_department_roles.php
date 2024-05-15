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
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Department Roles</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">HR Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ul>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mt-1"
                         data-bs-toggle="modal" data-bs-target="#modal_create_roles">
                            <span class="fa-solid fa-plus"></span> Add Role</button>

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
                                    <th>Role</th>
                                    <th>Description</th>
                                    <th>Deparment</th>
                                    <th>Salary</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                //get select-options
                                $query =  $this->db->query('SELECT 
                                d.id AS dept_id,

                                d.department,
                                dr.id AS role_id,
                                dr.roles AS role,
                                dr.description,
                                dr.salary,
                                dr.salary_type
                            FROM 
                                department_roles dr
                             JOIN 
                                department d ON dr.department = d.id;
                            ');
                                $data['query'] = $query;
                                // Check if query executed successfully
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {

                                ?>
                                        <tr class="hoverable-row" data-dept-id="<?php echo $row->role_id; ?>">
                                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                <?php echo $row->role; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->description; ?>

                                            </td>

                                            <td>
                                                <?php echo $row->department; ?>

                                            </td>

                                            <td>
                                                <?php echo $row->salary?>
                                            </td>


                                            <td>

                                                <button type="button" class="edit-department modal-trigger btn btn-rounded btn-primary p-1 px-2" 
                                                style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_roles"
                                                data-role-id="<?= $row->role_id?>" data-role-title = "<?= $row->role?>"
                                                 data-role-desc="<?= $row->description?>" data-department-id = "<?= $row->dept_id?>"
                                                 data-role-salary = "<?= $row->salary?>" data-role-salary-type = "<?= $row->salary_type?>">
                                                    <i class="fas fa-pencil m-r-5"></i>Edit
                                                </button>
                                                <button type="button" class="edit-department modal-trigger btn btn-rounded btn-danger p-1 px-2" 
                                                style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_department"
                                                data-role-id="<?= $row->role_id?>" data-role-title = "<?= $row->role?>">
                                                    <i class="fas fa-trash m-r-5"></i>Delete
                                                </button>
             


                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    // Handle no results from the database
                                    echo '<tr>No departments found</tr>';
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

<!-- jQuery -->


<?php $this->load->view('templates\modals\dept_roles_create.php'); ?>
<?php $this->load->view('templates\modals\dept_roles_edit.php'); ?>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/department_roles') ?>']").parent().addClass("active");


        $('#dt_announcements').DataTable();



    })
</script>