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


      <!-- /Notifications -->
      <!-- Message Notifications -->
      <?php
      $this->db->select('SELECT COUNT(id) as `total_unread`, * FROM `chat_messages` WHERE from_ = 1 OR to_ = 1
      GROUP BY from_, to_');
      $this->db->where('to_', $_SESSION['id']); // Add condition to match session id
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