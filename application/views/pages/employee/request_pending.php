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
                        $user_id = $this->session->userdata('emp_id');

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
                            $user_id = $this->session->userdata('emp_id');

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

                                $emp_id = $this->session->userdata('emp_id');

                                // Query employee data to get the profile picture (pfp) and name
                                $query_employee = $this->db->query("SELECT * FROM employee WHERE id = '$emp_id'");
                                if ($query_employee->num_rows() > 0) {
                                    $row_employee = $query_employee->row();
                                    $pfp = $row_employee->pfp;
                                }

                                // Query leave data
                                $name = ($_SESSION['name']);
                                $query_leaves = $this->db->where('emp_id', $emp_id)->where('status', 'pending')->get('f_leaves');

                                foreach ($query_leaves->result() as $row) {
                                    $leave_id =  $row->id;
                                    $date_filled = $row->date_filled;
                                    $leave_type = $row->type_of_leave;
                                    $status = $row->status;
                                    $request_type = "LEAVE REQUEST"; // Define request type

                                    // Construct row data including pfp and name
                                    $row_arr[] = array(
                                        'pfp' => $pfp,
                                        'id' => $leave_id,
                                        'name' => $name,
                                        'request_type' => $request_type,
                                        'date_filled' => $date_filled,
                                        'status' => $status
                                    );
                                }

                                foreach ($row_arr as $row) {
                                    // Output or process each row as needed

                                ?>
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
                                                                    echo base_url('path/to/placeholder_image.jpg');
                                                                }
                                                                ?>" alt="User Image">
                                                </a>
                                                <a href="<?= base_url('hr_profile') ?>" style="font-size: 0.6em;"><?php echo $row['name']; ?></a>
                                            </h2>
                                        </td>

                                        <td><?php echo $row['request_type']; ?></td>
                                        <td><?php echo $row['date_filled']; ?></td>

                                        <td class="text-center">
                                            <?php
                                            // Set the color of the dot icon, the text color, and the border color based on the status
                                            switch ($row['status']) {
                                                case 'new':
                                                    $dot_color = 'text-purple';
                                                    $text_color = 'text-purple'; // Text color for 'New' status
                                                    $border_color = 'border-purple'; // Border color for 'New' status
                                                    $status_text = 'New';
                                                    break;
                                                case 'pending':
                                                    $dot_color = 'text-info';
                                                    $text_color = 'text-info'; // Text color for 'Pending' status
                                                    $border_color = 'border-info'; // Border color for 'Pending' status
                                                    $status_text = 'Pending';
                                                    break;
                                                case 'approved':
                                                    $dot_color = 'text-success';
                                                    $text_color = 'text-success'; // Text color for 'Approved' status
                                                    $border_color = 'border-success'; // Border color for 'Approved' status
                                                    $status_text = 'Approved';
                                                    break;
                                                case 'declined':
                                                    $dot_color = 'text-danger';
                                                    $text_color = 'text-danger'; // Text color for 'Declined' status
                                                    $border_color = 'border-danger'; // Border color for 'Declined' status
                                                    $status_text = 'Declined';
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


                                        <td class="text-center">
                                            <div class="dropdown dropdown-action">
                                                <button class="btn btn-sm btn-rounded dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item update-req" href="#" data-bs-toggle="modal" data-bs-target="#edit_leave" data-target-id="<?php echo $row['id']; ?>">
                                                        <i class="fa-solid fa-pencil-alt"></i> Edit
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
        <!-- /Page Content -->
    </div>
    <!-- Approve Leave Modal -->
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
    <!-- /Approve Leave Modal -->

    <!-- Delete Leave Modal -->
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
    <!-- /Delete Leave Modal -->
</div>
<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->



<script>
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