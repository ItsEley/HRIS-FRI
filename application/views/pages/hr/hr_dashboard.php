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
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php

               $total_emp = $this->db->count_all('employee');
               $data['icon'] = "fa-solid fa-user";
               $data['count'] = $total_emp;

               $data['label'] = "Employees";
               $this->load->view('components/card-dash-widget', $data)
               ?>


            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php
               $data['icon'] = "fa fa-address-book";
               $data['count'] = rand(0, 200);
               $data['label'] = "Applicant";
               $this->load->view('components/card-dash-widget', $data)

               ?>

            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
               <?php
               $data['icon'] = "fa fa-check-circle";
               $data['count'] = rand(0, 200);
               $data['label'] = "Overtime";
               $this->load->view('components/card-dash-widget', $data)

               ?>

            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
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


         <div class="row">
                <div class="col">
                    <h2 class="page-title" >
                        <!-- <?php //print_r($_SESSION) ?> -->
                        <a href="../pages/hr_announcement.php" style = "color:black">Announcements</a>
                    </h2>


                    <?php

                    $query = $this->db->get('announcement', 6);

                    // print_r($this->session->get_userdata('fname'));
                    // echo $_SESSION['fname'];

                    foreach ($query->result() as $row) {
                        $title =  $row->title;
                        $content = $row->content;
                        $author = $row->author;
                        $department = $row->to_all;
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
                <div class="col-4">
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