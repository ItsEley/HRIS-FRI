<style>
  input[type="checkbox"] {
    width: 15px; /* Adjust width as needed */
    height: 15px; /* Adjust height as needed */
  }
</style>
<div id="payroll" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="standard-modalLabel">Generate Payroll List</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('payroll_hr/generatePayroll')?>" method="post">
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label>From</label>
                <input type="date" class="form-control" name="startdate">
              </div>
              <div class="col-md-6">
                <label>To</label>
                <input type="date" class="form-control" name="enddate">
              </div>
              <br><br><br><br><br>
              <div class="form-group">
                <label>Choose Mandatory/Mandatories included to the payroll <span style="color: red">*</span></label>
                <br><br>
                <div class="row">
                  <div class="col-md-4">
                    <input type="checkbox" class="form-check-input" value="pagibig" name="mandatory[]">
                    <label>PAG-IBIG</label>
                  </div>
                  <div class="col-md-4">
                    <input type="checkbox" class="form-check-input" value="sss" name="mandatory[]">
                    <label>SSS</label>
                  </div>
                  <div class="col-md-4">
                    <input type="checkbox" class="form-check-input" value="philhealth" name="mandatory[]">
                    <label>PHILHEALTH</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-md">Generate Payroll</button>
        </form>
      </div>
    </div>
  </div>
</div>