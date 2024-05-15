<!-- //** STATE HERE WHERE THE MODAL WAS USED */ -->
<!-- //** eg. hr/hr_report_timesheet.php  */ -->


<style>
    .file-upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    .file-upload-label {
        background-color: #3498db;
        color: #fff;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .file-upload-label:hover {
        background-color: #2980b9;
    }

    .file-upload-label .icon {
        margin-right: 8px;
    }

    .file-drop-area {
        border: 2px dashed #3498db;
        border-radius: 4px;
        padding: 16px;
        text-align: center;
        width: 100%;
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .file-drop-area:hover {
        border-color: #2980b9;
    }

    .file-drop-area .text {
        color: #3498db;
    }

    .file-input {
        display: none;
    }
</style>

<!-- Attendance file upload -->
<div id="attendance_fileup" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload_note">
                    <p><b>Note : </b> Please make sure that the file your uploading adhere's to the column format :</p>
                    <div>
                        <table class="table table-bordered align-middle" name="example_template">
                            <thead>
                                <th>Name</th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Time in</th>
                                <th>Time out</th>

                            </thead>
                            <tbody>
                                <td>Jason Magsino</td>
                                <td>1000256</td>
                                <td>2024-05-05</td>
                                <td>08:00:00</td>
                                <td>17:00:00</td>
                            </tbody>
                        </table>
                    </div>
                    <p>Make sure the file is in <b>CSV (Comma Delimited), UTF-8 format</b></p>
                </div>
                <form id="import_attendance_csv" method="post" enctype="multipart/form-data">
                    <div class="file-upload-container">
                        <label for="fileInput" class="file-upload-label">
                            <span class="icon"><i class="fas fa-upload"></i></span>
                            <span class="text">Upload File</span>
                        </label>
                        <input type="file" id="fileInput" name = "fileInput" class="file-input" accept=".csv" />

                    </div>
                </form>




            </div>
        </div>
    </div>
</div>
<!-- /Attendance file upload -->

<div class="modal fade" id="excelColumnsModal" tabindex="-1" role="dialog" aria-labelledby="excelColumnsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document"> <!-- Added modal-xl class for large size -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelColumnsModalLabel">Excel File Columns</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="excelColumnsBody" style="overflow-x: auto;">
                <!-- Excel file columns will be displayed here -->
            </div>
            <div class="modal-footer">
                <!-- Move the Upload Excel button here -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- < id="import_attendance_csv" method="post" name="upload_excel_attendance" enctype="multipart/form-data" style="display: inline;"> -->
                <div id="upload_btn" class="form-group" style="display: inline;">
                    <button type="button" id="import_attendance" name="Import_attendance" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Excelx
                    </button>
</div>

            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {

        previewFileCsv('fileInput', 'excelColumnsModal', 'excelColumnsBody');

        $("#import_attendance").on('click',function(){
            $("#import_attendance_csv").submit();

            
        })



    });
</script>