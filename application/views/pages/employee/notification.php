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
                            <ul class="activity-list">
                                <?php
                                $this->db->select('COUNT(*) as total_rows');
                                $id1 = $_SESSION['id'];
                                $this->db->where('user_id', $id1);
                                $query = $this->db->get('notifications');

                                // Check if query was successful
                                if ($query) {
                                    // Fetch the total rows count
                                    $row = $query->row();
                                    $total_rows = $row->total_rows;
                                } else {
                                    // Handle error if query fails
                                    $total_rows = 0; // Set default value
                                }
                                if ($total_rows > 0) {
                                    // Retrieve the latest 5 notifications
                                    $id1 = $_SESSION['id']; // Corrected syntax for accessing session variable
                                    $this->db->select('*');
                                    $this->db->from('notifications');
                                    $this->db->where('user_id', $id1);
                                    $this->db->order_by('created_at', 'desc');
                                    $this->db->limit(5);
                                    $latest_notifications_query = $this->db->get();

                                    if ($latest_notifications_query->num_rows() > 0) { // Check if there are notifications
                                        foreach ($latest_notifications_query->result() as $notification) {
                                            $notif_time = date('F j, Y g:i A', strtotime($notification->created_at));
                                            $unread_style = $notification->status == "unread" ? 'style="background-color: #f2f2f2;"' : '';
                                ?>
                                            <li>
                                                <div class="activity-user">
                                                    <a href="profile.html" title="" data-bs-toggle="tooltip" class="avatar">
                                                        <img src="assets/img/profiles/avatar-01.jpg" alt="User Image">
                                                    </a>
                                                </div>
                                                <div class="activity-content">
                                                    <div class="timeline-content">
                                                        <div class="name-and-action">
                                                            <a href="profile.html" class="name"><?= $notification->user_id ?></a>
                                                           
                                                            <a href="#" class="task-title"><?= $notification->title ?></a>
                                                            <span> - </span>
                                                            <a href="#" class="message"><?= $notification->message ?></a>
                                                        </div>
                                                        <div class="time-wrapper">
                                                            <span class="time"><?= $notif_time ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                <?php
                                        }
                                    } else {
                                        echo '<li>No notifications found.</li>'; // Display if there are no notifications
                                    }
                                } else {
                                    // Display a message if there are no notifications
                                    echo '<li>No notifications found.</li>';
                                }
                                ?>
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