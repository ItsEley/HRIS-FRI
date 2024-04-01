<!-- Main Wrapper -->
<div class="main-wrapper">
   <!-- Header -->


   <?php
   // $_SESSION[]

   // navbar
   $this->load->view('templates/nav_bar');
   // sidebar
   $this->load->view('templates/sidebar');

   ?>
   <!-- /Sidebar -->
   <!-- Two Col Sidebar -->

   <!-- /Two Col Sidebar -->
   <!-- Page Wrapper -->
   <div class="page-wrapper w-100">

      <!-- Page Content -->
      <div class="content container-fluid">
         <!-- Page Header -->
         <div class="page-header">
            <div class="row">
               <div class="col-sm-12">
                  <h3 class="page-title">Welcome <span><?php echo ucwords(strtolower($_SESSION['name'])); ?> !</span></h3>
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item active">HR Dashboard / <?php echo date("l, jS F Y") ?></li>

                  </ul>
               </div>
            </div>
         </div>
         <!-- /Page Header -->

         <div class="row"> <!-- main metrics -->
            <div class="col-lg-3 col-6">

               <?php

               $total_emp = $this->db->count_all('employee');
               $data['icon'] = "fa-solid fa-user";
               $data['count'] = $total_emp;

               $data['label'] = "Employees";
               $this->load->view('components/card-dash-widget', $data)
               ?>


            </div>
            <div class="col-lg-3 col-6">

               <?php
               $data['icon'] = "fa fa-address-book";
               $data['count'] = rand(0, 200);
               $data['label'] = "Applicant";
               $this->load->view('components/card-dash-widget', $data)

               ?>

            </div>
            <div class="col-lg-3 col-6">
               <?php
               $data['icon'] = "fa fa-check-circle";
               $data['count'] = rand(0, 200);
               $data['label'] = "Overtime";
               $this->load->view('components/card-dash-widget', $data)

               ?>

            </div>
            <div class="col-lg-3 col-6">
               <?php

               $pending_leave = $this->db->count_all('f_leaves');
               $pending_ob = $this->db->count_all('f_off_bussiness');
               $pending_og = $this->db->count_all('f_outgoing');
               $pending_ot = $this->db->count_all('f_overtime');
               $pending_ut = $this->db->count_all('f_undertime');
               $pending_wsa = $this->db->count_all('f_worksched_adj');

               $total = $pending_leave + $pending_ob + $pending_og + $pending_ot + $pending_ut + $pending_wsa;

               $data['icon'] = "fa fa-rocket";
               $data['count'] = $total;
               $data['label'] = "Leaves";
               $this->load->view('components/card-dash-widget', $data)

               ?>
            </div>
         </div>
        

               <!-- Page Header -->
               <div class="page-header">
                  <div class="content-page-header">
                     <h5>Charts</h5>
                  </div>
               </div>
               
               <div class="row">
                 
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title">Column Chart</h5>
                        </div>
                        <div class="card-body">
                           <div id="s-col"></div>
                        </div>
                     </div>
                  </div>
               
                  <div class="col-md-6">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title">Employees in Departments</h5>
                        </div>
                        <div class="card-body">
                           <div id="s-bar"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            

         <div class="row">
            <div class="col">
               <h2 class="page-title">

                  <a href="../pages/hr_announcement.php" style="color:black">Announcements</a>
               </h2>

               <div class="timeline-panel">


                  <?php

                  $query = $this->db->get('announcement', 6);



                  foreach ($query->result() as $row) {


                     $data['id'] = $row->id;
                     $data['title'] = $row->title;
                     $data['content'] =  $row->content;
                     $data['author'] =  $row->author;
                     $data['department'] = $row->to_all;
                     $data['date'] =  $row->date_created;



                     $this->load->view('components/card-announcement', $data);
                  }

                  ?>

               </div>




            </div>
            <div class="col-lg-4 col-md-12">
               <h2 class="page-title">Upcoming Events</h2>

               <div class="row timeline-panel " style="background-color: white; ">
                  <h3>It's John Leo Bayani's Birthday!</h3>
                  <p>Today • March 26, 2023</p>
                  <p class="text-overflow-ellipsis" style="height:120px;" onclick="$(this).css('height','auto')">Happy Birthday! 🎉🎂 Wishing you a day filled with joy, laughter,
                     and all the things that make you smile. May this special day be as
                     wonderful as you are, and may the year ahead bring you countless blessings,
                     love, and unforgettable memories. Here's to celebrating you today and always!
                     Have an amazing birthday Mr. Leo!</p>
                  <img src="../assets/img/birthday-GIF.gif" alt="User Image" loop="infinite">

               </div>

               <div class="row timeline-panel " style="background-color: white;">
                  <h3>Innovate 2024: Unleashing Creativity in the Digital Era</h3>
                  <p>April 15, 2024, 9:00 AM - 5:00 PM</p>
                  <p class="text-overflow-ellipsis" style="height:120px;" onclick="$(this).css('height','auto')">Join us for a day of exploration and inspiration as we delve into the world of digital
                     innovation. From cutting-edge technologies to groundbreaking strategies, this event will
                     ignite your creativity and empower you to shape the future. Engage with industry experts,
                     participate in interactive workshops, and network with like-minded innovators. Don't miss
                     this opportunity to unlock your potential and drive change in the digital landscape.
                  </p>
               </div>

               <div class="row timeline-panel " style="background-color: white; ">
                  <h3>Wellness Week: Mind, Body, and Soul</h3>
                  <p>May 20-24, 2024, All Day</p>
                  <p class="text-overflow-ellipsis" style="height:200px;" onclick="$(this).css('height','auto')">Take a break from the hustle and bustle of work and prioritize your well-being during Wellness Week.
                     Join us for a series of activities designed to rejuvenate your mind, energize your body,
                     and nourish your soul. From yoga sessions and meditation workshops to nutritious cooking
                     classes and stress-relief seminars, this week-long event offers something for everyone.
                     Invest in yourself and discover the power of holistic wellness.
                  </p>
               </div>



            </div>
         </div>




         <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
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
                              <input type="text" class="form-control" name="title" placeholder="Title">
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
         </div>






      </div>
      <!-- /Page Content -->
   </div>
   <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->


