<!-- Main Wrapper -->
<div class="main-wrapper">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Notifications</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Notifications</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="activity">
                        <div class="activity-box">
                            <ul class="activity-list" id="notification-list">
                                <!-- Notification items will be dynamically loaded here -->
                            </ul>

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