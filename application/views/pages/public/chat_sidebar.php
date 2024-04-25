<div class="sidebar" id="sidebar" style="overflow-y:scroll;scrollbar-width:none;">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 432px;">
        <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 432px;">
            <div id="sidebar-menu" class="sidebar-menu">

                <nav class="greedy">
                    <ul class="link-item">
                    <?php
   
   if(strtolower($_SESSION['role']) == "head" && strtolower($_SESSION['acro']) == 'hr'){
      $redirect_home = base_url('hr/dashboard');
   }else{
      $redirect_home = base_url('employee/dashboard');
   }
   ?>
                        <li>
                            <a href="<?= $redirect_home?>"><i class="la la-home"></i> <span>Back to Home</span></a>
                        </li>
                        <li class="menu-title"><span>Chat Groups</span> <a href="#" data-bs-toggle="modal" data-bs-target="#add_group" class="subdrop"><i class="fa-solid fa-plus"></i></a></li>
                        <?php

                        $query = "SELECT 
									cg.id AS group_id,
									cg.group_name,
									cg.group_cover_pic,
									cg.owner,
									cg.date_created
								FROM 
									chat_group_members AS cgm
								JOIN 
									chat_group AS cg ON cgm.group_id = cg.id
								WHERE 
									cgm.member = '" . $this->session->userdata('id') . "';
							";

                        $result = $this->db->query($query)->result_array();

                        foreach ($result as $row) {



                        ?>
                            <li data-group-id="<?= $row['group_id'] ?>" class = "conversation-group">
                                <a href="#">
                                    <span class="chat-avatar-sm user-img">
                                        <?php
                                        if ($row['group_cover_pic'] == NULL) {
                                            echo "
				<img class='rounded-circle' src='" . base_url('assets/img/user.jpg') . "' alt='Group Image'>
				
				";
                                        } else {
                                            echo "
				<img class='rounded-circle' src='data:image/jpeg;base64," . base64_encode($row['group_cover_pic']) . "' alt='Group Image'>
				
				";
                                        }
                                        ?>
                                    </span>
                                    <span class="chat-user conversation-title"><?= $row['group_name'] ?></span>
                                </a>
                            </li>



                        <?php
                        }
                        ?>

                        <li class="menu-title">Direct Chats <a href="#" data-bs-toggle="modal" data-bs-target="#add_chat_user" class=""><i class="fa-solid fa-plus"></i></a></li>


                        <?php

                        $query = "SELECT 
                        CASE WHEN cm.from_ = '".$this->session->userdata('id')."' THEN cm.to_ ELSE cm.from_ END AS employee_id,
                        CONCAT(e.fname, ' ', e.lname) AS emp_name,
                        e.pfp AS profile_picture,
                        (
                            SELECT MAX(cm.id) AS message_id
                            FROM chat_messages AS cm
                            WHERE (cm.from_ = e.id OR cm.to_ = e.id) AND cm.from_ IN ('".$this->session->userdata('id')."', '".$this->session->userdata('id')."')
                        ) AS message_id,
                        (
                            SELECT cm.message
                            FROM chat_messages AS cm
                            WHERE (cm.from_ = e.id OR cm.to_ = e.id) AND cm.from_ IN ('".$this->session->userdata('id')."', '".$this->session->userdata('id')."')
                            ORDER BY cm.id DESC
                            LIMIT 1
                        ) AS last_message,
                        (
                            SELECT cm.timestamp
                            FROM chat_messages AS cm
                            WHERE (cm.from_ = e.id OR cm.to_ = e.id) AND cm.from_ IN ('".$this->session->userdata('id')."', '".$this->session->userdata('id')."')
                            ORDER BY cm.id DESC
                            LIMIT 1
                        ) AS last_timestamp
                    FROM 
                        chat_messages AS cm
                    JOIN 
                        employee AS e ON (cm.from_ = e.id OR cm.to_ = e.id) AND e.id != '".$this->session->userdata('id')."'
                    WHERE 
                        '".$this->session->userdata('id')."' IN (cm.from_, cm.to_)
                    GROUP BY 
                        employee_id, emp_name;
                    ";

                        $result = $this->db->query($query)->result_array();

                        foreach ($result as $row) {



                        ?>




                            <li class="conversation-private" data-employee-id="<?= $row['employee_id'] ?>" >


                                <a href="#" class="p-0">
                                    <div class="row">
                                        <div class="col-2">
                                            <span class="chat-avatar-sm user-img">

                                                <?php
                                                if ($row['profile_picture'] == NULL) {
                                                    echo "
				<img class='rounded-circle' src='" . base_url('assets/img/user.jpg') . "' alt='Group Image'>
				
				";
                                                } else {
                                                    echo "
				<img class='rounded-circle' src='data:image/jpeg;base64," . base64_encode($row['profile_picture']) . "' alt='profile_picture'>
				
				";
                                                }
                                                ?>

                                                <!-- <span class="status online"></span> -->
                                            </span>
                                        </div>

                                        <div class="col p-0">

                                            <div class="row">
                                                <div class="col p-0 text-start conversation-title"><?= $row['emp_name'] ?></div>

                                                <?php

                                                $dateString = $row['last_timestamp'];
                                                $dateTimestamp = strtotime($dateString);
                                                $currentTimestamp = time();

                                                // Calculate the difference in seconds
                                                $diffInSeconds = $currentTimestamp - $dateTimestamp;

                                                // Convert seconds to days
                                                $diffInDays = $diffInSeconds / (60 * 60 * 24);

                                                // Check if the difference is less than or equal to 1 day
                                                if ($diffInDays <= 1) {
                                                    // echo "The given date has passed within a day.";
                                                    echo "<div class='col-4 p-0 text-end' style='font-size: 10px;'>" . formatTimeOnly($row['last_timestamp']) . "</div>";
                                                } else {
                                                    // echo "The given date has not passed within a day.";

                                                    echo "<div class='col-4 p-0 text-end' style='font-size: 10px;'>" . formatDateOnly($row['last_timestamp']) . "</div>";
                                                }
                                                ?>

                                            </div>
                                            <div class="row"><?= $row['last_message'] ?></div>


                                        </div>
                                    </div>

                                </a>
                            </li>

                        <?php

                        }

                        ?>

                        <li>

                        </li>



                    </ul>
                </nav>
            </div>
        </div>

    </div>
</div>