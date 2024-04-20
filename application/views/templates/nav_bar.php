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
   <!-- /Logo -->
   <a id="toggle_btn" href="javascript:void(0);">
      <span class="bar-icon">
         <span></span>
         <span></span>
         <span></span>
      </span>
   </a>
   <!-- Header Title -->
   <div class="page-title-box">
      <h3>Famco Retail Incorporated</h3>
   </div>
   <!-- /Header Title -->
   <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>
   <!-- Header Menu -->
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
                     $this->db->select('*');
                     $this->db->from('notifications');
                     $this->db->order_by('created_at', 'desc');
                     $this->db->limit(5);
                     $latest_notifications_query = $this->db->get();

                     if ($latest_notifications_query) {
                        // Fetch and display the latest notifications
                        foreach ($latest_notifications_query->result() as $notification) {
                           $notif_time = date('F j, Y g:i A', strtotime($notification->created_at));
                           // Define inline style for unread notifications
                           $unread_style = $notification->status == "unread" ? 'style="background-color: #f2f2f2;"' : ''; // Check if status is 0 for unread
                           echo '<li class="notification-message" ' . $unread_style . '>';
                           echo '<a href="chat.html">';
                           echo '<div class="list-item">';
                           echo '<div class="list-left">';
                           echo '<span class="avatar">';
                           echo '<img src="../assets/img/profiles/avatar-08.jpg" alt="User Image">';
                           echo '</span>';
                           echo '</div>';
                           echo '<div class="list-body">';
                           // Display notification details
                           echo '<span class="message-author">' . $notification->user_id . '</span>';
                           echo '<span class="message-time">' . $notif_time . '</span>'; // Corrected line
                           echo '<div class="clearfix"></div>';
                           echo '<span class="message-content">' . $notification->message . '</span>';
                           echo '</div>';
                           echo '</div>';
                           echo '</a>';
                           echo '</li>';
                       }
                       
                       
                     } else {
                        // Handle error if fetching latest notifications fails
                        echo '<li>Error retrieving notifications.</li>';
                     }
                  } else {
                     // Display a message if there are no notifications
                     echo '<li>No notifications.</li>';
                  }
                  ?>
               </ul>
            </div>
            <div class="topnav-dropdown-footer">
               <a href="chat.html">View all Notifications</a>
            </div>
         </div>
      </li>


      <!-- /Notifications -->
      <!-- Message Notifications -->
      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <i class="fa-regular fa-comment"></i><span class="badge rounded-pill">8</span>
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
               <a href="chat.html">View all Messages</a>
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