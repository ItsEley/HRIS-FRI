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

                    $this->db->select('COUNT(*) as count');
                    $this->db->from('f_leaves');
                    $this->db->where('status', 'Approved');
                    $this->db->where('CURDATE() BETWEEN date_from AND date_to');

                    // Execute the query
                    $query = $this->db->get();

                    $data['count'] = $query->row_array()['count'];
                    $data['label'] = "Active leaves";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Pending";
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

                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Pending approvals</h4>
                            <!-- <p class="card-text">
                                This is the most basic example of the datatables with zero configuration. 
                                Use the <code>.datatable</code> class to initialize datatables.
                            </p> -->
                        </div>
                        <div class="card-body">

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


                                        // $this->db->where('status', 'pending');
                                        // Execute the query
                                        $query = $this->db->query("SELECT * FROM vw_emp_leaves WHERE status = 'pending'");;

                                        foreach ($query->result() as $row) {



                                        ?>
                                            <tr class="hoverable-row" id="double-click-row_<?php echo $row->leave_id ?>">

                                                <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                                    <?php echo $row->fullname; ?>
                                                </td>

                                                <td><?php echo $row->date_filled; ?></td>
                                                <td name="leave_type"><?php echo $row->leave_type; ?></td>
                                                <td name="date_from"><?php echo formatDateOnly($row->from); ?></td>
                                                <td name="date_to"><?php echo formatDateOnly($row->to); ?></td>
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
                <div class="tab-pane" id="solid-tab2">

                

                <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Leave history</h4>
                            <!-- <p class="card-text">
                                This is the most basic example of the datatables with zero configuration. 
                                Use the <code>.datatable</code> class to initialize datatables.
                            </p> -->
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                               <!-- data table -->
            <div class="row ">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_emp_leaves_history" class="datatable table-striped custom-table mb-0">
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


                                // $this->db->where('status', 'pending');
                                // Execute the query
                                $query = $this->db->query("SELECT * FROM vw_emp_leaves WHERE status != 'pending'");;

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row" id="double-click-row_<?php echo $row->leave_id ?>">

                                        <td style="max-width: 200px; overflow: hidden; 
                                        text-overflow: ellipsis; white-space: nowrap;" name="emp_name">
                                            <?php echo $row->fullname; ?>
                                        </td>

                                        <td><?php echo $row->date_filled; ?></td>
                                        <td name="leave_type"><?php echo $row->leave_type; ?></td>
                                        <td name="date_from"><?php echo formatDateOnly($row->from); ?></td>
                                        <td name="date_to"><?php echo formatDateOnly($row->to); ?></td>
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

            </div>



        </div>
        <!-- /Page Content -->



    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<div id="view_request" class="modal custom-modal fade p-0 " role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Request</h5>
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