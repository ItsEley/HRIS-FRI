<style>
	.button-grid {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		/* Adjust the number of columns as needed */
		grid-gap: 10px;
	}

	.button-grid button {
		width: 100%;
		/* Set the width of each button to 100% */
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
	<div class="page-wrapper" style="margin-left:0px;">
		<!-- Page Content -->
		<div class="content container-fluid">
			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">Forms</h3>
						<!-- <ul class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="admin-dashboard.html">Dashboard</a>
								</li>
								<li class="breadcrumb-item active">Blank Page</li>
							</ul> -->
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<!-- Content Starts -->

			<!-- buttons -->


			<div class="button-grid">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_leave_request">
					Apply for a leave request
				</button>

				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_ob_request">
					Apply for Official Business Request
				</button>

				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_outgoing_pass">
					Apply for Outgoing pass
				</button>

				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_schedule_adjustment">
					Apply for Work Schedule Adjustment
				</button>

				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_undertime_request">
					Apply for Undertime Request
				</button>

				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_overtime_request">
					Apply for Overtime Request
				</button>
			</div>







			<?php
			$userid = $_SESSION['id'];
			$fname = $_SESSION['fname'];
			$lname = $_SESSION['lname'];
			$department = $_SESSION['department'];

			$status = 'Pending';

			$fullName = $fname . ' ' . $lname;

			?>


			<!-- modals -->

			<!-- Modal leave request-->
			<div class="modal fade" id="modal_leave_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_leave_request_label" aria-hidden="true">
				<div class="modal-dialog">
					<form id="leave_request" method="post">


						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
								<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->


							</div>
							<div class="modal-body">


								<div class="container"> <!-- Employee leave form inputs -->
									<div style="background-color: white;
												max-width: 540px;max-height: auto;">
										<!-- Header-->

										<div class="row mb-2">
											<div class="col-3">
												<div class="account-logo">
													<img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" alt="Famco Retail Inc." style="width: 150px" />
												</div>
											</div>
											<div class="col text-start">
												<h3>Leave Request Form</h3>
											</div>

										</div>

										<!-- /Form content -->

										<input type="hidden" class="form-control input-field mb-2" value="<?php echo $userid; ?>" name="empid">
										<input type="hidden" class="form-control input-field mb-2" value="<?php echo $department; ?>" name="department">
										<input type="hidden" class="form-control input-field mb-2" value="<?php echo $fullName; ?>" name="name">
										<input type="hidden" class="form-control input-field mb-2" value="<?php echo $status; ?>" name="status">
										<div class="row ">
											<div class="col-3">

												<label for="from_date" class="form-label mb-2">From:</label>

											</div>
											<div class="col-8">

												<input type="date" class="form-control input-field mb-2" name="from_date" id="from_date" />
											</div>
										</div>


										<div class="row">
											<div class="col-3">

												<label for="to_date" class="form-label mb-2">To:</label>

											</div>
											<div class="col-8">

												<input type="date" class="form-control input-field mb-2 " name="to_date" id="to_date" />
											</div>
										</div>


										<div class="row mb-2">
											<label class="col-3">Type of Leave</label>
											<div class="col-md-8">
												<select class="form-control form-select" name="leaveType">
													<option>-- Select an Option--</option>
													<option>Vacation</option>
													<option>Maternity</option>
													<option>Emergency</option>
													<option>Paternity</option>
													<option>Authorized Absent</option>
													<option>Service Incentive Leave</option>
													<option>Other reason</option>
												</select>
											</div>
										</div>

										<div class="mb-3 row">
											<label class="col-3">Reason</label>
											<div class="col-md-8">
												<textarea rows="1" cols="5" class="form-control" name="reason" placeholder="Enter text here"></textarea>

											</div>
										</div>





									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!-- Modal outgoing pass -->
			<div class="modal fade" id="modal_outgoing_pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_outgoing_pass_label" aria-hidden="true">
				<div class="modal-dialog">
					<form action="#" method="post">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
								<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

							</div>
							<div class="modal-body">

								<div class="container"> <!-- Employee Outgoing Pass form inputs -->
									<div style="max-height: auto;">
										<!-- Header-->

										<div class="row mb-2">
											<div class="col-2">
												<div class="account-logo">
													<img src="<?= base_url('assets/img/famco_logo_clear.png') ?> " alt="Famco Retail Incorporated" style="width: 150px" />
												</div>
											</div>
											<div class="col ">
												<h3>Outgoing Pass</h3>
											</div>

										</div>

										<!-- /Form content -->


										<div class="row ">
											<!-- <p>I, have to leave the company premises on this day : </p> -->
											<div class="col-3">

												<label for="outgoing_pass_date" class="form-label mb-2">Date:</label>

											</div>
											<div class="col-8">

												<input type="date" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
											</div>
										</div>



										<div class="row">
											<div class="col-3">

												<label for="from_time" class="form-label mb-2">From:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="from_time" id="from_time" />
											</div>
										</div>


										<div class="row">
											<div class="col-3">

												<label for="to_time" class="form-label mb-2">To:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="to_time" id="to_time" />
											</div>
										</div>





										<div class="mb-3 row">
											<label class="col-form-label col-md-3">Reason</label>
											<div class="col-md-8">
												<textarea rows="1" cols="5" class="form-control" placeholder="Enter text here"></textarea>

											</div>
										</div>

										<div class="mb-3 row">
											<label class="col-form-label col-md-3">Destination</label>
											<div class="col-md-8">
												<input type="text" class="form-control">
											</div>
										</div>



									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			<!-- Modal schedule adjustment-->
			<div class="modal fade" id="modal_schedule_adjustment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_schedule_adjustment_label" aria-hidden="true">
				<div class="modal-dialog">
					<form action="#" method="post">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
								<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

							</div>
							<div class="modal-body">

								<div class="container"> <!-- Employee Work Schedule Adjustment form inputs -->
									<div style="max-height: auto;">
										<!-- Header-->

										<div class="row mb-2">
											<div class="col-2">
												<div class="account-logo">
													<img src="<?= base_url('assets/img/famco_logo_clear.png') ?> " alt="Famco Retail Incorporated" style="width: 150px" />
												</div>
											</div>
											<div class="col text-center">
												<h3>Work Schedule Adjustment Form</h3>
											</div>

										</div>

										<!-- /Form content -->

										<div class=" mb-3 row">
											<label class="col-form-label col-md-3">To Change</label>
											<div class="col-md-8">
												<select class="form-control form-select">
													<option>-- Select an Option--</option>
													<option>Time Schedule</option>
													<option>Day off</option>
													<option>Both</option>
												</select>
											</div>
										</div>

										<div id="time_sched_div">

											<div class="row ">
												<p class="row text-center">Change Time Schedule</p>
												<div class="col-3">

													<label for="outgoing_pass_date" class="form-label mb-2">From:</label>

												</div>
												<div class="col-8">

													<input type="time" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
												</div>
											</div>



											<div class="row">
												<div class="col-3">

													<label for="from_time" class="form-label mb-2">To:</label>

												</div>
												<div class="col-8">

													<input type="time" class="form-control input-field mb-2 " name="from_time" id="from_time" />
												</div>
											</div>

										</div>


										<div id="time_dayoff_div">

											<div class="row ">
												<p class="row text-center">Change Day Off</p>
												<div class="col-3">

													<label for="outgoing_pass_date" class="form-label mb-2">From:</label>

												</div>
												<div class="col-8">

													<input type="date" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
												</div>
											</div>



											<div class="row">
												<div class="col-3">

													<label for="from_time" class="form-label mb-2">To:</label>

												</div>
												<div class="col-8">

													<input type="date" class="form-control input-field mb-2 " name="from_time" id="from_time" />
												</div>
											</div>

										</div>




										<div class=" mb-3 row">
											<label class="col-form-label col-md-3">Reason</label>
											<div class="col-md-8">
												<textarea rows="1" cols="5" class="form-control" placeholder="Enter text here"></textarea>

											</div>
										</div>

									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>


			<!-- Modal undertime-->
			<div class="modal fade" id="modal_undertime_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_undertime_request_label" aria-hidden="true">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
							<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

						</div>
						<div class="modal-body">

							<div class="container"> <!-- Employee Undertime form inputs -->
								<div style="max-height: auto; ">
									<!-- Header-->

									<div class="row mb-2">
										<div class="col-2">
											<div class="account-logo">
												<img src="<?= base_url('assets/img/famco_logo_clear.png') ?> " alt="Famco Retail Incorporated" style="width: 150px" />
											</div>
										</div>
										<div class="col text-center">
											<h3>Undertime Form</h3>
										</div>

									</div>

									<!-- /Form content -->

									<form method="post" action="submit_leave_request.php" class="mb-2">

										<div class="row ">
											<!-- <p>I, have to leave the company premises on this day : </p> -->
											<div class="col-3">

												<label for="outgoing_pass_date" class="form-label mb-2">Date of Undertime:</label>

											</div>
											<div class="col-8">

												<input type="date" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
											</div>
										</div>



										<div class="row">
											<div class="col-3">

												<label for="from_time" class="form-label mb-2">Time in:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="from_time" id="from_time" />
											</div>
										</div>


										<div class="row">
											<div class="col-3">

												<label for="to_time" class="form-label mb-2">Time out:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="to_time" id="to_time" />
											</div>
										</div>



										<div class=" mb-3 row">
											<label class="col-form-label col-md-3">Reason</label>
											<div class="col-md-8">
												<textarea rows="1" cols="5" class="form-control" placeholder="Enter text here"></textarea>

											</div>
										</div>



								</div>
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Submit</button>
						</div>
					</div>
					</form>
				</div>
			</div>

			<!-- Modal ob request -->
			<div class="modal fade" id="modal_ob_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_ob_request_label" aria-hidden="true">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
							<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

						</div>
						<div class="modal-body">



							<div class="container"> <!-- Employee Official Business form inputs -->
								<div style="
                max-height: auto;">
									<!-- Header-->

									<div class="row mb-2">
										<div class="col-2">
											<div class="account-logo">
												<img src="<?= base_url('assets/img/famco_logo_clear.png') ?> " alt="Famco Retail Incorporated" style="width: 150px" />
											</div>
										</div>
										<div class="col text-center">
											<h3>Official Business Form</h3>
										</div>

									</div>

									<!-- /Form content -->



									<div class="row ">
										<!-- <p>I, have to leave the company premises on this day : </p> -->
										<div class="col-3">

											<label for="outgoing_pass_date" class="form-label mb-2">Date</label>

										</div>
										<div class="col-8">

											<input type="date" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
										</div>
									</div>


									<div class="row ">
										<p class="row text-center">Destination</p>
										<div class="col-3">

											<label for="outgoing_pass_date" class="form-label mb-2">From:</label>

										</div>
										<div class="col-8">

											<input type="text" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
										</div>
									</div>



									<div class="row">
										<div class="col-3">

											<label for="from_time" class="form-label mb-2">To:</label>

										</div>
										<div class="col-8">

											<input type="text" class="form-control input-field mb-2 " name="from_time" id="from_time" />
										</div>
									</div>


									<div class="row ">
										<p class="row text-center">Time</p>
										<div class="col-3">

											<label for="outgoing_pass_date" class="form-label mb-2">From:</label>

										</div>
										<div class="col-8">

											<input type="time" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
										</div>
									</div>



									<div class="row">
										<div class="col-3">

											<label for="from_time" class="form-label mb-2">To:</label>

										</div>
										<div class="col-8">

											<input type="time" class="form-control input-field mb-2 " name="from_time" id="from_time" />
										</div>
									</div>



									<div class=" mb-3 row">
										<label class="col-form-label col-md-3">Reason</label>
										<div class="col-md-8">
											<textarea rows="1" cols="5" class="form-control" placeholder="Enter text here"></textarea>

										</div>
									</div>

								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Submit</button>
						</div>
					</div>
					</form>
				</div>
			</div>


			<!-- Modal overtime-->
			<div class="modal fade" id="modal_overtime_request" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_overtime_request_label" aria-hidden="true">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Fill up form</h5>
							<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->

						</div>
						<div class="modal-body">

							<div class="container"> <!-- Employee Undertime form inputs -->
								<div style="max-height: auto; ">
									<!-- Header-->

									<div class="row mb-2">
										<div class="col-2">
											<div class="account-logo">
												<img src="<?= base_url('assets/img/famco_logo_clear.png') ?> " alt="Famco Retail Incorporated" style="width: 150px" />
											</div>
										</div>
										<div class="col text-center">
											<h3>Overtime Form</h3>
										</div>

									</div>

									<!-- /Form content -->

									<form method="post" action="submit_leave_request.php" class="mb-2">

										<div class="row ">
											<!-- <p>I, have to leave the company premises on this day : </p> -->
											<div class="col-3">

												<label for="outgoing_pass_date" class="form-label mb-2">Date of Overtime:</label>

											</div>
											<div class="col-8">

												<input type="date" class="form-control input-field mb-2" name="outgoing_pass_date" id="outgoing_pass_date" />
											</div>
										</div>



										<div class="row">
											<div class="col-3">

												<label for="from_time" class="form-label mb-2">Time in:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="from_time" id="from_time" />
											</div>
										</div>


										<div class="row">
											<div class="col-3">

												<label for="to_time" class="form-label mb-2">Time out:</label>

											</div>
											<div class="col-8">

												<input type="time" class="form-control input-field mb-2 " name="to_time" id="to_time" />
											</div>
										</div>



										<div class=" mb-3 row">
											<label class="col-form-label col-md-3">Reason</label>
											<div class="col-md-8">
												<textarea rows="1" cols="5" class="form-control" placeholder="Enter text here"></textarea>

											</div>
										</div>



								</div>
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Submit</button>
						</div>
					</div>
					</form>
				</div>
			</div>









			<!-- /Content End -->
		</div>
		<!-- /Page Content -->
	</div>
	<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		$("li > a[href='<?= base_url('resources/forms') ?>']").parent().addClass("active");


	})
</script>