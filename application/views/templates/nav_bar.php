<div class="header" style="background: linear-gradient(to right, #070f4d 40%, #5a6dff 100%);">
   <!-- Logo -->
   <div class="header-left">

      <?php

      if (strtolower($_SESSION['role']) == "head" && strtolower($_SESSION['acro']) == 'hr') {
         $redirect_home = base_url('hr/dashboard');
      } else {
         $redirect_home = base_url('employee/dashboard');
      }
      ?>
      <a href="<?= $redirect_home ?>" class="logo">
         <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" width="80" height="80" alt="Logo">
      </a>
      <a href="<?= $redirect_home ?>" class="logo2">
         <img src="../assets/img/logo2.png" width="40" height="40" alt="Logo">
      </a>
   </div>

   <a id="toggle_btn" href="javascript:void(0);">
      <span class="bar-icon">
         <span></span>
         <span></span>
         <span></span>
      </span>
   </a>

   <div class="page-title-box">
      <h3>Famco Retail Incorporated</h3>
   </div>

   <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

   <ul class="nav user-menu">



      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i class="fa-regular fa-bell"></i><span class="badge rounded-pill" id="notification-count"></span>
         </a>


         <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
               <span class="notification-title">Notifications</span>
               <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
               <ul class="notification-list" id="notification-list">
                  <!-- Notification items will be dynamically added here -->
               </ul>
            </div>
            <div class="topnav-dropdown-footer">
               <a href="<?php echo base_url('employee/notification'); ?>">View all Notifications</a>
            </div>
         </div>

      </li>



      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i class="fa-regular fa-comment"></i><span class="badge rounded-pill" id="message-count"></span>
         </a>
         <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
               <span class="notification-title">Messages</span>
               <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
               <ul class="notification-list" id="message-list">
                  <!-- Message items will be dynamically added here -->
               </ul>
            </div>
            <div class="topnav-dropdown-footer">
               <a href="<?= base_url('pages/public_chat') ?>">View all Messages</a>
            </div>
         </div>
      </li>

      <!-- /Message Notifications -->
      <li class="nav-item dropdown has-arrow main-drop">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <span class="user-img">
               <img src="data:image/jpeg;base64,<?= base64_encode($this->session->userdata('pfp')) ?>" alt="" style="object-fit: cover; aspect-ratio: 1; height: auto;">
               <span class="status online"></span></span>
            <span><?php echo ucwords($this->session->userdata('fullname')); ?></span>


         </a>
         <div class="dropdown-menu">

            <?php
            if (strtolower($_SESSION['department']) == 'sys-at') { //admin
               echo '
                     <a class="dropdown-item" href="' . base_url('emp_profile') . '">My Profile</a>  
                        ';
            } else if (strtolower($_SESSION['department']) == 'hr') { //hr
               echo '
                        <a class="dropdown-item" href="' . base_url('hr/profile') . '">My Profile</a>  
                        <a class="dropdown-item" href="' . base_url('hr/settings') . '">Settings</a>  

                           ';
            } else { //emp
               echo '
                        <a class="dropdown-item" href="' . base_url('employee/profile') . '">My Profile</a> 
                        <a class="dropdown-item" href="' . base_url('employee/setting') . '">Settings</a>  
                         
                           ';
            }
            ?>
            <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
            <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
         </div>
      </li>
   </ul>
   <!-- /Header Menu -->
   <!-- Mobile Menu -->
   <div class="dropdown mobile-user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
         <a class="dropdown-item" href="profile.html">My Profile</a>
         <a class="dropdown-item" href="settings.html">Settings</a>
         <a class="dropdown-item" href="index.html">Logout</a>
      </div>
   </div>
   <!-- /Mobile Menu -->
</div>

<script>
   function fetchNotifications() {
      $.ajax({
         url: base_url + "humanr/fetch_notifications",
         type: "GET",
         dataType: "json", // Specify that the response should be treated as JSON
         success: function(response) {
            // Update the notification list HTML
            $("#notification-list").html(response.html);

            // Check if total_rows is greater than zero
            if (response.total_rows > 0) {
               // Update the notification count badge with the total rows count
               $("#notification-count").text(response.total_rows);
               // Show the badge pill
               $("#notification-count").show();
            } else {
               // If total_rows is zero or less than zero, hide the badge pill
               $("#notification-count").hide();
            }
         },
         error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any errors to the console for debugging
         },
      });
   }

   // Call fetchNotifications function every 2 seconds
   setInterval(fetchNotifications, 2000);


   function fetchLatestMessages() {
      $.ajax({
         url: base_url + "humanr/show_latest_messages",
         type: "GET",
         dataType: "json",
         success: function(response) {
            console.log("latest message : ", response);
            if (response.success) {
               // Clear previous messages
               $("#message-list").empty();
               $("#chat-group-list").empty(); // Clear group list
               $("#conversation-private").empty(); // Clear individual list

               if (response.html_messages && response.html_messages.length > 0) {
                  // Append each HTML message to the message list
                  response.html_messages.forEach(function(message) {
                     $("#message-list").append(message.html);

                     if (message.type == 'group') {
                        $("#chat-group-list").append(message.html);
                     } else if (message.type == 'individual') {
                        $("#conversation-private").append(message.html);
                     }
                     // Select the element with data-message-id equal to 15
                     var messageElement = $('#sidebar-menu li[data-emp-id]');

                     // Find the anchor tag within the selected element
                     var anchorTag = messageElement.find('a');

                     // Replace the anchor tag with its content
                     anchorTag.replaceWith(anchorTag.contents());


                  });

                  // Update the message count badge
                  $("#message-count").text(response.html_messages.length);
               } else {
                  $("#message-list").append("<li>No messages found</li>");
               }




            } else {
               console.error("Error fetching latest messages:", response.error);
            }
         },
         error: function(xhr, status, error) {
            console.error("Error fetching latest messages:", error);
         },
      });
   }












   fetchLatestMessages(); // Fetch chat data on page load

   // Fetch chat data every 2 seconds
   // setInterval(fetchLatestMessages, 5000);

   $(document).ready(function() {
      //  console.log = function () {};

   })
</script>