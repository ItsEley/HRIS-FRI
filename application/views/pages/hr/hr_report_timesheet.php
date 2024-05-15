<!-- Main Wrapper -->
<style>
    .timesheet-absent.active {
        display: none;

    }
</style>

<div class="main-wrapper">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>


    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Reports</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Timesheet</li>
                        </ul>
                    </div>



                    <div class="col-auto ms-auto d-flex">

                        <button class="btn btn-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print as PDF</button>

                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#attendance_fileup"><i class="fa-solid fa-upload"></i> Upload</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-regular fa-circle-question" title="Mandatory Format"></i></a>
                    </div>
                </div>



            </div>


            <div class="row pb-3">
                <div class="col filter-container" id="attendance_filters">


                    <label for="start_date" class="filter-label">Date: </label>
                    <input type="number" name="filter_date" id="filter_date" min="1" max="31" class="filter-input numeric">


                    <label for="month" class="filter-label">Month:</label>
                    <select name="filter_month" id="filter_month" class="filter-input select">
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

                    <label for="year" class="filter-label">Year:</label>
                    <select name="filter_year" id="filter_year" class="filter-input select">
                        <!-- You can generate the options dynamically using JavaScript -->
                        <!-- For example, from the current year to 10 years in the future -->
                        <?php
                        $current_year = date('Y');
                        $current_month = date('m');

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



                    <button type="button" id="btn_apply_filter" class="btn btn-primary" style="font-size:10px;">
                        <i class="fas fa-search m-r-5"></i>
                        Filter</button>

                </div>
                <div class="col m-auto form-check form-switch">

                    <div id="hidden_count_div">
                        <p>Hidden : <span id="hidden_count">0</span></p>
                    </div>
                    <input class="form-check-input" type="checkbox" id="hide_toggle_btn">
                    <label class="form-check-label" for="toggle-btn">Hide Absent</label>

                </div>

            </div>


            <div class="row timeline-panel">


                <table id="dt_report_timesheet" class="datatable table-striped custom-table mb-0">
                    <thead>
                        <tr class="text-center">
                            <th hidden>ID</th>
                            <!-- <th></th> -->
                            <th>Name</th>
                            <th>Time-in</th>
                            <th>Time-out</th>
                            <th>Total Hours Worked</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<?php $this->load->view('templates\modals\attendance_file_upload.php'); ?>
<?php $this->load->view('templates\modals\timesheet_create.php'); ?>
<?php $this->load->view('templates\modals\timesheet_edit.php'); ?>
<?php $this->load->view('templates\modals\timesheet_delete.php');
?>




