<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>


    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="<?= base_url('hr/employees') ?>" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                            <a href="<?= base_url('hr/employees-list') ?>" class="list-view btn btn-link active"><i class="fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <!-- data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_emp_list" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact No</th>
                                    <th>Role</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query('
                                SELECT employee.id,vw_emp_designation.full_name,employee.current_add,employee.contact_no,vw_emp_designation.roles
                                FROM vw_emp_designation
                                JOIN employee
                                ON employee.id = vw_emp_designation.emp_id
                                WHERE
                                    vw_emp_designation.emp_id IS NOT NULL
                                ORDER BY
                                    vw_emp_designation.emp_id ASC,
                                    vw_emp_designation.full_name;
                            
                                ');

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row">
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $row->id; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $row->full_name;; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $row->current_add;?></td>

                                        <td><?php echo $row->contact_no; ?></td>
                                        <td><?php echo $row->roles; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $row->emp_id; ?>">
                                                    <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $row->id; ?>">
                                                        <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $row->emp_id; ?>">
                                                        <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                    </a>
                                                </div> -->
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
            <!-- /data table -->

        </div>
        <!-- /Page Content -->

        <!-- Add Employee Modal -->
        <div id="add_employee" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Last Name</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Password</label>
                                        <input class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Confirm Password</label>
                                        <input class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Phone </label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Company</label>
                                        <select class="select">
                                            <option value="">Global Technologies</option>
                                            <option value="1">Delta Infotech</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select Department</option>
                                            <option>Web Development</option>
                                            <option>IT Management</option>
                                            <option>Marketing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Designation <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select Designation</option>
                                            <option>Web Designer</option>
                                            <option>Web Developer</option>
                                            <option>Android Developer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive m-t-15">
                                <table class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>Module Permission</th>
                                            <th class="text-center">Read</th>
                                            <th class="text-center">Write</th>
                                            <th class="text-center">Create</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Import</th>
                                            <th class="text-center">Export</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Holidays</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Leaves</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Clients</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Projects</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tasks</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chats</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Assets</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Timing Sheets</td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" checked>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <label class="custom_check">
                                                    <input type="checkbox" name="rememberme" class="rememberme">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->

        <!-- Edit Employee Modal -->


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
                        <form id="edit_employee2" enctype="multipart/form-data" method="post">
                            <input class="form-control" type="hidden" name="emp_id">
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
                                        <label class="col-form-label">Religion </label>
                                        <input class="form-control" type="text" name="religion">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Sex</label>
                                        <select class="select form-control" name="sex">
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                            <option value="B">Bakla</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Civil Status </label>
                                        <select class="select form-control" name="civil_status">
                                            <option value="N/A">N/A</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Live In">Live In</option>
                                            <option value="Widowed">Widowed</option>

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
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="input-block mb-3">
                                        <label class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="contact_no">
                                    </div>
                                </div>

                            </div>

                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Employee Modal -->

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
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/employees') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees') ?>']").parent().parent().css("display", "block")


        $('#dt_emp_list').DataTable({
            "paging": true, // Enable paging
            "ordering": true, // Enable sorting
            "info": true // Enable table information display
            // You can add more options as needed
        });



    });
</script>