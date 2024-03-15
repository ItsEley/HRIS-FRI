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
                        <h3 class="page-title">Departments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Departments</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Department</a>
                        <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <?php
                $query_departments = $this->db->get('department');

                // Check if query executed successfully
                if ($query_departments->num_rows() > 0) {
                    foreach ($query_departments->result() as $row_department) {
                ?>
                        <div class="col">
                            <div class="card dep-card-cont">

                                <div class="card-header bg-info bg-opacity-25">

                                    <div class="row">
                                        <div class="col overflow-ellipsis">
                                            <h4 class="card-title mb-0 overflow-ellipsis"><?= $row_department->department ?></h4>
                                        </div>
                                        <div class="col text-end">
                                            <div class="btn btn-square btn-success"><i class="fa-solid fa-plus"></i> Add roles</div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Salary</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="p-4">
                                                <?php
                                                $query_roles = $this->db->get_where('vw_emp_designation', array('department' => $row_department->department));

                                                // Check if query executed successfully
                                                if ($query_roles->num_rows() > 0) {
                                                    foreach ($query_roles->result() as $row_role) {
                                                        echo "<tr class= ''>";
                                                        echo "<td>$row_role->emp_id</td>";
                                                        echo "<td>$row_role->full_name</td>";
                                                        echo "<td>$row_role->roles</td>";
                                                        echo "<td>$row_role->salary" . "/" . $row_role->salary_type . " </td>";
                                                        echo "<td>...</td>";


                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='5' class ='text-center'>No roles specified</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // Handle no departments found
                    echo '<option value="">No departments found</option>';
                }
                ?>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">No Roles <span class="pill nav-pill bg-danger text-light" style="border-radius:4px"></span></h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Querying employees with null roles
                                        $query_null_roles = $this->db->where("roles = '' OR roles IS NULL")->get('vw_emp_designation');


                                        // Check if query executed successfully
                                        if ($query_null_roles->num_rows() > 0) {
                                            foreach ($query_null_roles->result() as $row_role) {
                                                echo "<tr>";
                                                echo "<td>$row_role->ins_id</td>";
                                                echo "<td>$row_role->fullname</td>";
                                                echo "<td>$row_role->department</td>";
                                                echo "<td>Assign</td>";

                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' class= 'text-center'>No employees with null roles found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!-- /Page Content -->




    </div>
    <!-- /Page Wrapper -->




</div>
<!-- /Main Wrapper -->


<!-- MODALS -->

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
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Employee Modal -->

<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="adddepartment">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="dept_name">
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




<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/departments') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/departments') ?>']").parent().parent().css("display", "block")




    })
</script>