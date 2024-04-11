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