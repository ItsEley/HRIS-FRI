<div class="main-wrapper">
	<?php $this->load->view('templates/nav_bar'); ?>
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
						<h3 class="page-title">Profile</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
							<li class="breadcrumb-item active">Profile</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
			<?php
			$query = $this->db->query("SELECT * FROM employee WHERE id = '" . $_SESSION['emp_id'] . "'");
			foreach ($query->result() as $row) {

				$fname = $row->fname;
				$mname = $row->mname;
				$lname = $row->lname;

				$fullname = $row->fname . ' ' . $row->mname . ' ' . $row->lname;
				$pfp = $row->pfp;
				$emp_id = $row->id;
				$dob = $row->dob;
				$email = $row->email;
				$current_add = $row->current_add;
				$sex = $row->sex;
			}
			?>

			<div class="card mb-0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<div class="profile-view">
								<div class="profile-img-wrap">
									<div class="profile-img">
										<a href="#">
										<img src="data:image/jpeg;base64,<?= base64_encode($pfp) ?>" alt="" style="object-fit: cover; aspect-ratio: 1; height: auto;">


										</a>
									</div>

								</div>
								<?php
			$query = $this->db->query("SELECT * FROM vw_emp_designation WHERE emp_id = '" . $_SESSION['emp_id'] . "'");
			foreach ($query->result() as $row) {

				$department = $row->department;
				$role = $row->roles;
		


			}
			?>
								<div class="profile-basic">
									<div class="row">
										<div class="col-md-5">
											<div class="profile-info-left">

												<h3 class=" m-t-0 mb-0" style = "padding:8px;"><?php echo $fullname; ?></h3>


												<ul class="personal-info" style="margin-left:20px; margin-top:5px;">

													<li>
														<div class="title">Employee ID : </div>
														<div class="text"><?php echo $emp_id; ?></div>
													</li>

			
													<li>
														<div class="title">Department : </div>
														<div class="text"><?php echo $department; ?></div>
													</li>
													<li>
														<div class="title">Role(s) : </div>
														<div class="text"><?php echo $role; ?></div>
													</li>
												</ul>

												<!-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> -->
											</div>
										</div>
										<div class="col-md-7">
											<ul class="personal-info" style="margin-top:5px;">
												<li>
													<div class="title">Phone:</div>
													<div class="text"><a href="#"></a></div>
												</li>
												<li>
													<div class="title">Email:</div>
													<div class="text"><a href="#"><span class="__cf_email__" data-cfemail="13797c7b7d777c7653766b727e637f763d707c7e"><?php echo $email; ?></span></a></div>
												</li>
												<li>
													<div class="title">Birthday:</div>
													<div class="text"><?php echo formatDateOnly($dob); ?></div>
												</li>
												<li>
													<div class="title">Address:</div>
													<div class="text"><?php echo $current_add; ?></div>
												</li>
												<li>
													<div class="title">Sex:</div>
													<div class="text"><?php
																		if (strtolower($sex) == 'm') {
																			echo 'Male';
																		} else if (strtolower($sex) == 'f') {
																			echo 'Female';
																		} else if ($sex == '' || $sex == null) {
																			echo 'N/A';
																		} else {
																			echo $sex;
																		}
																		?></div>
												</li>

											</ul>
										</div>
									</div>
								</div>
								<div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#"><i class="fa-solid fa-pencil"></i></a></div>
							</div>
						</div>
					</div>

					<div class="row user-tabs">
						<div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
							<ul class="nav nav-tabs nav-tabs-bottom" style="border:none;">
								<li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>

								<li class="nav-item"><a href="#emp_assets" data-bs-toggle="tab" class="nav-link">Assets</a></li>
							</ul>
						</div>
					</div>


				</div>
			</div>



			<div class="tab-content">

				<!-- Profile Info Tab -->
				<div id="emp_profile" class="pro-overview tab-pane fade show active">
					<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card profile-box flex-fill">
								<div class="card-body">
									<h3 class="card-title">Personal Information
										<a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#personal_info_modal">
											<i class="fa-solid fa-pencil"></i>
										</a>
									</h3>
									<ul class="personal-info">
								
										<li>
											<div class="title">Nationality</div>
											<div class="text">Indian</div>
										</li>
										
										<li>
											<div class="title">Religion</div>
											<div class="text">Christian</div>
										</li>
										<li>
											<div class="title">Marital status</div>
											<div class="text">Married</div>
										</li>
										<li>
											<div class="title">Employment of spouse</div>
											<div class="text">No</div>
										</li>
										<li>
											<div class="title">No. of children</div>
											<div class="text">2</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6 d-flex">
							<div class="card profile-box flex-fill">
								<div class="card-body">
									<h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#emergency_contact_modal"><i class="fa-solid fa-pencil"></i></a></h3>
									<h5 class="section-title">Primary</h5>
									<ul class="personal-info">
										<li>
											<div class="title">Name</div>
											<div class="text">John Doe</div>
										</li>
										<li>
											<div class="title">Relationship</div>
											<div class="text">Father</div>
										</li>
										<li>
											<div class="title">Phone </div>
											<div class="text">9876543210, 9876543210</div>
										</li>
									</ul>
									<hr>
									<h5 class="section-title">Secondary</h5>
									<ul class="personal-info">
										<li>
											<div class="title">Name</div>
											<div class="text">Karen Wills</div>
										</li>
										<li>
											<div class="title">Relationship</div>
											<div class="text">Brother</div>
										</li>
										<li>
											<div class="title">Phone </div>
											<div class="text">9876543210, 9876543210</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-6 d-flex">
							<div class="card profile-box flex-fill">
								<div class="card-body">
									<h3 class="card-title">Family Information<a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#family_info_modal"><i class="fa-solid fa-pencil"></i></a></h3>
									<div class="table-responsive">
										<table class="table table-nowrap">
											<thead>
												<tr>
													<th>Name</th>
													<th>Relationship</th>
													<th>Date of Birth</th>
													<th>Phone</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Leo</td>
													<td>Brother</td>
													<td>Feb 16th, 2019</td>
													<td>9876543210</td>
													<td class="text-end">
														<div class="dropdown dropdown-action">
															<a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
															<div class="dropdown-menu dropdown-menu-right">
																<a href="#" class="dropdown-item"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
																<a href="#" class="dropdown-item"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card profile-box flex-fill">
								<div class="card-body">
									<h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#education_info"><i class="fa-solid fa-pencil"></i></a></h3>
									<div class="experience-box">
										<ul class="experience-list">
											<li>
												<div class="experience-user">
													<div class="before-circle"></div>
												</div>
												<div class="experience-content">
													<div class="timeline-content">
														<a href="#/" class="name">International College of Arts and Science (UG)</a>
														<div>Bsc Computer Science</div>
														<span class="time">2000 - 2003</span>
													</div>
												</div>
											</li>
											<li>
												<div class="experience-user">
													<div class="before-circle"></div>
												</div>
												<div class="experience-content">
													<div class="timeline-content">
														<a href="#/" class="name">International College of Arts and Science (PG)</a>
														<div>Msc Computer Science</div>
														<span class="time">2000 - 2003</span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 d-flex">
							<div class="card profile-box flex-fill">
								<div class="card-body">
									<h3 class="card-title">Experience <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#experience_info"><i class="fa-solid fa-pencil"></i></a></h3>
									<div class="experience-box">
										<ul class="experience-list">
											<li>
												<div class="experience-user">
													<div class="before-circle"></div>
												</div>
												<div class="experience-content">
													<div class="timeline-content">
														<a href="#/" class="name">Web Designer at Zen Corporation</a>
														<span class="time">Jan 2013 - Present (5 years 2 months)</span>
													</div>
												</div>
											</li>
											<li>
												<div class="experience-user">
													<div class="before-circle"></div>
												</div>
												<div class="experience-content">
													<div class="timeline-content">
														<a href="#/" class="name">Web Designer at Ron-tech</a>
														<span class="time">Jan 2013 - Present (5 years 2 months)</span>
													</div>
												</div>
											</li>
											<li>
												<div class="experience-user">
													<div class="before-circle"></div>
												</div>
												<div class="experience-content">
													<div class="timeline-content">
														<a href="#/" class="name">Web Designer at Dalt Technology</a>
														<span class="time">Jan 2013 - Present (5 years 2 months)</span>
													</div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Profile Info Tab -->
				<!-- Assets -->
				<div class="tab-pane fade" id="emp_assets">
					<div class="table-responsive table-newdatatable">
						<table class="table table-new custom-table mb-0 datatable">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Asset ID</th>
									<th>Assigned Date</th>
									<th>Assignee</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>
										<a href="assets-details.html" class="table-imgname">
											<img src="assets/img/laptop.png" class="me-2" alt="Laptop Image">
											<span>Laptop</span>
										</a>
									</td>
									<td>AST - 001</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="javascript:void(0);" class="table-profileimage">
											<img src="assets/img/profiles/avatar-02.jpg" class="me-2" alt="User Image">
										</a>
										<a href="javascript:void(0);" class="table-name">
											<span>John Paul Raj</span>
											<p><span class="__cf_email__" data-cfemail="f49e9b9c9ab4908691959993818d878091979cda979b99">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>
										<a href="assets-details.html" class="table-imgname">
											<img src="assets/img/laptop.png" class="me-2" alt="Laptop Image">
											<span>Laptop</span>
										</a>
									</td>
									<td>AST - 002</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="javascript:void(0);" class="table-profileimage" data-bs-toggle="modal" data-bs-target="#edit-asset">
											<img src="assets/img/profiles/avatar-05.jpg" class="me-2" alt="User Image">
										</a>
										<a href="javascript:void(0);" class="table-name">
											<span>Vinod Selvaraj</span>
											<p><span class="__cf_email__" data-cfemail="3e485750515a104d7e5a4c5b5f53594b474d4a5b5d56105d5153">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td>
										<a href="assets-details.html" class="table-imgname">
											<img src="assets/img/keyboard.png" class="me-2" alt="Keyboard Image">
											<span>Dell Keyboard</span>
										</a>
									</td>
									<td>AST - 003</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="javascript:void(0);" class="table-profileimage" data-bs-toggle="modal" data-bs-target="#edit-asset">
											<img src="assets/img/profiles/avatar-03.jpg" class="me-2" alt="User Image">
										</a>
										<a href="javascript:void(0);" class="table-name">
											<span>Harika </span>
											<p><span class="__cf_email__" data-cfemail="fb939a8992909ad58dbb9f899e9a969c8e82888f9e9893d5989496">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>4</td>
									<td>
										<a href="#" class="table-imgname">
											<img src="assets/img/mouse.png" class="me-2" alt="Mouse Image">
											<span>Logitech Mouse</span>
										</a>
									</td>
									<td>AST - 0024</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="assets-details.html" class="table-profileimage">
											<img src="assets/img/profiles/avatar-02.jpg" class="me-2" alt="User Image">
										</a>
										<a href="assets-details.html" class="table-name">
											<span>Mythili</span>
											<p><span class="__cf_email__" data-cfemail="f39e8a879b9a9f9ab3978196929e94868a808796909bdd909c9e">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>5</td>
									<td>
										<a href="#" class="table-imgname">
											<img src="assets/img/laptop.png" class="me-2" alt="Laptop Image">
											<span>Laptop</span>
										</a>
									</td>
									<td>AST - 005</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="assets-details.html" class="table-profileimage">
											<img src="assets/img/profiles/avatar-02.jpg" class="me-2" alt="User Image">
										</a>
										<a href="assets-details.html" class="table-name">
											<span>John Paul Raj</span>
											<p><span class="__cf_email__" data-cfemail="ddb7b2b5b39db9afb8bcb0baa8a4aea9b8beb5f3beb2b0">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
								<tr>
									<td>6</td>
									<td>
										<a href="#" class="table-imgname">
											<img src="assets/img/laptop.png" class="me-2" alt="Laptop Image">
											<span>Laptop</span>
										</a>
									</td>
									<td>AST - 006</td>
									<td>22 Nov, 2022 10:32AM</td>
									<td class="table-namesplit">
										<a href="javascript:void(0);" class="table-profileimage">
											<img src="assets/img/profiles/avatar-05.jpg" class="me-2" alt="User Image">
										</a>
										<a href="javascript:void(0);" class="table-name">
											<span>Vinod Selvaraj</span>
											<p><span class="__cf_email__" data-cfemail="06706f686962287546627463676b61737f757263656e2865696b">[email&#160;protected]</span></p>
										</a>
									</td>
									<td>
										<div class="table-actions d-flex">
											<a class="delete-table me-2" href="user-asset-details.html">
												<img src="assets/img/icons/eye.svg" alt="Eye Icon">
											</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /Assets -->

			</div>
		</div>
		<!-- /Page Content -->

		<!-- Profile Modal -->
		<div id="profile_info" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Profile Information</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="edituser" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-img-wrap edit-img">


										<div class="fileupload btn">
											<span class="btn-text">Edit</span>
											<input id="uploadInput" class="upload" name="pfp" type="file" accept="image/*" onchange="previewFile()">

										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">First Name</label>
												<input type="text" class="form-control" value="<?php echo $fname ?>" name="fname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Middle Name</label>
												<input type="text" class="form-control" value="<?php echo $mname ?>" name="mname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Last Name</label>
												<input type="text" class="form-control" value="<?php echo $lname ?>" name="lname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Birth Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text" value="<?php echo $dob ?>" name="dob">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Sex</label>
												<select class="select form-control" name="sex">
													<option value="M" <?php if ($sex === "M") echo "selected"; ?>>Male</option>
													<option value="F" <?php if ($sex === "F") echo "selected"; ?>>Female</option>
												</select>

											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Phone Number</label>
												<input class="form-control" type="number" name="contact_no" value="<?php echo $contact_no ?>">

											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Current Addressz</label>
										<input type="text" class="form-control" name="current_add" value="<?php echo $current_add ?>">
									</div>
								</div>
								<div class="col-md-12">
									<div class="input-block mb-3">
										<label class="col-form-label">Permanent Address</label>
										<input type="text" class="form-control" name="perm_add" value="<?php echo $perm_add ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Role</label>
										<input type="text" class="form-control" name="role" value="<?php //echo $role 
																									?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Department</label>
										<select class="form-control" name="department">
										<?php
                            //get select-options
                            $this->db->order_by('department', 'ASC');
                            $query =  $this->db->get('department');
                            $data['query'] = $query;
                            $this->load->view('components/select-options', $data);
                            ?>
										</select>

									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Email</label>
										<input type="email" class="form-control" name="email" value="<?php echo $email ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Password <span class="text-danger">*</span></label>


										<input type="password" id="password" class="form-control" name="password" value="<?php echo $password ?>">


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
		<!-- /Profile Modal -->

		<!-- Personal Info Modal -->
		<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Personal Information</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="row">
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Passport No</label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Passport Expiry Date</label>
										<div class="cal-icon">
											<input class="form-control datetimepicker" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Tel</label>
										<input class="form-control" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Nationality <span class="text-danger">*</span></label>
										<input class="form-control" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Religion</label>
										<div class="cal-icon">
											<input class="form-control" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Marital status <span class="text-danger">*</span></label>
										<select class="select form-control">
											<option>-</option>
											<option>Single</option>
											<option>Married</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">Employment of spouse</label>
										<input class="form-control" type="text">
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-block mb-3">
										<label class="col-form-label">No. of children </label>
										<input class="form-control" type="text">
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Personal Info Modal -->

		<!-- Family Info Modal -->
		<div id="family_info_modal" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"> Family Informations</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-scroll">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Relationship <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Date of birth <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Phone <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Name <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Relationship <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Date of birth <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3">
													<label class="col-form-label">Phone <span class="text-danger">*</span></label>
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="add-more">
											<a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add More</a>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Family Info Modal -->

		<!-- Emergency Contact Modal -->
		<div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Personal Information</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="card">
								<div class="card-body">
									<h3 class="card-title">Primary Contact</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Relationship <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Phone <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Phone 2</label>
												<input class="form-control" type="text">
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-body">
									<h3 class="card-title">Primary Contact</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Relationship <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Phone <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-block mb-3">
												<label class="col-form-label">Phone 2</label>
												<input class="form-control" type="text">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Emergency Contact Modal -->

		<!-- Education Modal -->
		<div id="education_info" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"> Education Informations</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-scroll">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Oxford University" class="form-control floating">
													<label class="focus-label">Institution</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Computer Science" class="form-control floating">
													<label class="focus-label">Subject</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<div class="cal-icon">
														<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
													</div>
													<label class="focus-label">Starting Date</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<div class="cal-icon">
														<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
													</div>
													<label class="focus-label">Complete Date</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="BE Computer Science" class="form-control floating">
													<label class="focus-label">Degree</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Grade A" class="form-control floating">
													<label class="focus-label">Grade</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Oxford University" class="form-control floating">
													<label class="focus-label">Institution</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Computer Science" class="form-control floating">
													<label class="focus-label">Subject</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<div class="cal-icon">
														<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
													</div>
													<label class="focus-label">Starting Date</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<div class="cal-icon">
														<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
													</div>
													<label class="focus-label">Complete Date</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="BE Computer Science" class="form-control floating">
													<label class="focus-label">Degree</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus focused">
													<input type="text" value="Grade A" class="form-control floating">
													<label class="focus-label">Grade</label>
												</div>
											</div>
										</div>
										<div class="add-more">
											<a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add More</a>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Education Modal -->

		<!-- Experience Modal -->
		<div id="experience_info" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Experience Informations</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-scroll">
								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="Digital Devlopment Inc">
													<label class="focus-label">Company Name</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="United States">
													<label class="focus-label">Location</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="Web Developer">
													<label class="focus-label">Job Position</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<div class="cal-icon">
														<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
													</div>
													<label class="focus-label">Period From</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<div class="cal-icon">
														<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
													</div>
													<label class="focus-label">Period To</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="card">
									<div class="card-body">
										<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="fa-regular fa-trash-can"></i></a></h3>
										<div class="row">
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="Digital Devlopment Inc">
													<label class="focus-label">Company Name</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="United States">
													<label class="focus-label">Location</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<input type="text" class="form-control floating" value="Web Developer">
													<label class="focus-label">Job Position</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<div class="cal-icon">
														<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
													</div>
													<label class="focus-label">Period From</label>
												</div>
											</div>
											<div class="col-md-6">
												<div class="input-block mb-3 form-focus">
													<div class="cal-icon">
														<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
													</div>
													<label class="focus-label">Period To</label>
												</div>
											</div>
										</div>
										<div class="add-more">
											<a href="javascript:void(0);"><i class="fa-solid fa-plus-circle"></i> Add More</a>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Experience Modal -->

	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->