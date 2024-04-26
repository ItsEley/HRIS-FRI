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
    <?php $this->load->view('templates/sidebar') ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
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
                    $this->db->from('f_leaves');
                    $this->db->where('status', 'pending');
                    $this->db->where('head_status', 'approved');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_outgoing');
                    $this->db->where('status', 'pending');
                    $this->db->where('head_status', 'approved');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_overtime');
                    $this->db->where('status', 'pending');
                    $this->db->where('head_status', 'approved');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_undertime');
                    $this->db->where('status', 'pending');
                    $this->db->where('head_status', 'approved');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_off_bussiness');
                    $this->db->where('status', 'pending');
                    $this->db->where('head_status', 'approved');
                    $total_count += $this->db->count_all_results();
                    $data['icon_type'] = "1";

                    $data['icon'] = "fa fa-address-book";
                    $data['count'] = $total_count;
                    $data['label'] = "Requests Pending";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon_type'] = "1";

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
                    $data['icon_type'] = "1";

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
                    $data['icon_type'] = "1";

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
                        $data['icon_type'] = "1";

                        $this->db->from('f_leaves');
                        $this->db->where('head_status', 'approved');
                        $this->db->where('status', 'pending');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-1" style="font-size: 10px;">' . $count . '</span>';
                        }

                        ?></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">Pending Outgoing
                        <?php
                        $this->db->from('f_outgoing');
                        $this->db->where('status', 'pending');
                        $this->db->where('head_status', 'approved');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-1" style="font-size: 10px;">' . $count . '</span>';
                        }
                        ?>

                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab3" data-bs-toggle="tab">Pending Overtime

                        <?php
                        $this->db->from('f_overtime');
                        $this->db->where('status', 'pending');
                        $this->db->where('head_status', 'approved');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-1" style="font-size: 10px;">' . $count . '</span>';
                        }
                        ?>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab4" data-bs-toggle="tab">Pending Undertime

                        <?php
                        $this->db->from('f_undertime');
                        $this->db->where('status', 'pending');
                        $this->db->where('head_status', 'approved');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-1" style="font-size: 10px;">' . $count . '</span>';
                        }
                        ?>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab5" data-bs-toggle="tab">Pending Official Business

                        <?php
                        $this->db->from('f_off_bussiness');
                        $this->db->where('status', 'pending');
                        $this->db->where('head_status', 'approved');
                        $data['count'] = $count = $this->db->count_all_results();

                        if ($count > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-1" style="font-size: 10px;">' . $count . '</span>';
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
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date Filled</th>
                                            <th class="text-center">Leave Type</th>
                                            <th class="text-center">Date From</th>
                                            <th class="text-center">Date To</th>
                                            <th class="text-center">Reason</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $session_emp = $_SESSION['id'];
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_leaves f 
                           LEFT JOIN employee e ON f.emp_id = e.id 
                           WHERE f.head_status = 'approved' AND f.status = 'pending' OR f.status IS NULL AND f.emp_id != $session_emp");

                                        foreach ($query->result() as $row) {
                                            $fname = $row->fname;
                                            $lname = $row->lname;
                                            $fullname = $fname . ' ' . $lname;
                                            // Do something with $fullname

                                        ?>

                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $fullname; ?>
                                                </td>
                                                <td name="date_filled"><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo $row->type_of_leave; ?></td>
                                                <td name="date_from"><?php echo formatDateOnly($row->date_from); ?></td>
                                                <td name="date_to"><?php echo formatDateOnly($row->date_to); ?></td>
                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ($row->status); ?></td>
                                                <td class = "d-inline-flex justify-content-between w-75 text-end">

                                                <a class="dropdown-item leave_req" href="#" data-bs-toggle="modal" data-bs-target="#view_request" data-leave-id="<?php echo $row->id; ?>" data-request-type="LEAVE REQUEST">
                                                                <i class="fa-solid fa-pencil m-r-5" title = "Edit"></i> Edit   
                                                            </a>  
                                                
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5" title = "Delete"></i>Delete 
                                                            </a>

                                                    
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="leave_req_det" tabindex="-1" aria-labelledby="edit_employee_label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                                                            <h3 class="m-0 text-center">Leave Request Details</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                                                                <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                                                    <div class="account-logo">
                                                                        <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="update_leave" method="posts">
                                                                <input type="text" class="form-control text-left" id="leave_id" readonly hidden>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="emp_name" class="form-label">Employee Name</label>

                                                                        <input type="text" class="form-control text-left" id="emp_name" readonly>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="date_filled" class="form-label">Date Filled</label>
                                                                        <input type="text" class="form-control" id="date_filled" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-4">
                                                                        <label for="leave_type">Leave Type</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="leave_type" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_from">Date From</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="date_from" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_to">Date To</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="date_to" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="leave_reason">Leave Reason</label>
                                                                    <div>
                                                                        <textarea class="form-control" id="leave_reason" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="leave_denyButtonHr" class="btn btn-danger btn-block ">Deny</button>
                                                            <button id="leave_approveButtonHr" class="btn btn-primary btn-block" data-row-id="<?php echo $row->id; ?>">Approve</button>


                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
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

                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="outgoingreq_dt" class="datatable table-striped custom-table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">Date Filled</th>
                                                        <th class="text-center">Destination</th>
                                                        <th class="text-center">Time From</th>
                                                        <th class="text-center">Time To</th>
                                                        <th class="text-center">Reason</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_outgoing f 
                                       LEFT JOIN employee e ON f.emp_id = e.id 
                                       WHERE f.head_status = 'approved' AND f.status = 'pending'");

                                                    foreach ($query->result() as $row) {
                                                        $fname = $row->fname;
                                                        $lname = $row->lname;
                                                        $fullname = $fname . ' ' . $lname;
                                                    ?>
                                                        <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                            <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                                <?php echo $fullname; ?>
                                                            </td>
                                                            <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                            <td name="leave_type"><?php echo $row->going_to; ?></td>
                                                            <td name="date_from"><?php echo date("h:i A", strtotime($row->time_from)); ?></td>
                                                            <td name="date_to"><?php echo date("h:i A", strtotime($row->time_to)); ?></td>
                                                            <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                            <td name="status"><?php echo ucwords($row->status); ?></td>
                                                            <td class = "d-inline-flex justify-content-between w-75 text-end">
                                                            <a class="dropdown-item og_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_outgoing" data-og-id="<?php echo $row->id; ?>" data-request-type="OUTGOING REQUEST">
                                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                                        </a>

                                                                        <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                                        </a>
                                                            </td>
                                                        </tr>

                                                        <div class="modal fade" id="og_req_det" tabindex="-1" aria-labelledby="edit_outgoing_label" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg ">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                                                                        <h3 class="m-0 text-center">Outgoing Request Details</h3>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                                                                            <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                                                                <div class="account-logo">
                                                                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 200px; height: auto;" /> <!-- Adjusted logo size -->
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <form id="update_outgoing" method="post">
                                                                            <div class="mb-3 row">
                                                                                <div class="col-md-6">
                                                                                    <label for="emp_name" class="form-label">Employee Name</label>
                                                                                    <input type="text" class="form-control text-left" id="emp_name" readonly>

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="date_filled" class="form-label">Date Filled</label>
                                                                                    <input type="text" class="form-control" id="date_filled" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="mb-3 row">
                                                                                <div class="col-md-4">
                                                                                    <label for="leave_type">Destination</label>
                                                                                    <div>
                                                                                        <input type="text" class="form-control" id="destin" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="date_from">Time From</label>
                                                                                    <div>
                                                                                        <input type="text" class="form-control" id="date_from" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label for="date_to">Time To</label>
                                                                                    <div>
                                                                                        <input type="text" class="form-control" id="date_to" readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label for="leave_reason">Reason</label>
                                                                                <div>
                                                                                    <textarea class="form-control" id="outgoing_reason" rows="3" readonly></textarea>
                                                                                </div>
                                                                            </div>
                                                                            

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button id="og_denyButtonHr"data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>

                                                                        <button id="og_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>
                                                                    </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>


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
                                <table id="overtime_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date Filled</th>
                                            <th class="text-center">OT Date</th>
                                            <th class="text-center">Time From</th>
                                            <th class="text-center">Time To</th>
                                            <th class="text-center">Reason</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_overtime f 
                                       LEFT JOIN employee e ON f.emp_id = e.id 
                                       WHERE f.head_status = 'approved' AND f.status = 'pending'");

                                        foreach ($query->result() as $row) {
                                            $fname = $row->fname;
                                            $lname = $row->lname;
                                            $fullname = $fname . ' ' . $lname;
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="ot_emp_name">
                                                    <?php echo $fullname; ?>
                                                </td>
                                                <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo formatDateOnly($row->date_ot); ?></td>


                                                <td name="date_from"><?php echo date("h:i A", strtotime($row->time_in)); ?></td>
                                                <td name="date_to"><?php echo date("h:i A", strtotime($row->time_out)); ?></td>
                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td class = "d-inline-flex justify-content-between">
                                                <a class="dropdown-item ot_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime" data-ot-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="ot_req_det" tabindex="-1" aria-labelledby="edit_overtime_label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                                                            <h3 class="m-0 text-center">Overtime Request Details</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                                                                <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                                                    <div class="account-logo">
                                                                        <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="update_outgoing" method="post">
                                                                <input type="text" class="form-control text-left" id="ot_id" readonly>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="emp_name" class="form-label">Employee Name</label>
                                                                        <input type="text" class="form-control text-left" id="ot_emp_name" readonly>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="date_filled" class="form-label">Date Filled</label>
                                                                        <input type="text" class="form-control" id="ot_date_filled" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 row">
                                                                    <div class="col-md-4">
                                                                        <label for="leave_type">Overtime Date</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ot_date" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_from">Time From</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ot_time_from" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_to">Time To</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ot_time_to" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="leave_reason">Reason</label>
                                                                    <div>
                                                                        <textarea class="form-control" id="ot_reason" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 mx-auto">
                                                                        <div class="input-block mb-3 form-focus select-focus text-center">
                    
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="ot_denyButtonHr"data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>

                                                            <button id="ot_approveButtonHr" class="btn btn-primary" data-row-id="<?php echo $row->id; ?>">Approve</button>
                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
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

                                <table id="undertime_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>

                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date Filled</th>
                                            <th class="text-center">Undertime Date</th>
                                            <th class="text-center">Time From</th>
                                            <th class="text-center">Time To</th>
                                            <th class="text-center">Reason</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_undertime f 
                                       LEFT JOIN employee e ON f.emp_id = e.id 
                                       WHERE f.head_status = 'approved' AND f.status = 'pending'");

                                        foreach ($query->result() as $row) {
                                            $fname = $row->fname;
                                            $lname = $row->lname;
                                            $fullname = $fname . ' ' . $lname;
                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $fullname; ?>
                                                </td>
                                                <td><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="leave_type"><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="time_in"><?php echo date("h:i A", strtotime($row->time_in)); ?></td>
                                                <td name="time_out"><?php echo date("h:i A", strtotime($row->time_out)); ?></td>

                                                <td name="leave_reason" style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td class = "d-inline-flex justify-content-between w-75 text-end">
                                                <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                <a class="dropdown-item ut_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_undertime" data-ut-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>

                                                          
                                                    
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="ut_req_det" tabindex="-1" aria-labelledby="edit_undertime_label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                                                            <h3 class="m-0 text-center">Undertime Request Details</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                                                                <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                                                    <div class="account-logo">
                                                                        <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="update_outgoing" method="post">
                                                                <input type="text" class="form-control text-left" id="ut_id" readonly hidden>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="emp_name" class="form-label">Employee Name</label>
                                                                        <input type="text" class="form-control text-left" id="ut_emp_name" readonly>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="date_filled" class="form-label">Date Filled</label>
                                                                        <input type="text" class="form-control" id="ut_date_filled" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 row">
                                                                    <div class="col-md-4">
                                                                        <label for="leave_type">Undertime Date</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ut_date" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_from">Time From</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ut_time_from" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="date_to">Time To</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ut_time_to" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label for="leave_reason">Reason</label>
                                                                    <div>
                                                                        <textarea class="form-control" id="ut_reason" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                                


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="ut_denyButtonHr"data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>
                                                            <button id="ut_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>


                                                        </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>


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
                                <table id="ob_dt" class="datatable table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Date Applied</th>
                                            <th class="text-center">Destin From</th>
                                            <th class="text-center">Destin To</th>
                                            <th class="text-center">Time From</th>
                                            <th class="text-center">Time To</th>
                                            <th class="text-center">Reason</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_off_bussiness f 
                                       LEFT JOIN employee e ON f.emp_id = e.id 
                                       WHERE f.head_status = 'approved' AND f.status = 'pending'");

                                        foreach ($query->result() as $row) {
                                            $fname = $row->fname;
                                            $lname = $row->lname;
                                            $fullname = $fname . ' ' . $lname;
                                        ?>

                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->id ?>">
                                                <td style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;" name="ob_emp_name">
                                                    <?php echo $fullname; ?>
                                                </td>
                                                <td name="ob_date_filled"><?php echo formatDateOnly($row->date_filled); ?></td>
                                                <td name="ob_destin_from"><?php echo $row->destin_from; ?></td>
                                                <td name="ob_destin_to"><?php echo $row->destin_to; ?></td>
                                                <td name="ob_time_from"><?php echo date("h:i A", strtotime($row->time_from)); ?></td>
                                                <td name="ob_time_to"><?php echo date("h:i A", strtotime($row->time_to)); ?></td>


                                                <td name="ob_reason" style="max-width: 200px; overflow: hidden; 
                    text-overflow: ellipsis; white-space: nowrap;cursor: pointer;user-select:none" title="Double click to expand"><?php echo $row->reason; ?></td>
                                                <td name="status"><?php echo ucwords($row->status); ?></td>
                                                <td class = "d-inline-flex justify-content-between">
                                                <a class="dropdown-item ob_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_ob" data-ob-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="ob_req_det" tabindex="-1" aria-labelledby="edit_ob_label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                                                            <h3 class="m-0 text-center">Official Business Request Details</h3>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-4 justify-content-center"> <!-- Added justify-content-center to center horizontally -->
                                                                <div class="col-md-9 d-flex justify-content-center align-items-center"> <!-- Added justify-content-center to center horizontally -->
                                                                    <div class="account-logo">
                                                                        <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <form id="update_outgoing" method="post">
                                                                <input type="text" class="form-control text-left" id="ob_id" readonly>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="emp_name" class="form-label">Employee Name</label>
                                                                        <input type="text" class="form-control text-left" id="ob_emp_name" readonly>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="date_filled" class="form-label">Date Filled</label>
                                                                        <input type="text" class="form-control" id="ob_date_filled" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="leave_type">Destination From</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ob_destin_from" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="leave_type">Destination To</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ob_destin_to" readonly>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <div class="col-md-6">
                                                                        <label for="date_from">Time From</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ob_time_from" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="date_to">Time To</label>
                                                                        <div>
                                                                            <input type="text" class="form-control" id="ob_time_to" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <label for="leave_reason">Reason</label>
                                                                    <div>
                                                                        <textarea class="form-control" id="ob_reason" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                                


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button id="ob_denyButtonHr"data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny <?php echo $row->id; ?></button>

                                                            <button id="ob_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



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
        <form id="leave_request1" method="post">
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
        <form id="outgoing_request1" method="post">
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
                                <input type="date" class="form-control" name="outgoing_date" id="outgoing_date" min="<?php echo date('Y-m-d'); ?>" />
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
        <form method="post" id="ot_request1">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                    <h3 class="m-0 text-center">Overtime Request Form</h3>
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
                                <label for="ot_date" class="form-label">Date of Overtime</label>
                                <input type="date" class="form-control" name="ot_date" id="ot_date" min="<?php echo date('Y-m-d'); ?>" />
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
                    <!-- <h5 class="modal-title">Outgoing Pass</h5> -->
                    <h3 class="m-0 text-center">Undertime Request Form</h3>
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
                                <label for="undertime_date" class="form-label">Date of Undertime</label>
                                <input type="date" class="form-control" name="undertime_date" id="undertime_date" min="<?php echo date('Y-m-d'); ?>" />
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
<div class="modal fade" id="add_ob" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_ob_request_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal size if needed -->
        <form method="post" id="ob_request1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0">Official Business Form</h5> <!-- Adjusted title -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="account-logo">
                                    <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Incorporated" style="max-width: 100px; height: auto;" /> <!-- Adjusted logo size -->
                                </div>
                            </div>
                            <div class="col-md-10">
                                <!-- Empty column for alignment -->
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
                                <label for="outgoing_pass_date" class="form-label">Date</label>
                                <input type="date" class="form-control" name="ob_date" id="ob_date" min="<?php echo date('Y-m-d'); ?>" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="destin_from" class="form-label">Destination From</label>
                                <input type="text" class="form-control" name="destin_from" id="destin_from" />
                            </div>
                            <div class="col-md-6">
                                <label for="destin_to" class="form-label">Destination To</label>
                                <input type="text" class="form-control" name="destin_to" id="destin_to" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="time_from" class="form-label">Time From</label>
                                <input type="time" class="form-control" name="time_from" id="time_from" />
                            </div>
                            <div class="col-md-6">
                                <label for="time_to" class="form-label">Time To</label>
                                <input type="time" class="form-control" name="time_to" id="time_to" />
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
<script>
    $(document).ready(function() {
        $('.ot_req').click(function() {
            // Get the closest table row to the clicked "Edit" action
            var row = $(this).closest('tr');

            // Retrieve data from the table row
            let ot_id = $(this).attr("data-ot-id");
            var ot_emp_name = row.find('td[name="ot_emp_name"]').text().trim();
            var dateFilled = row.find('td:eq(1)').text().trim(); // Using :eq() to get the second column
            var otDate = row.find('td[name="leave_type"]').text().trim();
            var timeFrom = row.find('td[name="date_from"]').text().trim();
            var timeTo = row.find('td[name="date_to"]').text().trim();
            var otReason = row.find('td[name="leave_reason"]').text().trim();

            // Populate the fields in the modal with the retrieved data
            $('#ot_emp_name').val(ot_emp_name);
            $('#ot_date_filled').val(dateFilled);
            $('#ot_date').val(otDate);
            $('#ot_time_from').val(timeFrom);
            $('#ot_time_to').val(timeTo);
            $('#ot_reason').val(otReason);
            $('#ot_id').val(ot_id);

            // Show the modal
            $('#ot_req_det').modal('show');
        });
    });

    $(document).ready(function() {
        $('.leave_req').click(function() {
            // Get the closest table row to the clicked "Edit" action
            var row = $(this).closest('tr');

            // Retrieve data from the table row
            let leave_id = $(this).attr("data-leave-id");
            var empName = row.find('td[name="emp_name"]').text().trim();
            var empName = row.find('td[name="emp_name"]').text().trim();
            var dateFilled = row.find('td[name="date_filled"]').text().trim();
            var leaveType = row.find('td[name="leave_type"]').text().trim();
            var dateFrom = row.find('td[name="date_from"]').text().trim();
            var dateTo = row.find('td[name="date_to"]').text().trim();
            var leaveReason = row.find('td[name="leave_reason"]').text().trim();

            // Populate the fields in the modal with the retrieved data
            $('#emp_name').val(empName);
            $('#date_filled').val(dateFilled);
            $('#leave_type').val(leaveType);
            $('#date_from').val(dateFrom);
            $('#date_to').val(dateTo);
            $('#leave_reason').val(leaveReason);
            $('#leave_id').val(leave_id);
            // Show the modal
            $('#leave_req_det').modal('show');
        });
    });

    $(document).ready(function() {
        $('.og_req').click(function() {
            // Get the closest table row to the clicked "Edit" action
            var row = $(this).closest('tr');

            // Retrieve data from the table row
            let og_id = $(this).attr("data-og-id");
            var empName = row.find('td[name="emp_name"]').text().trim();
            var dateFilled = row.find('td:eq(1)').text().trim(); // Using :eq() to get the second column
            var leaveType = row.find('td[name="leave_type"]').text().trim();
            var dateFrom = row.find('td[name="date_from"]').text().trim();
            var dateTo = row.find('td[name="date_to"]').text().trim();
            var leaveReason = row.find('td[name="leave_reason"]').text().trim();

            // Populate the fields in the modal with the retrieved data
            $('#emp_name_og').val(empName);
            $('#date_filled_og').val(dateFilled);
            $('#destin').val(leaveType);
            $('#date_from_og').val(dateFrom);
            $('#date_to_og').val(dateTo);
            $('#outgoing_reason').val(leaveReason);
            $('#og_id').val(og_id);


            // Show the modal
            $('#og_req_det').modal('show');
        });
    });



    $(document).ready(function() {
        $('.ut_req').click(function() {
            // Get the closest table row to the clicked "Edit" action
            var row = $(this).closest('tr');

            // Retrieve data from the table row
            let ut_id = $(this).attr("data-ut-id");
            var empName = row.find('td[name="emp_name"]').text().trim();
            var dateFilled = row.find('td:eq(1)').text().trim(); // Using :eq() to get the second column
            var utDate = row.find('td[name="leave_type"]').text().trim();
            var timeFrom = row.find('td[name="time_in"]').text().trim();
            var timeTo = row.find('td[name="time_out"]').text().trim();
            var utReason = row.find('td[name="leave_reason"]').text().trim();

            // Populate the fields in the modal with the retrieved data
            $('#ut_emp_name').val(empName);
            $('#ut_date_filled').val(dateFilled);
            $('#ut_date').val(utDate);
            $('#ut_time_from').val(timeFrom);
            $('#ut_time_to').val(timeTo);
            $('#ut_reason').val(utReason);
            $('#ut_id').val(ut_id);
            // Show the modal
            $('#ut_req_det').modal('show');
        });
    });

    $(document).ready(function() {
        $('.ob_req').click(function() {
            // Get the closest table row to the clicked "Edit" action
            var row = $(this).closest('tr');

            // Retrieve data from the table row
            let ob_id = $(this).attr("data-ob-id");
            var empName = row.find('td[name="ob_emp_name"]').text().trim();
            var dateFilled = row.find('td[name="ob_date_filled"]').text().trim();
            var destinFrom = row.find('td[name="ob_destin_from"]').text().trim();
            var destinTo = row.find('td[name="ob_destin_to"]').text().trim();
            var timeFrom = row.find('td[name="ob_time_from"]').text().trim();
            var timeTo = row.find('td[name="ob_time_to"]').text().trim();
            var obReason = row.find('td[name="ob_reason"]').text().trim();

            // Populate the fields in the modal with the retrieved data
            $('#ob_emp_name').val(empName);
            $('#ob_date_filled').val(dateFilled);
            $('#ob_destin_from').val(destinFrom);
            $('#ob_destin_to').val(destinTo);
            $('#ob_time_from').val(timeFrom);
            $('#ob_time_to').val(timeTo);
            $('#ob_reason').val(obReason);
            $('#ob_id').val(ob_id);

            // Show the modal
            $('#ob_req_det').modal('show');
        });
    });
</script>



<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/pendingrequests') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/pendingrequests') ?>']").parent().parent().css("display", "block")


    })

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
</script>
<!-- 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
 -->

<script>
    $(document).ready(function() {
        $('#leavereq_dt').DataTable();
        $('#outgoingreq_dt').DataTable();
        $('#overtime_dt').DataTable();
        $('#undertime_dt').DataTable();
        $('#ob_dt').DataTable(); // Initialize DataTable
    });
</script>
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Confirm Approval Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Approve?
                <input type="text" id="approveModalRowId" value="">


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="confirmApproveHr">Approve</button>
              
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="denyModal" tabindex="-1" aria-labelledby="denyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Confirm Deny Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to Deny?
                <input type="text" id="denyModalRowId" value="">
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" class="btn btn-danger" id="confirmDenyHr">Deny</button>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var approveButtonhr = document.getElementById('approveButtonhr');
        var denyButton = document.getElementById('denyButton');
        var approveModal = new bootstrap.Modal(document.getElementById('approveModal'));
        var editEmployeeModal = new bootstrap.Modal(document.getElementById('edit_employee'));

        approveButtonhr.addEventListener('click', function() {
            editEmployeeModal.hide(); // Hide the edit_employee modal
            approveModal.show(); // Show the approveModal
        });

        denyButton.addEventListener('click', function() {
            editEmployeeModal.hide(); // Hide the edit_employee modal
            approveModal.show(); // Show the approveModal
        });

        var confirmApprovehrButton = document.getElementById('confirmApprovehr');
        var confirmDenyButton = document.getElementById('confirmDeny');

        confirmApprovehrButton.addEventListener('click', function() {
            // Perform logic for approving OT status here
            approveModal.hide();
        });

        confirmDenyButton.addEventListener('click', function() {
            // Perform logic for denying OT status here
            approveModal.hide();
        });

        // Add an event listener to the shown.bs.modal event of approveModal
        approveModal.addEventListener('shown.bs.modal', function () {
            editEmployeeModal.hide(); // Hide the edit_employee modal when approveModal is shown
        });
    });
</script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>