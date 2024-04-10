<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_shifts.php  */ -->



<!-- Edit Event Modal -->
<div class="modal fade" id="modal_delete_shift" tabindex="-1" aria-labelledby="modal_delete_shiftLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_shiftLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                <form id="delete_shift_form">
                <input type="text" id = "delete_shift_id" name = "delete_shift_id" hidden>

               

                <img src="<?php echo base_url('assets\img\icons\exclamation-mark.png')?>" alt="danger"
                     class = "p-2" style = "width:80px;">
               
                <h4>Are you sure you want to delete 
                &ldquo;<span id = "delete_group_label" style="font-weight: 700;">{Group Label}</span>&rdquo;?</h4>
                <p>Once confirmed, you won't be able to revert this process.</p>

                <button type = "button" class = "btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">No, nevermind.</button>
                <button type = "submit" class = "btn btn-danger" >Yes, delete it!</button>
                </form>

                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- /Edit Event Modal -->


<script>
let shift_label;

    $(".delete-shift.modal-trigger").on('click', function() {

        let shift_id = $(this).data('shift-id');
         shift_label = $(this).data('shift-label');

        $("#delete_group_label").html(shift_label);
        $("#delete_shift_id").val(shift_id);
        // console.log( $("#delete_shift_id").val());

       
    });

    // Assuming you have a button or form submission triggering this event
    $('#delete_shift_form').on('submit', function(e) {
        e.preventDefault();

        // Get the values from your form or wherever they are stored
        // var id = $('#delete_shift_id').val();
        var formData = $(this).serialize(); // Serialize the form data

        // Send the AJAX request
        console.log(formData)
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/shift_delete'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == 'success') {
                    //alert(response.message); // Show success message
                    // Optionally, you can perform additional actions here
                    toastr.success('Success! Shift &ldquo;' + shift_label + ' &rdquo; has been deleted.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    //alert(response.message); // Show error message
                    toastr.error('Error! Shift &ldquo;' + shift_label + '&rdquo; has failed to delete due to an error.');


                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
                alert('An error occurred while processing your request.'); // Show generic error message
            }
        });
    });
</script>