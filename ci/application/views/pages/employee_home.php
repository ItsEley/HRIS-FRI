
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
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
									<img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
								</div>
								<div class="welcome-det">
									<h3>Welcome, John Doe</h3>
									<p>Monday, 20 May 2019</p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
						<div class="card-body">
						<span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
						<div class="dash-widget-info">
						<h3>1</h3>
						<span>Absent this year</span>
						</div>
						</div>
						</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
						<div class="card-body">
						<span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
						<div class="dash-widget-info">
						<h3>10</h3>
						<span>Leaves</span>
						</div>
						</div>
						</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
						<div class="card-body">
						<span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
						<div class="dash-widget-info">
						<h3>37</h3>
						<span>Overtime</span>
						</div>
						</div>
						</div>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
						<div class="card-body">
						<span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
						<div class="dash-widget-info">
						<h3>5</h3>
						<span>Undertime</span>
						</div>
						</div>
						</div>
						</div>
						</div>

					<div class="row">
						<div class="col bg-primary">
							<h2>Announcements</h2>




						</div>
						<div class="col-4 bg-secondary">
							<h2 class = "text-center">Upcoming Events</h2>

							<div class="row" style ="background-color: white;">
								<h3>Event</h3>
								<p>time and date</p>
								<p>We will gather for something! And that something is I dont know</p>
							</div>

							
						</div>
					</div>

				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
