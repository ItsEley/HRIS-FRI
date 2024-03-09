<!-- Main Wrapper -->
<div class="main-wrapper">
   <!-- Header -->


   <?php
   // $_SESSION[]

   $this->load->view('templates/nav_bar'); ?>
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
            <div class="row">
               <div class="col-sm-12">
                  <h3 class="page-title">Welcome <span><?php echo ucwords(strtolower($_SESSION['fname'])); ?></span><span><?php echo ucwords(strtolower($_SESSION['user_type'])); ?></span>
!</h3>
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item active">HR Dashboard</li>

                  </ul>
               </div>
            </div>
         </div>
         <!-- /Page Header -->

         <div class="row"> <!-- main metrics -->
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php 
               $data['icon'] = "fa-solid fa-user";
               $data['count'] = rand(0,200);
               $data['label'] = "Employees";
               $this->load->view('components/card-dash-widget',$data)
                ?>


            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php 
               $data['icon'] = "fa fa-address-book";
                $data['count'] = rand(0,200);
                $data['label'] = "Applicant";
                $this->load->view('components/card-dash-widget',$data)

                ?>


            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
               <?php 
               $data['icon'] = "fa fa-check-circle";
                $data['count'] = rand(0,200);
                $data['label'] = "Overtime";
                $this->load->view('components/card-dash-widget',$data)

                ?>

            </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
               <?php
               $data['icon'] = "fa fa-rocket";
                $data['count'] = rand(0,200);
                $data['label'] = "Leaves";
                $this->load->view('components/card-dash-widget',$data)

               ?>

            </div>
         </div>


         <div class="row">
            <div class="col-lg-8 col-md-8">

               <h3 class="page-title">
                  <!-- <?php print_r($_SESSION) ?> -->
                  <a href="../pages/hr_announcement.php">Announcements</a>
               </h3>


               <?php

               $query = $this->db->get('announcement', 6);

               // print_r($this->session->get_userdata('fname'));
               // echo $_SESSION['fname'];

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

            <div class="col-lg-4 col-md-4">
               <div class="dash-sidebar">
                  <section>
                     <h5 class="dash-title">Projects</h5>
                     <div class="card">
                        <div class="card-body">
                           <div class="time-list">
                              <div class="dash-stats-list">
                                 <h4>71</h4>
                                 <p>Total Tasks</p>
                              </div>
                              <div class="dash-stats-list">
                                 <h4>14</h4>
                                 <p>Pending Tasks</p>
                              </div>
                           </div>
                           <div class="request-btn">
                              <div class="dash-stats-list">
                                 <h4>2</h4>
                                 <p>Total Projects</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
                  <section>
                     <h5 class="dash-title">Your Leave</h5>
                     <div class="card">
                        <div class="card-body">
                           <div class="time-list">
                              <div class="dash-stats-list">
                                 <h4>4.5</h4>
                                 <p>Leave Taken</p>
                              </div>
                              <div class="dash-stats-list">
                                 <h4>12</h4>
                                 <p>Remaining</p>
                              </div>
                           </div>
                           <div class="request-btn">
                              <a class="btn btn-primary" href="#">Apply Leave</a>
                           </div>
                        </div>
                     </div>
                  </section>
                  <section>
                     <h5 class="dash-title">Your time off allowance</h5>
                     <div class="card">
                        <div class="card-body">
                           <div class="time-list">
                              <div class="dash-stats-list">
                                 <h4>5.0 Hours</h4>
                                 <p>Approved</p>
                              </div>
                              <div class="dash-stats-list">
                                 <h4>15 Hours</h4>
                                 <p>Remaining</p>
                              </div>
                           </div>
                           <div class="request-btn">
                              <a class="btn btn-primary" href="#">Apply Time Off</a>
                           </div>
                        </div>
                     </div>
                  </section>
                  <section>
                     <h5 class="dash-title">Upcoming Holiday</h5>
                     <div class="card">
                        <div class="card-body text-center">
                           <h4 class="holiday-title mb-0">Mon 20 May 2019 - Ramzan</h4>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>










      </div>
      <!-- /Page Content -->
   </div>
   <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->


<script>
   document.addEventListener('DOMContentLoaded', function() {
      $("li > a[href='<?= base_url('hr/dashboard') ?>']").parent().addClass("active");
   })
</script>