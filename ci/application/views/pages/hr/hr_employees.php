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

                $query = $this->db->query('
SELECT vw_emp_designation.*, employee.pfp 
FROM vw_emp_designation
JOIN employee 
ON vw_emp_designation.emp_id = employee.id
ORDER BY vw_emp_designation.dept_id ASC, vw_emp_designation.full_name
');
                // print_r($this->session->get_userdata('fname'));
                // echo $_SESSION['fname'];

                foreach ($query->result() as $row) {



                    $data['emp_name'] = $row->full_name;
                    $data['emp_id'] = $row->emp_id;
                    $data['department'] = $row->department;
                    $data['role'] = $row->roles;
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
                                <form id="edit_employee" method="post">
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

                                                            // Output each department as an option


                                                            echo '<option value="' . $row->id . '">' .  $row->department . '</option>';
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
                                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
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
                        <button type="button" class="btn btn-primary submit-btn" id="openSecondModalBtn">Image Capturing</button>
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
          <video id="video" autoplay></video><br>
          <button class="btn btn-secondary" id="captureButton">Capture</button>
          <button class="btn btn-danger" id="retakeButton" style="display: none;">Retake</button><br>
          <canvas style="display: none;" id="canvas"></canvas>
        </div>

        <!-- Captured Image Container -->
        <div id="capturedImageContainer" style="display: none;">
          <h5>Employee Picture</h5>
          <img id="capturedImage" style="max-width: 100%;" />
        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitSecondModalBtn">Submit</button>
                <button class="btn btn-secondary" data-bs-target="#add_employee" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // When the "Submit & Open Modal" button is clicked
    $('#submitAndOpenModalBtn').click(function() {
        // Submit the form
        $('#myForm').submit();
        
        // Show the modal
        $('#exampleModalToggle2').modal('show');
    });
});
</script>>


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

    
        });


        const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('captureButton');
    const retakeButton = document.getElementById('retakeButton');
    const employeeForm = document.getElementById('employeeForm');
    const cameraSection = document.getElementById('cameraSection');
    const capturedImageContainer = document.getElementById('capturedImageContainer');
    const capturedImage = document.getElementById('capturedImage');
    let mediaStream; // Variable to store the media stream

    // Access the device camera and stream to video element
    async function initCamera() {
        try {
            mediaStream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = mediaStream;
        } catch (err) {
            console.error('Error accessing camera:', err);
        }
    }

    // Stop the camera stream
    function stopCamera() {
        if (mediaStream) {
            const tracks = mediaStream.getTracks();
            tracks.forEach(track => {
                track.stop();
            });
        }
    }

    // Show camera section
    function showCameraSection() {
        cameraSection.style.display = 'block';
    }

    // Hide camera section
    function hideCameraSection() {
        cameraSection.style.display = 'none';
        stopCamera(); // Stop the camera when hiding the section
    }

    // Capture and display the photo
    captureButton.addEventListener('click', function() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imgUrl = canvas.toDataURL('image/png'); // Convert to data URL
        capturedImage.src = imgUrl;
        video.style.display = 'none'; // Hide video element
        capturedImageContainer.style.display = 'block'; // Show captured image container
        retakeButton.style.display = 'inline-block';
        captureButton.style.display = 'none';
        stopCamera(); // Stop the camera when hiding the section

    });

    // Retake photo
    retakeButton.addEventListener('click', function() {
        retakeButton.style.display = 'none';
        captureButton.style.display = 'inline-block';
        capturedImageContainer.style.display = 'none';
        video.style.display = 'block';
    });

    // Submit basic info form
    employeeForm.addEventListener('submit', function(event) {
        event.preventDefault();
        showCameraSection();
    });

    // Initialize the camera when the modal is shown
    $('#exampleModalToggle2').on('shown.bs.modal', function () {
        initCamera();
    });

    // Reset camera when the modal is closed
    $('#exampleModalToggle2').on('hidden.bs.modal', function () {
        hideCameraSection();
    });



    })
</script>