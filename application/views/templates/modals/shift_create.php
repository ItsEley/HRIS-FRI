<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_shifts.php  */ -->


<div class="modal fade" id="modal_create_shift" tabindex="-1" aria-labelledby="modal_create_shiftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_shiftLabel">Create Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create_shift_form">

                    <div class="mb-3">
                        <label for="createEventTitle" class="form-label">Group label</label>
                        <input type="text" class="form-control" id="create_shift_label" name="create_shift_label" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="createEventTitle" class="form-label">Short description</label>
                        <input type="text" class="form-control" id="create_shift_description" name="create_shift_description"
                        placeholder="e.g 'Regular','Dayshift','Nightshift' (Optional)">
                    </div>
                    <div class="mb-3">
                        <label for="createEventStart" class="form-label">Time from</label>
                        <input type="time" class="form-control" id="create_shift_time_from" name="create_shift_time_from" required>
                    </div>
                    <div class="mb-3">
                        <label for="createEventEnd" class="form-label">Time to</label>
                        <input type="time" class="form-control" id="create_shift_time_to" name="create_shift_time_to" required>
                    </div>
                    <!-- Add more fields for createing event details -->
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create</button>
                </form>
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