<style>
    .button-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* Adjust the number of columns as needed */
        grid-gap: 10px;
    }

    .button-grid button {
        width: 100%;
        /* Set the width of each button to 100% */
    }
</style>



<!-- Main Wrapper -->
<div class="main-wrapper">
    <?php
    // $_SESSION[]

    $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /Page Header -->


            <div class="row"> <!-- main metrics -->
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon_type'] = "2";
                    // $data['icon'] = "fa-solid fa-user";
                    $data['img_name'] = 'absent-2.png';
                    $data['size'] = "40px";

                    $data['count'] = rand(0, 200);
                    $data['label'] = "Absent this year";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>


                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon_type'] = "1";

                    $data['icon'] = "fa fa-address-book";
                    $data['count'] = rand(0, 200);
                    $data['label'] = "Remaining Leaves";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>


                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php
                    $data['icon_type'] = "2";

                    $data['img_name'] = "overtime-2.png";
                    $data['size'] = "40px";

                    $data['count'] = rand(0, 200);
                    $data['label'] = "Overtime";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php

                    $data['icon_type'] = "2";
                    $data['img_name'] = "undertime.png";
                    $data['size'] = "47px";
                    $data['count'] = rand(0, 200);
                    $data['label'] = "Undertime";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
            </div>

            <div class="card mb-0">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title mb-0">Attendance Report - {Month}</h4>
                            </div>
                            <div class="col-auto">
                                <div class="col-auto float-end ms-auto">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-print"></i> Print</button>
                                    <div class="view-icons">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="att_report" class="datatable table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Time in</th>
                                        <th class="text-center">Time out</th>
                                        <th class="text-center">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<?php $this->load->view('components\modal-announcement-details.php'); ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('employee/reports/attendance') ?>']").addClass("active");
        $("li > a[href='<?= base_url('employee/reports/attendance') ?>']").parent().parent().css("display", "block")

        $("#att_report").DataTable();






    })
</script>