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
    <div class="page-wrapper">

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
            <!-- /Page Header -->



            <!-- Search Filter -->
            <div class="row">
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
                                $row_arr = array();

                                $emp_id = $this->session->userdata('id');
                                
                                // Query employee data to get the profile picture (pfp) and name
                                $query_employee = $this->db->query("SELECT * FROM employee WHERE id = '$emp_id'");
                                if ($query_employee->num_rows() > 0) {
                                    $row_employee = $query_employee->row();
                                    $pfp = $row_employee->pfp;
                                }
                                
                                // Query leave data
                                $name = ($_SESSION['fullname']);
                                $this->db->where('emp_id', $emp_id);
                                $query_leaves = $this->db->get('f_leaves');
                                foreach ($query_leaves->result() as $row) {
                                    $leave_id =  $row->id;
                                    $date_filled = $row->date_filled;
                                    $leave_type = $row->type_of_leave;
                                    $status = $row->status;
                                    $head_status = $row->head_status;
                                    $request_type = "LEAVE REQUEST"; // Define request type
                                
                                    // Only include rows where status is "approved" or "declined"
                                    if ($status == 'approved' || $status == 'denied' || $head_status == 'denied') {
                                        // Construct row data including pfp and name
                                        $row_arr[] = array(
                                            'pfp' => $pfp,
                                            'id' => $leave_id,
                                            'name' => $name,
                                            'request_type' => $request_type,
                                            'date_filled' => $date_filled,
                                            'status' => $status,
                                            'head_status' => $head_status
                                        );
                                    }
                                }         
                                foreach ($row_arr as $row) {

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
                                                                    echo "path/to/placeholder_image.jpg";
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
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item update-req" href="#" data-bs-toggle="modal" id="" data-bs-target="#edit_leave" data-target-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item delete-req" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve" data-target-id="<?php echo $row['id']; ?>"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('forms/history') ?>']").parent().parent().css("display", "block") //get sidebar item with link
        $("li > a[href='<?= base_url('forms/history') ?>']").addClass("active"); // for items inside the sidebar




    })
</script>