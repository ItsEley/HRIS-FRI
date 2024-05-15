<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

<!-- FullCalendar core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
<!-- FullCalendar Sandstone theme CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/themes/sandstone.min.css" rel="stylesheet">

<style>
  .fc-daygrid-day-frame.fc-scrollgrid-sync-inner {
    height: 0 !important;
  }
</style>

<!-- Main Wrapper -->
<div class="main-wrapper">
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
            <h3 class="page-title">Calendar</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin-dashboard.html">HR Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ul>
          </div>
          <div class="col-auto float-end ms-auto">
            <button class="btn add-btn" id="btn_holiday_update">
              <i class="fa-solid fa-plus"></i>Update Holidays</button>
            <div class="view-icons">

            </div>
          </div>
        </div>
      </div>
      <!-- /Page Header -->



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


<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form id="addEventForm">

          <div class="row">
            <div class="mb-3">
              <label for="eventTitle" class="form-label input-required">Title</label>
              <input type="text" class="form-control" id="eventTitle" name="event_title" placeholder="Event title" required>
            </div>
            <div class="mb-3">
              <label for="eventTitle" class="form-label input-required">Description</label>
              <textarea type="text" class="form-control" id="event_description" name="event_description" cols="30" rows="2" placeholder="Event description"></textarea>
            </div>
          </div>

          <div class="row">
            <h3>Date</h3>
            <div class="mb-3 col">
              <label for="eventTitle" class="form-label input-required">From</label>
              <input type="date" class="form-control" id="eventStartDate" name="event_date_start" required>
            </div>
            <div class="mb-3 col">
              <label for="eventTitle" class="form-label input-required">To</label>
              <input type="date" class="form-control" id="eventEndDate" name="event_date_end" required>
            </div>
          </div>



          <div class="row">
            <h3>Time <span>
                <label for="toggle_all_day" style="font-size:12px">All day</label>
                <input type="checkbox" name="toggle_all_day" id="toggle_all_day"></span></h3>
            <div class="mb-3 col">
              <label for="eventTitle" class="form-label input-required">From</label>
              <input type="time" class="form-control" id="eventStartDate" name="event_time_start" required>
            </div>
            <div class="mb-3 col">
              <label for="eventTitle" class="form-label input-required">To</label>
              <input type="time" class="form-control" id="eventEndDate" name="event_time_end" required>
            </div>
          </div>

          <!-- Add more fields for date, time, category, color, etc. -->
          <button type="submit" class="btn btn-primary">Add Event</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Event Modal -->



<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
      </div>
      <div class="modal-body">
        <form id="editEventForm">
          <input type="text" id="edit_event_id" name="edit_event_id">

          <div class="mb-3">
            <label for="editEventTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="editEventTitle" name="title">
          </div>
          <div class="mb-3">
            <label for="editEventStart" class="form-label">Start Date</label>
            <input type="text" class="form-control" id="editEventStart" name="start">
          </div>
          <div class="mb-3">
            <label for="editEventEnd" class="form-label">End Date</label>
            <input type="text" class="form-control" id="editEventEnd" name="end">
          </div>
          <!-- Add more fields for editing event details -->
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Event Modal -->


