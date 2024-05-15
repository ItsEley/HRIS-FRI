<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_report_timesheet.php  */ -->


<div class="modal fade" id="modal_create_timesheet" tabindex="-1" aria-labelledby="modal_create_shiftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_shiftLabel">Manual Input</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create_attendance_form">
                    <div class="mb-3">
                        <p>Manual time in and time out input for <b><span id="create_for">NAME</span></b> on
                            <span id="create_date">YYYY/MM/DD</span>
                        </p>
                    </div>
                    <input type="text" class="form-control col" id="create_date" name="att_date" required>
                        
                    <div class="mb-3 row" style="width:90%">
                        <label for="create_time_in" class="form-label col-3 m-auto text-center">Time in</label>
                        <input type="time" class="form-control col" id="create_time_in" name="create_time_in" required>
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label for="create_time_out" class="form-label col-3 m-auto text-center">Time out</label>
                        <input type="time" class="form-control col" id="create_time_out" name="create_time_out" required>
                    </div>

                    <!-- Hidden input to capture employee ID or other relevant data -->
                    <input type="hidden" id="employee_id" name="employee_id" >
                    <input type="hidden" id="att_date" name="att_date" >


                    <button type="submit" class="btn btn-primary float-end"><i class="fa-solid fa-plus"></i> Create</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#create_attendance_form').on('submit', function(e) {
    e.preventDefault();

    // Get the value of the date input field
    var dateString = $('#create_date').val();

    // Parse the date string
    var dateObject = new Date(dateString);

    // Extract year, month, and day
    var year = dateObject.getFullYear();
    var month = ('0' + (dateObject.getMonth() + 1)).slice(-2); // Months are zero-based
    var day = ('0' + dateObject.getDate()).slice(-2);

    // Format the date as yyyy-mm-dd
    var formattedDate = year + '-' + month + '-' + day;

    // Update the value of the date input field
    $('#create_date').val(formattedDate);

    // Serialize the form data
    var formData = $(this).serialize();

    // Send the AJAX request
    console.log(formData)
    $.ajax({
        type: 'POST',
        url: base_url+'datatablec/timesheet_create',
        data: formData,
        dataType: 'json',
        success: function(response) {
            // Handle the response from the server
            if (response.status == 'success') {
                // Format the time
              

                // Display formatted time
                toastr.success('Success! Attendance has been added.');

                setTimeout(function() {
                    location.reload();
                }, 5000);
            } else {
                toastr.error('Error! Adding attendance has failed due to an error. ' + response.message);

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any errors to the console
            alert('An error occurred while processing your request.'); // Show generic error message
        }
    });
});

</script>