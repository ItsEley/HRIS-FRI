<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>


    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Shifts</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">HR Home</a></li>
                            <li class="breadcrumb-item active">Shifts</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_create_shift">
                            <i class="fa-solid fa-plus"></i>Create Shift</button>
                        <div class="view-icons">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_shifts" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th hidden>ID</th>
                                    <th>Group</th>
                                    <th>Description</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('SELECT * FROM `sys_shifts`');


                                // Check if the query was successful
                                if ($query) {
                                    // Check if there are rows returned
                                    if ($query->num_rows() > 0) {
                                        // Fetch the result rows as an array of objects
                                        $shifts = $query->result();

                                        // Process the result rows
                                        foreach ($shifts as $shift) {
                                            // Access properties of each shift object as needed


                                ?>


                                            <tr class="hoverable-row">
                                                <td hidden><?= $shift->id ?></td>

                                                <td>
                                                    <?= $shift->group_ ?>

                                                </td>
                                                <td style="max-width: 200px; overflow: hidden;
                                                 text-overflow: ellipsis; white-space: nowrap;">

                                                    <?php
                                                    if ($shift->description === NULL || $shift->description === '') {
                                                        echo "No description";
                                                    } else {
                                                        echo $shift->description;
                                                    }
                                                    ?>
                                                </td>


                                                <td><?= formatTimeOnly($shift->time_from) ?></td>

                                                <td><?= formatTimeOnly($shift->time_to) ?></td>
                                                <td>
                                                    <a class="dropdown-item edit-shift" href="#" data-shift-id="<?= $shift->id ?>" data-bs-toggle="modal" data-bs-target="#modal_edit_shift">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>


                                                </td>


                                            </tr>


                                <?php
                                        }
                                    } else {
                                        // Handle case when no rows are returned
                                        echo "No shifts found.";
                                    }
                                } else {
                                    // Handle case when query fails
                                    echo "Error executing query: " . $this->db->error()['message'];
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



<!-- Edit Event Modal -->
<div class="modal fade" id="modal_create_shift" tabindex="-1" aria-labelledby="modal_create_shiftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_shiftLabel">Create Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEventForm">

                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Group label</label>
                        <input type="text" class="form-control" id="editEventTitle" name="shift_label" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Short description</label>
                        <input type="text" class="form-control" id="editEventTitle" name="shift_description"
                        placeholder="e.g 'Regular','Dayshift','Nightshift' (Optional)">
                    </div>
                    <div class="mb-3">
                        <label for="editEventStart" class="form-label">Time from</label>
                        <input type="time" class="form-control" id="editEventStart" name="shift_start" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEventEnd" class="form-label">Time to</label>
                        <input type="time" class="form-control" id="editEventEnd" name="shift_start" required>
                    </div>
                    <!-- Add more fields for editing event details -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Event Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/shifts') ?>']").parent().addClass("active");


        $('#dt_shifts').DataTable({
            "paging": true, // Enable paging
            "ordering": true, // Enable sorting
            "info": true // Enable table information display
            // You can add more options as needed
        });


    });
</script>