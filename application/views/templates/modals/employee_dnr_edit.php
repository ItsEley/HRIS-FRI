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
                        <input type="text" name="edit_dnr_emp_id" id="edit_dnr_emp_id" readonly>
                        <p>Edit employee role for <b><span id="edit_dnr_empname">NAME</span></b></p>
                    </div>


                    <div class="mb-3 row" style="width:90%">
                        <label class="col-form-label col-3" for="edit_role_epartment">Role<span class="text-danger">*</span></label>
                        <select class="form-select form-control col" name="edit_role_department" id="edit_role_department">

                            <?php
                            $query = $this->db->query(' SELECT dr.id, dr.roles, dr.description, dr.department,  d.department AS department_name,dr.salary, dr.salary_type
                            FROM department_roles dr
                            LEFT JOIN employee e ON dr.id = e.role
                            LEFT JOIN department d ON dr.department = d.id
                            WHERE e.role IS NULL
                            ORDER BY dr.roles ASC');
                            $department_roles = $query->result();
                            foreach ($department_roles as $role) {
                                echo "<option value = '$role->id' data-department = '$role->department_name' data-department-id = '$role->department'>$role->roles</option>";
                            } ?>

                            <option value="null" style = "color:red">Remove role</option>

                        </select>
                    </div>

                    <div class="mb-3">
                        <p>This role is part of <b><span id="role_department">department</span></b> department.</p>
                    </div>

            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-xmark"></i> Close</button>
                        <button type="submit" class="btn btn-primary float-end"><i class="fa-solid fa-pencil"></i> Save</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>


function update_corr_dept(){
    // Get the data-department attribute of the selected option
    var department = $('#edit_role_department').find(':selected').data('department');
    
    // Update the span content
    $("#modal_edit_dnr span#role_department").html(department);
    
    // Log the updated content

    // console.log($("#modal_edit_dnr span#role_department").html());
}


    $('button[data-bs-target="#modal_edit_dnr"]').on('click', function() {
        // Your code here
        // console.log("Button clicked:", this);

        update_corr_dept();
        // Example: Get data attributes
        let emp_name = $(this).data('emp-name');
        let emp_id = $(this).data('emp-id');


        $("#modal_edit_dnr input#edit_dnr_emp_id").val(emp_id);
        $("#modal_edit_dnr span#edit_dnr_empname").html(emp_name);




    });

    $("#edit_role_department").on('change',function(){
        update_corr_dept();

    })



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