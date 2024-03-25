<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->
    <!-- Two Col Sidebar -->

    <!-- /Two Col Sidebar -->
    <!-- Page Wrapper -->
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Requests History</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Request History</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">

                        <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->



            <!-- Data table -->
            <div class="row timeline-panel">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="dt_announcements" class="datatable table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Author</th>
                                    <th>Department</th>
                                    <th>Date Created</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = $this->db->order_by('date_created', 'DESC')->get('announcement');
                                foreach ($query->result() as $row) {
                                    $ann_id = $row->id;
                                    $title = $row->title;
                                    $content = $row->content;
                                    $author = $row->author;
                                    // $department = $row->department;
                                    $date = $row->date_created;
                                ?>
                                    <tr class="hoverable-row">
                                        <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                            <?php echo $title; ?>
                                        </td>
                                        <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                            <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                                <?php echo $content; ?>
                                            </div>
                                        </td>

                                        <td><?php echo $author; ?></td>
                                        <td><?php //echo $department; 
                                            ?> {not implemented yet}</td>
                                        <td><?php echo date('M j, Y', strtotime($date)); ?></td>

                                        <td>
                                        <div class="dropdown">
                                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="material-icons">more_vert</i>
                                                                    </a>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_<?php echo $ann_id ?>">
                                                                        <a class="dropdown-item edit-employee" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee" data-emp-id="<?php echo $ann_id ?>">
                                                                            <i class="fa-solid fa-pencil m-r-5"></i> Edit
                                                                        </a>
                                                                        <a class="dropdown-item delete-employee" href="#" data-bs-toggle="modal" data-bs-target="#delete_approve_<?php echo $ann_id ?>">
                                                                            <i class="fa-regular fa-trash-can m-r-5"></i> Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>
<!-- /Page Content -->






</div>
<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/historyrequests') ?>']").parent().parent().css("display", "block") //get sidebar item with link
        $("li > a[href='<?= base_url('hr/historyrequests') ?>']").addClass("active"); // for items inside the sidebar




    })
</script>