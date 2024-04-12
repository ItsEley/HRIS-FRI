<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_departments.php  */ -->



<div class="modal fade" id="modal_edit_department" tabindex="-1" aria-labelledby="modal_edit_departmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_departmentLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit_department">
                    <input type="text" id = "edit_department_id" name = "edit_department_id" hidden>

                    <div class="mb-3">
                        <label for="department_name" class="form-label ">Department</label>
                        <input type="text" class="form-control" id="edit_department_name" name="edit_department_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="dept_acronym" class="form-label ">Acronym</label>
                        <input type="text" class="form-control" id="edit_dept_acronym" name="edit_dept_acronym"
                        placeholder="e.g 'HR','IT','SALES','RND'" required>
                    </div>
                 
                    <!-- Add more fields for editing event details -->
                    <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save" aria-hidden="true"></i> Save</button>

                    </div>
               

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(".edit-department.modal-trigger").on('click', function() {

        let department_id = $(this).data('dept-id');
        console.log(department_id);

        //  fetch the announcement data using AJAX
        $.ajax({
            url: base_url + 'datatablec/department_select', // Replace with your backend endpoint
            method: 'POST',
            data: {
                'department_id': department_id
            },
            dataType: 'json',
            success: function(response) {
                console.log("posted : ", department_id)
                console.log(response)
                $("#edit_department_id").val(response.data.id)
                $("#edit_department_name").val(response.data.department)
                $("#edit_dept_acronym").val(response.data.acro_dept)
   

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Assuming you have a button or form submission triggering this event
    $('#form_edit_department').on('submit', function(e) {
        e.preventDefault();

        // Get the values from your form or wherever they are stored
        var id = $("#edit_department_id").val()
        var department = $("#edit_department_name").val()
        var acro_dept = $("#edit_dept_acronym").val()

        // Send the AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/department_update'); ?>',
            data: {
                id: id,
                department: department,
                acro_dept: acro_dept
   
            },
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server
                if (response.status == 'success') {
                    //alert(response.message); // Show success message
                    // Optionally, you can perform additional actions here
                    toastr.success('Success! Department ' + department + ' has been updated.');
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    //alert(response.message); // Show error message
                    toastr.error('Error! Department ' + department + '  has failed to update due to an error.');


                }
            },
            error: function(xhr, status, errorThrown) {
    console.error(xhr.responseText); // Log the full response text for reference
    // Parse the response text to extract the error message
    var errorMessage = $(xhr.responseText).find('p:contains("Message:")').text().trim();
    console.error("Error message:", errorMessage); // Log the extracted error message
    // alert('An error occurred while processing your request.\nError message: ' + errorMessage); // Show generic error message with the extracted error message
}

        });
    });
</script>