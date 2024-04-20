


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
                        <h3 class="page-title">Payslip</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Payslip</li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <!-- /Page Header -->

            <div class="card mb-0">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title mb-0">Payslip History</h4>
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
                            <table id="payslip_report" class="datatable table-striped custom-table mb-0">
                                <thead>
                                    <tr class = "text-center">
                                        <th>Reference Number</th>
                                        <th>Date Issued</th>
                                        <th>Issued By</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr class = "text-center">
                                    <td>#REF-5232ZBQ-4550</td>
                                    <td>Apr 12,2024</td>
                                    <td>First Last</td>
                                    <td>12,000.00 PHP</td>
                                    <td>Print</td>
                              
                                    </tr>
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
        $("li > a[href='<?= base_url('employee/reports/payslip') ?>']").addClass("active");
        $("li > a[href='<?= base_url('employee/reports/payslip') ?>']").parent().parent().css("display", "block")

        $("#payslip_report").DataTable();






    })
</script>