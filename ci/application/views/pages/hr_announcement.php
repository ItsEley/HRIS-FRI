<link href="..\assets\text-editor\node_modules\froala-editor\css\froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="..\assets\text-editor\node_modules\froala-editor\js\froala_editor.pkgd.min.js"></script>

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


            <div class="row">
                <div class="col">
                    <h1>Announcements <span>
                   
                    <button type="button" class="btn btn-primary waves-effect waves-light mt-1" 
                    data-bs-toggle="modal" data-bs-target="#con-close-modal"> <span class = "fa-solid fa-plus"></span></button>



                    </span></h1>
                   
                </div>
                <div class="col"></div>
                <div class="col text-end">
<!-- 
                    <button type="button" class="btn btn-success waves-effect waves-light mt-1" 
                    data-bs-toggle="modal" data-bs-target="#con-close-modal"> <span class = "fa-solid fa-plus"></span></button> -->

                </div>
            </div>


            <?php
            $query = $this->db->order_by('date_created', 'DESC')->get('announcement');

            foreach ($query->result() as $row) {
                $title =  $row->title;
                $content = $row->content;
                $author = $row->author;
                $department = $row->department;
                $date = $row->date_created;

                $data['title'] = $title;
                $data['content'] = $content;
                $data['author'] = $author;
                $data['department'] = $department;
                $data['date'] = $date;

                $this->load->view('components/card-announcement', $data);
            }



            ?>

        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->


<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Announcement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="add_announcement">
                <div class="modal-body p-4">

                    <div class="row p-2">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Department</label>
                        <div class="col-md-10">
                            <select class="form-control form-select" name="department">
                            <option value="All">All</option>
                                <?php
                  $this->db->order_by('department', 'ASC');
                  $query = $this->db->get('department');
                  

                                // Check if query executed successfully
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                        $depID = $row->id;
                                        $department1 = $row->department;
                                        $acro = $row->acro_dept;
                                        $data['department'] = $department1;
                                        // Output each department as an option
                                        echo '<option value="' . $depID . '">' .  $data['department'] . '</option>';
                                    }
                                } else {
                                    // Handle no results from the database
                                    echo '<option value="">No departments found</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <textarea id="froala-editor" name="content"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div><!-- /.modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/announcement') ?>']").parent().addClass("active");

        new FroalaEditor('textarea#froala-editor')
    })
</script>