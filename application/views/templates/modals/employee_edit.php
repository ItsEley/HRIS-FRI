<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_employee.php  */ -->

<!-- Edit Employee Modal -->
<div id="edit_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form id="edit_employee" enctype="multipart/form-data" method="post">
                    <input class="form-control" type="hidden" name="emp_id">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                <input class="form-control" value="" type="text" name="fname">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Middle Name</label>
                                <input class="form-control" value="" type="text" name="mname">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" value="" type="text" name="lname">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Nickname <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="nickn">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Current Address</label>
                                <input class="form-control" type="text" name="current_add">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Permanent Address</label>
                                <input class="form-control" type="text" name="perm_add">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Date Of Birth <span class="text-danger">*</span></label>
                                <div class="cal-icon"><input class="form-control" name="dob" type="date"></div>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Religion </label>
                                <input class="form-control" type="text" name="religion">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Sex</label>
                                <select class="select form-control" name="sex">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Civil Status </label>
                                <select class="select form-control" name="civil_status">
                                    <option value="N/A">N/A</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Live In">Live In</option>
                                    <option value="Widowed">Widowed</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Place of Birth <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="pob">
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-block mb-3">
                                <label class="col-form-label">Contact Number <span class="text-danger">*</span></label>
                                <input class="form-control input-mask" type="text" name="contact_no">

                            </div>
                        </div>

                    </div>

                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Employee Modal -->