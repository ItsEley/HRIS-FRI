<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_announcment.php  */ -->

<div id="modal_announcement_create" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Create Announcement</h4>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form method="post" id="add_announcement">
                   <div class="modal-body p-4">

                       <div class="input-block mb-3 row">
                           <label class="col-form-label col-md-2">Title</label>

                           <div class="col-md-10">
                               <input type="text" class="form-control" name="title" placeholder="Title" required>
                           </div>

                           <input type="text" name="selected_dept" id="selected_dept" hidden required>
                           <input type="text" name="author" id="author" value = "<?= $_SESSION['id']?>" hidden>


                       </div>

                       <div class="input-block mb-3 row">
                           <label class="col-form-label col-md-2">Department</label>
                           <div class="col-md-10">



                               <?php

                                echo ' <input type="checkbox" class="btn-check" id="select_all" group="dept_multi" autocomplete="off">
                                <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="select_all" style = "font-size:12px;margin:2px">All</label>';

                                //get select-options
                                $query =  $this->db->get('department');
                                $data['query'] = $query;
                                // Check if query executed successfully
                                if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {

                                        // Output each department as an option
                                        echo '
                                        <input type="checkbox" class="btn-check" id="dept_' . $row->id . '" value = "' . $row->id . '" group="dept_multi" autocomplete="off">
                                        <label class="btn btn-light btn-rounded d-inline-flex w-auto" for="dept_' . $row->id . '" style = "font-size:12px;margin:2px">' . $row->department . '</label>';

                                        // echo '<option value="' . $row->id . '">' .  $row->department . '</option>';
                                    }
                                } else {
                                    // Handle no results from the database
                                    echo '<option value="">No departments found</option>';
                                }
                                ?>
                           </div>
                       </div>


                       <!-- Hidden input field to store Summernote content -->
                       <input type="hidden" name="editor_content" id="editor_content" required>
                       <!-- Editor container -->
                       <div id="editor" name="content"></div>



                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>

                       <button type="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                   </div>
           </div>
           </form>
       </div>
   </div>