<script>
  document.addEventListener('DOMContentLoaded', function() {
    $("li > a[href='<?php echo base_url('hr/calendar'); ?>']").parent().addClass("active");

      function convertDateFormat(dateString) {
        var date = new Date(dateString);
        var year = date.getFullYear();
        var month = ('0' + (date.getMonth() + 1)).slice(-2);
        var day = ('0' + date.getDate()).slice(-2);
        return year + '-' + month + '-' + day;
      }

        function adjustEndDateForFullDay(endDate) {
          if (endDate) {
            var date = new Date(endDate);
            date.setDate(date.getDate() + 1);
            return date.toISOString().split('T')[0];
          }else{

          return null;
          }
        }



    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'sandstone',
      initialView: 'dayGridMonth',
      // editable: true,
      selectable: true,
      select: function(arg) {
        var title = prompt('Enter event title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.startStr,
            end: arg.endStr,
            allDay: arg.allDay
          });
        }
        calendar.unselect();
      },
      eventAdd: function(info) {
        console.log("ADD EVENT");
        handleEventAction(info.event, 'add');
      },
      eventDrop: function(info) {
        console.log("DROP EVENT");
        handleEventAction(info.event, 'update');
      },
      eventResize: function(info) {
        console.log("RESIZE EVENT");
        handleEventAction(info.event, 'update');
      },
      events: [
        <?php
        $query = $this->db->query("SELECT 
        'event' AS type,
        `id`, `event_name` AS name, 
        `event_description` AS description, 
        `date_start`, `date_end`, 
        `time_start`, `time_end`, 
        `is_workday`, `date_created` 
      FROM 
        `sys_events`
      UNION
      SELECT 
        'holiday' AS type,
        `id`, `holiday_name` AS name, 
        `holiday_description`, 
        `date_start`, `date_end`, 
        `time_start`, `time_end`, 
        `is_workday`, `date_created` 
      FROM 
        `sys_holidays`;
      ");
        foreach ($query->result() as $row) {
          echo '{';
          echo "id: '{$row->id}',";
          echo "title: \"" . str_replace('"', '\"', $row->name) . "\",";
          echo "start: '{$row->date_start} {$row->time_start}',";
          echo "end: '{$row->date_end} {$row->time_end}',";
          if ($row->type == "holiday") {
            echo "allDay: true,";
            echo "editable: false,";
            echo "description: \"" . str_replace('"', '\"', $row->description) . "\",";
            echo "className: 'calendar-event holiday'";
          }
          echo '},';
        }
        ?>
      ]
    });

    function handleEventAction(event, action) {
      var eventData = {
        id: event.id,
        title: event.title,
        start: event.start.toISOString().split('T')[0], // Use date only
        end: event.end ? adjustEndDateForFullDay(event.end) : null, // Adjust end date
        allDay: event.allDay
      };

      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('calendar/event/'); ?>' + action,
        data: eventData,
        success: function(response) {
          console.log('Event ' + action + 'd successfully:', response);
        },
        error: function(xhr, status, error) {
          console.error('Error ' + action + 'ing event:', error);
        }
      });
    }

    // Show the modal when the user clicks on a day to add an event
    calendar.setOption('select', function(arg) {
      $('#addEventModal').modal('show');
      $('#eventTitle').val('');
      $('#eventStartDate').val(arg.startStr);
      $('#eventEndDate').val(arg.endStr);
    });

    // Handle form submission for adding events
    $('#addEventForm').submit(function(event) {
      event.preventDefault();
      var eventData = {
        title: $('#eventTitle').val(),
        start: $('#eventStartDate').val(),
        end: $('#eventEndDate').val(),
      };

      calendar.addEvent(eventData);
      $('#addEventModal').modal('hide');
    });

    // Trigger Edit Event Modal when an event is clicked
    calendar.on('eventClick', function(info) {
      console.log("eventClick : ", info.event.start.toISOString());
      $('#editEventModal').modal('show');
      $('#edit_event_id').val(info.event.id);
      $('#editEventTitle').val(info.event.title);
      // Get the start date from the event and parse it
      var startDate = new Date(info.event.start);
      // Add 1 day to the start date
      startDate.setDate(startDate.getDate() + 1);
      // Convert the adjusted start date to ISO string and split at 'T'
      var adjustedStartDate = startDate.toISOString().split('T')[0];

      $('#editEventStart').val(adjustedStartDate);
      $('#editEventEnd').val(info.event.end ? info.event.end.toISOString().split('T')[0] : '');
    });

    // Handle form submission for editing events
    $('#editEventForm').submit(function(event) {
      event.preventDefault();
      var eventData = {
        id: $('#edit_event_id').val(),
        title: $('#editEventTitle').val(),
        start: $('#editEventStart').val(),
        end: $('#editEventEnd').val(),
      };
      var eventToUpdate = calendar.getEventById(eventData.id);
      if (eventToUpdate) {
        eventToUpdate.setProp('title', eventData.title);
        eventToUpdate.setStart(eventData.start);
        eventToUpdate.setEnd(eventData.end ? new Date(eventData.end + 'T23:59:59') : null); // Fix end date
        handleEventAction(eventToUpdate, 'update');
      }
      $('#editEventModal').modal('hide');
    });

    calendar.render();

    $("#btn_holiday_update").on('click', function() {
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url('data/api/holiday/insert'); ?>',
        success: function(response) {
          console.log("Success calendar insert");
        },
        error: function(xhr, status, error) {
          console.log("Failed calendar insert");
        }
      });
    });
  });
</script>