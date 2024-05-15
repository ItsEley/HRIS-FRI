<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_employees.php  */ -->
<!-- dnr (department and roles) -->


<div class="modal fade" id="modal_edit_dnr" tabindex="-1" aria-labelledby="modal_edit_dnrLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_dnrLabel">Edit Employee Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form id="edit_roles_form">

                    <!-- <input type="text" id="edit_emp_id" name="edit_emp_id"> -->

                    <div class="mb-3">
                        <p>Edit employee role for <b><span id="edit_for">NAME</span></b></p>
                    </div>


                    <div class="mb-3 row" style="width:90%">
                        <label class="col-form-label col-3" for="edit_role_epartment">Role<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="edit_role_department" id="edit_role_department">

                            <?php
                            $query = $this->db->query('SELECT * FROM `department_roles` ORDER BY roles ASC');
                            $department_roles = $query->result();
                            foreach ($department_roles as $role) {
                                echo "<option value = '$role->id'>$role->roles</option>";
                            } ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <p>This role is part of <b><span id="role_department">department</span></b> department.</p>
                    </div>

            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        <button type="submit" class="btn btn-primary float-end"><i class="fa-solid fa-pencil"></i> edit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('button[data-bs-target="#modal_edit_dnr"]').on('click', function() {
        // Your code here
        console.log("Button clicked:", this);
        // Example: Get data attributes
        let role_id = $(this).data('role-id');
        let role_title = $(this).data('role-title');
        let description = $(this).data('role-desc');
        let department_id = $(this).data('department-id');
        let salary = $(this).data('role-salary');
        let salary_type = $(this).data('role-salary-type');


        $("#modal_edit_dnr input#edit_role_id").val(role_id);
        $("#modal_edit_dnr input#edit_role_title").val(role_title);
        $("#modal_edit_dnr input#edit_role_description").val(description);
        $("#modal_edit_dnr input#edit_role_department").val(department_id);
        $("#modal_edit_dnr input#edit_role_salary").val(salary);
        $("#modal_edit_dnr input#edit_role_salary_type").val(salary_type);


    });



    $('#edit_roles_form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/department_role_update'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response
                if (response.success) {
                    // Display success message
                    alert(response.message);
                    // Optionally, you can reload the page or perform other actions
                } else {
                    // Display error message
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Display error message
                alert('Error: ' + error);
            }
        });
    });
</script>