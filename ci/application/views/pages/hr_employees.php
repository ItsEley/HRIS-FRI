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
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee</li>
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
                        <select class="form-select form-control">
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

            <div class="row staff-grid-row">

                <?php

                $query = $this->db->get('employees');

                // print_r($this->session->get_userdata('fname'));
                // echo $_SESSION['fname'];

                foreach ($query->result() as $row) {
                    $emp_id =  $row->id;

                    $fname = ucwords(strtolower($row->fname));
                    $lname = ucwords(strtolower($row->lname));
                    $mname = $row->mname;
                    $fullname = $fname . " " . $lname;
                    $sex = $row->sex;


                    $data['emp_name'] = $fullname;
                    $data['emp_id'] = $emp_id;
                    $data['pfp'] = $row->pfp;


                    $this->load->view('components/card-employee-basic', $data);
                }



                ?>

                <!-- Edit Employee Modal -->
                <div id="edit_employee" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Employee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('edituser') ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                                <input class="form-control" value="" type="text" name="fname">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Middle Name</label>
                                                <input class="form-control" value="" type="text" name="mname">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control" value="" type="text" name="lname">

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
                                                <div class="cal-icon"><input class="form-control" name="dob" type="date"></div>

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
                                                <select class="select form-control" name="sex">
                                                    <option value="M" <?php if ($sex === "M") echo "selected"; ?>>Male</option>
                                                    <option value="F" <?php if ($sex === "F") echo "selected"; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Civil Status </label>
                                                <select class="select form-control" name="civil_status">
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

                                                <select class="form-control" name="">
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
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-block mb-3">
                                                <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="role">
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
                                        <button type="sbmit" class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Edit Employee Modal -->




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
                                        <input class="form-control" type="number" name="age">
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
                                        <select class="form-select form-control" name="sex">
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Civil Status </label>
                                        <select class="form-select form-control" name="civil_status">

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
                                        <select class="form-select form-control">
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/employees') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees') ?>']").parent().parent().css("display", "block")




        $(".dropdown-item.edit-employee").click(function(e) {

            console.log($(this).data("emp-id"));

            var emp_id = $(this).data("emp-id");

            // $.ajax({
            // 	url: base_url + 'upload/do_upload',
            // 	type:"post",
            // 	data:new FormData(this),
            // 	processData:false,
            // 	contentType:false,
            // 	cache:false,
            // 	async:false,
            // 	beforeSend: function() {
            // 		$("#update_img").html("Updating... <span class='fa fa-spinner fa-1x fa-spin'></span>");
            // 	},
            // 	success: function(data) {
            // 		swal(
            //     {
            //         title: 'Successfuly Update!',	                    
            //         type: 'success',	                    
            //         confirmButtonClass: 'btn btn-success',	                    
            //     }
            // );
            // 		$("#update_img").attr("disabled", false).html("Update Image");
            // 		$("#carousel").modal('hide');
            // 		$("#imgfrm")[0].reset();
            // 		show_car_con();
            // 	}
            // })
        });




    })
</script>