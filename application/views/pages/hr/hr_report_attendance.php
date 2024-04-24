<style>
    #emp_attendance_table>thead th {
        border: none;
    }

    @media print {

        body {
            visibility: hidden;
        }

        @page {
            /* size: landscape */
        }

        .att-emp-img {
            display: none;
        }

        #report_header {
            display: block !important;
            /* visibility: visible; */
            /* position: absolute; */

        }

        #print-area {
        visibility: visible;
        position: absolute;
        width: 120%;
        top:0;
        left: -200px;
        /* transform: scale(1); */
        
    }

    #emp_attendance_table {
        transform-origin: top left;
        transform: scale(0.95);

        width: max-content;

    }





    }
</style>


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
    <div class="page-wrapper" style="width:-webkit-fill-available;
                                    min-height: -webkit-fill-available;">

        <!-- Page Content -->
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ul>
                    </div>
                    <div class="col">
    <label for="month">Month:</label>
    <select id="month">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>
    
    <label for="year">Year:</label>
    <select id="year">
        <!-- You can generate the options dynamically using JavaScript -->
        <!-- For example, from the current year to 10 years in the future -->
        <?php
$current_year = date('Y');
// Generate options for 10 years in the past
for ($i = $current_year - 10; $i <= $current_year; $i++) {
    echo "<option value='$i'>$i</option>";
}

// Generate options for the current year and 10 years in the future
for ($i = $current_year; $i <= $current_year + 10; $i++) {
    if($i == $current_year){
    echo "<option value='$i' selected>$i</option>";

    }else{
        echo "<option value='$i'>$i</option>";

    }


}
?>

    </select>
