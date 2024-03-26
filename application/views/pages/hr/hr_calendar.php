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
      <!-- <div class="row justify-content-center m-0 p-0">
      <div class="btn-group m-0 p-0" role="group">
        <button type="button" class="btn btn-secondary" onclick="calendar.changeView('day');">Day</button>
        <button type="button" class="btn btn-secondary" onclick="calendar.changeView('week');">Week</button>
        <button type="button" class="btn btn-secondary" onclick="calendar.changeView('month');">Month</button>
        <button type="button" class="btn btn-secondary" onclick="calendar.changeView('year');">Year</button>
      </div>
    </div> -->
      <div class="row timeline-panel m-0 p-3" style="min-height:400px">




        <!-- Calendar -->
        <div id="calendar" class="fc fc-unthemed fc-ltr " style="height:auto"></div>
        <!-- /Calendar -->



      </div>
      <!-- /data table -->

    </div>
    <!-- /Page Content -->

  </div>
  <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->



<script>
  document.addEventListener('DOMContentLoaded', function() {
    $("li > a[href='<?= base_url('hr/calendar') ?>']").parent().addClass("active");



    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'sandstone',
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listYear'
      },
      editable: true,
      selectable: true,
      select: function(arg) {
        var title = prompt('Enter event title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          });
        }
        calendar.unselect();
      },
      eventAdd: function(info) {
        // This function is triggered when a new event is added to the calendar
        // Here you can get the newly added event info and send it to the server if needed
        var eventData = {
          title: info.event.title,
          start: info.event.start,
          end: info.event.end,
          allDay: info.event.allDay
        };

        console.log(eventData)
        // Send the eventData object to the server using AJAX
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url('calendar/event/add'); ?>', // Specify your server endpoint to handle the new event data
          data: eventData,
          success: function(response) {
            // Handle success response from the server
            console.log('Event added successfully:', response);
          },
          error: function(xhr, status, error) {
            // Handle error
            console.error('Error adding event:', error);
          }
        });
      },
      events: [
        <?php
        $query = $this->db->query('SELECT * FROM `sys_holidays`');

        foreach ($query->result() as $row) {
          echo '{';
          echo "title : '$row->holiday_name',";
          echo "start : '$row->date_start',";
          echo "start : '$row->date_end'";
          echo '},';
        }
        ?>

      ]
    });


    calendar.render();



  });
</script>