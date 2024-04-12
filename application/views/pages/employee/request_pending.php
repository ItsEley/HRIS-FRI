<!-- Main Wrapper -->
<div class="main-wrapper">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <?php
    // $_SESSION[]

    // navbar
    $this->load->view('templates/nav_bar');
    // sidebar
    $this->load->view('templates/sidebar');

    ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pending Requestssss</h3>
                        <?php $emp_id = $this->session->userdata('id');
                        echo $emp_id; ?>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending Requests</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->

            <!-- Leave Statistics -->
            <div class="row">
                <div class="col-md-3 d-flex">
                    <div class="stats-info w-100">
                        <h6>Paid Leaves Left</h6>
                        <?php
                        // Retrieve the user ID from the session
                        $user_id = $this->session->userdata('id');

                        // Get the current year
                        $current_year = date('Y');

                        // Set the start and end dates for the current year
                        $start_date = $current_year . '-01-01';
                        $end_date = $current_year . '-12-31';

                        // Count pending leaves within the current year where the employee ID matches the session ID
                        $this->db->where('emp_id', $user_id);

                        $this->db->where('YEAR(date_filled)', $current_year); // Filter by the current year
                        $pending_leave = $this->db->count_all_results('f_leaves');

                        // Calculate remaining leaves
                        $total_leaves = 5; // Assuming the total number of leaves available is 5
                        $remaining_leaves = $total_leaves - $pending_leave;
                        ?>



                        <h4><?php echo $remaining_leaves; ?><span> Day/s</span></h4>
                    </div>

                </div>
                <div class="col-md-3 d-flex">
                    <div class="stats-info w-100">
                        <h6>Sick Leaves Left</h6>
                        <h4>8 <span>Day/s</span></h4>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="stats-info w-100">
                        <h6>Annual Leaves Left</h6>
                        <h4>10 <span>Day/s</span></h4>
                    </div>
                </div>

                <div class="col-md-3 d-flex">
                    <div class="stats-info w-100">
                        <h6>Pending Requests</h6>
                        <h4>
                            <?php
                            // Get the session user ID
                            $user_id = $this->session->userdata('id');

                            // Count pending leaves where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_leave = $this->db->count_all_results('f_leaves');

                            // Count pending official business requests where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_ob = $this->db->count_all_results('f_off_bussiness');

                            // Count pending outgoing requests where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_og = $this->db->count_all_results('f_outgoing');

                            // Count pending overtime requests where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_ot = $this->db->count_all_results('f_overtime');

                            // Count pending undertime requests where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_ut = $this->db->count_all_results('f_undertime');

                            // Count pending work schedule adjustment requests where the employee ID matches the session ID
                            $this->db->where('emp_id', $user_id);
                            $pending_wsa = $this->db->count_all_results('f_worksched_adj');

                            // Calculate total pending requests
                            $total_pending = $pending_leave + $pending_ob + $pending_og + $pending_ot + $pending_ut + $pending_wsa;

                            // Output the total pending requests
                            echo $total_pending;
                            ?>
                        </h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">

                        Pending Leaves
                        <?php
                        $data['icon_type'] = "1";

                        $this->db->from('f_leaves');
                        $this->db->where('status', 'pending');
                        $this->db->where_in('head_status', array('approved', 'pending'));
                        $session_emp = $_SESSION['id'];
                        $this->db->where('emp_id', $session_emp);

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
                        $this->db->where_in('head_status', array('approved', 'pending'));
                        $session_emp = $_SESSION['id'];
                        $this->db->where('emp_id', $session_emp);
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
                        $this->db->where_in('head_status', array('approved', 'pending'));
                        $session_emp = $_SESSION['id'];
                        $this->db->where('emp_id', $session_emp);
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
                        $this->db->where_in('head_status', array('approved', 'pending'));
                        $session_emp = $_SESSION['id'];
                        $this->db->where('emp_id', $session_emp);
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
                        $this->db->where_in('head_status', array('approved', 'pending'));
                        $session_emp = $_SESSION['id'];
                        $this->db->where('emp_id', $session_emp);
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
                                                                   WHERE (f.head_status = 'pending' AND f.status = 'pending') 
                                                                   OR (f.head_status = 'approve' AND f.status = 'pending') 
                                                                   OR (f.status IS NULL AND f.emp_id != $session_emp)");

                                        foreach ($query->result() as $row) {
                                            // Process retrieved data
                                            $fname = $row->fname;
                                            $lname = $row->lname;
                                            $fullname = $fname . ' ' . $lname;
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
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu update-leave" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <!-- <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee"data-leave-id="<?php echo $row->id; ?>" data-request-type="LEAVE REQUEST" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a> -->
                                                            <a class="dropdown-item leave_req" href="#" data-bs-toggle="modal" data-bs-target="#view_request" data-leave-id="<?php echo $row->id; ?>" data-request-type="LEAVE REQUEST">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
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
                                                                <input type="text" class="form-control text-left" id="leave_id" readonly>
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
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12 mx-auto">
                                                                        <div class="input-block mb-3 form-focus select-focus text-center">
                                                                            <div class="row">
                                                                                <div class="mb-3 row">
                                                                                    <div class="col-sm-6">
                                                                                        <button id="leave_denyButtonHr" class="btn text-danger btn-block bg-white border border-danger">Deny</button>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <button id="leave_approveButtonHr" class="btn btn-primary btn-block" data-row-id="<?php echo $row->id; ?>">Approve</button>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                                    $session_emp = $_SESSION['id'];
                                                    $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_outgoing f 
                                                                               LEFT JOIN employee e ON f.emp_id = e.id 
                                                                               WHERE (f.head_status = 'pending' AND f.status = 'pending') 
                                                                               OR (f.head_status = 'approve' AND f.status = 'pending') 
                                                                               OR (f.status IS NULL AND f.emp_id != $session_emp)");

                                                    foreach ($query->result() as $row) {
                                                        // Process retrieved data
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
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="material-icons">more_vert</i>
                                                                    </a>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                                        <!-- <a class="dropdown-item update-outgoing" href="#" data-bs-toggle="modal" data-bs-target="#edit_outgoing" data-emp-id="<?php echo $row->emp_id; ?>">
                                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                                            </a> -->
                                                                        <a class="dropdown-item og_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_outgoing" data-og-id="<?php echo $row->id; ?>" data-request-type="OUTGOING REQUEST">
                                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                                        </a>

                                                                        <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
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
                                                                            <div class="mb-3 row">
                                                                                <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 mx-auto">
                                                                                    <div class="input-block mb-3 form-focus select-focus text-center">
                                                                                        <button id="og_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>
                                                                                        <button id="og_denyButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        $session_emp = $_SESSION['id'];
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_overtime f 
                                                                     LEFT JOIN employee e ON f.emp_id = e.id 
                                                                     WHERE (f.head_status = 'pending' AND f.status = 'pending') 
                                                                     OR (f.head_status = 'approve' AND f.status = 'pending') 
                                                                     OR (f.status IS NULL AND f.emp_id != $session_emp)");

                                        foreach ($query->result() as $row) {
                                            // Process retrieved data
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
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item ot_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_overtime" data-ot-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
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
                                                                            <button id="ot_approveButtonHr" class="btn btn-primary" data-row-id="<?php echo $row->id; ?>">Approve</button>
                                                                            <button id="ot_denyButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        $session_emp = $_SESSION['id'];
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_undertime f 
                                                                LEFT JOIN employee e ON f.emp_id = e.id 
                                                                WHERE (f.head_status = 'pending' AND f.status = 'pending') 
                                                                OR (f.head_status = 'approve' AND f.status = 'pending') 
                                                                OR (f.status IS NULL AND f.emp_id != $session_emp)");

                                        foreach ($query->result() as $row) {
                                            // Process retrieved data
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
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item ut_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_undertime" data-ut-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
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
                                                                <input type="text" class="form-control text-left" id="ut_id" readonly>
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
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 mx-auto">
                                                                        <div class="input-block mb-3 form-focus select-focus text-center">
                                                                            <button id="ut_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>
                                                                            <button id="ut_denyButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny</button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        $session_emp = $_SESSION['id'];
                                        $query = $this->db->query("SELECT f.*, e.fname, e.lname FROM f_off_bussiness f 
                                                                     LEFT JOIN employee e ON f.emp_id = e.id 
                                                                     WHERE (f.head_status = 'pending' AND f.status = 'pending') 
                                                                     OR (f.head_status = 'approve' AND f.status = 'pending') 
                                                                     OR (f.status IS NULL AND f.emp_id != $session_emp)");

                                        foreach ($query->result() as $row) {
                                            // Process retrieved data
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
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="material-icons">more_vert</i>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                            <a class="dropdown-item ob_req" href="#" data-bs-toggle="modal" data-bs-target="#edit_ob" data-ob-id="<?php echo $row->id; ?>">
                                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                            </a>
                                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                            </a>
                                                        </div>
                                                    </div>
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
                                                                <div class="mb-3 row">
                                                                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12 mx-auto">
                                                                        <div class="input-block mb-3 form-focus select-focus text-center">
                                                                            <button id="ob_approveButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-primary">Approve</button>
                                                                            <button id="ob_denyButtonHr" data-row-id="<?php echo $row->id; ?>" class="btn btn-danger">Deny <?php echo $row->id; ?></button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    </div>
    <div class="modal custom-modal fade" id="approve_leave" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Leave Approve</h3>
                        <p>Are you sure want to approve for this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Decline</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal custom-modal fade" id="delete_approve" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave</h3>
                        <p>Are you sure want to delete this leave?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="view_pending" tabindex="-1" aria-labelledby="viewPendingLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-3" id="viewPendingLabel">View Pending Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fs-5">Name:</label>
                            <span id="modal-name" class="fs-5 fw-bold"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-5">Request Type:</label>
                            <span id="modal-request-type" class="fs-5"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fs-5">Date Filled:</label>
                            <span id="modal-date-filled" class="fs-5"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label fs-5">Reason:</label>
                            <textarea id="modal-reason" class="form-control" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <hr> <!-- Add a horizontal line for separation -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fs-5">Head Status:</label>
                            <span id="modal-head-status" class="fs-5"></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-5">Status:</label>
                            <span id="modal-status" class="fs-5"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#users_pendings').DataTable();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var viewPendLinks = document.querySelectorAll('.view-pend');
            viewPendLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var rowId = link.getAttribute('data-row-id');
                    var rowType = link.getAttribute('data-row-type');
                    var rowName = link.getAttribute('data-row-name');
                    var rowDateFilled = link.getAttribute('data-row-date-filled');
                    var rowStatus = link.getAttribute('data-row-status').toLowerCase(); // Convert to lowercase
                    var rowHeadStatus = link.getAttribute('data-row-head-status').toLowerCase(); // Convert to lowercase
                    var rowReason = link.getAttribute('data-row-reason');
                    var rowHeadId = link.getAttribute('data-row-head-id');
                    var rowHeadStatusDate = link.getAttribute('data-row-head-status-date');

                    document.getElementById('modal-name').innerText = rowName;
                    document.getElementById('modal-request-type').innerText = rowType;
                    document.getElementById('modal-date-filled').innerText = rowDateFilled;
                    document.getElementById('modal-reason').innerText = rowReason;

                    // Set Status with appropriate class
                    var modalStatus = document.getElementById('modal-status');
                    modalStatus.innerText = rowStatus;

                    if (rowStatus === 'pending') { // Check lowercase value
                        modalStatus.classList.add('text-warning');
                    } else if (rowStatus === 'approved') { // Check lowercase value
                        modalStatus.classList.add('text-success');
                    } else if (rowStatus === 'denied') { // Check lowercase value
                        modalStatus.classList.add('text-danger');
                    }

                    // Set Head Status with appropriate text
                    var modalHeadStatus = document.getElementById('modal-head-status');
                    if (rowHeadStatus === 'pending') {
                        modalHeadStatus.innerText = 'Pending';
                    } else if (rowHeadStatus === 'approved' || rowHeadStatus === 'denied') {
                        modalHeadStatus.innerText = `Denied by ${rowHeadId} on ${rowHeadStatusDate}`;
                    }

                    var modal = new bootstrap.Modal(document.getElementById('view_pending'));
                    modal.show();
                });
            });
        });



        $(document).ready(function() {

            $("li > a[href='<?= base_url('leave_pending') ?>']").parent().parent().css("display", "block") //get sidebar item with link
            $("li > a[href='<?= base_url('leave_pending') ?>']").addClass("active"); // for items inside the sidebar


            $("a .dropdown-item.update-req").click(function(e) {
                var target_id = $(this).data("target-id");

                alert(target_id);
                console.log(target_id)

                // AJAX request to fetch employee details
                $.ajax({
                    url: base_url + 'admin/showUserdetails',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        emp_id: emp_id
                    },
                    success: function(employee) {
                        // Populate modal fields with employee data
                        $('#edit_employee input[name="fname"]').val(employee.fname);
                        $('#edit_employee input[name="mname"]').val(employee.mname);
                        $('#edit_employee input[name="lname"]').val(employee.lname);
                        $('#edit_employee input[name="nickn"]').val(employee.nickn);
                        $('#edit_employee input[name="current_add"]').val(employee.current_add);
                        $('#edit_employee input[name="perm_add"]').val(employee.perm_add);
                        $('#edit_employee input[name="age"]').val(employee.age);
                        $('#edit_employee input[name="religion"]').val(employee.religion);
                        $('#edit_employee select[name="sex"]').val(employee.sex);
                        $('#edit_employee select[name="civil_status"]').val(employee.civil_status);
                        $('#edit_employee input[name="pob"]').val(employee.pob);
                        $('#edit_employee input[name="dob"]').val(employee.dob);
                        $('#edit_employee select[name="department"]').val(employee.department);
                        $('#edit_employee input[name="role"]').val(employee.role);
                        $('#edit_employee input[name="pfp"]').val(employee.pfp);
                        $('#edit_employee input[name="email"]').val(employee.email);
                        $('#edit_employee input[name="password"]').val(employee.password);

                        // Show the modal
                        $('#edit_employee').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Handle error if necessary
                    }
                });
            });
        })
    </script>

    </body>

    <!-- Mirrored from smarthr.dreamstechnologies.com/html/template/leaves.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2024 04:02:18 GMT -->

    </html>