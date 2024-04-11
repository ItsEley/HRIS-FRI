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