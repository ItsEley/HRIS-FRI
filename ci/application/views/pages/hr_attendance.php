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
    <div class="page-wrapper" style = "width:-webkit-fill-available">

        <!-- Page Content -->
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">

                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus">
                        <input type="text" class="form-control floating">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="form-select form-control" >
                            <option value="">All</option>

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

                        <label class="focus-label">Department</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating form-select form-control">

                            <option>All</option>
                            <option>Web Developer</option>
                            <option>Web Designer</option>
                            <option>Android Developer</option>
                            <option>Ios Developer</option>
                        </select>
                        <label class="focus-label">Role</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="d-grid">
                        <a href="#" class="btn btn-success w-100"> Search </a>
                    </div>
                </div>
            </div>
            <!-- Search Filter -->

       <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table table-nowrap mb-0">
									<thead>
										<tr>
											<th>Employee</th>
											<th>1</th>
											<th>2</th>
											<th>3</th>
											<th>4</th>
											<th>5</th>
											<th>6</th>
											<th>7</th>
											<th>8</th>
											<th>9</th>
											<th>10</th>
											<th>11</th>
											<th>12</th>
											<th>13</th>
											<th>14</th>
											<th>15</th>
											<th>16</th>
											<th>17</th>
											<th>18</th>
											<th>19</th>
											<th>20</th>
											<th>22</th>
											<th>23</th>
											<th>24</th>
											<th>25</th>
											<th>26</th>
											<th>27</th>
											<th>28</th>
											<th>29</th>
											<th>30</th>
											<th>31</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a class="avatar avatar-xs" href="profile.html"><img src="assets/img/profiles/avatar-09.jpg" alt="User Image"></a>
													<a href="profile.html">John Doe</a>
												</h2>
											</td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td>
												<div class="half-day">
													<span class="first-off"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></span> 
													<span class="first-off"><i class="fa fa-close text-danger"></i></span>
												</div>
											</td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td>
												<div class="half-day">
													<span class="first-off"><i class="fa fa-close text-danger"></i></span> 
													<span class="first-off"><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></span>
												</div>
											</td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><i class="fa fa-close text-danger"></i> </td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
											<td><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#attendance_info"><i class="fa-solid fa-check text-success"></i></a></td>
										</tr>
										
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
        </div>
        <!-- /Page Content -->



        <!-- MODALS -->

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="adduser">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="fname">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Middle Name</label>
                                        <input class="form-control" type="text" name="mname">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="lname">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Nickname <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="nickn">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Current Address</label>
                                        <input class="form-control" type="text" name="current_add">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Permanent Address</label>
                                        <input class="form-control" type="text" name="perm_add">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Date Of Birth <span class="text-danger">*</span></label>
                                        <div class="cal-icon"><input class="form-control" type="date"></div>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Age <span class="text-danger">*</span></label>
                                        <input class="form-control" type="int" name="age">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Religion </label>
                                        <input class="form-control" type="text" name="religion">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Sex</label>
                                        <select class="select" type="text" name="sex">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Civil Status </label>
                                        <select class="select" type="text" name="civil_status">
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="3">Live In</option>
                                            <option value="4">Widowed</option>
                                            <option value="5">Jowa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Place of Birth <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="pob">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="role">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Profile Image <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="pfp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->

        <!-- Delete Employee Modal -->
        <div class="modal custom-modal fade" id="delete_employee" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Employee</h3>
                            <p>Are you sure want to delete?</p>
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
        <!-- /Delete Employee Modal -->



    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->



		<!-- Attendance Modal -->
        <div class="modal custom-modal fade" id="attendance_info" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Attendance Info</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
												<div class="punch-det">
													<h6>Punch In at</h6>
													<p>Wed, 11th Mar 2019 10.00 AM</p>
												</div>
												<div class="punch-info">
													<div class="punch-hours">
														<span>3.45 hrs</span>
													</div>
												</div>
												<div class="punch-det">
													<h6>Punch Out at</h6>
													<p>Wed, 20th Feb 2019 9.00 PM</p>
												</div>
												<div class="statistics">
													<div class="row">
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Break</p>
																<h6>1.21 hrs</h6>
															</div>
														</div>
														<div class="col-md-6 col-6 text-center">
															<div class="stats-box">
																<p>Overtime</p>
																<h6>3 hrs</h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card recent-activity">
											<div class="card-body">
												<h5 class="card-title">Activity</h5>
												<ul class="res-activity-list">
													<li>
														<p class="mb-0">Punch In at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															10.00 AM.
														</p>
													</li>
													<li>
														<p class="mb-0">Punch Out at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															11.00 AM.
														</p>
													</li>
													<li>
														<p class="mb-0">Punch In at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															11.15 AM.
														</p>
													</li>
													<li>
														<p class="mb-0">Punch Out at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															1.30 PM.
														</p>
													</li>
													<li>
														<p class="mb-0">Punch In at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															2.00 PM.
														</p>
													</li>
													<li>
														<p class="mb-0">Punch Out at</p>
														<p class="res-activity-time">
															<i class="fa-regular fa-clock"></i>
															7.30 PM.
														</p>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Attendance Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/attendance') ?>']").parent().parent().css("display", "block") //get sidebar item with link
        $("li > a[href='<?= base_url('hr/attendance') ?>']").addClass("active"); // for items inside the sidebar








    })
</script>