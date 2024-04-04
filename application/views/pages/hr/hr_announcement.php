<style>
    label.btn.btn-light.btn-rounded:hover {
        /* background-color: red !important; */
        background-color: #26c769 !important;
        /* color: #fff !important; */
    }

    input[type='checkbox']:checked+label.btn.btn-light.btn-rounded {

        background-color: #26c769 !important;
        color: #fff !important;

    }
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>



<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
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
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Announcements</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">HR Home</a></li>
                            <li class="breadcrumb-item active">Announcements</li>
                        </ul>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#modal_announcement_detail" id="btn_create_ann">
                            <span class="fa-solid fa-plus"></span> Create Announcement</button>

                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_announcements" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Author</th>
                                    <th>Department</th>
                                    <th>Date Created</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $this->db->order_by('date_created', 'DESC')->get('announcement');
                                foreach ($query->result() as $row) {
                                    $ann_id = $row->id;
                                    $title = $row->title;
                                    $content = $row->content;
                                    $author = $row->author;
                                    // $department = $row->department;
                                    $date = $row->date_created;
                                ?>
                                    <tr class="hoverable-row" data-ann-id ="<?= $ann_id?>">
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $title; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <a class="ellipsis announcement-open" style="max-height: 1.2em; overflow: hidden;color:black !important"
                                            href = "#" 
                                            data-bs-toggle="modal" data-bs-target="#modal_announcement_detail"
                                              data-ann-id = "<?= $ann_id?>">
                                            
                                                <?php echo $content; ?>
                                            </a>
                                        </td>

                                        <td><?php echo $author; ?></td>
                                        <td><?php //echo $department; 
                                            ?> {not implemented yet}</td>
                                        <td><?php echo formatDateTime($date); ?></td>

                                        <td>

                                            <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $ann_id ?>">
                                                <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                            </a>
                                            <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $ann_id ?>">
                                                <i class="fa-regular fa-trash-can m-r-5"></i> Delete
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

<!-- jQuery -->


<div id="modal_announcement_create" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Announcement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="add_announcement">
                <div class="modal-body p-4">

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Title</label>

                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" placeholder="Title" required>
                        </div>

                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Department</label>
                        <div class="col-md-10">



                            <?php

                            echo ' <input type="checkbox" class="btn-check" id="select_all" group="dept_multi" autocomplete="off">
                                <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="select_all" style = "font-size:12px;margin:2px">All</label>';

                            //get select-options
                            $query =  $this->db->get('department');
                            $data['query'] = $query;
                            // Check if query executed successfully
                            if ($query->num_rows() > 0) {
                                foreach ($query->result() as $row) {

                                    // Output each department as an option
                                    echo '
                                        <input type="checkbox" class="btn-check" id="' . $row->id . '" group="dept_multi" autocomplete="off">
                                        <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="' . $row->id . '" style = "font-size:12px;margin:2px">' . $row->department . '</label>';

                                    // echo '<option value="' . $row->id . '">' .  $row->department . '</option>';
                                }
                            } else {
                                // Handle no results from the database
                                echo '<option value="">No departments found</option>';
                            }
                            ?>
                        </div>
                    </div>


                    <!-- Hidden input field to store Summernote content -->
                    <input type="hidden" name="editor_content" id="editor_content">
                    <!-- Editor container -->
                    <div id="editor" name="content"></div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->

<?php $this->load->view('components\modal-announcement-details.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/announcement') ?>']").parent().addClass("active");

        $('#dt_announcements').DataTable();


        // Initialize Summernote when modal is shown
        $('#modal_announcement_create').on('shown.bs.modal', function() {
            if (!window.summernoteInitialized) {
                $('#editor').summernote({
                    placeholder: 'Type your text here...',
                    tabsize: 1,
                    height: 300
                });
                window.summernoteInitialized = true; // Set flag to indicate Summernote instance is initialized
            }
        });

        // add announcement 
        $("#add_announcement").submit(function(e) {
            e.preventDefault();
            // Get the HTML content from Summernote editor
            var content = $('#editor').summernote('code');

            // Set the value of the hidden input field to the Summernote content
            $('#editor_content').val(content);

            var addAnnounce = $(this).serialize();

            // console.log("1: ", addAnnounce);

            // console.log("2: ", content);
            $.ajax({
                url: base_url + 'humanr/add_announce',
                type: 'post',
                data: addAnnounce,
                dataType: 'json',
                success: function(res) {
                    if (res.status === 1) {
                        alert(JSON.stringify(res));
                        // console.log('reloading')

                    } else {
                        alert(res.msg);
                    }
                }
            })
        })




        var checkboxes = document.querySelectorAll('input.btn-check');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (this.id == "select_all") {
                    console.log("select")


                    if (this.checked) {
                        console.log('Toggle is active');
                        checkboxes.forEach(function(x) {
                            if (x.id !== "select_all") {
                                $("#" + x.id).attr("disabled", "disabled")
                                // $("#" + x.id).checked = false;

                            }
                        })

                    } else {
                        console.log('Toggle is inactive');
                        checkboxes.forEach(function(x) {
                            if (x.id !== "select_all") {
                                $("#" + x.id).removeAttr("disabled", "disabled")
                            }
                        })
                    }
                } else {

                }

            });


        })
    })
</script>