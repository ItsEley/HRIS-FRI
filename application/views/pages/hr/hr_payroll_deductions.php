
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Salary Deduction</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Payroll</a></li>
                            <li class="breadcrumb-item active">Deduction</li>
                        </ul>
                    </div>
                
                </div>
            </div>
            <!-- /Page Header -->

            <div class = "timeline-panel">
                <h4>Mandatory Deductions</h4>

                <p class = "mb-0"><b>Pag-ibig</b> - ₱200.00</p>
                <p class = "mb-0"><b>Social Security System (SSS)</b>
                <i>For employees with more than ₱20,000.00 salary</i> - 12%</p>
                <p class = "mb-0"><b>Philhealth</b> - 5% </p>
            </div>

            
            <div class = "timeline-panel">
                <h4>Optinal Deductions</h4>

                <p class = "mb-0"><b>Cashadvance</b></p>
                <p class = "mb-0"><b>Den Expenses</b> </p>
                <p class = "mb-0"><b>Philhealth</b></p>
            </div>


        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->




<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("li > a[href='<?= base_url('hr/payroll/deduction') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/payroll/deduction') ?>']").parent().parent().css("display", "block")



    })
</script>