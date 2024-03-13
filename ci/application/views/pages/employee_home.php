
	<style>
	.button-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Adjust the number of columns as needed */
    grid-gap: 10px;
}

.button-grid button {
    width: 100%; /* Set the width of each button to 100% */
}

	</style>



		<!-- Main Wrapper -->
        <div class="main-wrapper">
        <?php
   // $_SESSION[]

   $this->load->view('templates/nav_bar'); ?>
   <!-- /Header -->
   <!-- Sidebar -->
   <?php $this->load->view('templates/sidebar') ?>
			
			<!-- Page Wrapper -->
            <div class="page-wrapper w-100">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
									
								</div>
								<div class="welcome-det">
									<h3>Welcome, <?php echo ucwords($_SESSION['fname'])?>! </h3>
									<p><?php echo date("l, jS F Y")?></p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row"> <!-- main metrics -->
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php 
               $data['icon'] = "fa-solid fa-user";
               $data['count'] = rand(0,200);
               $data['label'] = "Absent this year";
               $this->load->view('components/card-dash-widget',$data)
                ?>


            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

               <?php 
               $data['icon'] = "fa fa-address-book";
                $data['count'] = rand(0,200);
                $data['label'] = "Remaining Leaves";
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
                $data['label'] = "Undertime";
                $this->load->view('components/card-dash-widget',$data)

               ?>

            </div>
         </div>

					<div class="row">
						<div class="col">
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
						<div class="col-4">
							<h2 class = "text-center">Upcoming Events</h2>

							<div class="row" style ="background-color: white;">
								<h3>Event</h3>
								<p>time and date</p>
								<p>We will gather for something! And that something is I dont know</p>
							</div>
							<div class="row" style ="background-color: white;">
								<h3>Birthday</h3>
								<p>TODAY</p>
								<p>We will gather for something! And that something is I dont know</p>
								<img src="../assets/img/birthday-GIF.gif" alt="User Image" loop="infinite">
								
							</div>

							
						</div>
					</div>

				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
