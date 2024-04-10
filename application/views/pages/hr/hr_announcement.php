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
                                    a.content, e.id as `emp_id`,
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
                                    a.id DESC
                                
                                ");
                                    foreach ($query->result() as $row) {
                                        $ann_id = $row->id;
                                        $title = $row->title;
                                        $content = $row->content;
                                        $author = ($row->author === NULL) ? "N/A" : $row->author;
                                        $department = ($row->to_all == "1") ? "All" : $row->departments;
                                        $date = $row->date_created;
                                    ?>
                                       <tr class="hoverable-row" data-ann-id="<?= $ann_id ?>">
                                           <td><?= $title ?></td>
                                           <td style="max-width: 200px; overflow: hidden;">
                                               <div style="max-height: 50px; overflow: hidden;">
                                                   <a class="ellipsis announcement-open my-hover" style="text-decoration:none;color:black" href="#" 
                                                   data-bs-toggle="modal" data-bs-target="#modal_announcement_detail" data-ann-id="<?= $ann_id ?>"
                                                   id = "ann_content_<?= $ann_id ?>">
                                                       <?= $content ?>
                                                   </a>
                                               </div>
                                           </td>
                                           <td><?= $author ?></td>
                                           <td><?= $department ?></td>
                                           <td><?= formatDateTime($date) ?></td>
                                           <td class = "text-center">
                                            <?php
                                            if($row->emp_id == $this->session->userdata('id')){
                                                echo '
                                                <button type = "button" class="edit-announcement modal-trigger btn btn-rounded btn-primary p-1 px-2"
                                                 style = "margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_announcement_edit"
                                                  data-ann-id="'. $ann_id .'">
                                                    <i class="fas fa-pencil m-r-5"></i>Edit
                                                </button>

                                               <button type = "button" class="delete-announcement modal-trigger btn btn-rounded btn-danger p-1 px-2"
                                               style = "font-size:10px"  data-bs-toggle="modal" data-bs-target="#modal_announcement_delete"
                                               data-ann-id="'. $ann_id .'">
                                                <i class="fa-regular fa-trash-can m-r-5"></i>Delete
                                               </button>
                                                ';
                                            }else{
                                                echo '
                                                <button type = "button" class="delete-announcement modal-trigger btn btn-rounded btn-info p-1 px-2" 
                                                style = "font-size:10px" 
                                                data-ann-id="<?= $ann_id ?>" onclick = "$(\'#ann_content_'.$ann_id.'\')[0].click()" >
                                                <i class="fa-solid fa-eye"></i> View
                                            </button>
                                                ';
                                            }
                                            ?>
                                         
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



   <!-- modal create -->
   <?php $this->load->view('templates\modals\announcement_create.php'); ?>
   <?php $this->load->view('templates\modals\announcement_edit.php'); ?>




   <?php $this->load->view('components\modal-announcement-details.php'); ?>

   <!-- Include Summernote JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           $("li > a[href='<?= base_url('hr/announcement') ?>']").parent().addClass("active");

           $('#dt_announcements').DataTable({
               "order": [] // Disable initial sorting
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