<!-- Modal -->
<?php  $this->load->view('templates/header');?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($row)): ?>
                    <?php if($requestType === 'LEAVE REQUEST'): ?>
                        <p>ID: <?php echo $row['id']; ?></p>
                        <p>Date Filled: <?php echo $row['date_filled']; ?></p>
                        <p>Date From: <?php echo $row['date_from']; ?></p>
                        <p>Date To: <?php echo $row['date_to']; ?></p>
                        <p>Reason: <?php echo $row['reason']; ?></p>
                        <p>Employee ID: <?php echo $row['emp_id']; ?></p>
                    <?php elseif($requestType === 'offbusiness'): ?>
                        <p>ID: <?php echo $row['id']; ?></p>
                        <p>Date Filled: <?php echo $row['date_filled']; ?></p>
                        <p>Date: <?php echo $row['date']; ?></p>
                        <p>Destination From: <?php echo $row['destination_from']; ?></p>
                        <p>Destination To: <?php echo $row['destination_to']; ?></p>
                        <p>Reason: <?php echo $row['reason']; ?></p>
                        <p>Employee ID: <?php echo $row['emp_id']; ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
