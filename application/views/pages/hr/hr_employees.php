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
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a>
                        <div class="view-icons">
                            <a href="<?= base_url('hr/employees') ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="<?= base_url('hr/employees-list') ?>" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
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
                            //get select-options
                            $query =  $this->db->get('department');
                            $data['query'] = $query;
                            $this->load->view('components/select-options', $data);
                            ?>
                        </select>

                        <label class="focus-label">Department</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="input-block mb-3 form-focus select-focus">
                        <select class="select floating form-select form-control">


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
                //display employee cards
                $query = $this->db->query("
                SELECT 
                e.employee_id,
                e.id AS employee_id,
                CONCAT(e.fname, ' ', e.mname, ' ', e.lname) AS full_name,
                e.pfp,
                e.department AS department_id,
                d.department AS department,
                e.role AS role_id,
                dr.roles AS role
            FROM 
                employee e
            JOIN 
                department d ON e.department = d.id
            JOIN 
                department_roles dr ON e.role = dr.id;
            
                    ");

                foreach ($query->result() as $row) {

                    $data['emp_name'] = $row->full_name;
                    $data['emp_id'] = $row->employee_id;

                    if ($row->department == '' || $row->department == NULL) {
                        $data['department'] = "Not assigned to a deparment.";
                    } else {
                        $data['department'] = $row->department;
                    }

                    if ($row->role == '' || $row->role == NULL) {
                        $data['role'] = "Not assigned to any roles.";
                    } else {
                        $data['role'] = $row->role;
                    }

                    if ($row->pfp == '' || $row->pfp == NULL) {
                        $data['pfp'] = base_url('assets\img\user.jpg');
                    } else {

                        $data['pfp'] = "data:image/jpeg;base64," . base64_encode($row->pfp) . "";
                    }





                    $this->load->view('components/card-employee-basic', $data);
                }



                ?>



            </div>


            <a href="<?php echo base_url('hr/departments#emp_no_roles') ?>">Click here to view employees without designated roles.</a>

        </div>
        <!-- /Page Content -->



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
                        <form id="edit_employee" enctype="multipart/form-data" method="post">
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
                                        <input class="form-control input-mask" type="text" name="contact_no">

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
                                        <select class="form-select form-control" name="department">

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
                                        <label class="col-form-label">Role <span class="text-danger">*</span></label>
                                        <select class="form-select form-control" name="role" id="add_emp_role">
                                            <option value="">Add role</option>
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
        <!-- /Add Employee Modal -->

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
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="confirmFirstDeleteBtn">Delete</a>
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

        <!-- Second Confirmation Modal -->
        <div class="modal custom-modal fade" id="confirm_delete" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Confirmation</h3>
                            <p>Are you really sure?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" class="btn btn-primary continue-btn" id="confirmFinalDeleteBtn">Yes, Delete</a>
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





        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('captureButton');
        const retakeButton = document.getElementById('retakeButton');
        const employeeForm = document.getElementById('add_employee');
        const cameraSection = document.getElementById('cameraSection');
        const capturedImageContainer = document.getElementById('capturedImageContainer');
        const capturedImage = document.getElementById('capturedImage');
        let mediaStream; // Variable to store the media stream

        // Access the device camera and stream to video element
        async function initCamera() {
            try {
                mediaStream = await navigator.mediaDevices.getUserMedia({
                    video: true
                });
                video.srcObject = mediaStream;
                video.addEventListener('loadedmetadata', () => {
                    const aspectRatio = 1; // Desired aspect ratio (1x1)
                    // const videoWidth = video.videoWidth;
                    // const videoHeight = video.videoHeight;
                    const videoWidth = 400;
                    const videoHeight = 400;
                    let newWidth, newHeight;

                    if (videoWidth / videoHeight > aspectRatio) {
                        newWidth = videoHeight * aspectRatio;
                        newHeight = videoHeight;
                    } else {
                        newWidth = videoWidth;
                        newHeight = videoWidth / aspectRatio;
                    }

                    // Set video element dimensions to maintain 1x1 aspect ratio
                    video.width = newWidth;
                    video.height = newHeight;
                });
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

            // Crop the image to 1x1 with focus on the center
            const ctx = canvas.getContext('2d');
            const img = new Image();
            img.onload = function() {
                const aspectRatio = 1; // Aspect ratio for square image
                const size = Math.min(img.width, img.height);
                const x = (img.width - size) / 2;
                const y = (img.height - size) / 2;
                canvas.width = size;
                canvas.height = size;
                ctx.drawImage(img, x, y, size, size, 0, 0, size, size);

                // Display cropped image
                capturedImage.src = canvas.toDataURL('image/png');
                video.style.display = 'none'; // Hide video element
                capturedImageContainer.style.display = 'block'; // Show captured image container
                retakeButton.style.display = 'inline-block';
                captureButton.style.display = 'none';
                stopCamera(); // Stop the camera when hiding the section
            };
            img.src = imgUrl;

        });

        // Retake photo
        retakeButton.addEventListener('click', function() {
            retakeButton.style.display = 'none';
            captureButton.style.display = 'inline-block';
            capturedImageContainer.style.display = 'none';
            video.style.display = 'block';
            initCamera();
        });

        // Submit basic info form
        employeeForm.addEventListener('submit', function(event) {
            event.preventDefault();
            showCameraSection();
        });

        // Initialize the camera when the modal is shown
        $('#exampleModalToggle2').on('shown.bs.modal', function() {
            initCamera();
            showCameraSection();
        });

        // Reset camera when the modal is closed
        $('#exampleModalToggle2').on('hidden.bs.modal', function() {
            hideCameraSection();
        });


        $('.input-mask[name="contact_no"]').inputmask({
            mask: '0999-999-9999',
            placeholder: 'X'
        });




    }) //DOMContentLoaded end 
</script>