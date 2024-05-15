<style>
    input[readonly],
    textarea[readonly] {
        background-color: white !important;
        box-shadow: none;
        cursor: default;
    }
</style>

<!-- Main Wrapper --><meta charset="UTF-8">

<div class="main-wrapper">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Pending Requests</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pendings</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <!-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_employee"><i class="fa-solid fa-plus"></i> Add Employee</a> -->
                        <div class="view-icons">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                   

                </div> -->
                <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->select('COUNT(*) as count');
                    $this->db->from('f_leaves');
                    $this->db->where('status', 'Approved');
                    $this->db->where('CURDATE() BETWEEN date_from AND date_to');

                    // Execute the query
                    $query = $this->db->get();
                    $data['count'] = $query->row_array()['count'];
                    $data['label'] = "Active Leaves";

                    // $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div> -->
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('f_overtime');
                    $this->db->where('status', 'approved');
                    $this->db->where('date_ot', date('Y-m-d'));
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active Overtime";
                    // $this->load->view('components/card-dash-widget', $data)
                    ?>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('f_undertime');
                    $this->db->where('status', 'approved');
                    $this->db->where('date_of_undertime', date('Y-m-d'));
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active Undertime";
                    // $this->load->view('components/card-dash-widget', $data)
                    ?>
                </div>
            </div>

            <div class="row">
                <div id="csv_preview" class="timeline-panel" hidden></div>

            </div>


            <div class="row">
                <!-- Add Bootstrap Modal container with custom classes -->
                <!-- Add Bootstrap Modal container with custom classes -->
              


                <!-- Your existing form code -->
                <form class="form-horizontal" id="import_csv" method="post" name="upload_excel"accept-charset="UTF-8" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Import Data</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4" >
                                <label for="csvFileInput" style="border: 1px solid #ccc; display: inline-block; padding: 8px 16px; cursor: pointer; background-color: #f9f9f9; color: #333; border-radius: 4px;">
                                    <i class="fa fa-cloud-upload"></i> Choose Excel File
                                </label>
                                <input type="file" name="file" id="csvFileInput" class="input-large" style="display: none;">
                            </div>
                        </div>
                        <div class="row">
                            <div id="csv_preview" class="col-md-8 col-md-offset-2" hidden></div>
                        </div>
                        <div id="upload_btn" class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                                <button type="submit" id="submit_import" name="Import" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Excel
                                </button>
                            </div>
                        </div>
                    </fieldset>
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
                                <form id="import_csv" method="post" name="upload_excel"accept-charset="UTF-8"  enctype="multipart/form-data" style="display: inline;">
                                    <div id="upload_btn" class="form-group" style="display: inline;">
                                        <button type="submit" id="submit_import" name="Import" class="btn btn-primary">
                                            <i class="fas fa-upload"></i> Upload Excel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </form>

            </div>

            <a href="#" id="exportBtn" style="display: inline-block; padding: 8px 16px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 4px; cursor: pointer;">
                <i class="fas fa-download"></i> </i> Download to Excel
            </a>




        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<script>
   
$(document).ready(function () {
    previewFileCsv('csvFileInput', 'excelColumnsModal', 'excelColumnsBody');


})

</script>

