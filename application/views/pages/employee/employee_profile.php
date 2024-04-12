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
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($this->session->userdata('pfp')); ?>" alt="User Image">
                                        </a>
                                    </div>


                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <input type="hidden" id="fname" name="fname">
                                                <input type="hidden" id="mname" name="mname">
                                                <input type="hidden" id="lname" name="lname">
                                                <input type="hidden" id="contact_no" name="contact_no">
                                                <input type="hidden" id="department" name="department">
                                                <input type="hidden" id="role" name="role">
                                                <input type="hidden" id="id" name="id">
                                                <input type="hidden" id="email" name="email">
                                                <input type="hidden" id="dob" name="dob">
                                                <input type="hidden" id="current_add" name="current_add">
                                                <input type="hidden" id="perm_add" name="perm_add">
                                                <input type="hidden" id="sex" name="sex">


                                                <h3 class="user-name m-t-0 mb-0"></h3>
                                                <h6 class="text-muted"></h6>
                                                <small class="text-muted"></small>
                                                <div class="staff-id">Employee ID: <?php echo $_SESSION['id']; ?></div>
                                                <div class="staff-id">Employee ID: <?php echo $_SESSION['id2']; ?></div>
                                                <div class="staff-fullname">Full Name: <?php echo $_SESSION['fullname']; ?></div>
                                                <div class="staff-role">Role: <?php echo $_SESSION['role']; ?></div>
                                                <div class="staff-department">Department: <?php echo $_SESSION['department']; ?></div>
                                                <div class="staff-acro">Acronym: <?php echo $_SESSION['acro']; ?></div>



                                                <!-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="#"></a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="#"><span class="__cf_email__"></span></a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text"></div>
                                                </li>
                                                <li>
                                                    <div class="title">Address:</div>
                                                    <div class="text"></div>
                                                </li>
                                                <li>
                                                    <div class="title">Sex:</div>
                                                    <div class="text"></div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#"><i class="fa-solid fa-pencil"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Personal Information <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#personal_info_modal"><i class="fa-solid fa-pencil"></i></a></h3>
                                <ul class="personal-info">

                                    <li>
                                        <div class="title">Tel</div>
                                        <div class="text"><a href="#">9876543210</a></div>
                                    </li>
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
                                <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#family_info_modal"><i class="fa-solid fa-pencil"></i></a></h3>
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
        </div>
        <!-- /Page Content -->

        <div class="row">
        <?php print_r($_SESSION)?>

        </div>

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

                                        <img id="previewImage" src="" alt="User Image">
                                        <div class="fileupload btn">
                                            <span class="btn-text">Edit</span>
                                            <input id="uploadInput" class="upload" name="pfp" type="file" accept="image/*" onchange="previewFile()">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">First Name</label>
                                                <input type="text" class="form-control" value="" name="fname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Middle Name</label>
                                                <input type="text" class="form-control" value="" name="mname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Last Name</label>
                                                <input type="text" class="form-control" value="" name="lname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control datetimepicker" type="text" value="" name="dob">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Sex</label>
                                                <select class="select form-control" name="sex">
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Phone Number</label>
                                                <input class="form-control" type="number" name="contact_no" value="">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Current Addressz</label>
                                        <input type="text" class="form-control" name="current_add" value="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Permanent Address</label>
                                        <input type="text" class="form-control" name="perm_add" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Role</label>
                                        <input type="text" class="form-control" name="role" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Department</label>
                                        <select class="form-control" name="department">
                                            <?php
                                            $query = $this->db->get('department');

                                            // Check if query executed successfully
                                            if ($query->num_rows() > 0) {
                                                foreach ($query->result() as $row) {
                                                    $depID = $row->id;
                                                    $department1 = $row->department;
                                                    $acro = $row->acro_dept;
                                                    $selected = ($depID == $selected_depID) ? "selected" : ""; // Check if this option is selected
                                                    // Output each department as an option
                                                    echo '<option value="' . $depID . '" ' . $selected . '>' .  $department1 . '</option>';
                                                }
                                            } else {
                                                // Handle no results from the database
                                                echo '<option value="">No departments found</option>';
                                            }
                                            ?>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" value="">
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