<!-- id, name, age, department -->
<script>
    function count_hidden() {
        $("#hidden_count").html($('tr.timesheet-absent.active').length);
    }

    function add_listeners() {
        add_create_listener();
        add_edit_listener();
        add_delete_listener();
    }


    function add_create_listener() {

        $('button.create-timesheet').on('click', function() {

            let emp_id = $(this).parent().parent().children("td.famco-id").text();
            let full_name = $(this).parent().parent().children("td").children(".emp-fullname").text();
            // Parse the date string into a Date object
            var date = new Date($("#filter_year").val() + "-" + date_padding($("#filter_month").val()) + "-" + date_padding($("#filter_date").val()));

            // Format the date to "May 15, 2024"
            var formattedDate = date.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });

            // Set the formatted date as the HTML content of the span element
            $("#create_attendance_form span#create_date").html(formattedDate);
            $("#create_attendance_form input#create_date").val(date);

            $("#create_attendance_form span#create_for").html(full_name)



            $("#create_attendance_form input#employee_id").val(emp_id);
            $("#create_attendance_form input#att_date").val(date);
        });
    }

    function add_edit_listener() {

        $('button[data-bs-target="#modal_edit_timesheet"]').on('click', function() {
            // Your code here
            // console.log("Button clicked:", this);
            // Example: Get data attributes
            let attendance_id = $(this).data('att-id');
            let time_in = $(this).data('time-in');
            let time_out = $(this).data('time-out');
            let date = $(this).data('date');
            let emp_name = $(this).data('emp-name');

            $("#modal_edit_timesheet span#create_for").html(emp_name);
            $("#modal_edit_timesheet span#create_date").html(date);

            $("#modal_edit_timesheet input#att_id_timesheet").val(attendance_id);
            $("#modal_edit_timesheet input#att_time_in").val(time_in);
            $("#modal_edit_timesheet input#att_time_out").val(time_out);

        });

    }

    function add_delete_listener() {

        $('button[data-bs-target="#modal_delete_timesheet"]').on('click', function() {
            // Your code here
            console.log("Button clicked:", this);
            // Example: Get data attributes
            let attendance_id = $(this).data('att-id');
            let date = $(this).data('date');
            let emp_name = $(this).data('emp-name');

            $("#modal_delete_timesheet span#delete_attendance_name").html(emp_name);
            $("#modal_delete_timesheet span#delete_attendance_date").html(date);

            $("#modal_delete_timesheet input#delete_attendance_id").val(attendance_id);


        });

    }



    function get_ajax_timesheet(date, month, year) {
        console.log(year + "-" + month + "-" + year);

        let hide;
        if ($("#hide_toggle_btn").prop('checked')) {
            hide = true;
        } else {
            hide = false;
        }

        console.log("before ajax : " + hide);

        $.ajax({
            url: base_url + 'datatable_fetchers/get_day_timesheet', // Adjust the URL to match your CodeIgniter controller
            type: 'POST',
            data: {
                date: date,
                month: month,
                year: year,
                hide: hide
            },
            success: function(data) {
                // Display the results in the #dt_report_timesheet table body
                var $tbody = $('#dt_report_timesheet tbody');
                $tbody.empty(); // Clear existing table body

                // Assuming `data` is HTML and contains the rows
                if (data.trim().length > 0) {
                    $tbody.append(data);
                } else {
                    $tbody.append('<tr><td colspan="8">No attendance records found for today.</td></tr>');
                }

                add_listeners(); // Call add_listeners after updating the table
                $('#dt_report_timesheet').DataTable({
                    "pageLength": 100
                });

                count_hidden();

            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error('AJAX Error: ' + status + error);
                $('#dt_report_timesheet tbody').html('<div class="alert alert-danger">An error occurred while fetching the timesheet.</div>');
            }
        });
    }



    // Add change event listener to the checkbox
    $('#hide_toggle_btn').change(function() {
        // Check if the checkbox is checked
        if ($(this).prop('checked')) {
            // Perform actions when the toggle is active
            console.log('Toggle is active');

            var elements = $('tr.timesheet-absent');

            // Loop through each element
            elements.each(function(index, element) {
                // Add 'active' class to each element
                element.classList.add('active');
            });



        } else {
            console.log('Toggle is inactive');
            // Perform actions when the toggle is inactive
            var elements = $('tr.timesheet-absent');

            // Loop through each element
            elements.each(function(index, element) {
                // Remove 'active' class from each element
                $(element).removeClass('active');
            });


        }

        // Call the function to count hidden elements (if you have such a function)
        count_hidden();
    });




    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/reports/timesheet') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/reports/timesheet') ?>']").parent().parent().css("display", "block")

        // Get the current values
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth() + 1; // Adding 1 to get the month in the range of 1 to 12
        var currentDay = currentDate.getDate(); // Adding 1 to get the month in the range of 1 to 12

        // fetch_attendance(currentYear, currentMonth);
        $("#filter_month").val(currentMonth);
        $("#filter_year").val(currentYear);
        $("#filter_date").val(currentDay);


        get_ajax_timesheet($("#filter_date").val(), $("#filter_month").val(), $("#filter_year").val())


        // add_listeners();

        $("#filter_date").on('change', function() {
            // console.log(this.value)
            if (!(this.value > 0 && this.value < 32)) {
                alert("Please enter a value in between 1 and 31");
                this.value = 1;
                this.focus();
            }

        })

        // Check for changes on form submission
        $('#btn_apply_filter').on('click', function(e) {
            // Check if any of the values have changed
            if ($("#filter_date").val() != '' || $("#filter_month").val() != '' || $("#filter_year").val() != '') {
                console.log('One or more elements have changed.');
                get_ajax_timesheet($("#filter_date").val(), $("#filter_month").val(), $("#filter_year").val())


                // save filters on URL
                var newUrl = window.location.href + '?date=' + $("#filter_date").val() + '&month=' + $("#filter_month").val() +
                    '&year=' + $("#filter_year").val(); // Replace with your desired URL
                // rewriteUrl(newUrl);

            } else {
                console.log('No changes detected.');
            }
        });





    });
</script>