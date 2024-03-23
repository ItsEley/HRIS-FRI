<!-- Main Wrapper -->
<div class="main-wrapper">
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
                        <h3 class="page-title">Calendar</h3>
                        <ul class="breadcrumb" hidden>
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
                            <li class="breadcrumb-item active">Timesheet</li>
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


            <!-- data table -->
            <div class = "row" id = "change_cal_view">
                    <button onclick="calendar.changeView('day');">Day</button>
                    <button onclick="calendar.changeView('week');">Week</button>
                    <button onclick="calendar.changeView('month');">Month</button>
                    <button onclick="calendar.changeView('year');">Year</button>


                </div>

            <div class="row timeline-panel" style = "min-height:400px">
                



                <!-- Calendar -->
                <div id="calendar" class="fc fc-unthemed fc-ltr" style = "height:auto"></div>
                <!-- /Calendar -->



            </div>
            <!-- /data table -->

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<!-- Calendar JS -->

<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script> -->

<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>

<script>
    $(document).ready(function() {
        $("li > a[href='<?= base_url('hr/calendar') ?>']").parent().addClass("active");

        /* in the browser environment namespace */
const Calendar = tui.Calendar;

         Calendar = new Calendar('#calendar', {
            defaultView: 'month',
            template: {
                time(event) {
                    const {
                        start,
                        end,
                        title
                    } = event;

                    return `<span style="color: white;">${formatTime(start)}~${formatTime(end)} ${title}</span>`;
                },
                allday(event) {
                    return `<span style="color: gray;">${event.title}</span>`;
                },
            },
            calendars: [{
                    id: 'cal1',
                    name: 'Personal',
                    backgroundColor: '#03bd9e',
                },
                {
                    id: 'cal2',
                    name: 'Work',
                    backgroundColor: '#00a9ff',
                },
            ],
        });


      

        Calendar.createEvents([
  {
    id: '1',
    calendarId: 'calendar',
    title: 'my event',
    category: 'date',
    dueDateClass: '',
    start: '2023-04-21T22:30:00+09:00',
    end: '2023-04-21T02:30:00+09:00',
  },
  {
    id: '2',
    calendarId: 'calendar',
    title: 'second event',
    category: 'date',
    dueDateClass: '',
    start: '2023-03-22T17:30:00+09:00',
    end: '2023-03-22T17:31:00+09:00',
  },
]);

    });
</script>