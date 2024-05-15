<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_report_timesheet.php  */ -->

<!-- 
<div class="modal fade" id="modal_edit_timesheet" tabindex="-1" aria-labelledby="modal_edit_timesheetLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_shiftLabel">Edit Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="timesheet_form">

                    <div class="mb-3">
                        <label for="" class="form-label">ID Attendance</label>
                        <input type="text" class="form-control" id="att_id_timesheet" name="att_id_timesheet" required>
                    </div>
                    <div class="mb-3">
                        <label for="att_time_in" class="form-label">Time from</label>
                        <input type="text" class="form-control" id="att_time_in" name="att_time_in" required>
                    </div>
                    <div class="mb-3">
                        <label for="att_time_out" class="form-label">Time to</label>
                        <input type="text" class="form-control" id="att_time_out" name="att_time_out" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="modal_edit_timesheet" tabindex="-1" aria-labelledby="modal_edit_timesheet_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_timesheet_label">Edit Timesheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit_timesheet_form">
                    <div class="mb-3">
                        <h5><b><span id="create_for">NAME</span></b> 's Time-In and Time-Out on <span id="create_date"></span></h5>
                    </div>
                    <div class="mb-3">
                        <!-- <label for="att_id_timesheet" class="form-label">ID Attendance</label> -->
                        <input type="text" class="form-control" id="att_id_timesheet" name="att_id_timesheet" hidden required>
                    </div>
                    <div class="mb-3">
                        <label for="att_time_in" class="form-label">Time from</label>
                        <input type="time" class="form-control" id="att_time_in" name="att_time_in" required>
                    </div>
                    <div class="mb-3">
                        <label for="att_time_out" class="form-label">Time to</label>
                        <input type="time" class="form-control" id="att_time_out" name="att_time_out" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i> Save</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    
$(document).ready(function() {
    $('#edit_timesheet_form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            att_id: $('#att_id_timesheet').val(),
            time_in: $('#att_time_in').val(),
            time_out: $('#att_time_out').val()
        };

        $.ajax({
            url: base_url+'humanr/edit_timesheet', // Replace with your controller method URL
            type: 'POST',
            data: formData,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'success') {
                    // Handle success
                    alert('Timesheet updated successfully!');
                    $('#modal_edit_timesheet').modal('hide'); // Hide the modal if needed
                    // Optionally, refresh the table or perform other actions
                } else {
                    alert('Error: ' + jsonResponse.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error
                console.log('Error:', textStatus, errorThrown);
                alert('Failed to update timesheet. Please try again.');
            }
        });
    });
});

   
</script>