<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_departments.php  */ -->


<div class="modal fade" id="modal_create_department" tabindex="-1" aria-labelledby="modal_create_departmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_departmentLabel">Create Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_create_department">

                    <div class="mb-3">
                        <label for="department_name" class="form-label input-required">Department</label>
                        <input type="text" class="form-control" id="department_name" name="department_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dept_acronym" class="form-label input-required">Acronym</label>
                        <input type="text" class="form-control" id="dept_acronym" name="dept_acronym"
                        placeholder="e.g 'HR','IT','SALES','RND'" required>
                    </div>
                 
                    <!-- Add more fields for createing event details -->
                    <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Create</button>

                    </div>
               

                </form>
            </div>
        </div>
    </div>
</div>


<script>

     // Assuming you have a button or form submission triggering this event
     $('#form_create_department').on('submit', function(e) {
        e.preventDefault();

   
        // Serialize the form data
        var formData = $(this).serialize();
        // Send the AJAX request
        console.log(formData)
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/department_insert'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == 'success') {
                    alert(response.message); // Show success message
                    // Optionally, you can perform additional actions here
                    toastr.success('Success! Shift ' + group + ' has been updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    alert(response.message); // Show error message
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