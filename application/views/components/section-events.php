<?php
               $query = $this->db->query("SELECT * FROM (
                  SELECT 
                      'event' AS type,
                      `id`, 
                      `event_name` AS name, 
                      `event_description` AS description, 
                      `date_start`, 
                      `date_end`, 
                      `time_start`, 
                      `time_end`, 
                      `is_workday`, 
                      `date_created` 
                  FROM 
                      `sys_events`
                  WHERE 
                      MONTH(`date_start`) = MONTH(CURDATE()) AND YEAR(`date_start`) = YEAR(CURDATE())
              
                  UNION
              
                  SELECT 
                      'holiday' AS type,
                      `id`, 
                      `holiday_name` AS name, 
                      `holiday_description`, 
                      `date_start`, 
                      `date_end`, 
                      `time_start`, 
                      `time_end`, 
                      `is_workday`, 
                      `date_created` 
                  FROM 
                      `sys_holidays`
                  WHERE 
                      MONTH(`date_start`) = MONTH(CURDATE()) AND YEAR(`date_start`) = YEAR(CURDATE())
              
                  UNION
              
                  SELECT 
                      'birthday' AS type,
                      NULL AS id,
                      CONCAT(`fname`, ' ', COALESCE(`mname`, ''), ' ', `lname`) AS name,
                      'Employee Birthday' AS description,
                      DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', MONTH(`dob`), '-', DAY(`dob`)), '%Y-%m-%d') AS date_start,
                      DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', MONTH(`dob`), '-', DAY(`dob`)), '%Y-%m-%d') AS date_end,
                      NULL AS time_start,
                      NULL AS time_end,
                      0 AS is_workday,
                      `date_created` 
                  FROM 
                      `employee`
                  WHERE 
                      MONTH(`dob`) = MONTH(CURDATE())
              ) AS combined_events
              ORDER BY date_start ASC;
              
           ");

               // Check if the query was successful
               if ($query) {
                  // Check if there are rows returned
                  if ($query->num_rows() > 0) {
                     // Fetch the result rows as an array of objects
                     $announcement = $query->result();

                     // Process the result rows
                     foreach ($announcement as $row) {
                        // Access properties of each shift object as needed
                        // $data['id'] = $row->id;
                        // $data['title'] = $row->title;
                        // $data['content'] =  $row->content;
                        // $data['author']  = ($row->author === NULL) ? "N/A" : $row->author;
                        // $data['department'] = ($row->to_all == "1") ? "All" : $row->departments;
                        // $data['date'] =  $row->date_created;

                        $isToday = strtotime($row->date_start) === strtotime(date('Y-m-d'));


                        if(strtotime($row->date_start) >= strtotime(date('Y-m-d'))){

                        
               ?>

<!-- 

               //limit the result for this week
               //if the event is not on this week, hide them
               //add a see more section

 -->
               

                        <div class="timeline-panel type-<?= $row->type ?>" style="background-color: white; ">
                           <h3 class="event-name">

                              <?php if ($row->type == "birthday") {
                                 echo "Happy Birthday $row->name !";
                              } else {
                                 echo $row->name;
                              }
                              ?>
                           </h3>
                           <p class="event-date"><?= $isToday ? "<span class = 'badge badge-soft-info'>Today</span> • " : ""; ?> 
                            <?= formatDateOnly($row->date_start); ?></p>
                           <p class="text-overflow-ellipsis event-description" onclick="$(this).css('height','auto')">
                              <?php
                              if ($row->description == NULL || $row->description == '') {
                                 echo "No description available";
                              } else {
                                 echo $row->description;
                              }
                              ?></p>

                           <?php
                           if ($row->type == "birthday") {
                              echo '<img src="../assets/img/birthday-GIF.gif" alt="User Image" loop="infinite">';
                           }
                           ?>



                        </div>

               <?php
                        }

                     }
                  } else {
                     // Handle case when no rows are returned
                     echo "No announcements yet.";
                  }
               } else {
                  // Handle case when query fails
                  echo "Error executing query: " . $this->db->error()['message'];
               }


               ?>



