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
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Leaves</li>
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

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'active');
                    // $count = $this->db->count_all_results();

                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active leaves";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    // $count = $this->db->count_all_results();

                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Pending";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>

            </div>

            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_emp_leaves" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Date Applied</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('SELECT * FROM vw_emp_leaves');

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row" id="double-click-row">

                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $row->fullname; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $row->date_filled; ?></td>
                                        <td><?php echo $row->leave_type; ?></td>
                                        <td><?php echo $row->from; ?></td>
                                        <td><?php echo $row->to; ?></td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo ucwords($row->reason); ?></td>


                                        <td><?php echo ucwords($row->status); ?></td>


                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                    <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->id; ?>">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div> -->
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
        <!-- /Page Content -->



    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<div id="view_request" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="modalName" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="modalName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalDateFilled" class="form-label">Date Filled:</label>
                        <input type="text" class="form-control" id="modalDateFilled" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modalLeaveType" class="form-label">Leave Type:</label>
                        <input type="text" class="form-control" id="modalLeaveType" readonly>
                    </div>
                    <!-- Add more fields for other data such as 'From', 'To', 'Reason', 'Status', etc. -->
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
        //     "info": true, // Enable table information display
        //     // You can add more options as needed
        //     destroy: true,
        //     autoWidth: false,
        //     autoHeight: false

        // });


        $("#dt_emp_leaves").on("dblclick", "tr.hoverable-row", function() {
            // Your event handling code here
            // console.log(this);
            // var zz = this;
            // $('#view_request').append(zz)
        });




    




    });
</script>