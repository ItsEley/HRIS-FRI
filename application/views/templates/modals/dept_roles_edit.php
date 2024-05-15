<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_department_roles.php  */ -->


<div class="modal fade" id="modal_edit_roles" tabindex="-1" aria-labelledby="modal_edit_rolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_edit_rolesLabel">Add Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form id="edit_roles_form">

                <input type="text" id = "edit_role_id" name = "edit_role_id">

                    <div class="mb-3 row" style="width:90%">
                        <label for="edit_role_title" class="form-label col-3 m-auto text-center">Role title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control col" placeholder="e.g CEO, Manager" id="edit_role_title" name="edit_role_title" required>
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label for="edit_role_description" class="form-label col-3 m-auto text-center">Description</label>
                        <input type="text" class="form-control col" placeholder="e.g Responsible for managing" id="edit_role_description" name="edit_role_description">
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label class="col-form-label col-3" for = "edit_role_epartment">Department<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="edit_role_department" id="edit_role_department" >

                            <?php
                            $query = $this->db->query('SELECT * FROM `department` ORDER BY department ASC');
                            $departments = $query->result();
                            foreach ($departments as $department) {
                                echo "<option value = '$department->id'>$department->department</option>";
                            } ?>

                        </select>
                    </div>


                    <div class="mb-3 row" style="width:90%">
                        <label for="edit_role_salary" class="form-label col-3 m-auto text-center">Salary<span class="text-danger">*</span></label>
                        <input type="number" class="form-control col" placeholder="e.g ₱21,000" id="edit_role_salary" name="edit_role_salary" required>
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label for="edit_role_salary_type" class="form-label col-3 m-auto text-center">Salary Type<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="edit_role_salary_type" id = "edit_role_salary_type" required>
                            <option value="Monthly">Monthly</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Contractual">Contractual</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary float-end"><i class="fa-solid fa-plus"></i> edit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

$('button[data-bs-target="#modal_edit_roles"]').on('click', function() {
            // Your code here
            console.log("Button clicked:", this);
            // Example: Get data attributes
            let role_id = $(this).data('role-id');
            let role_title = $(this).data('role-title');
            let description = $(this).data('role-desc');
            let department_id = $(this).data('department-id');
            let salary = $(this).data('role-salary');
            let salary_type = $(this).data('role-salary-type');


            $("#modal_edit_roles input#edit_role_id").val(role_id);
            $("#modal_edit_roles input#edit_role_title").val(role_title);
            $("#modal_edit_roles input#edit_role_description").val(description);
            $("#modal_edit_roles input#edit_role_department").val(department_id);
            $("#modal_edit_roles input#edit_role_salary").val(salary);
            $("#modal_edit_roles input#edit_role_salary_type").val(salary_type);


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