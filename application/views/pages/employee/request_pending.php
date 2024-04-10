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
                        <h3 class="page-title">Pending Requests</h3>
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
                            $this->db->where('id', $user_id);
                            $pending_leave = $this->db->count_all_results('f_leaves');

                            // Count pending official business requests where the employee ID matches the session ID
                            $this->db->where('id', $user_id);
                            $pending_ob = $this->db->count_all_results('f_off_bussiness');

                            // Count pending outgoing requests where the employee ID matches the session ID
                            $this->db->where('id', $user_id);
                            $pending_og = $this->db->count_all_results('f_outgoing');

                            // Count pending overtime requests where the employee ID matches the session ID
                            $this->db->where('id', $user_id);
                            $pending_ot = $this->db->count_all_results('f_overtime');

                            // Count pending undertime requests where the employee ID matches the session ID
                            $this->db->where('id', $user_id);
                            $pending_ut = $this->db->count_all_results('f_undertime');

                            // Count pending work schedule adjustment requests where the employee ID matches the session ID
                            $this->db->where('id', $user_id);
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

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">

                        <table id="users_pendings" class="datatable table-striped custom-table mb-0 datatable">
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
                                $row_arr = array();
                                $emp_id = $this->session->userdata('id');

                                $query_employee = $this->db->query("SELECT pfp, fname, lname FROM employee WHERE id = ?", array($emp_id));
                                if ($query_employee->num_rows() > 0) {
                                    $row_employee = $query_employee->row();
                                    $pfp = $row_employee->pfp;
                                    $name = $row_employee->fname;
                                }

                                // Query leave data
                                $query_leaves = $this->db
                                    ->select('id, date_filled, type_of_leave, status, head_status, reason')
                                    ->where('emp_id', $emp_id)
                                    ->group_start()
                                    ->where('status', 'pending')
                                    ->or_where('status', NULL)
                                    ->group_end()
                                    ->where('head_status', 'pending')
                                    ->get('f_leaves');

                                foreach ($query_leaves->result() as $row) {
                                    $leave_id = $row->id;
                                    $date_filled = $row->date_filled;
                                    $leave_type = $row->type_of_leave;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $reason = $row->reason;
                                    $request_type = "LEAVE REQUEST";
                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $leave_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status,
                                        'head_status' => $head_status,
                                        'reason' => $reason
                                    );
                                }

                                // Query outgoing data
                                $query_outgoing = $this->db
                                    ->select('id, date_filled, time_to, time_from, going_to, reason, status, head_status')
                                    ->where('emp_id', $emp_id)
                                    ->group_start()
                                    ->where('status', 'pending')
                                    ->or_where('status', NULL)
                                    ->group_end()
                                    ->where('head_status', 'pending')
                                    ->get('f_outgoing');

                                foreach ($query_outgoing->result() as $row) {
                                    $og_id = $row->id;
                                    $date_filled = $row->date_filled;
                                    $time_to = $row->time_to;
                                    $time_from = $row->time_from;
                                    $going_to = $row->going_to;
                                    $reason = $row->reason;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $request_type = "OUTGOING REQUEST";

                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $og_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status,
                                        'head_status' => $head_status,
                                        'reason' => $reason
                                    );
                                }

                                // Query official business data
                                $query_ob = $this->db
                                    ->select('id, date_filled, date, destin_to, destin_from, time_to, time_from, reason, status, head_status')
                                    ->where('emp_id', $emp_id)
                                    ->group_start()
                                    ->where('status', 'pending')
                                    ->or_where('status', NULL)
                                    ->group_end()
                                    ->where('head_status', 'pending')
                                    ->get('f_off_bussiness');

                                foreach ($query_ob->result() as $row) {
                                    $ob_id = $row->id;
                                    $date_filled = $row->date_filled;
                                    $date = $row->date;
                                    $destin_to = $row->destin_to;
                                    $destin_from = $row->destin_from;
                                    $time_to = $row->time_to;
                                    $time_from = $row->time_from;
                                    $reason = $row->reason;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $request_type = "OFFICIAL BUSINESS REQUEST";
                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $ob_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status,
                                        'head_status' => $head_status,
                                        'reason' => $reason
                                    );
                                }

                                // Query overtime data
                                $query_ot = $this->db
                                    ->select('id, date_filled, date_ot, time_in, time_out, reason, status, head_status')
                                    ->where('emp_id', $emp_id)
                                    ->group_start()
                                    ->where('status', 'pending')
                                    ->or_where('status', NULL)
                                    ->group_end()
                                    ->where('head_status', 'pending')
                                    ->get('f_overtime');

                                foreach ($query_ot->result() as $row) {
                                    $ot_id = $row->id;
                                    $date_filled = $row->date_filled;
                                    $date_ot = $row->date_ot;
                                    $time_in = $row->time_in;
                                    $time_out = $row->time_out;
                                    $reason = $row->reason;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $request_type = "OVERTIME REQUEST";

                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $ot_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status,
                                        'head_status' => $head_status,
                                        'reason' => $reason
                                    );
                                }

                                // Query undertime data
                                $query_ut = $this->db
                                    ->select('id, date_filled, date_of_undertime, time_in, time_out, reason, status, head_status')
                                    ->where('emp_id', $emp_id)
                                    ->group_start()
                                    ->where('status', 'pending')
                                    ->or_where('status', NULL)
                                    ->group_end()
                                    ->where('head_status', 'pending')
                                    ->get('f_undertime');

                                foreach ($query_ut->result() as $row) {
                                    $ut_id = $row->id;
                                    $date_filled = $row->date_filled;
                                    $date_of_undertime = $row->date_of_undertime;
                                    $time_in = $row->time_in;
                                    $time_out = $row->time_out;
                                    $reason = $row->reason;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $request_type = "UNDERTIME REQUEST";
                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $ut_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status,
                                        'head_status' => $head_status,
                                        'reason' => $reason
                                    );
                                }

                                foreach ($row_arr as $row) {
                                ?>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="<?php echo !empty($row['pfp']) ? "data:image/jpeg;base64," . base64_encode($row['pfp']) : base_url('path/to/placeholder_image.jpg'); ?>" alt="User Image">
                                                </a>
                                                <a href="<?= base_url('hr_profile') ?>" style="font-size: 0.6em;"><?php echo $row['name']; ?></a>
                                            </h2>
                                        </td>
                                        <td><?php echo $row['request_type']; ?></td>
                                        <td><?php echo $row['date_filled']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            $dot_color = $text_color = $border_color = '';
                                            switch ($row['status']) {
                                                case 'new':
                                                    $dot_color = $text_color = 'text-purple';
                                                    $border_color = 'border-purple';
                                                    break;
                                                case 'pending':
                                                    $dot_color = $text_color = 'text-info';
                                                    $border_color = 'border-info';
                                                    break;
                                                case 'approved':
                                                    $dot_color = $text_color = 'text-success';
                                                    $border_color = 'border-success';
                                                    break;
                                                case 'declined':
                                                    $dot_color = $text_color = 'text-danger';
                                                    $border_color = 'border-danger';
                                                    break;
                                                default:
                                                    $dot_color = 'text-purple';
                                                    $text_color = 'text-dark';
                                                    $border_color = 'border-dark';
                                            }
                                            ?>
                                            <span class="badge rounded-pill <?php echo $text_color; ?> <?php echo $border_color; ?>">
                                                <i class="fa-regular fa-circle-dot <?php echo $dot_color; ?>"></i> <?php echo ucwords($row['head_status']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <button class="btn btn-sm btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item view-pend" href="#" data-bs-toggle="modal" data-bs-target="#view_pending" data-row-id="<?php echo $row['id']; ?>" data-row-type="<?php echo $row['request_type']; ?>" data-row-name="<?php echo $row['name']; ?>" data-row-date-filled="<?php echo $row['date_filled']; ?>" data-row-head-status="<?php echo $row['head_status']; ?>" data-row-reasonz="<?php echo $row['reason']; ?>">
                                                        <i class="fa-solid fa-pencil-alt"></i> View
                                                    </a>

                                                    <a class="dropdown-item delete-req" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve" data-target-id="<?php echo $row['id']; ?>">
                                                        <i class="fa-regular fa-trash-alt"></i> Delete
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