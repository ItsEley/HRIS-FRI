<div class="modal custom-modal fade" id="leave_modal" tabindex="-1" role="dialog" aria-labelledby="leave_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leave_modal_label">Leave Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <form id="edit_leave_form">
        <div class="mb-3">
            <label for="date_filled" class="form-label"><strong>Date Filled:</strong></label>
            <input type="text" class="form-control" id="date_filled" name="date_filled" value="<?php echo $date_filled; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="date_from" class="form-label"><strong>Date From:</strong></label>
            <input type="text" class="form-control" id="date_from" name="date_from" value="<?php echo $date_from; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="date_to" class="form-label"><strong>Date To:</strong></label>
            <input type="text" class="form-control" id="date_to" name="date_to" value="<?php echo $date_to; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="reason" class="form-label"><strong>Reason:</strong></label>
            <textarea class="form-control" id="reason" name="reason" readonly><?php echo $reason; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label"><strong>Status:</strong></label>
            <input type="text" class="form-control" id="status" name="status" value="<?php echo $status; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="empid" class="form-label"><strong>Employee ID:</strong></label>
            <input type="text" class="form-control" id="empid" name="empid" value="<?php echo $empid; ?>" readonly>
        </div>
    </form>
</div>

        </div>
    </div>
</div>
