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
            <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">

                        </div>
                        <div class="welcome-det">
                            <h3>Welcome, <span><?php echo ucwords(strtolower($this->session->userdata('fullname'))); ?></span>!</h3>

                            <?php
                            // Display department if it exists in the session
                            if ($this->session->userdata('department')) {
                                echo "<p>Department: " . str_replace('Department', '', $this->session->userdata('department'))  . "</p>";
                                // echo "<p>ID: " . $this->session->userdata('id') . "</p>";
                            }
                            ?>

                            <p><?php echo date("l, jS F Y") ?></p>
                        </div>
                    </div>
                </div>
            </div>

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




            <div class="row">
                <div class="col">
                <h2 class="page-title">Announcements</h2>
                

                    <?php
               $data['for'] = "emp";
               $this->load->view('components/section-announcement', $data)
               ?>
               
                </div>




                <div class="col-lg-5 col-md-12">
               <h2 class="page-title">Upcoming Events</h2>

               <?php
               $this->load->view('components/section-events', $data)
            
            ?>

            </div>
            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<?php $this->load->view('components\modal-announcement-details.php'); ?>