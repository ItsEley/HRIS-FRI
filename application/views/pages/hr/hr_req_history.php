<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
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
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Forms</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Forms</a></li>
                            <li class="breadcrumb-item active">History</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">

                        <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">

                        <table id="" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Request Type</th>
                                    <th>Date Filled</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Initialize the row array
                                $row_arr = array();

                                // Map table names to request types
                                $table_request_map = array(
                                    'f_leaves' => "LEAVE REQUEST",
                                    'f_worksched_adj' => "WORK SCHED ADJ REQUEST",
                                    'f_undertime' => "UNDERTIME REQUEST",
                                    'f_overtime' => "OVERTIME REQUEST",
                                    'f_outgoing' => "OUTGOING REQUEST",
                                    'f_off_bussiness' => "OFFICIAL BUSINESS REQUEST"
                                );

                                // Query the forms pending view to retrieve relevant rows
                                $query_forms_pending = $this->db
                                    ->select('emp_id, id, date_filled, status, table_name')
                                    ->from('vw_forms_pending')
                                    ->where_in('status', array('approved', 'denied', 'expired'))
                                    ->get();

                                // Iterate through the query results
                                foreach ($query_forms_pending->result() as $row) {
                                    // Set default request type
                                    $request_type = "UNKNOWN REQUEST";

                                    // Check if the table name exists in the mapping
                                    if (isset($table_request_map[$row->table_name])) {
                                        $request_type = $table_request_map[$row->table_name];
                                    }

                                    // Fetch additional data based on employee ID
                                    $employee_query = $this->db->get_where('employee', array('id' => $row->emp_id));
                                    $employee_row = $employee_query->row();

                                    // Initialize row data array
                                    $row_data = array();

                                    if ($employee_row) {
                                        // Add employee-related data to the row data
                                        $row_data['fname'] = $employee_row->fname;
                                        $row_data['lname'] = $employee_row->lname;
                                        $row_data['mname'] = $employee_row->mname;
                                        $row_data['pfp'] = $employee_row->pfp;
                                        $row_data['full_name'] = $employee_row->fname . ' ' . $employee_row->lname;
                                    }

                                    // Construct row data array
                                    $row_data['id'] = $row->id;
                                    $row_data['name'] = isset($row_data['full_name']) ? $row_data['full_name'] : '';
                                    $row_data['request_type'] = $request_type;
                                    $row_data['date_filled'] = $row->date_filled;
                                    $row_data['status'] = $row->status;


                                    // Fetch additional data based on table name
                                    $query_table = $this->db->get_where($row->table_name, array('id' => $row->id));
                                    $table_row = $query_table->row();

                                    if ($table_row) {
                                        // Add relevant data to the row data

                                        // Add relevant data to the row data
                                        switch ($row->table_name) {
                                            case 'f_leaves':

                                                $row_data['emp_id'] = $table_row->emp_id;
                                                $row_data['date_from'] = $table_row->date_from;
                                                $row_data['date_to'] = $table_row->date_to;
                                                $row_data['type_of_leave'] = $table_row->type_of_leave;
                                                $row_data['reason'] = $table_row->reason;
                                                $row_data['comment'] = $table_row->comment;
                                                $row_data['date_ans'] = $table_row->date_ans;

                                                break;
                                            case 'f_overtime':
                                                $row_data['emp_id'] = $table_row->emp_id;
                                                $row_data['date_ot'] = $table_row->date_ot;
                                                $row_data['time_in'] = $table_row->time_in;
                                                $row_data['time_out'] = $table_row->time_out;
                                                $row_data['total_duty_hours'] = $table_row->total_duty_hours;
                                                $row_data['reason'] = $table_row->reason;
                                                break;
                                            case 'f_off_bussiness':
                                                $row_data['emp_id'] = $table_row->emp_id;
                                                $row_data['date'] = $table_row->date;
                                                $row_data['destin_from'] = $table_row->destin_from;
                                                $row_data['destin_to'] = $table_row->destin_to;
                                                $row_data['time_from'] = $table_row->time_from;
                                                $row_data['time_to'] = $table_row->time_to;
                                                $row_data['reason'] = $table_row->reason;
                                                break;
                                            case 'f_outgoing':
                                                $row_data['emp_id'] = $table_row->emp_id;
                                                $row_data['going_to'] = $table_row->going_to;
                                                $row_data['time_from'] = $table_row->time_from;
                                                $row_data['time_to'] = $table_row->time_to;
                                                $row_data['reason'] = $table_row->reason;
                                                break;
                                            case 'f_undertime':
                                                $row_data['emp_id'] = $table_row->emp_id;
                                                $row_data['date_of_undertime'] = $table_row->date_of_undertime;
                                                $row_data['time_in'] = $table_row->time_in;
                                                $row_data['time_out'] = $table_row->time_out;
                                                $row_data['reason'] = $table_row->reason;
                                                break;
                                        }
                                    }
                                    $employee_query = $this->db->get_where('employee', array('id' => $row->emp_id));
                                    $employee_row = $employee_query->row();

                                    if ($employee_row) {
                                        // Add employee-related data to the row data
                                        $row_data['fname'] = $employee_row->fname;
                                        $row_data['lname'] = $employee_row->lname;
                                        $row_data['mname'] = $employee_row->mname;
                                        $row_data['pfp'] = $employee_row->pfp;
                                        $row_data['full_name'] = $employee_row->fname . ' ' . $employee_row->lname;
                                    }
                                    // Add the row data to the row array
                                    $row_arr[] = $row_data;
                                }
                                ?>
                                <?php foreach ($row_arr as $row) : ?>
                                    <!-- Modal for displaying row details -->
                                    <div class="modal fade" id="myModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Row Details</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">

                                                    <?php if ($row['request_type'] === 'LEAVE REQUEST') : ?>
                                                        <div class="row">
                                                            <div class="col-md-6 mx-auto text-center mb-3"> <!-- Added mb-3 class for margin bottom -->
                                                                <div class="form-group">
                                                                    <label for="employee" class="form-label">Employee</label>
                                                                    <input type="text" class="form-control text-center" id="employee" value="<?php echo $row['full_name']; ?>" readonly style="font-weight: bold; font-size: 16px;">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="date_from" class="form-label">Date From</label>
                                                                            <input type="text" class="form-control" id="date_from" value="<?php echo date('F j, Y', strtotime($row['date_from'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="date_to" class="form-label">Date To</label>
                                                                            <input type="text" class="form-control" id="date_to" value="<?php echo
                                                                                                                                        date('F j, Y', strtotime($row['date_to']));
                                                                                                                                        ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="type_of_leave" class="form-label">Type of Leave</label>
                                                                    <input type="text" class="form-control" id="type_of_leave" value="<?php echo $row['type_of_leave']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="reason" class="form-label">Reason</label>
                                                                    <textarea class="form-control" id="reason" rows="4" readonly><?php echo $row['reason']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-3 text-right"> <!-- Adjust the column width as needed -->
                                                                        <div id="status" class="text-<?php echo ($row['status'] === 'approved') ? 'success' : (($row['status'] === 'denied') ? 'danger' : 'warning'); ?>" readonly>
                                                                            <?php echo strtoupper($row['status']); ?> on <?php echo date('F j, Y', strtotime($row['date_filled'])); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    <?php elseif ($row['request_type'] === 'OVERTIME REQUEST') : ?>

                                                        <div class="row">
                                                            <div class="col-md-6 mx-auto text-center mb-3">
                                                                <div class="form-group">
                                                                    <label for="employee" class="form-label">Employee</label>
                                                                    <input type="text" class="form-control text-center" id="employee" value="<?php echo $row['full_name']; ?>" readonly style="font-weight: bold; font-size: 16px;">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="date_ot" class="form-label">Date of Overtime</label>
                                                                            <input type="text" class="form-control" id="date_ot" value="<?php echo date('F j, Y', strtotime($row['date_ot'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_in" class="form-label">Time from</label>
                                                                            <input type="text" class="form-control" id="time_in" value="<?php echo date('g:i A', strtotime($row['time_in'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_out" class="form-label">Time To</label>
                                                                            <input type="text" class="form-control" id="time_out" value="<?php echo date('g:i A', strtotime($row['time_out'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="reason" class="form-label">Reason</label>
                                                                    <textarea class="form-control" id="reason" rows="4" readonly><?php echo $row['reason']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-8 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-3"> <!-- Adjust the column width as needed -->
                                                                        <div id="status" class="text-<?php echo ($row['status'] === 'approved') ? 'success' : (($row['status'] === 'denied') ? 'danger' : 'warning'); ?>" readonly>
                                                                            <?php echo strtoupper($row['status']); ?> on <?php echo date('F j, Y', strtotime($row['date_filled'])); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                    <?php elseif ($row['request_type'] === 'OFFICIAL BUSINESS REQUEST') : ?>

                                                        <div class="row">
                                                            <div class="col-md-6 mx-auto text-center mb-3">
                                                                <div class="form-group">
                                                                    <label for="employee" class="form-label">Employee</label>
                                                                    <input type="text" class="form-control text-center" id="employee" value="<?php echo $row['full_name']; ?>" readonly style="font-weight: bold; font-size: 16px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="date_ot" class="form-label">Date</label>
                                                                            <input type="text" class="form-control" id="date" value="<?php echo date('F j, Y', strtotime($row['date_filled'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="destin_from" class="form-label">Destin From</label>
                                                                            <input type="text" class="form-control" id="destin_from" value="<?php echo $row['destin_from']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="destin_to" class="form-label">Destin To</label>
                                                                            <input type="text" class="form-control" id="destin_to" value="<?php echo $row['destin_to']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_from" class="form-label">Time From</label>
                                                                            <input type="text" class="form-control" id="time_from" value="<?php echo date('g:i A', strtotime($row['time_from'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_to" class="form-label">Time To</label>
                                                                            <input type="text" class="form-control" id="time_to" value="<?php echo date('g:i A', strtotime($row['time_to'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="reason" class="form-label">Reason</label>
                                                                    <textarea class="form-control" id="reason" rows="4" readonly><?php echo $row['reason']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-3 text-right"> <!-- Adjust the column width as needed -->
                                                                        <div id="status" class="text-<?php echo ($row['status'] === 'approved') ? 'success' : (($row['status'] === 'denied') ? 'danger' : 'warning'); ?>" readonly>
                                                                            <?php echo strtoupper($row['status']); ?> on <?php echo date('F j, Y', strtotime($row['date_filled'])); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php elseif ($row['request_type'] === 'OUTGOING REQUEST') : ?>

                                                        <div class="row">
                                                            <div class="col-md-6 mx-auto text-center mb-3">
                                                                <div class="form-group">
                                                                    <label for="employee" class="form-label">Employee</label>
                                                                    <input type="text" class="form-control text-center" id="employee" value="<?php echo $row['emp_id']; ?>" readonly style="font-weight: bold; font-size: 16px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="date_filled" class="form-label">Date</label>
                                                                            <input type="text" class="form-control" id="date_filled" value="<?php echo date('F j, Y', strtotime($row['date_filled']));?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="going_to" class="form-label">Destination</label>
                                                                            <input type="text" class="form-control" id="going_to" value="<?php echo $row['going_to']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_from" class="form-label">Time From</label>
                                                                            <input type="text" class="form-control" id="time_from" value="<?php echo date('g:i A', strtotime($row['time_from'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 mb-2">
                                                                        <div class="form-group">
                                                                            <label for="time_to" class="form-label">Time To</label>
                                                                            <input type="text" class="form-control" id="time_to" value="<?php echo date('g:i A', strtotime($row['time_to'])); ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-2">
                                                                    <label for="reason" class="form-label">Reason</label>
                                                                    <textarea class="form-control" id="reason" rows="4" readonly><?php echo $row['reason']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-8 mx-auto">
                                                                <div class="row">
                                                                    <div class="col-md-3 text-right"> <!-- Adjust the column width as needed -->
                                                                        <div id="status" class="text-<?php echo ($row['status'] === 'approved') ? 'success' : (($row['status'] === 'denied') ? 'danger' : 'warning'); ?>" readonly>
                                                                            <?php echo strtoupper($row['status']); ?> on <?php echo date('F j, Y', strtotime($row['date_filled'])); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php elseif ($row['request_type'] === 'UNDERTIME REQUEST') : ?>
                                                        <p>Request : Undertime</p>
                                                        <p>Employee: <?php echo $row['emp_id']; ?></p>
                                                        <p>Date : <?php echo $row['date_filled']; ?></p>
                                                        <p>Date : <?php echo $row['date_of_undertime']; ?></p>
                                                        <p>Time In: <?php echo $row['time_in']; ?></p>
                                                        <p>Time Out: <?php echo $row['time_out']; ?></p>
                                                        <p>Reason: <?php echo $row['reason']; ?></p>


                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="<?php
                                                                // Retrieve base64-encoded image data from session
                                                                if ($this->session->userdata('pfp')) {
                                                                    $pfp = $this->session->userdata('pfp');
                                                                }

                                                                // Check if $pfp is set and not empty
                                                                if (!empty($pfp)) {
                                                                    // Embed the base64-encoded image data in the 'src' attribute of the <img> tag
                                                                    echo "data:image/jpeg;base64," . base64_encode($pfp);
                                                                } else {
                                                                    // If $pfp is empty or not set, display a placeholder image or handle it as per your requirement
                                                                    echo base_url('assets/img/user.jpg');
                                                                }
                                                                ?>" alt="User Image">
                                                </a>
                                                <a href="<?= base_url('hr_profile') ?>" style="color:black;font-size:12px;"><?php echo $row['name']; ?></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $row['request_type']; ?></td>
                                        <td><?php echo $row['date_filled']; ?></td>

                                        <td class="text-center">
                                            <?php
                                            // Set the color of the dot icon, the text color, and the border color based on the status
                                            switch ($row['status']) {

                                                case 'approved':
                                                    $dot_color = 'text-success';
                                                    $text_color = 'text-success'; // Text color for 'Approved' status
                                                    $border_color = 'border-success'; // Border color for 'Approved' status
                                                    $status_text = 'Approved';
                                                    break;
                                                case 'denied':
                                                    $dot_color = 'text-danger';
                                                    $text_color = 'text-danger'; // Text color for 'Declined' status
                                                    $border_color = 'border-danger'; // Border color for 'Declined' status
                                                    $status_text = 'Denied';
                                                    break;
                                                default:
                                                    $dot_color = 'text-purple'; // Default dot color
                                                    $text_color = 'text-dark'; // Default text color
                                                    $border_color = 'border-dark'; // Default border color
                                                    $status_text = 'Unknown'; // Default status text
                                            }
                                            ?>
                                            <span class="badge rounded-pill <?php echo $text_color; ?> <?php echo $border_color; ?>">
                                                <i class="fa-regular fa-circle-dot <?php echo $dot_color; ?>"></i> <?php echo $status_text; ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <button type="button" class="btn btn-link action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item view-details" href="#" data-bs-toggle="modal" data-bs-target="#myModal_<?php echo $row['id']; ?>">
                                                        <i class="fa-regular fa-eye m-r-5"></i> View Details
                                                    </a>
                                                    <a class="dropdown-item update-req" href="#" data-bs-toggle="modal" id="" data-bs-target="#edit_leave" data-target-id="<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-req" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve" data-target-id="<?php echo $row['id']; ?>">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/historyrequests') ?>']").parent().parent().css("display", "block") //get sidebar item with link
        $("li > a[href='<?= base_url('hr/historyrequests') ?>']").addClass("active"); // for items inside the sidebar




    })
</script>