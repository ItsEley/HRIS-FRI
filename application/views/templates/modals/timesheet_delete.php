<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_report_timesheet.php  */ -->


<div class="modal fade" id="modal_delete_timesheet" tabindex="-1" aria-labelledby="modal_delete_timesheetLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_timesheetLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                <form id="delete_timesheet_form">
                <input type="text" id = "delete_attendance_id" name = "delete_attendance_id">

               

                <img src="<?php echo base_url('assets\img\icons\exclamation-mark.png')?>" alt="danger"
                     class = "p-2" style = "width:80px;">
               
                <h4>Are you sure you want to delete  <b><span id = "delete_attendance_name">{Name}</span></b>'s 
                attendance for <span id = "delete_attendance_date">{Date}</span> ?</h4>
                <p>Once confirmed, you won't be able to revert this process.</p>

                <button type = "button" class = "btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No, nevermind.</button>
                <button type = "submit" class = "btn btn-danger" >Yes, delete it!</button>
                </form>

                </div>
               
            </div>
        </div>
    </div>
</div>


<script>

     // Assuming you have a button or form submission triggering this event
     $('#create_shift_form').on('submit', function(e) {
        e.preventDefault();

   
        // Serialize the form data
        var formData = $(this).serialize();
        // Send the AJAX request
        console.log(formData)
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/shift_insert'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == '1') {
                    // alert(response.msg); // Show success message
                    // Optionally, you can perform additional actions here
                    toastr.success('Success! Shift ' + $("#create_shift_label").val() + ' has been updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    // alert(response.msg); // Show error message
                    toastr.error('Error! Shift ' + $("#create_shift_label").val() + '  has failed to update due to an error.');


                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
                alert('An error occurred while processing your request.'); // Show generic error message
            }
        });
    });
</script>