</div>
                    <div class="col-auto float-end ms-auto">
                        <button class="btn btn-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print as PDF</button>
                        <!-- <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            <div id="print-area">

                <h1 class="text-center" style="display:none" id="report_header">Employee Attendance Report - March 2024</h1>

                <div class="row legend timeline-panel" id="emp_att_legend">
                    <div class="d-flex justify-content-between">
                        <!-- <h3>Legend</h3> -->
                        <p class="m-0"><span class="att-p"></span> - Present</p>
                        <p class="m-0"><span class="att-o"></span> - On time</p>
                        <p class="m-0"><span class="att-l"></span> - Late</p>
                        <p class="m-0"><span class="att-a"></span> - Absent</p>
                        <p class="m-0"><span class="att-d"></span> - Day-off</p>
                        <p class="m-0"><span class="att-e"></span> - On Leave</p>
                        <p class="m-0"><span class="att-h"></span> - Half-day</p>
                        <p class="m-0"><span class="att-b"></span> - On Official Business</p>
                        <p class="m-0"><span class="att-n"></span> - No Work Day</p>
                    </div>
                    <div class="col-4"></div>
                </div>


                <div class="row timeline-panel">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="emp_attendance_table_container">
                            <table class="table table-striped " id="emp_attendance_table">
                                <h3><span id="title_attendance_month">{MONTH}</span><span id="title_attendance_month"> {YEAR}</span></h3>


                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <?php
                                        $year = 2024;
                                        $month = 4;

                                        // Get the number of days in the month
                                        $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                                        // Loop through each day of the month
                                        for ($day = 1; $day <= $num_days; $day++) {
                                            // Get the day of the week for the current date
                                            $day_of_week = date('l', strtotime("$year-$month-$day"));

                                            if ($day_of_week == "Sunday") {
                                                echo "<th style='color:red'>$day</th>";
                                            } else {
                                                echo "<th>$day</th>";
                                            }
                                        }
                                        echo "<th></th>";
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $month = $month < 10 ? "0$month" : $month;
                                    $query = $this->db->query("SELECT DISTINCT(a.emp_id), CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS full_name, e.pfp
    FROM attendance AS a
    INNER JOIN employee AS e ON a.emp_id = e.id 
    WHERE a.date LIKE '%$year-$month%'");

                                    // Check if the query was successful
                                    if ($query->num_rows() > 0) {
                                        // Fetch the result rows as an array of objects
                                        $result = $query->result();

                                        foreach ($result as $row) {
                                            $emp_id = $row->emp_id;

                                            echo "<tr data-att-emp-id='" . $emp_id . "'> ";
                                            echo "<td>
                <h2 class='table-avatar'>
                    <a class='avatar avatar-xs att-emp-img' href='#'>
                    <img src='data:image/jpeg;base64," . base64_encode($row->pfp) . "' alt='User Image' >
                    </a>
                    <a href='#' att-emp-name>" . $row->full_name . "</a>
                </h2>
            </td>";

                                            // Your original SQL query
                                            $sql = "SELECT a.attendance_id, a.emp_id, a.date, a.time_in, a.status, a.time_out, a.num_hr, CONCAT(e.fname, ' ', COALESCE(e.mname, ''), ' ', e.lname) AS full_name, e.pfp
                FROM attendance a
                INNER JOIN employee e ON a.emp_id = e.id
                WHERE a.emp_id = ? AND a.date LIKE ?
                ORDER BY a.date ASC";

                                            // Execute the query with placeholders
                                            $query1 = $this->db->query($sql, array($emp_id, "$year-$month%"));

                                            // Check if the query was successful
                                            if ($query1) {
                                                // Get the result as an array of rows
                                                $result1 = $query1->result_array();

                                                // Loop through the result
                                                foreach ($result1 as $row1) {
                                                    if (strtotime($row1['time_in']) < strtotime("8:00")) {
                                                        echo "<td><p class='att-record m-0 p-0 att-o'></p></td>"; //on time
                                                        // echo "<td><p class='att-record m-0 p-0 att-o'>".$row1['time_in']."</p></td>"; //on time

                                                    } elseif (strtotime($row1['time_in']) > strtotime("8:00")) {
                                                        echo "<td><p class='att-record m-0 p-0 att-l'></p></td>"; //late
                                                    }
                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    ?>


                                    <tr id="emp_id" hidden>

                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-xs" href="profile.html"><img src="<?php echo base_url('assets\img\user.jpg') ?>" alt="User Image"></a>
                                                <a href="profile.html">John Doe</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <p class="att-record m-0 p-0 "></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-a m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-l m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-l m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-b m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-e m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-a m-0 p-0"></p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->



        <!-- MODALS -->


    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->



<!-- Attendance Modal -->
<div class="modal custom-modal fade" id="attendance_info" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card punch-status">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                <div class="punch-det">
                                    <h6>Punch In at</h6>
                                    <p>Wed, 11th Mar 2019 10.00 AM</p>
                                </div>
                                <div class="punch-info">
                                    <div class="punch-hours">
                                        <span>3.45 hrs</span>
                                    </div>
                                </div>
                                <div class="punch-det">
                                    <h6>Punch Out at</h6>
                                    <p>Wed, 20th Feb 2019 9.00 PM</p>
                                </div>
                                <div class="statistics">
                                    <div class="row">
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Break</p>
                                                <h6>1.21 hrs</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Overtime</p>
                                                <h6>3 hrs</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card recent-activity">
                            <div class="card-body">
                                <h5 class="card-title">Activity</h5>
                                <ul class="res-activity-list">
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            10.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            11.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            11.15 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            1.30 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            2.00 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            7.30 PM.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Attendance Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").parent().parent().css("display", "block")



        $(window).on('beforeprint', function() {
        $('.att-emp-img').hide();
        $('.att-emp-name').style("font-size","10px");
        $('#emp_attendance_table_container').get(0).scrollLeft = 0;
    });


    // Show elements with class "no-print" after printing
    $(window).on('afterprint', function() {
        $('.att-emp-img').hide();
        $('.att-emp-name').style("font-size","");



    });


      // Detect the print event
      var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
        if (mql.matches) {
            // Print event detected, reset scroll position
            $('#emp_attendance_table_container').get(0).scrollLeft = 0;

        }
    });


    })
</script>