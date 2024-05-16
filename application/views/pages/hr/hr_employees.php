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
    <div class="page-wrapper">

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
                    <div class="col-auto float-end ms-auto d-flex flex-row-reverse ">
                        <!-- <a href="#" class="btn add-btn mx-1" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-upload"></i> Import CSV</a> -->


                        <label for="csvFileInput" style="border: 1px solid #ccc; display: inline-block; padding: 8px 16px; cursor: pointer;
                         background-color: #f9f9f9; color: #333; border-radius: 4px;" class="mx-1">
                            <i class="fa fa-cloud-upload"></i> Import Excel
                        </label>

                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a>


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
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = $this->db->query("
                                SELECT 
                                e.employee_id,
                                e.id ,
                                CONCAT(e.fname, ' ', e.mname, ' ', e.lname) AS full_name,
                                e.pfp,e.current_add,e.contact_no,
                                e.department AS department_id,
                                d.department AS department,
                                e.role AS role_id,
                                dr.roles AS role,
                                e.famco_id
                            FROM 
                                employee e
                            LEFT JOIN 
                                department d ON e.department = d.id
                            LEFT JOIN 
                                department_roles dr ON e.role = dr.id;
                            
                                ");

                                foreach ($query->result() as $row) {



                                ?>
                                    <tr class="hoverable-row">
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $row->famco_id; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $row->full_name;; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $row->current_add; ?></td>

                                        <td><?php echo $row->contact_no; ?></td>
                                        <td><?php echo $row->department; ?></td>

                                        <td><?php echo $row->role; ?></td>
                                        <td>
                                            <?php
                                            echo '<button type="button" class="a-shift modal-trigger btn btn-rounded btn-primary p-1 px-2 create-timesheet"
                     style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_dnr"
                      data-emp-id="' . $row->famco_id . '" data-emp-name = "'.$row->full_name.'">
                      <i class="fas fa-pencil m-r-5"></i>Edit Designation</button>';

                                            ?>
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


            <a href="<?php echo base_url('hr/departments/emp_no_roles') ?>">Click here to view employees without designated roles.</a>

        </div>
        <!-- /Page Content -->

        <form class="form-horizontal" id="import_csv" method="post" name="upload_excel" accept-charset="UTF-8" enctype="multipart/form-data">


            <input type="file" name="file" id="csvFileInput" class="input-large" style="display: none;">

            <div class="row">
                <div id="csv_preview" class="col-md-8 col-md-offset-2" hidden></div>
            </div>

            <!-- </fieldset> -->
            <div class="modal fade" id="excelColumnsModal" tabindex="-1" role="dialog" aria-labelledby="excelColumnsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document"> <!-- Added modal-xl class for large size -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="excelColumnsModalLabel">Excel File Columns</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="excelColumnsBody" style="overflow-x: auto;">
                            <!-- Excel file columns will be displayed here -->
                        </div>
                        <div class="modal-footer">
                            <!-- Move the Upload Excel button here -->
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form id="import_csv" method="post" name="upload_excel" accept-charset="UTF-8" enctype="multipart/form-data" style="display: inline;">
                                <div id="upload_btn" class="form-group" style="display: inline;">
                                    <button type="submit" id="submit_import" name="Import" class="btn btn-primary">
                                        <i class="fas fa-upload"></i> Upload Excel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!-- MODALS -->


        <?php $this->load->view('templates\modals\employee_edit.php'); ?>
        <?php $this->load->view('templates\modals\employee_add.php'); ?>
        <?php $this->load->view('templates\modals\employee_delete.php'); ?>



        <?php $this->load->view('templates\modals\employee_dnr_edit.php'); ?>













    </div>
    <!-- /Page Wrapper -->
</div>

<!-- /Main Wrapper -->



<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/employees') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees') ?>']").parent().parent().css("display", "block")

        previewFileCsv('csvFileInput', 'excelColumnsModal', 'excelColumnsBody');


        $('#dt_emp_list').DataTable({
            "paging": true, // Enable paging
            "ordering": true, // Enable sorting
            "info": true, // Enable table information display
            "pageLength": 100
            // You can add more options as needed
        });






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

                    video.style.transform = 'scaleX(-1)';
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