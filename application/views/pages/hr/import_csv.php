<style>
    input[readonly],
    textarea[readonly] {
        background-color: white !important;
        box-shadow: none;
        cursor: default;
    }
</style>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">

    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <div class="page-wrapper w-100">
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
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <?php

                    $total_count = 0;
                    $this->db->from('vw_emp_leaves');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_outgoing');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_overtime');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_undertime');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $this->db->from('f_off_bussiness');
                    $this->db->where('status', 'pending');
                    $total_count += $this->db->count_all_results();
                    $data['icon'] = "fa fa-address-book";
                    $data['count'] = $total_count;
                    $data['label'] = "Requests Pending";
                    $this->load->view('components/card-dash-widget', $data)
                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

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

                    $this->load->view('components/card-dash-widget', $data)

                    ?>

                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">

                    <?php
                    $data['icon'] = "fa fa-address-book";

                    $this->db->from('f_overtime');
                    $this->db->where('status', 'approved');
                    $this->db->where('date_ot', date('Y-m-d'));
                    $data['count'] = $count = $this->db->count_all_results();;
                    $data['label'] = "Active Overtime";
                    $this->load->view('components/card-dash-widget', $data)
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
                    $this->load->view('components/card-dash-widget', $data)
                    ?>
                </div>
            </div>

            <div class="row">
                <div id="csv_preview" class="timeline-panel" hidden></div>

            </div>


            <div class="row">
                <form class="form-horizontal" id="import_csv" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Import Data</legend>

                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <label for="csvFileInput" style="border: 1px solid #ccc; display: inline-block; padding: 8px 16px; cursor: pointer; background-color: #f9f9f9; color: #333; border-radius: 4px;">
                                    <i class="fa fa-cloud-upload"></i> Choose File
                                </label>
                                <input type="file" name="file" id="csvFileInput" class="input-large" style="display: none;">
                            </div>
                        </div>

                        <!-- CSV Preview -->
                        <div class="row">
                            <div id="csv_preview" class="col-md-8 col-md-offset-2" hidden></div>
                        </div>

                        <!-- Import Button -->
                        <div id="upload_btn" class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                                <button type="submit" id="submit_import" name="Import" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Excel
                                </button>
                            </div>
                        </div>

                    </fieldset>
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
$(document).ready(function() {
    // Check if there are any tables inside the CSV preview
    if ($('#csv_preview').find('table').length > 0) {
        $('#upload_btn').show();
    } else {
        $('#upload_btn').hide();
    }
});


    document.getElementById('csvFileInput').addEventListener('change', function(e) {

        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var lines = e.target.result.split('\n');
            var html = '<table>';
            lines.forEach(function(line, index) {
                html += '<tr>';
                var cells = line.split(',');
                cells.forEach(function(cell) {
                    html += index === 0 ? '<th>' + cell + '</th>' : '<td>' + cell + '</td>';
                });
                html += '</tr>';
            });
            html += '</table>';

            document.getElementById('csv_preview').innerHTML = html;
            document.getElementById('csv_preview').removeAttribute('hidden');

        };

        reader.readAsText(file);
    });
</script>
