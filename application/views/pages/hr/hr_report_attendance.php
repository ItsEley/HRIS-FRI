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
            top: 0;
            left: -200px;
            /* transform: scale(1); */

        }

        #emp_attendance_table {
            transform-origin: top left;
            transform: scale(0.95);

            width: max-content;

        }





    }


    .late-highlight {
        /* text-decoration: underline red; */
        background-color: red !important;
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
        <div class="content container-fluid">

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
                    <div class="col" id="attendance_filters">


                        <label for="month">Month:</label>
                        <select id="filter_month">
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


                        <?php

                        // Minimum year and month
                        $query = $this->db->query("SELECT MIN(YEAR(`date`)) AS min_year, MIN(MONTH(`date`)) AS min_month FROM `attendance`");
                        $min_result = $query->row();

                        $min_year = $min_result->min_year;
                        $min_month = $min_result->min_month;

                        // Maximum year and month
                        $query = $this->db->query("SELECT MAX(YEAR(`date`)) AS max_year, MAX(MONTH(`date`)) AS max_month FROM `attendance`");
                        $max_result = $query->row();

                        $max_year = $max_result->max_year;
                        $max_month = $max_result->max_month;

                        // Output the results
                        // echo "Minimum Year: $min_year, Minimum Month: $min_month <br>";
                        // echo "Maximum Year: $max_year, Maximum Month: $max_month";

                        ?>


                        <label for="year">Year:</label>
                        <select id="filter_year">
                            <!-- You can generate the options dynamically using JavaScript -->
                            <!-- For example, from the current year to 10 years in the future -->
                            <?php
                            $current_year = date('Y');
                            $current_month = date('Mm');



                            // Generate options for the current year and 10 years in the future
                            for ($i = $min_year; $i <= $max_year; $i++) {
                                if ($i == $current_year) {
                                    echo "<option value='$i' selected>$i</option>";
                                } else {
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
                <div class="d-flex justify-content-center">
    <!-- <h3>Legend</h3> -->
    <p class="m-0 mx-5" style="font-size: 18px; line-height: 1;"><span class="fas fa-check text-success"></span> - Present</p>
    <p class="m-0 mx-5" style="font-size: 18px; line-height: 1;"><span class="fas fa-times fa-fw text-danger"></span> - Absent</p>
</div>

                    <div class="col-4"></div>
                </div>


                <div class="row timeline-panel">
                    <div class="col-lg-12">
                        <div class="table-responsive" id="emp_attendance_table_container">
                            <table class="table table-striped " id="emp_attendance_table">
                                <h3><span id="title_attendance_month">{MONTH}</span> <span id="title_attendance_year"> {YEAR}</span></h3>


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
    $(window).on('beforeprint', function() {
        $('.att-emp-img').hide();
        $('.att-emp-name').style("font-size", "10px");
        $('#emp_attendance_table_container').get(0).scrollLeft = 0;
    });


    // Show elements with class "no-print" after printing
    $(window).on('afterprint', function() {
        $('.att-emp-img').hide();
        $('.att-emp-name').style("font-size", "");



    });


    // Detect the print event
    var mediaQueryList = window.matchMedia('print');
    mediaQueryList.addListener(function(mql) {
        if (mql.matches) {
            // Print event detected, reset scroll position
            $('#emp_attendance_table_container').get(0).scrollLeft = 0;

        }
    });




    function fetch_attendance(year, month) {
        $.ajax({
            url: base_url + "datatable_fetchers/fetch_attendance",
            type: "POST",
            dataType: "json",
            data: {
                year: year,
                month: month
            },
            success: function(response) {
                // Check if the response indicates success and has the expected properties
                if (response.success && response.attendance_data && response.month && response.year && response.table_row) {
                    console.log(response);

                    // Clear the existing table body and header
                    $("#emp_attendance_table tbody").empty();
                    $("#emp_attendance_table thead").empty();

                    // Append the month and year to the table

                    // Convert numeric month to full text
                    var fullMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var monthText = fullMonths[parseInt(response.month) - 1]; // Subtract 1 since months are zero-indexed

                    $("#title_attendance_month").text(monthText);
                    $("#title_attendance_year").text(response.year);

                    // Append the table row to the table header
                    $("#emp_attendance_table thead").append(response.table_row);

                    // Iterate through the response data
                    $.each(response.attendance_data, function(index, empRecord) {
                        var row = $("<tr data-att-emp-id='" + empRecord.emp_id + "'>");
                        var cell = $("<td>").html("<h2 class='table-avatar'>" +
                            "<a class='avatar avatar-xs att-emp-img' href='#'>" +
                            "<img src='data:image/jpeg;base64," + empRecord.pfp + "' alt='User Image'>" +
                            "</a>" +
                            "<a href='#' att-emp-name>" + empRecord.full_name + "</a>" +
                            "</h2>");
                        row.append(cell);

                        // Append attendance records
                        $.each(empRecord.attendance_records, function(index, attendance) {
                            var attClass = attendance.class;
                            var attClass2 = attendance.class2;

                            // Check if attClass2 contains 'text-danger' or 'bg-white' classes
                            if (attClass2.includes('text-danger') || attClass2.includes('bg-white')) {
                                var tooltipText = 'Late';
                            } else {
                                var tooltipText = 'Present';
                            }

                            var attCell = $("<td id='att_" + attendance.attendance_id + "' data-att-date='" + attendance.date + "'>")
                                .html("<div><p class='att-record m-0 p-0 " + attClass + "' title='Present'></p></div><div><p class='att-record m-0 p-0 " + attClass2 + "' title='" + tooltipText + "'></p></div>");
                            row.append(attCell);


                        });

                        // Append the row to the table body
                        $("#emp_attendance_table tbody").append(row);
                    });
                }
            }
        });
    }





    // Create a new Date object
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth() + 1; // Adding 1 to get the month in the range of 1 to 12

    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").parent().parent().css("display", "block")





        fetch_attendance(currentYear, currentMonth);
        $("#filter_month").val(currentMonth);
        $("#filter_year").val(currentYear);


        $("#attendance_filters > select").on('change', function() {
            console.log($(this).val());

            let month = $("#filter_month").val();
            let year = $("#filter_year").val();

            fetch_attendance(year, month)

        });





    })
</script>