<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_employee.php  */ -->




<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form accept-charset="UTF-8" method="post" id="adduser" enctype="multipart/form-data">


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
                                <label class="col-form-label">Nickname </label>
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
                                <label class="col-form-label">Date of Birth <span class="text-danger">*</span></label>
                                <div class="cal-icon"><input class="form-control" type="date"></div>

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
                                <label class="col-form-label">Religion </label>
                                <input class="form-control" type="text" name="religion">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Sex <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="sex">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Civil Status <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="civil_status">

                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Live In">Live In</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Contact No <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="contact">
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Department <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="department" id="department_select">
                                    <?php
                                    // Get select-options
                                    $this->db->order_by('department', 'ASC');
                                    $query = $this->db->get('department');
                                    if ($query->num_rows() > 0) {
                                        foreach ($query->result() as $row) {
                                            echo '<option value="' . $row->id . '">' . $row->department . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No departments found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                <select class="form-select form-control" name="role" id="role_select">
                                    <option value="">Select role</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6" hidden>
                            <div class="input-block mb-3">
                                <label class="col-form-label">Add role on <span id="add_selected_dep">{DEPARTMENT}</span><span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="contact">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <input type="file" name="capturedImage" id="capturedImageInput" style="display: none;">

                            </div>
                        </div>

                    </div>

                    <div class="submit-section">
                        <button type="button" class="btn btn-primary submit-btn" id="openSecondModalBtn">Next</button>
                    </div>

            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    $('#department_select').change(function() {
        var departmentId = $(this).val();
        console.log('Department selected: ', departmentId); // Check if departmentId is correct

        $.ajax({
            url: base_url + 'humanr/get_roles_by_department',
            type: 'POST',
            data: { department_id: departmentId },
            dataType: 'json',
            success: function(response) {
                console.log('AJAX response: ', response); // Check if response is correct
                var roleSelect = $('#role_select');
                roleSelect.empty(); // Clear previous options

                if (response.length > 0) {
                    $.each(response, function(index, role) {
                        roleSelect.append('<option value="' + role.id + '">' + role.role + '</option>');
                    });
                } else {
                    roleSelect.append('<option value="">No roles found</option>');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error: ', error); // Check for any AJAX errors
            }
        });
    });
});

</script>


<!-- modal img capture -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalToggleLabel2">Image Capturing</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">

                <div id="cameraSection" style="display: none;">
                    <h5>Employee Picture</h5>
                    <video id="video" autoplay width="400" height="400"></video><br>
                    <!-- Captured Image Container -->
                    <div id="capturedImageContainer" style="display: none;">
                        <h5>Employee Picture</h5>
                        <img id="capturedImage" name="image" width="400" height="400" />
                    </div>
                    <!--/// Captured Image Container -->

                    <input type="file" id="capt_img_file" name="capt_img_file">

                    <button class="btn btn-primary w-100" id="captureButton">Capture</button>
                    <button class="btn btn-danger w-100" id="retakeButton" style="display: none;">Retake</button><br>
                    <canvas style="display: none;" id="canvas"></canvas>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-target="#add_employee" data-bs-toggle="modal" data-bs-dismiss="modal">Return</button>
                <button class="btn btn-secondary" data-bs-target="#add_employee" data-bs-toggle="modal" data-bs-dismiss="modal">Skip</button>

                <button type="button" class="btn btn-primary" id="add_employee_submit">Submit</button>
            </div>
        </div>
    </div>
</div>