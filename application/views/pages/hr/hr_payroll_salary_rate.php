
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
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Salary Rates</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Payroll</a></li>
                            <li class="breadcrumb-item active">Salary Rates</li>
                        </ul>
                    </div>
                
                </div>
            </div>
            <!-- /Page Header -->

            
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->




<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("li > a[href='<?= base_url('hr/payroll/salary_rate') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/payroll/salary_rate') ?>']").parent().parent().css("display", "block")



    })
</script>