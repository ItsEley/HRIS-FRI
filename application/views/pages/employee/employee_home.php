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
                    $data['img_name'] = 'absent.png';
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
                                        $data['icon_type'] = "1";

                    $data['icon'] = "fa fa-check-circle";
                    $data['count'] = rand(0, 200);
                    $data['label'] = "Overtime";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php
                                        $data['icon_type'] = "1";

                    $data['icon'] = "fa fa-rocket";
                    $data['count'] = rand(0, 200);
                    $data['label'] = "Undertime";
                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
            </div>




            <div class="row">
                <div class="col">
                    <h2 class="page-title">

                        <h2>Announcements</h2>
                    </h2>

                    <div class="timeline-panel">
                        <?php
                        $query = $this->db->query("SELECT 
                        a.id, 
                        a.type, 
                        a.title, 
                        a.content, 
                        CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS author,
                        a.to_all, 
                        a.date_created, 
                        GROUP_CONCAT(d.acro_dept ORDER BY d.acro_dept SEPARATOR ', ') AS departments,
                        GROUP_CONCAT(d.department ORDER BY d.acro_dept SEPARATOR ', ') AS full_departments
                    FROM 
                        announcement a
                    LEFT JOIN 
                        announce_to t ON a.id = t.ann_id
                    LEFT JOIN 
                        department d ON t.dept_id = d.id
                    LEFT JOIN 
                        employee e ON a.author = e.id
                    GROUP BY 
                        a.id
                    HAVING 
                        departments LIKE '%".$_SESSION['acro']."%' OR a.to_all = 1
                    ORDER BY 
                        a.date_created DESC
                    
                                                ");

                        // Check if the query was successful
                        if ($query) {
                            // Check if there are rows returned
                            if ($query->num_rows() > 0) {
                                // Fetch the result rows as an array of objects
                                $announcement = $query->result();

                                // Process the result rows
                                foreach ($announcement as $row) {
                                    // Access properties of each shift object as needed
                                    $data['id'] = $row->id;
                                    $data['title'] = $row->title;
                                    $data['content'] =  $row->content;
                                    $data['author']  = ($row->author === NULL) ? "N/A" : $row->author;
                                    $data['department'] = ($row->to_all == "1") ? "All" : $row->departments;
                                    $data['date'] =  $row->date_created;

                                    $this->load->view('components/card-announcement', $data);
                                }
                            } else {
                                // Handle case when no rows are returned
                                echo "No announcements yet.";
                            }
                        } else {
                            // Handle case when query fails
                            echo "Error executing query: " . $this->db->error()['message'];
                        }


                        ?>

                    </div>
                </div>




                <div class="col-lg-5 col-md-12">
               <h2 class="page-title">Upcoming Events</h2>

               <?php
               $query = $this->db->query("SELECT 
               'event' AS type,
               `id`, 
               `event_name` AS name, 
               `event_description` AS description, 
               `date_start`, 
               `date_end`, 
               `time_start`, 
               `time_end`, 
               `is_workday`, 
               `date_created` 
           FROM 
               `sys_events`
           WHERE 
               MONTH(`date_start`) = MONTH(CURDATE()) AND YEAR(`date_start`) = YEAR(CURDATE())
           
           UNION
           
           SELECT 
               'holiday' AS type,
               `id`, 
               `holiday_name` AS name, 
               `holiday_description`, 
               `date_start`, 
               `date_end`, 
               `time_start`, 
               `time_end`, 
               `is_workday`, 
               `date_created` 
           FROM 
               `sys_holidays`
           WHERE 
               MONTH(`date_start`) = MONTH(CURDATE()) AND YEAR(`date_start`) = YEAR(CURDATE())
           
           UNION
           
           SELECT 
               'birthday' AS type,
               NULL AS id, -- No ID for birthday event
               CONCAT(`fname`, ' ', COALESCE(`mname`, ''), ' ', `lname`) AS name, -- Concatenate first, middle, and last name
               'Employee Birthday' AS description, -- Set a default description
               DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', MONTH(`dob`), '-', DAY(`dob`)), '%Y-%m-%d') AS date_start, -- Use current year's birthday as the start date
               DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', MONTH(`dob`), '-', DAY(`dob`)), '%Y-%m-%d') AS date_end, -- Use current year's birthday as the end date
               NULL AS time_start, -- No specific time for birthdays
               NULL AS time_end, -- No specific time for birthdays
               0 AS is_workday, -- Assuming birthdays are not workdays
               `date_created` 
           FROM 
               `employee`
           WHERE 
               MONTH(`dob`) = MONTH(CURDATE()) -- Filter birthdays occurring in the current month
           ");

               // Check if the query was successful
               if ($query) {
                  // Check if there are rows returned
                  if ($query->num_rows() > 0) {
                     // Fetch the result rows as an array of objects
                     $announcement = $query->result();

                     // Process the result rows
                     foreach ($announcement as $row) {
                        // Access properties of each shift object as needed
                        // $data['id'] = $row->id;
                        // $data['title'] = $row->title;
                        // $data['content'] =  $row->content;
                        // $data['author']  = ($row->author === NULL) ? "N/A" : $row->author;
                        // $data['department'] = ($row->to_all == "1") ? "All" : $row->departments;
                        // $data['date'] =  $row->date_created;

                        $isToday = strtotime($row->date_start) === strtotime(date('Y-m-d'));


               ?>


                        <div class="timeline-panel type-<?= $row->type ?>" style="background-color: white; ">
                           <h3 class="event-name">

                              <?php if ($row->type == "birthday") {
                                 echo "Happy Birthday $row->name !";
                              } else {
                                 echo $row->name;
                              }
                              ?>
                           </h3>
                           <p class="event-date"><?= $isToday ? "<span class = 'badge badge-soft-info'>Today</span> • " : ""; ?> 
                            <?= formatDateOnly($row->date_start); ?></p>
                           <p class="text-overflow-ellipsis event-description" onclick="$(this).css('height','auto')">
                              <?php
                              if ($row->description == NULL || $row->description == '') {
                                 echo "No description available";
                              } else {
                                 echo $row->description;
                              }
                              ?></p>

                           <?php
                           if ($row->type == "birthday") {
                              echo '<img src="../assets/img/birthday-GIF.gif" alt="User Image" loop="infinite">';
                           }
                           ?>



                        </div>

               <?php

                     }
                  } else {
                     // Handle case when no rows are returned
                     echo "No announcements yet.";
                  }
               } else {
                  // Handle case when query fails
                  echo "Error executing query: " . $this->db->error()['message'];
               }


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