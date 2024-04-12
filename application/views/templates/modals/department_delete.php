<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_departments.php  */ -->

<div class="modal fade" id="modal_delete_department" tabindex="-1" aria-labelledby="modal_delete_departmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_delete_departmentLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center">
                <form id="delete_department_form">
                <input type="text" id = "delete_department_id" name = "delete_department_id" hidden>

               

                <img src="<?php echo base_url('assets\img\icons\exclamation-mark.png')?>" alt="danger"
                     class = "p-2" style = "width:80px;">
               
                <h4>Are you sure you want to delete 
                &ldquo;<span id = "delete_group_label" style="font-weight: 700;">{Department}</span>&rdquo;?</h4>
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
let department_label;

    $(".delete-department.modal-trigger").on('click', function() {

        let department_id = $(this).data('dept-id');
         department_label = $(this).data('dept-label');

        $("#delete_group_label").html(department_label);
        $("#delete_department_id").val(department_id);
        // console.log( $("#delete_department_id").val());

       
    });

    // Assuming you have a button or form submission triggering this event
    $('#delete_department_form').on('submit', function(e) {
        e.preventDefault();

        // Get the values from your form or wherever they are stored
        // var id = $('#delete_department_id').val();
        var formData = $(this).serialize(); // Serialize the form data

        // Send the AJAX request
        console.log(formData)
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/department_delete'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == 'success') {
                    //alert(response.message); // Show success message
                    // Optionally, you can perform additional actions here
                    $("#modal_delete_department").modal('toggle');
                    toastr.success('Success! department &ldquo;' + department_label + ' &rdquo; has been deleted.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                    
                } else {
                    //alert(response.message); // Show error message
                    toastr.error('Error! department &ldquo;' + department_label + '&rdquo; has failed to delete due to an error.');


                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
                alert('An error occurred while processing your request.'); // Show generic error message
            }
        });
    });
</script>