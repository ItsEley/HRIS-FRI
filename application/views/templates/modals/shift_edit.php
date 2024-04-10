<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_shifts.php  */ -->



<!-- Edit Event Modal -->
<div class="modal fade" id="modal_edit_shift" tabindex="-1" aria-labelledby="modal_edit_shiftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_shiftLabel">Edit Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="edit_shift_form">

                    <input type="text" name="edit_shift_id" id="edit_shift_id" hidden>

                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Group label</label>
                        <input type="text" class="form-control" id="edit_shift_label" name="edit_shift_label" required>
                    </div>

                    <div class="mb-3">
                        <label for="editEventTitle" class="form-label">Short description</label>
                        <input type="text" class="form-control" id="edit_shift_description" name="edit_shift_description" placeholder="e.g 'Regular','Dayshift','Nightshift' (Optional)">
                    </div>
                    <div class="mb-3">
                        <label for="editEventStart" class="form-label">Time from</label>
                        <input type="time" class="form-control" id="edit_shift_time_start" name="edit_shift_time_start" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEventEnd" class="form-label">Time to</label>
                        <input type="time" class="form-control" id="edit_shift_time_end" name="edit_shift_time_end" required>
                    </div>
                    <!-- Add more fields for editing event details -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-regular fa-floppy-disk"></i>
                        Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Event Modal -->


<script>
    $(".edit-shift.modal-trigger").on('click', function() {

        let shift_id = $(this).data('shift-id');
        console.log(shift_id);

        //  fetch the announcement data using AJAX
        $.ajax({
            url: base_url + 'datatablec/shift_select', // Replace with your backend endpoint
            method: 'POST',
            data: {
                'shift_id': shift_id
            },
            dataType: 'json',
            success: function(response) {
                console.log("posted : ", shift_id)
                console.log(response)
                $("#edit_shift_id").val(response.data.id)
                $("#edit_shift_label").val(response.data.group_)
                $("#edit_shift_description").val(response.data.description)
                $("#edit_shift_time_start").val(response.data.time_from)
                $("#edit_shift_time_end").val(response.data.time_to)

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Assuming you have a button or form submission triggering this event
    $('#edit_shift_form').on('submit', function(e) {
        e.preventDefault();

        // Get the values from your form or wherever they are stored
        var id = $('#edit_shift_id').val();
        var group = $('#edit_shift_label').val();
        var description = $('#edit_shift_description').val();
        var time_from = $('#edit_shift_time_start').val();
        var time_to = $('#edit_shift_time_end').val();

        // Send the AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/shift_update'); ?>',
            data: {
                id: id,
                group: group,
                description: description,
                time_from: time_from,
                time_to: time_to
            },
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == 'success') {
                    //alert(response.message); // Show success message
                    // Optionally, you can perform additional actions here
                    toastr.success('Success! Shift ' + group + ' has been updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    //alert(response.message); // Show error message
                    toastr.error('Error! Shift ' + group + '  has failed to update due to an error.');


                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
                alert('An error occurred while processing your request.'); // Show generic error message
            }
        });
    });
</script>