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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
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
                        <h3 class="page-title">Pending Requests</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pendings</li>
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

                    $total_count = 0;
                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_outgoing');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_overtime');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_undertime');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_off_bussiness');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $data['icon'] = "fa fa-address-book";
                    $data['count'] = $total_count;
                    $data['label'] = "Requests Pending";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>

                </div>
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
                    $data['label'] = "Active Leaves";

                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('f_overtime');
                    $this->db->where('status', 'approved');
                    $this->db->where('date_ot', date('Y-m-d'));
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active Overtime";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('f_undertime');
                    $this->db->where('status', 'approved');
                    $this->db->where('date_of_undertime', date('Y-m-d'));
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active Undertime";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>
                </div>
            </div>
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">

                        Pending Leaves
                        <?php
                        $this->db->from('vw_emp_leaves');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-primary rounded-pill ms-1" style="font-size: 1.0rem;">' . $count . '</span>';
                        }

                        ?></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">Pending Outgoing
                        <?php
                        $this->db->from('f_outgoing');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-primary rounded-pill ms-1" style="font-size: 1.0rem;">' . $count . '</span>';
                        }
                        ?>

                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab3" data-bs-toggle="tab">Pending Overtime

                        <?php
                        $this->db->from('f_overtime');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-primary rounded-pill ms-1" style="font-size: 1.0rem;">' . $count . '</span>';
                        }
                        ?>


                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab4" data-bs-toggle="tab">Pending Undertime

                        <?php
                        $this->db->from('f_undertime');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-primary rounded-pill ms-1" style="font-size: 1.0rem;">' . $count . '</span>';
                        }
                        ?>


                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab5" data-bs-toggle="tab">Pending Official Business

                        <?php
                        $this->db->from('f_off_bussiness');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-primary rounded-pill ms-1" style="font-size: 1.0rem;">' . $count . '</span>';
                        }
                        ?>

                    </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title mb-0">Pending Leave Request</h4>
                                </div>
                                <div class="col-auto">
                                    <div class="float-end ms-auto">
                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_leave_request">
                                            <i class="fa-solid fa-plus"></i> Add Leave Request
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="leavereq_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date Filled</th>
                                            <th>Leave Type</th>
                                            <th>Date From</th>
                                            <th>Date To</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT * FROM f_leaves WHERE status = 'pending'");;
                                        foreach ($query->result() as $row) {
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->emp_id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $row->emp_id; ?>
                                                </td>
                                                <td name="date_filled"><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo $row->type_of_leave; ?></td>
                                                <td name="date_from"><?php echo formatDateOnly($row->date_from); ?></td>
                                                <td name="date_to"><?php echo formatDateOnly($row->date_to); ?></td>
                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_leavereq" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
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
                </div>
                <div class="tab-pane" id="solid-tab2">
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title mb-0">Pending Outgoing Request</h4>
                                </div>
                                <div class="col-auto">
                                    <div class="float-end ms-auto">
                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_outgoing_pass">
                                            <i class="fa-solid fa-plus"></i> Add Outgoing Request
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- data table -->
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="outgoingreq_dt" class="datatable table-striped custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Date Filled</th>
                                                        <th>Destination</th>
                                                        <th>Time From</th>
                                                        <th>Time To</th>
                                                        <th>Reason</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // $this->db->where('status', 'pending');
                                                    // Execute the query
                                                    $query = $this->db->query("SELECT * FROM f_outgoing WHERE status = 'pending'");;

                                                    foreach ($query->result() as $row) {
                                                    ?>
                                                        <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                            <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                                <?php echo $row->emp_id; ?>
                                                            </td>
                                                            <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                            <td name="leave_type"><?php echo $row->going_to; ?></td>
                                                            <td name="date_from"><?php echo date("h:i A", strtotime($row->time_from)); ?></td>
                                                            <td name="date_to"><?php echo date("h:i A", strtotime($row->time_to)); ?></td>
                                                            <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                            <td name="status"><?php echo ucwords($row->status); ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="material-icons">more_vert</i>
                                                                    </a>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                                        <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                                        </a>
                                                                        <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
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
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="solid-tab3">
                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title mb-0">Pending Overtime Request</h4>
                                </div>
                                <div class="col-auto">
                                    <div class="float-end ms-auto">
                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_overtime_request">
                                            <i class="fa-solid fa-plus"></i> Add Overtime Request
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="leavereq_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date Filled</th>
                                            <th>OT Date</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT * FROM f_overtime WHERE status = 'pending'");;
                                        foreach ($query->result() as $row) {
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $row->emp_id; ?>
                                                </td>
                                                <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo formatDateOnly($row->date_ot); ?></td>


                                                <td name="date_from"><?php echo date("h:i A", strtotime($row->time_in)); ?></td>
                                                <td name="date_to"><?php echo date("h:i A", strtotime($row->time_out)); ?></td>
                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
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

                </div>
                <div class="tab-pane" id="solid-tab4">

                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title mb-0">Pending Undertime Request</h4>
                                </div>
                                <div class="col-auto">
                                    <div class="float-end ms-auto">
                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_undertime_request">
                                            <i class="fa-solid fa-plus"></i> Add Undertime Request
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="leavereq_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Date Filled</th>
                                            <th>Undertime Date</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT * FROM f_undertime WHERE status = 'pending'");;
                                        foreach ($query->result() as $row) {
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $row->emp_id; ?>
                                                </td>
                                                <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="time_in"><?php echo date("h:i A", strtotime($row->time_in)); ?></td>
                                                <td name="time_out"><?php echo date("h:i A", strtotime($row->time_out)); ?></td>

                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
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

                </div>
                <div class="tab-pane" id="solid-tab5">

                    <div class="card mb-0">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title mb-0">Pending Official Business Request</h4>
                                </div>
                                <div class="col-auto">
                                    <div class="float-end ms-auto">
                                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_ob">
                                            <i class="fa-solid fa-plus"></i> Add Official Business Request
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="leavereq_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th>Date Applied</th>
                                            <th>Destin From</th>
                                            <th>Destin To</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT * FROM f_off_bussiness WHERE status = 'pending'");;
                                        foreach ($query->result() as $row) {
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $row->emp_id; ?>
                                                </td>
                                                <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo $row->destin_from; ?></td>
                                                <td name="leave_type"><?php echo $row->destin_to; ?></td>
                                                <td name="time_from"><?php echo date("h:i A", strtotime($row->time_from)); ?></td>
                                                <td name="time_to"><?php echo date("h:i A", strtotime($row->time_to)); ?></td>


                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
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

                </div>

            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<div class="modal fade" id="modal_leave_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_leave_request_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Increased modal size to large -->
        <form id="leave_request" method="post">
            <div class="modal-content">
            <div class="modal-header">
                    <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                    <h3 class="m-0 text-center">Leave Request Form</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                            <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                <div class="account-logo">
                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="emp_id" class="form-label">Select Employee</label>
                                <select class="form-select show-tick" data-live-search="true" name="emp_id" id="emp_id">
                                    <option value="">-- Select an Employee --</option>
                                    <?php
                                    // Get employees from the database
                                    $employees = $this->db->order_by('id', 'ASC')->get('employee');

                                    // Check if there are any employees
                                    if ($employees->num_rows() > 0) {
                                        // Loop through each employee
                                        foreach ($employees->result() as $employee) {
                                            // Output an option for each employee
                                            echo '<option value="' . $employee->id . '">' . $employee->fname . ' ' . $employee->lname . '</option>';
                                        }
                                    } else {
                                        // If no employees found, display a message
                                        echo '<option disabled>No employees found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="emp_pfp" class="form-label">Profile Picture</label>
                                <img src="" id="emp_pfp" class="img-fluid" alt="Profile Picture">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="leaveType" class="form-label">Type of Leave</label>
                                <select class="form-select show-tick" data-live-search="true" name="leaveType">
                                    <option value="">-- Select an Option --</option>
                                    <?php
                                    // Get select-options
                                    $query = $this->db->order_by('id', 'ASC')->get('f_leave_type');

                                    // Check if query executed successfully
                                    if ($query->num_rows() > 0) {
                                        foreach ($query->result() as $row) {
                                            // Output each option with its value and text
                                            echo '<option value="' . $row->id . '">' . $row->leave_type . '</option>';
                                        }
                                    } else {
                                        // Handle no results from the database
                                        // echo '<option value="">No options found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="from_date" class="form-label">From</label>
                                <input type="date" class="form-control" name="from_date" id="from_date" min="<?php echo date('Y-m-d'); ?>" />
                            </div>
                            <div class="col-md-3">
                                <label for="to_date" class="form-label">To</label>
                                <input type="date" class="form-control" name="to_date" id="to_date" min="<?php echo date('Y-m-d'); ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" rows="3" name="reason" placeholder="State your reason here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_outgoing_pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_outgoing_pass_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size if needed -->
        <form id="outgoing_request" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                    <h3 class="m-0 text-center">Outgoing Pass Form</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                            <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                <div class="account-logo">
                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="emp_id" class="form-label">Select Employee</label>
                                <select class="form-select" data-live-search="true" name="emp_id" id="emp_id">
                                    <option value="">-- Select an Employee --</option>
                                    <?php
                                    // Loop through each employee
                                    foreach ($employees->result() as $employee) {
                                        // Output an option for each employee
                                        echo '<option value="' . $employee->id . '">' . $employee->fname . ' ' . $employee->lname . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="outgoing_date" class="form-label">Date</label>
                                <input type="date" class="form-control" name="outgoing_date" id="outgoing_date" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="time_from" class="form-label">From</label>
                                <input type="time" class="form-control" name="time_from" id="time_from" />
                            </div>
                            <div class="col-md-6">
                                <label for="time_to" class="form-label">To</label>
                                <input type="time" class="form-control" name="time_to" id="time_to" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="State your reason here"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" name="destination" id="destination" placeholder="Destination">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_overtime_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_overtime_request_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size if needed -->
        <form method="post" id="ot_request">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="account-logo">
                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 150px; height: auto;" /> <!-- Adjusted logo size -->
                                </div>
                            </div>
                            <div class="col-md-9 d-flex align-items-center">
                                <h3 class="m-0">Overtime Request Form</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="emp_id" class="form-label">Select Employee</label>
                                <select class="form-select show-tick" data-live-search="true" name="emp_id" id="emp_id">
                                    <option value="">-- Select an Employee --</option>
                                    <?php
                                    // Get employees from the database
                                    $employees = $this->db->order_by('id', 'ASC')->get('employee');

                                    // Check if there are any employees
                                    if ($employees->num_rows() > 0) {
                                        // Loop through each employee
                                        foreach ($employees->result() as $employee) {
                                            // Output an option for each employee
                                            echo '<option value="' . $employee->id . '">' . $employee->fname . ' ' . $employee->lname . '</option>';
                                        }
                                    } else {
                                        // If no employees found, display a message
                                        echo '<option disabled>No employees found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ot_date" class="form-label">Date of Overtime</label>
                                <input type="date" class="form-control" name="ot_date" id="ot_date" />
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="from_time" class="form-label">Time from</label>
                                <input type="time" class="form-control" name="from_time" id="from_time" />
                            </div>
                            <div class="col-md-6">
                                <label for="to_time" class="form-label">Time to</label>
                                <input type="time" class="form-control" name="to_time" id="to_time" />
                            </div>


                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="State your reason here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_undertime_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_undertime_request_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size if needed -->
        <form method="post" id="undertime_request">

            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="account-logo">
                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 150px; height: auto;" /> <!-- Adjusted logo size -->
                                </div>
                            </div>
                            <div class="col-md-9 d-flex align-items-center">
                                <h3 class="m-0">Undertime Request Form</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="emp_id" class="form-label">Select Employee</label>
                                <select class="form-select show-tick" data-live-search="true" name="emp_id" id="emp_id">
                                    <option value="">-- Select an Employee --</option>
                                    <?php
                                    // Get employees from the database
                                    $employees = $this->db->order_by('id', 'ASC')->get('employee');

                                    // Check if there are any employees
                                    if ($employees->num_rows() > 0) {
                                        // Loop through each employee
                                        foreach ($employees->result() as $employee) {
                                            // Output an option for each employee
                                            echo '<option value="' . $employee->id . '">' . $employee->fname . ' ' . $employee->lname . '</option>';
                                        }
                                    } else {
                                        // If no employees found, display a message
                                        echo '<option disabled>No employees found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="undertime_date" class="form-label">Date of Undertime</label>
                                <input type="date" class="form-control" name="undertime_date" id="undertime_date" />
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="time_out" class="form-label">Time out</label>
                                <input type="time" class="form-control" name="time_out" id="time_out" />
                            </div>
                            <div class="col-md-6">
                                <label for="time_in" class="form-label">Time in</label>
                                <input type="time" class="form-control" name="time_in" id="time_in" />
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="reason" class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="State your reason here"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>



<div id="view_request" class="modal custom-modal fade p-0 " role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="expanded_vq">

                    <input type="text" name="vq_leave_status" id="vq_leave_status">
                    <input type="text" name="vq_leave_id" id="vq_leave_id">



                    <div class="input-block mb-3 row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly id="vq_emp_name">
                        </div>
                    </div>
                    <div class="input-block mb-3 row">
                        <label class="col-lg-3 col-form-label">Leave Type</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly id="vq_leave_type">
                        </div>
                    </div>
                    <div class="input-block mb-3 row">
                        <label class="col-lg-3 col-form-label">Date</label>
                        <div class="col-lg-9">
                            <input type="email" class="form-control" readonly id="vq_date">
                        </div>
                    </div>
                    <div class="input-block mb-3 row">
                        <label class="col-lg-3 col-form-label">Reason</label>
                        <div class="col-lg-9">
                            <textarea rows="4" cols="5" class="form-control" placeholder="Enter message" readonly id="vq_leave_reason"></textarea>
                        </div>
                    </div>


                    <div class="input-block mb-3 row">
                        <label class="col-lg-3 col-form-label"></label>
                        <div class="col-lg-9">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger" onclick='$("#vq_leave_status").val("denied")'>Deny</button>
                            <button type="submit" class="btn btn-success" onclick='$("#vq_leave_status").val("approved")'>Approve</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/employees/leaves') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/leaves') ?>']").parent().parent().css("display", "block")


        // $('#dt_emp_leaves').DataTable({
        //     "paging": true, // Enable paging
        //     "ordering": true, // Enable sorting
        //     "info": false, // Enable table information display
        //     // You can add more options as needed
        //     destroy: true,
        //     autoWidth: false,
        //     autoHeight: false

        // });


        // $('#dt_emp_leaves_history').DataTable({
        //     "paging": true, // Enable paging
        //     "ordering": true, // Enable sorting
        //     "info": false, // Enable table information display
        //     // You can add more options as needed
        //     destroy: true,
        //     autoWidth: false,
        //     autoHeight: false

        // });



        $("#dt_emp_leaves td[name='leave_reason']").dblclick(function() {

            // console.log($(this).parent());

            let row = $(this).parent()[0].id;

            // console.log(row)
            let leave_id = row.replace("double-click-row_", "");;

            let leave_type = $("#" + row + " td[name='leave_type']")[0].innerHTML;
            let leave_reason = $("#" + row + " td[name='leave_reason']")[0].innerHTML;
            let emp_name = $("#" + row + " td[name='emp_name']")[0].innerHTML;
            let date_to = $("#" + row + " td[name='date_to']")[0].innerHTML;
            let date_from = $("#" + row + " td[name='date_from']")[0].innerHTML;
            let status = $("#" + row + " td[name='status']")[0].innerHTML;


            // console.log(leave_reason[0].innerHTML)


            $("#vq_leave_id").val(leave_id);
            $("#view_request #vq_emp_name").val(emp_name.trim());
            $("#view_request #vq_date").val("From : " + date_from + " To : " + date_to);
            $("#view_request #vq_leave_type").val(leave_type);
            $("#view_request #vq_leave_reason").val(leave_reason);


            $("#view_request #vq_leave_status").val(status);

            // Open the modal
            $('#view_request').modal('show');
        });

        $("#view_request #vq_leave_status").on("change", function() {

            $("#expanded_vq").submit();




        });


        $(document).on("submit", "#expanded_vq", function(e) {
            e.preventDefault();

            // Serialize form data
            var expanded_vq = $(this).serialize();

            // Log serialized form data
            console.log("Serialized Form Data:", expanded_vq);

            // Send AJAX request
            $.ajax({
                url: base_url + 'humanr/update_leave_status',
                type: 'post',
                data: expanded_vq,
                dataType: 'json',
                success: function(res) {
                    if (res.status === 1) {
                        alert(res.msg);
                    } else {
                        alert(res.msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });





    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>