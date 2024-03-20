<!-- Main Wrapper -->
<div class="main-wrapper">

	<?php
	// $_SESSION[]

	// navbar
	$this->load->view('templates/nav_bar');
	// sidebar
	$this->load->view('templates/sidebar');

	?>
	<!-- Page Wrapper -->
	<div class="page-wrapper w-100">

		<!-- Page Content -->
		<div class="content container-fluid">

			<!-- Page Header -->
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title">Pending Requests</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Pending Requests</li>
						</ul>
					</div>
					<div class="col-auto float-end ms-auto">
						<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_leave"><i class="fa-solid fa-plus"></i> Add Leave</a>
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<!-- Leave Statistics -->
			<div class="row">
				<div class="col-md-3 d-flex">
					<div class="stats-info w-100">
						<h6>Today Presents</h6>
						<h4>12 / 60</h4>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="stats-info w-100">
						<h6>Planned Leaves</h6>
						<h4>8 <span>Today</span></h4>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="stats-info w-100">
						<h6>Unplanned Leaves</h6>
						<h4>0 <span>Today</span></h4>
					</div>
				</div>
				<div class="col-md-3 d-flex">
					<div class="stats-info w-100">
						<h6>Pending Requests</h6>
						<h4>

							
							<?php

							$pending_leave = $this->db->count_all('f_leaves');
							$pending_ob = $this->db->count_all('f_off_bussiness');
							$pending_og = $this->db->count_all('f_outgoing');
							$pending_ot = $this->db->count_all('f_overtime');
							$pending_ut = $this->db->count_all('f_undertime');
							$pending_wsa = $this->db->count_all('f_worksched_adj');

							$total = $pending_leave + $pending_ob + $pending_og + $pending_ot + $pending_ut + $pending_wsa;
							echo $total;
							?>


						</h4>
					</div>
				</div>
			</div>
			<!-- /Leave Statistics -->

			<!-- Search Filter -->
			<div class="row filter-row">
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<div class="input-block mb-3 form-focus">
						<input type="text" class="form-control floating">
						<label class="focus-label">Employee Name</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<div class="input-block mb-3 form-focus select-focus">
						<select class="select form-control floating">
							<option> -- Select -- </option>
							<option>Casual Leave</option>
							<option>Medical Leave</option>
							<option>Loss of Pay</option>
						</select>
						<label class="focus-label">Leave Type</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<div class="input-block mb-3 form-focus select-focus">
						<select class="select form-control floating">
							<option> -- Select -- </option>
							<option> Pending </option>
							<option> Approved </option>
							<option> Rejected </option>
						</select>
						<label class="focus-label">Leave Status</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<div class="input-block mb-3 form-focus">
						<div class="cal-icon">
							<input class="form-control floating datetimepicker" type="text">
						</div>
						<label class="focus-label">From</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<div class="input-block mb-3 form-focus">
						<div class="cal-icon">
							<input class="form-control floating datetimepicker" type="text">
						</div>
						<label class="focus-label">To</label>
					</div>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
					<a href="#" class="btn btn-success w-100"> Search </a>
				</div>
			</div>
			<!-- /Search Filter -->





			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped custom-table mb-0 datatable">
							<thead>
								<tr>
									<th>Employee</th>
									<th>Request Type</th>

									<th>Date Filled</th>
									<th>Department</th>
									<th class="text-center">Status</th>
									<th class="text-end">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$row_arr = array();

								$query = $this->db->get('f_leaves');
								foreach ($query->result() as $row) {
									$leave_id =  $row->id;
									$name = ucwords(strtolower($row->name));
									$date_filled = $row->date_filled;
									$leave_type = $row->type_of_leave;
									$department = $row->department;
									$status = $row->status;
									$request_type = "LEAVE REQUEST";
									$row_arr[] = array(
										'id' => $leave_id,
										'name' => $name,
										'leave_type' => $leave_type,
										'date_filled' => $date_filled,
										'department' => $department,
										'status' => $status,
										'request_type' => $request_type
									);
								}

								$query2 = $this->db->get('f_undertime');
								foreach ($query2->result() as $row2) {
									$undertime_leave_id =  $row2->id;
									$undertime_name = ucwords(strtolower($row2->name));
									$undertime_date_filled = $row2->date_filled;
									$undertime_department = $row2->department;
									$undertime_status = $row2->status;
									$request_type = "UNDERTIME REQUEST";
									$row_arr[] = array(
										'id' => $undertime_leave_id,

										'name' => $undertime_name,
										'date_filled' => $undertime_date_filled,
										'department' => $undertime_department,
										'status' => $undertime_status,
										'request_type' => $request_type
									);
								}
								$query3 = $this->db->get('f_outgoing');
								foreach ($query3->result() as $row3) {
									$outgoing_id =  $row3->id;
									$outgoing_name = ucwords(strtolower($row3->name));
									$outgoing_date_filled = $row3->date_filled;
									$outgoing_department = $row3->department;
									$outgoing_status = $row3->status;
									$request_type = "OUTGOING PASS REQUEST";
									$row_arr[] = array(
										'id' => $outgoing_id,

										'name' => $outgoing_name,
										'date_filled' => $outgoing_date_filled,
										'department' => $outgoing_department,
										'status' => $outgoing_status,
										'request_type' => $request_type
									);
								}

								$query4 = $this->db->get('f_off_bussiness');
								foreach ($query4->result() as $row4) {
									$ob_id =  $row4->id;
									$ob_name = ucwords(strtolower($row4->name));
									$ob_date_filled = $row4->outgoing_pass_date;
									$ob_department = $row4->department;
									$ob_status = $row4->status;
									$request_type = "OFFICIAL BUSINESS REQUEST";
									$row_arr[] = array(
										'id' => $ob_id,

										'name' => $ob_name,
										'date_filled' => $ob_date_filled,
										'department' => $ob_department,
										'status' => $ob_status,
										'request_type' => $request_type
									);
								}
								$query5 = $this->db->get('f_overtime');
								foreach ($query5->result() as $row5) {
									$ot_id =  $row5->id;
									$ot_name = ucwords(strtolower($row5->name));
									$date_ot = $row5->date_ot;
									$ot_department = $row5->department;
									$ot_status = $row5->status;
									$request_type = "OVERTIME REQUEST";
									$row_arr[] = array(
										'id' => $ot_id,

										'name' => $ob_name,
										'date_filled' => $date_ot,
										'department' => $ob_department,
										'status' => $ob_status,
										'request_type' => $request_type
									);
								}
								// $query6 = $this->db->get('work_schedule_adjustment_table');
								// foreach ($query6->result() as $row6) {
								// 	$ws_id =  $row6->id;
								// 	$ws_name = ucwords(strtolower($row6->name));
								// 	$ws_date = $row6->date_filled;
								// 	$ws_department = $row6->department;
								// 	$ws_status = $row6->status;
								// 	$request_type = "WORK SCHEDULE ADJUSTMENT REQUEST";
								// 	$row_arr[] = array(
								// 		'id' => $ws_id,

								// 		'name' => $ws_name,
								// 		'date_filled' => $ws_date,
								// 		'department' => $ws_department,
								// 		'status' => $ws_status,
								// 		'request_type' => $request_type
								// 	);
								// }

								$total_rows = count($row_arr);

								foreach ($row_arr as $row) {
								?>

									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-09.jpg" alt="User Image"></a>
												<a href="#"><?php echo $row['name']; ?><span></span></a>
											</h2>
										</td>
										<td><?php echo $row['request_type']; ?></td>
										<td><?php echo $row['date_filled']; ?></td>
										<td><?php echo $row['department']; ?></td>
										<td class="text-center">
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
													<i class="fa-regular fa-circle-dot text-purple"></i> <?php echo $row['status']; ?>
												</a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-purple"></i> New</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-info"></i> Pending</a>
													<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#approve_leave"><i class="fa-regular fa-circle-dot text-success"></i> Approved</a>
													<a class="dropdown-item" href="#"><i class="fa-regular fa-circle-dot text-danger"></i> Declined</a>
												</div>
											</div>
										</td>
										<td class="text-end">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item update-req" href="#" data-bs-toggle="modal" id="" data-bs-target="#edit_leave" data-target-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item delete-req" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve" data-target-id="<?php echo $row['id']; ?>"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
												</div>
											</div>
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
		</div>
		<!-- /Page Content -->

		<!-- Add Leave Modal -->
		<div id="add_leave" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Leave</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="input-block mb-3">
								<label class="col-form-label">Leave Type <span class="text-danger">*</span></label>
								<select class="form-control" name="department">
									<?php
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
							<div class="input-block mb-3">
								<label class="col-form-label">From <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text">
								</div>
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">To <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input class="form-control datetimepicker" type="text">
								</div>
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">Number of days <span class="text-danger">*</span></label>
								<input class="form-control" readonly type="text">
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">Remaining Leaves <span class="text-danger">*</span></label>
								<input class="form-control" readonly value="12" type="text">
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">Leave Reason <span class="text-danger">*</span></label>
								<textarea rows="4" class="form-control"></textarea>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Leave Modal -->

		<!-- Edit Leave Modal -->
		<div id="edit_leave" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Leave</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="edit_leave_form">
							<div class="input-block mb-3">
								<label class="col-form-label">Leave Type <span class="text-danger">*</span></label>
								<select id="leave_type" class="select">
									<option>Select Leave Type</option>
									<option>Casual Leave 12 Days</option>
								</select>
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">From <span class="text-danger">*</span></label>
								<div class="cal-icon">
									<input id="employee_name" class="form-control" value="" type="employee_name">
								</div>
							</div>
							<!-- Other form fields -->
							<div class="submit-section">
								<button id="save_edit_leave" class="btn btn-primary submit-btn">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>




		<!-- /Edit Leave Modal -->

		<!-- Approve Leave Modal -->
		<div class="modal custom-modal fade" id="approve_leave" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<div class="form-header">
							<h3>Leave Approve</h3>
							<p>Are you sure want to approve for this leave?</p>
						</div>
						<div class="modal-btn delete-action">
							<div class="row">
								<div class="col-6">
									<a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
								</div>
								<div class="col-6">
									<a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Decline</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Approve Leave Modal -->

		<!-- Delete Leave Modal -->
		<div class="modal custom-modal fade" id="delete_approve" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<div class="form-header">
							<h3>Delete Leave</h3>
							<p>Are you sure want to delete this leave?</p>
						</div>
						<div class="modal-btn delete-action">
							<div class="row">
								<div class="col-6">
									<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
								</div>
								<div class="col-6">
									<a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Delete Leave Modal -->


	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->



<script>
	$(document).ready(function() {

		$("li > a[href='<?= base_url('leave_pending') ?>']").parent().parent().css("display", "block") //get sidebar item with link
		$("li > a[href='<?= base_url('leave_pending') ?>']").addClass("active"); // for items inside the sidebar


		$("a .dropdown-item.update-req").click(function(e) {
			var target_id = $(this).data("target-id");

			alert(target_id);
			console.log(target_id)

			// AJAX request to fetch employee details
			$.ajax({
				url: base_url + 'admin/showUserdetails',
				type: 'GET',
				dataType: 'json',
				data: {
					emp_id: emp_id
				},
				success: function(employee) {
					// Populate modal fields with employee data
					$('#edit_employee input[name="fname"]').val(employee.fname);
					$('#edit_employee input[name="mname"]').val(employee.mname);
					$('#edit_employee input[name="lname"]').val(employee.lname);
					$('#edit_employee input[name="nickn"]').val(employee.nickn);
					$('#edit_employee input[name="current_add"]').val(employee.current_add);
					$('#edit_employee input[name="perm_add"]').val(employee.perm_add);
					$('#edit_employee input[name="age"]').val(employee.age);
					$('#edit_employee input[name="religion"]').val(employee.religion);
					$('#edit_employee select[name="sex"]').val(employee.sex);
					$('#edit_employee select[name="civil_status"]').val(employee.civil_status);
					$('#edit_employee input[name="pob"]').val(employee.pob);
					$('#edit_employee input[name="dob"]').val(employee.dob);
					$('#edit_employee select[name="department"]').val(employee.department);
					$('#edit_employee input[name="role"]').val(employee.role);
					$('#edit_employee input[name="pfp"]').val(employee.pfp);
					$('#edit_employee input[name="email"]').val(employee.email);
					$('#edit_employee input[name="password"]').val(employee.password);

					// Show the modal
					$('#edit_employee').modal('show');
				},
				error: function(xhr, status, error) {
					console.error(error);
					// Handle error if necessary
				}
			});
		});
	})
</script>

</body>

<!-- Mirrored from smarthr.dreamstechnologies.com/html/template/leaves.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2024 04:02:18 GMT -->

</html>