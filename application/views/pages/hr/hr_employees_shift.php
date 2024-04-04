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
                            <li class="breadcrumb-item active">Shifts</li>
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



            <div class="row legend timeline-panel" id="emp_att_legend">
                <div class="d-flex justify-content-between">
                    <!-- <h3>Legend</h3> -->
                    <p class="m-0"><span class="">Group A</span> - 8:00 AM - 5:00 PM (Regular)</p>
                    <p class="m-0"><span class="">Group B</span> - 6:00 AM - 6:00 PM (Dayshift)</p>
                    <p class="m-0"><span class="">Group C</span> - 6:00 PM - 6:00 AM (Nightshift)</p>
                </div>
                <div class="col-4"></div>
            </div>

            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_emp_shift" class="datatable table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Name</th>
                                    <th>Deparment</th>
                                    <th>Role</th>
                                    <th>Day-off</th>
                                    <th>Shift Group</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('
                                SELECT emp.emp_id,emp.full_name, emp.dept_id, emp.department, emp.acro_dept, emp.dept_roles_id, emp.roles,
                                shifts.day_off, shifts.shift_id, shifts.group_, shifts.time_from, shifts.time_to
                         FROM vw_emp_designation AS emp
                         INNER JOIN vw_emp_shifts AS shifts ON emp.emp_id = shifts.emp_id;
                         
                                ');

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row">
                                        <td hidden></td>
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $row->full_name; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $row->department;; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $row->roles; ?></td>
                                        <td><?php echo $row->day_off; ?> </td>
                                        <td><?php echo $row->group_; ?></td>
                                        <td>

                                            <a class="" href="#" data-bs-toggle="modal" data-bs-target="#modal_edit_shift" data-emp-id="<?= $row->emp_id ?>">
                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                            </a>


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


<!-- modal -->
<div id="modal_edit_shift" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Shift Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                <input type="text" name="emp_id" id="emp_id">


                <div class="col-md-6">
                    <p>Edit shift group for : </p>

                </div>

                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label class="col-form-label">Shift Group <span class="text-danger">*</span></label>
                        <select class="form-select form-control" name="department">

                            <?php
                            //get select-options
                            $this->db->order_by('id', 'ASC');
                            $query =  $this->db->get('sys_shifts');
                            $data['query'] = $query;


                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {
                                    // Output each department as an option
                                    echo '<option value="' . $row->id . '">' .  $row->group_ . '</option>';
                                }
                            } else {
                                // Handle no results from the database
                                echo '<option value="">No departments found</option>';
                            }

                            // $this->load->view('components/select-options', $data);
                            ?>
                        </select>
                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- modal end -->


<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/shifts') ?>']").parent().parent().css("display", "block")



        $('#approveButton').click(function() {
        var rowId = $(this).data('row-id');
        $.ajax({
            type: 'POST',
            url: base_url+'humanr/headapprove',
            data: {
                row_id: rowId
            },
            success: function(response) {
                // Handle the response, maybe show a success message
                console.log('Leave approved successfully');
                $('#approve_employee').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle any errors
                console.error('Error approving leave');
            }
        });
    });


    });
</script>