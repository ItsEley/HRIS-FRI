<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_department_roles.php  */ -->


<div class="modal fade" id="modal_create_roles" tabindex="-1" aria-labelledby="modal_create_rolesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_create_rolesLabel">Add Roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form id="create_roles_form">


                    <div class="mb-3 row" style="width:90%">
                        <label for="create_role_title" class="form-label col-3 m-auto text-center">Role title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control col" placeholder="e.g CEO, Manager" id="create_role_title" name="create_role_title" required>
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label for="create_role_description" class="form-label col-3 m-auto text-center">Description</label>
                        <input type="text" class="form-control col" placeholder="e.g Responsible for managing" id="create_role_description" name="create_role_description">
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label class="col-form-label col-3" for = "create_role_epartment">Department<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="create_role_department" id="create_role_department" >

                            <?php
                            $query = $this->db->query('SELECT * FROM `department` ORDER BY department ASC');
                            $departments = $query->result();
                            foreach ($departments as $department) {
                                echo "<option value = '$department->id'>$department->department</option>";
                            } ?>

                        </select>
                    </div>


                    <div class="mb-3 row" style="width:90%">
                        <label for="create_role_salary" class="form-label col-3 m-auto text-center">Salary<span class="text-danger">*</span></label>
                        <input type="number" class="form-control col" placeholder="e.g ₱21,000" id="create_role_salary" name="create_role_salary" required>
                    </div>

                    <div class="mb-3 row" style="width:90%">
                        <label for="create_role_salary_type" class="form-label col-3 m-auto text-center">Salary Type<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="create_role_salary_type" id = "create_role_salary_type" required>
                            <option value="Monthly">Monthly</option>
                            <option value="Hourly">Hourly</option>
                            <option value="Contractual">Contractual</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary float-end"><i class="fa-solid fa-plus"></i> Create</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#create_roles_form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize form data
        var formData = $(this).serialize();

        console.log(formData);
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('datatablec/department_role_insert'); ?>',
            data: formData,
            dataType: 'json',
            success: function(response) {

                console.log(response)
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
});
</script>
