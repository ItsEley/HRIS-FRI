<style>
    #emp_attendance_table>thead th {
        border: none;
    }

    @media print {

        body {
            visibility: hidden;
        }

        @page {
            /* size: landscape */
        }

        #report_header {
            display: block !important;
            /* visibility: visible; */
            /* position: absolute; */

        }

        #print-area {
            visibility: visible;
            position: absolute;
            top: 0px;
            left: -221px;
            width: max-content;
            max-width: 100vw;
            transform: scale(.99);
            /* margin: 20px; */
        }

     


    }
</style>


<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->
    <!-- Two Col Sidebar -->

    <!-- /Two Col Sidebar -->
    <!-- Page Wrapper -->
    <div class="page-wrapper" style="width:-webkit-fill-available;
                                    min-height: -webkit-fill-available;">

        <!-- Page Content -->
        <div class="content container-fluid" data-select2-id="select2-data-23-5b7q">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Employee Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <button class="btn btn-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Print as PDF</button>
                        <!-- <div class="view-icons">
                            <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                            <a href="employees-list.html" class="list-view btn btn-link"><i class="fa-solid fa-bars"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

          

            <div id="print-area">

                <h1 class="text-center" style="display:none" id="report_header">Employee Attendance Report - March 2024</h1>

                <div class="row legend timeline-panel" id="emp_att_legend">
                    <div class="d-flex justify-content-between">
                        <!-- <h3>Legend</h3> -->
                        <p class="m-0"><span class="att-p"></span> - Present</p>
                        <p class="m-0"><span class="att-o"></span> - On time</p>
                        <p class="m-0"><span class="att-l"></span> - Late</p>
                        <p class="m-0"><span class="att-a"></span> - Absent</p>
                        <p class="m-0"><span class="att-d"></span> - Day-off</p>
                        <p class="m-0"><span class="att-e"></span> - On Leave</p>
                        <p class="m-0"><span class="att-h"></span> - Half-day</p>
                        <p class="m-0"><span class="att-b"></span> - On Official Business</p>
                        <p class="m-0"><span class="att-n"></span> - No Work Day</p>
                    </div>
                    <div class="col-4"></div>
                </div>


                <div class="row timeline-panel">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped " id="emp_attendance_table">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>24</th>
                                        <th>25</th>
                                        <th>26</th>
                                        <th>27</th>
                                        <th>28</th>
                                        <th>29</th>
                                        <th>30</th>
                                        <th>31</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="emp_id">
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-xs" href="profile.html"><img src="<?php echo base_url('assets\img\user.jpg') ?>" alt="User Image"></a>
                                                <a href="profile.html">John Doe</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-a m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-l m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-l m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-b m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-e m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-p m-0 p-0"></p>
                                        </td>
                                        <td>
                                            <p class="att-a m-0 p-0"></p>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->



        <!-- MODALS -->


    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->



<!-- Attendance Modal -->
<div class="modal custom-modal fade" id="attendance_info" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attendance Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card punch-status">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                                <div class="punch-det">
                                    <h6>Punch In at</h6>
                                    <p>Wed, 11th Mar 2019 10.00 AM</p>
                                </div>
                                <div class="punch-info">
                                    <div class="punch-hours">
                                        <span>3.45 hrs</span>
                                    </div>
                                </div>
                                <div class="punch-det">
                                    <h6>Punch Out at</h6>
                                    <p>Wed, 20th Feb 2019 9.00 PM</p>
                                </div>
                                <div class="statistics">
                                    <div class="row">
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Break</p>
                                                <h6>1.21 hrs</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 text-center">
                                            <div class="stats-box">
                                                <p>Overtime</p>
                                                <h6>3 hrs</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card recent-activity">
                            <div class="card-body">
                                <h5 class="card-title">Activity</h5>
                                <ul class="res-activity-list">
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            10.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            11.00 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            11.15 AM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            1.30 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch In at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            2.00 PM.
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">Punch Out at</p>
                                        <p class="res-activity-time">
                                            <i class="fa-regular fa-clock"></i>
                                            7.30 PM.
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Attendance Modal -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/employees/attendance') ?>']").parent().parent().css("display", "block")







    })
</script>