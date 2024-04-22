<div class="header" style="background: linear-gradient(to right, #070f4d 40%, #5a6dff 100%);">
   <!-- Logo -->
   <div class="header-left">
      <a href="admin-dashboard.html" class="logo">
         <img src="<?= base_url('assets/img/famco_logo_clear.png') ?>" width="80" height="80" alt="Logo">
      </a>
      <a href="admin-dashboard.html" class="logo2">
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
      <?php
      $query = $this->db->query("SELECT * FROM employee WHERE id = '" . $_SESSION['id'] . "'");

      foreach ($query->result() as $row) {

         $fname = $row->fname;
         $pfp = $row->pfp;
      }
      ?>

      <?php
      $this->db->select('COUNT(*) as total_rows');
      $id1 = $_SESSION['id'];
      $this->db->where('user_id', $id1);
      $query = $this->db->get('notifications');

      // Check if query was successful
      if ($query) {
         // Fetch the total rows count
         $row = $query->row();
         $total_rows = $row->total_rows;
      } else {
         // Handle error if query fails
         $total_rows = 0; // Set default value
      }
      ?>
      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i class="fa-regular fa-bell"></i><span class="badge rounded-pill"><?php echo $total_rows; ?></span>
         </a>
         <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
               <span class="notification-title">Notifications</span>
               <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
               <ul class="notification-list">
                  <?php
                  // Check if there are notifications
                  if ($total_rows > 0) {
                     // Retrieve the latest 5 notifications
                     $id1 = $_SESSION['id']; // Corrected syntax for accessing session variable
                     $this->db->select('*');
                     $this->db->from('notifications');
                     $this->db->where('user_id', $id1);
                     $this->db->order_by('created_at', 'desc');
                     $this->db->limit(5);
                     $latest_notifications_query = $this->db->get();

                     if ($latest_notifications_query->num_rows() > 0) { // Check if there are notifications
                        foreach ($latest_notifications_query->result() as $notification) {
                           $notif_time = date('F j, Y g:i A', strtotime($notification->created_at));

                           $unread_style = $notification->status == "unread" ? 'style="background-color: #f2f2f2;"' : ''; // Check if status is 0 for unread
                           echo '<li class="notification-message" ' . $unread_style . '>';
                           echo '<a href="' . base_url('employee/notification') . '">';
                           echo '<div class="list-item" style="position: relative;">'; // Add relative positioning
                           echo '<div class="list-left">';
                           echo '<span class="avatar">';
                           echo '<img src="../assets/img/profiles/avatar-08.jpg" alt="User Image">';
                           echo '</span>';
                           echo '</div>';
                           echo '<div class="list-body" style="display: flex; justify-content: space-between;">'; // Use flexbox
                           echo '<div style="display: flex; flex-direction: column;">'; // Align items vertically
                           echo '<span class="message-author">' . $notification->title . '</span>';
                           echo '<div class="clearfix"></div>';
                           echo '<span class="message-content">' . $notification->message . '</span>';
                           echo '</div>';
                           // Assuming $notif_time is in 'Y-m-d H:i:s' format
                           $notif_timestamp = strtotime($notif_time); // Convert notif_time to a Unix timestamp
                           $current_timestamp = time(); // Get current Unix timestamp
                           
                           // Calculate the time difference in seconds
                           $time_diff = $current_timestamp - $notif_timestamp;
                           
                           // Define time intervals in seconds
                           $minute = 60;
                           $hour = 3600;
                           $day = 86400;
                           
                           if ($time_diff < $minute) {
                               $time_ago = $time_diff . 's ago'; // Seconds ago
                           } elseif ($time_diff < $hour) {
                               $time_ago = floor($time_diff / $minute) . 'm ago'; // Minutes ago
                           } elseif ($time_diff < $day) {
                               $time_ago = floor($time_diff / $hour) . 'h ago'; // Hours ago
                           } elseif ($time_diff < 30 * $day) {
                               $time_ago = floor($time_diff / $day) . 'd ago'; // Days ago
                           } else {
                               $time_ago = date('F j, Y', $notif_timestamp); // Display notif_date instead
                           }
                           
                           echo '<span class="message-time">' . $time_ago . '</span>';
                           // Show status
                           echo '<span class="status" style="position: absolute; bottom: 0; right: 0;">' . $notification->status . '</span>';
                           echo '</div>';
                           echo '</div>';
                           echo '</a>';
                           echo '</li>';
                           
                        }
                     } else {
                        echo '<li>No notifications.</li>'; // Output if there are no notifications
                     }
                  } else {
                     // Display a message if there are no notifications
                     echo '<div style="text-align: center;">No notifications.</div>';
                  }
                  ?>
               </ul>
            </div>
            <div class="topnav-dropdown-footer">
               <a href="base_url('employee/notification')">View all Notifications</a>
            </div>
         </div>
      </li>


      <!-- /Notifications -->
      <!-- Message Notifications -->
      <?php
      $this->db->select('COUNT(*) as total_unread');

      $query = $this->db->get('chat_messages');

      // Check if query was successful
      if ($query) {
         // Fetch the total rows count
         $row = $query->row();
         $total_unread = $row->total_unread;
      } else {
         // Handle error if query fails
         $total_unread = 0; // Set default value
      }
      ?>
      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i class="fa-regular fa-comment"></i><span class="badge rounded-pill"><?php echo $total_unread; ?></span>
         </a>
         <div class="dropdown-menu notifications">
            <div class="topnav-dropdown-header">
               <span class="notification-title">Messages</span>
               <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
            </div>
            <div class="noti-content">
               <ul class="notification-list">
                  <li class="notification-message">
                     <a href="chat.html">
                        <div class="list-item">
                           <div class="list-left">
                              <span class="avatar">
                                 <img src="../assets/img/profiles/avatar-09.jpg" alt="User Image">
                              </span>
                           </div>
                           <div class="list-body">
                              <span class="message-author">Richard Miles </span>
                              <span class="message-time">12:28 AM</span>
                              <div class="clearfix"></div>
                              <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                           </div>
                        </div>
                     </a>
                  </li>
                  <li class="notification-message">
                     <a href="chat.html">
                        <div class="list-item">
                           <div class="list-left">
                              <span class="avatar">
                                 <img src="../assets/img/profiles/avatar-02.jpg" alt="User Image">
                              </span>
                           </div>
                           <div class="list-body">
                              <span class="message-author">John Doe</span>
                              <span class="message-time">6 Mar</span>
                              <div class="clearfix"></div>
                              <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                           </div>
                        </div>
                     </a>
                  </li>
                  <li class="notification-message">
                     <a href="chat.html">
                        <div class="list-item">
                           <div class="list-left">
                              <span class="avatar">
                                 <img src="../assets/img/profiles/avatar-03.jpg" alt="User Image">
                              </span>
                           </div>
                           <div class="list-body">
                              <span class="message-author"> Tarah Shropshire </span>
                              <span class="message-time">5 Mar</span>
                              <div class="clearfix"></div>
                              <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                           </div>
                        </div>
                     </a>
                  </li>
                  <li class="notification-message">
                     <a href="chat.html">
                        <div class="list-item">
                           <div class="list-left">
                              <span class="avatar">
                                 <img src="../assets/img/profiles/avatar-05.jpg" alt="User Image">
                              </span>
                           </div>
                           <div class="list-body">
                              <span class="message-author">Mike Litorus</span>
                              <span class="message-time">3 Mar</span>
                              <div class="clearfix"></div>
                              <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                           </div>
                        </div>
                     </a>
                  </li>
                  <li class="notification-message">
                     <a href="chat.html">
                        <div class="list-item">
                           <div class="list-left">
                              <span class="avatar">
                                 <img src="../assets/img/profiles/avatar-08.jpg" alt="User Image">
                              </span>
                           </div>
                           <div class="list-body">
                              <span class="message-author"> Catherine Manseau </span>
                              <span class="message-time">27 Feb</span>
                              <div class="clearfix"></div>
                              <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                           </div>
                        </div>
                     </a>
                  </li>
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