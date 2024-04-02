<style>
    input[readonly],
    textarea[readonly] {
        background-color: white !important;
        box-shadow: none;
        cursor: default;
    }
</style>

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
                        <h3 class="page-title">Performance Evaluation</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Performance</li>
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

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->select('COUNT(*) as count');
                    $this->db->from('f_leaves');
                    $this->db->where('status', 'Approved');
                    $this->db->where('CURDATE() BETWEEN date_from AND date_to');

                    // Execute the query
                    $query = $this->db->get();

                    $data['count'] = $query->row_array()['count'];
                    $data['label'] = "Pending Evaluation";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Lowest Rating";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Average Rating";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>

                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Highest Rating";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>


            </div>

            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">Pending</a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">History</a></li>
            </ul>
            <div class="tab-content">


                <div class="tab-pane show active" id="solid-tab1">

                    <!-- data table -->
                    <div class="row timeline-panel">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt_emp_list" class="datatable table-striped custom-table mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Role</th>
                                            <th>Date Joined</th>
                                            <th>Last Evaluation</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = $this->db->query('
                                SELECT employee.id,vw_emp_designation.full_name,employee.current_add,
                                employee.contact_no,vw_emp_designation.department,vw_emp_designation.roles,
                                employee.date_created
                                FROM vw_emp_designation
                                JOIN employee
                                ON employee.id = vw_emp_designation.emp_id
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
                                                    <?php echo $row->id; ?>
                                                </td>
                                                <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                                    <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                        <?php echo $row->full_name;; ?>
                                                    </div>
                                                </td>

                                                <td><?php echo $row->department; ?></td>

                                                <td><?php echo $row->roles; ?></td>
                                                <td><?php echo formatDateOnly($row->date_created);?></td>
                                                <td> -- </td>

                                                <td>

                                                <a class="" href="#" data-bs-toggle="modal" data-bs-target="#modal_evaluate_emp"
                                                 data-emp-id="<?php echo $row->id; ?>" style = "color:black">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Evaluate
                                                    </a>
                                                    <!-- <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                    <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->id; ?>">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                                    </div> -->

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
                <div class="tab-pane" id="solid-tab2">

                </div>

            </div>



        </div>
        <!-- /Page Content -->



    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<?php
$this->load->view('components/modal_emp_performance_evaluation');
?>


<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/employees/evaluation') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/evaluation') ?>']").parent().parent().css("display", "block")






    });
</script>