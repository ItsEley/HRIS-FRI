   <!-- Include Summernote CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">


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
       <div class="page-wrapper">

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
                           <button type="button" class="btn btn-primary waves-effect waves-light mt-1" data-bs-toggle="modal" data-bs-target="#modal_announcement_create" id="btn_create_ann">
                               <span class="fa-solid fa-plus"></span> Create Announcement</button>

                       </div>

                   </div>
               </div>
               <!-- /Page Header -->


               <!-- data table -->
               <div class="row timeline-panel m-0">
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
                                    $query = $this->db->query("SELECT 
                                    a.id, 
                                    a.type, 
                                    a.title, 
                                    a.content, 
                                    CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS author,
                                    a.to_all, 
                                    a.date_created, 
                                    GROUP_CONCAT(d.acro_dept ORDER BY d.acro_dept SEPARATOR ', ') AS departments
                                FROM 
                                    announcement a
                                LEFT JOIN 
                                    announce_to t ON a.id = t.ann_id
                                LEFT JOIN 
                                    department d ON t.dept_id = d.id
                                LEFT JOIN 
                                    employee e ON a.author = e.id
                                GROUP BY 
                                    a.id
                                ORDER BY 
                                    a.date_created DESC
                                
                                ");
                                    foreach ($query->result() as $row) {
                                        $ann_id = $row->id;
                                        $title = $row->title;
                                        $content = $row->content;
                                        $author =($row->author === NULL) ? "N/A" : $row->author;
                                        $department = ($row->to_all == "1") ? "All" : $row->departments;
                                        $date = $row->date_created;
                                    ?>
                                       <tr class="hoverable-row" data-ann-id="<?= $ann_id ?>">
                                           <td><?= $title ?></td>
                                           <td style="max-width: 200px; overflow: hidden;">
                                               <div style="max-height: 50px; overflow: hidden;">
                                                   <a class="ellipsis announcement-open my-hover" style="text-decoration:none;color:black" href="#" data-bs-toggle="modal" data-bs-target="#modal_announcement_detail" data-ann-id="<?= $ann_id ?>">
                                                       <?= $content ?>
                                                   </a>
                                               </div>
                                           </td>
                                           <td><?= $author ?></td>
                                           <td><?= $department?></td>
                                           <td><?= formatDateTime($date) ?></td>
                                           <td>
                                               <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?= $ann_id ?>">
                                                   <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                               </a>
                                               <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?= $ann_id ?>">
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

                           <input type="text" name="selected_dept" id="selected_dept" hidden required>
                           <input type="text" name="author" id="author" value = "<?= $_SESSION['id']?>" hidden>


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
                                        <input type="checkbox" class="btn-check" id="dept_' . $row->id . '" value = "' . $row->id . '" group="dept_multi" autocomplete="off">
                                        <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="dept_' . $row->id . '" style = "font-size:12px;margin:2px">' . $row->department . '</label>';

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
                       <input type="hidden" name="editor_content" id="editor_content" required>
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

   <!-- Include Summernote JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           $("li > a[href='<?= base_url('hr/announcement') ?>']").parent().addClass("active");

           $('#dt_announcements').DataTable({
               order: [
                   [4, 'desc']
               ] // Sort the  column in ascending order initially
           });

           // Initialize Summernote when modal is shown
           $('#modal_announcement_create').on('shown.bs.modal', function() {
               if (!window.summernoteInitialized) {
                   $('#editor').summernote({
                       placeholder: 'Type your text here...',
                       tabsize: 1,
                       height: 250,
                       toolbar: [
                           ['style', ['style']],
                           ['font', ['bold', 'underline', 'clear']],
                           ['fontname', ['fontname']],
                           ['color', ['color']],
                           ['para', ['ul', 'ol', 'paragraph']],
                           ['table', ['table']],
                           ['insert', ['link', 'picture', 'video']],
                           ['view', ['fullscreen', ]],
                       ],
                       fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']
                       
                   });
                   window.summernoteInitialized = true;
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

               $.ajax({
                   url: base_url + 'humanr/add_announce',
                   type: 'post',
                   data: addAnnounce,
                   dataType: 'json',
                   success: function(res) {
                       if (res.status === 1) {
                           // alert(JSON.stringify(res));
                           // console.log('reloading')
                           toastr.success('Success! Announcement has been created.');
                           setTimeout(function() {
                               location.reload();
                           }, 5000);


                       } else {
                           // alert(res.msg);
                           toastr.error('Error! Announcement has failed to be created due to an error.');
                           console.log(res.msg)

                       }
                   }
               })
           })


           var checkboxes = document.querySelectorAll('input.btn-check');

           checkboxes.forEach(function(checkbox) {
               checkbox.addEventListener('change', function() {
                   if (this.id == "select_all") {
                       if (this.checked) {
                           // Disable all other checkboxes if "select all" is checked
                           checkboxes.forEach(function(x) {
                               if (x.id !== "select_all") {
                                   x.disabled = true;
                               }
                           });
                           // Set the hidden input value to "all"
                           $("#selected_dept").val("all");
                       } else {
                           // Enable all checkboxes if "select all" is unchecked
                           checkboxes.forEach(function(x) {
                               x.disabled = false;
                           });
                           // Reset the hidden input value
                           logSelectedDepartments();
                       }
                   } else {
                       // Log selected departments when individual checkbox is changed
                       logSelectedDepartments();
                   }
               });
           });

           function logSelectedDepartments() {
               var selectedDepartments = "";
               checkboxes.forEach(function(checkbox) {
                   if (checkbox.id !== "select_all" && checkbox.checked) {
                       selectedDepartments += checkbox.value + ",";
                   }
               });
               // Remove trailing comma
               selectedDepartments = selectedDepartments.replace(/,$/, "");
               console.log("Selected departments: ", selectedDepartments);
               // Update the hidden input field with selected departments
               $("#selected_dept").val(selectedDepartments);
           }


       })
   </script>