<div id="modal_announcement_detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Announcement Title</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body p-4">

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, debitis
               voluptas ea consequatur harum eum odit vero at quibusdam unde necessitatibus
               officiis eligendi aperiam sit commodi nesciunt corrupti ullam doloribus!</p>



         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
         </div>
      </div>

   </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      $("li > a[href='<?= base_url('hr/dashboard') ?>']").parent().addClass("active");



      
$(document).on("click", ".announcement-open", function(e) {
    e.preventDefault();

    var ann_id = $(this).data("ann-id"); // Use data() instead of attr() for data attributes
    console.log('Employee ID:', emp_id);

    // Use shorthand $.ajax method for cleaner code
    $.ajax({
        url: base_url + 'humanr/showUserdetails',
        type: 'POST',
        data: {'emp_id': emp_id },
        dataType: 'json', // Specify JSON data type for automatic parsing
        success: function(response) {
            console.log('Response:', response);

            if (response.status === "success") {
                var employee = response.data;

                // Populate form fields using object destructuring for cleaner code
                $("form#edit_employee input[name='emp_id']").val(employee.id);
                $("form#edit_employee input[name='fname']").val(employee.fname);
                $("form#edit_employee input[name='mname']").val(employee.mname || ''); // Handle null or undefined values
                $("form#edit_employee input[name='lname']").val(employee.lname);
                $("form#edit_employee input[name='nickn']").val(employee.nickn);
                $("form#edit_employee input[name='current_add']").val(employee.current_add);
                $("form#edit_employee input[name='perm_add']").val(employee.perm_add);
                $("form#edit_employee input[name='dob']").val(employee.dob);
                $("form#edit_employee input[name='religion']").val(employee.religion);
                $("form#edit_employee select[name='sex']").val(employee.sex);
                $("form#edit_employee select[name='civil_status']").val(employee.civil_status);

                // Handle select option for civil_status
                var civilStatusSelect = $("form#edit_employee select[name='civil_status']");
                civilStatusSelect.val(employee.civil_status);
                if (!civilStatusSelect.val()) {
                    civilStatusSelect.val('N/A');
                }

                $("form#edit_employee input[name='pob']").val(employee.pob);
                $("form#edit_employee input[name='email']").val(employee.email);
                $("form#edit_employee input[name='contact_no']").val(employee.contact_no);

            } else {
                console.error('Error:', response.message); // Log error message
                // Handle error if necessary
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            // Handle AJAX error if necessary
        }
    });
});

   })
</script>