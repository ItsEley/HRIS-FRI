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
                $query_departments = $this->db->query('
                SELECT 
                d.id AS department_id,
                d.department AS department,
                COUNT(dr.roles) AS role_count
            FROM 
                department d
            LEFT JOIN 
                department_roles dr ON d.id = dr.department
            GROUP BY 
                d.id, d.department
            ORDER BY 
                role_count DESC, department ASC;
            
                                ');

                // Check if query executed successfully
                if ($query_departments->num_rows() > 0) {
                    foreach ($query_departments->result() as $row_department) {
                ?>
                        <div class="col mb-2">
                            <div class="card dep-card-cont h-100">
                                <div class="card-header bg-info bg-opacity-25 p-2">
                                    <div class="row align-center">
                                        <div class="col text-ellipsis" style = "white-space: nowrap; overflow: hidden; text-overflow: ellipsis; ">
                                            <h4 class="card-title mb-0" title = "<?= $row_department->department ?>" style = "max-height:20px;"><?= $row_department->department ?></h4>
                                        </div>
                                        <div class="col text-end">
                                            <div class="btn btn-square btn-success addrole-btn" href="#" data-bs-toggle="modal" data-bs-target="#add_role" data-dept-id="<?= $row_department->department_id ?>">
                                                <i class="fa-solid fa-plus"></i> Add role
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">

                                            <?php
                                            $query_roles = $this->db->get_where('vw_emp_designation', array('department' => $row_department->department));

                                            // Check if query executed successfully
                                            if ($query_roles->num_rows() > 0) {

                                                echo '
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
                                                    ';

                                                foreach ($query_roles->result() as $row_role) {

                                                    if ($row_role->emp_id == null || $row_role->emp_id == 'null') {
                                                        $emp_id = 'Open';
                                                        $emp_name = 'Open';
                                                    } else {
                                                        $emp_id = $row_role->emp_id;
                                                        $emp_name = $row_role->full_name;
                                                    }



                                                    echo "<tr class= ''>";
                                                    echo "<td>$emp_id</td>";
                                                    echo "<td>$emp_name</td>";
                                                    echo "<td>$row_role->roles</td>";
                                                    echo "<td>$row_role->salary" . "/" . $row_role->salary_type . " </td>";
                                                    echo '<td>
                                                        <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="fa-solid fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="fa-solid fa-user m-r-5"></i> Assign</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve"><i class="fa-regular fa-trash-can m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                        </td>';


                                                    echo "</tr>";
                                                }

                                                echo '</tbody>';
                                            } else {
                                                // echo "<tr><td colspan='5' class ='text-center'>No roles specified</td></tr>";
                                                echo "<p class ='text-center m-auto'>No roles specified</p>";
                                            }
                                            ?>

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
                    <div class="card" id = "emp_no_roles">
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

<!--Add Role Modal -->
<div id="add_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalTitle">Add Role (ID: <span id="modalDeptId"></span>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addroles_dept" method="post">
                    <input type="text" id="departmentId" name="department_id" value="modalDeptId">
                    <div class="mb-3">
                        <label class="form-label">Role<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="role_name" placeholder="Enter role name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Salary<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="salary" placeholder="Enter salary" inputmode="numeric">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Salary Type<span class="text-danger">*</span></label>
                                <select class="form-select" name="salary_type">
                                    <option value="" selected disabled>Select Salary Type</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="hourly">Hourly</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
    $(document).ready(function() {
        $('.addrole-btn').click(function() {
            var deptId = $(this).data('dept-id');
            $('#modalDeptId').text(deptId);
            $('#departmentId').val(deptId);
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/departments') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/departments') ?>']").parent().parent().css("display", "block")



        $(".addrole-btn").on('click', function() {

            console.log($(this).data('dept-id'));

        })



    })
</script>