<!-- Main Wrapper -->
<div class="main-wrapper">
   <!-- Header -->


   <?php

   $this->load->view('templates/nav_bar');

   $this->load->view('templates/sidebar');

   ?>

   <div class="page-wrapper">


      <div class="content container-fluid">

         <div class="page-header">
            <div class="row">
               <div class="col-sm-12">
                  <h3 class="page-title">Welcome <span><?php echo ucwords(strtolower($_SESSION['fullname'])); ?> !</span></h3>
                  <ul class="breadcrumb">
                     <li class="breadcrumb-item active">HR Dashboard / <?php echo date("l, jS F Y") ?></li>

                  </ul>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-lg-3 col-6">

               <?php

               $total_emp = $this->db->count_all('employee');
               $data['icon_type'] = "1";
               $data['icon'] = "fa-solid fa-user";
               $data['count'] = $total_emp;
               $data['label'] = "Employees";
               $this->load->view('components/card-dash-widget', $data)
               ?>

            </div>
            <div class="col-lg-3 col-6">

               <?php
               $data['icon_type'] = "1";
               $data['icon'] = "fa fa-address-book";
               $data['count'] = rand(0, 200);
               $data['label'] = "Applicant";
               $this->load->view('components/card-dash-widget', $data)

               ?>

            </div>
            <div class="col-lg-3 col-6">
               <?php
               $data['icon_type'] = "1";
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

               $data['icon_type'] = "2";
               $data['img_name'] = "business-leave-2.png";
               $data['icon'] = "fa fa-rocket";
               $data['count'] = $total;
               $data['label'] = "Leaves";
               $this->load->view('components/card-dash-widget', $data)

               ?>
            </div>
         </div>
         <div class="page-header mb-2">
            <div class="content-page-header">
               <h5>Analytics</h5>
            </div>
         </div>

         <div class="row mb-3">
            <div class="col-md-8">
               <div class="timeline-panel h-100">
                  <div class="card-header">
                     <h5 class="card-title">Attendance Status Per Month</h5>
                  </div>
                  <div class="card-body">
                     <div class="chartjs-wrapper-demo" style="height:180px">
                        <canvas id="chartStacked1" class="h-300"></canvas>
                     </div>
                  </div>
               </div>
            </div>
            <!-- new added -->
            <div class="col-md-4">
               <div class="timeline-panel h-100">
                  <div class="card-header">
                     <h5 class="card-title">Employee Per Department</h5>
                  </div>
                  <div class="card-body">
                     <div class="chartjs-wrapper-demo" style="height:180px">
                        <canvas id="empPerdept" class="h-300"></canvas>
                     </div>
                  </div>
               </div>
            </div>

         </div>




         <div class="row">
            <div class="col">
               <h2 class="page-title">
                  <a href="<?= base_url('hr/announcement') ?>" class="my-link my-hover">Announcements</a>
               </h2>

               <?php
               $data['for'] = "hr";
               $this->load->view('components/section-announcement', $data)
               ?>
               

            </div>
            <div class="col-lg-5 col-md-12">
               <h2 class="page-title">Upcoming Events</h2>

            <?php
               $this->load->view('components/section-events', $data)
            
            ?>




            </div>
         </div>







      </div>
      <!-- /Page Content -->
   </div>
   <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<?php $this->load->view('components\modal-announcement-details.php'); ?>

<!-- jQuery -->

<script src=<?= base_url("assets/js/analytics.js") ?>></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      $("li > a[href='<?= base_url('hr/dashboard') ?>']").parent().addClass("active");




   })
</script>