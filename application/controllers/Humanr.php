<?php defined('BASEPATH') or exit('No direct script access allowed');

class Humanr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Admin_model', 'hr');
		// $this->zone = date_default_timezone_set('Asia/Manila');
		// $this->load->library('session');
		// $this->load->helper('my_gen_func_helper');
	}

	// public function hrapprove() {
	// 	$rowId = $this->input->post('rowId');
	// 	$session_emp_id = $this->session->userdata('id2');

	// 	$this->db->set('status', 'approved');
	// 	$this->db->set('hr_id', $session_emp_id);
	// 	$this->db->where('id', $rowId);
	// 	$this->db->update('f_leaves');
	// 	if ($this->db->affected_rows() > 0) {
	// 		echo 'Leave approved successfully';
	// 	} else {
	// 		echo 'Error: Leave not approved';
	// 	}
	// }

	public function hrapprove()
	{
		$rowId = $this->input->post('row_id');
		$hr_Id = $this->session->userdata('id');

		$source = $this->input->post('source');

		$validSources = array(
			'og_approveButton' => array('f_outgoing', ' Department Head <strong>Approved</strong> your <strong>Outgoing Request</strong>. Please wait for the approval of Human Resource.'),
			'leave_approveButton' => array('f_leaves', 'Department Head <strong>Approved</strong> your <strong>Leave Request</strong>. Please wait for the approval of Human Resource.'),
			'ot_approveButton' => array('f_overtime', ' Department Head <strong>Approved</strong> your <strong>Overtime Request</strong>. Please wait for the approval of Human Resource.'),
			'ut_approveButton' => array('f_undertime', 'Department Head <strong>Approved</strong> your <strong>Undertime Request</strong>. Please wait for the approval of Human Resource.'),
			'ob_approveButton' => array('f_off_bussiness', 'Department Head <strong>Approved</strong> your <strong>Off Business Request</strong>. Please wait for the approval of Human Resource.'),
			'og_denyButton' => array('f_outgoing', ' Department Head <strong>Denied</strong> your <strong>Outgoing Request</strong>. Please wait for the approval of Human Resource.'),
			'leave_denyButton' => array('f_leaves', 'Department Head <strong>Denied</strong> your <strong>Leave Request</strong>. Please wait for the approval of Human Resource.'),
			'ot_denyButton' => array('f_overtime', 'Department Head <strong>Denied</strong> your <strong>Overtime Request</strong>. Please wait for the approval of Human Resource.'),
			'ut_denyButton' => array('f_undertime', 'Department Head <strong>Denied</strong> your <strong>Undertime Request</strong>. Please wait for the approval of Human Resource.'),
			'ob_denyButton' => array('f_off_bussiness', 'Department Head <strong>Denied</strong> your <strong>Off Business Request</strong>. Please wait for the approval of Human Resource.')
		);

		if (isset($validSources[$source])) {
			$tableName = $validSources[$source];

			if (strpos($source, '_denyButtonHr') !== false) {
				$this->db->set('status', 'denied');
			} else {
				$this->db->set('status', 'approved');
			}

			$this->db->set('hr_id', $hr_Id);
			$this->db->set('hr_status_date', 'CURDATE()', false);
			$this->db->where('id', $rowId);
			$this->db->update($tableName);

			echo 'Operation successful. Row ID: ' . $rowId . ', Table Name: ' . $tableName . ', Employee ID: ' . $hr_Id;
		} else {
			echo 'Failed: Invalid source';
		}
	}
	public function headapprovez()
	{

		$rowId = $this->input->post('rowId');
		$session_emp_id = $this->session->userdata('id');

		$this->db->set('head_status', 'approved');
		$this->db->set('head_id', $session_emp_id);
		$this->db->where('id', $rowId);
		$this->db->update('f_leaves');

		echo 'Leave approved successfully';
	}

	public function headapprove()
	{
		$rowId = $this->input->post('row_id');
		$head_Id = $this->session->userdata('id2');

		$source = $this->input->post('source');

		$validSources = array(
			'og_approveButton' => array('f_outgoing', ' Department Head <strong>Approved</strong> your <strong>Outgoing Request</strong>. Please wait for the approval of Human Resource.'),
			'leave_approveButton' => array('f_leaves', 'Department Head <strong>Approved</strong> your <strong>Leave Request</strong>. Please wait for the approval of Human Resource.'),
			'ot_approveButton' => array('f_overtime', ' Department Head <strong>Approved</strong> your <strong>Overtime Request</strong>. Please wait for the approval of Human Resource.'),
			'ut_approveButton' => array('f_undertime', 'Department Head <strong>Approved</strong> your <strong>Undertime Request</strong>. Please wait for the approval of Human Resource.'),
			'ob_approveButton' => array('f_off_bussiness', 'Department Head <strong>Approved</strong> your <strong>Off Business Request</strong>. Please wait for the approval of Human Resource.'),
			'og_denyButton' => array('f_outgoing', ' Department Head <strong>Denied</strong> your <strong>Outgoing Request</strong>. Please wait for the approval of Human Resource.'),
			'leave_denyButton' => array('f_leaves', 'Department Head <strong>Denied</strong> your <strong>Leave Request</strong>. Please wait for the approval of Human Resource.'),
			'ot_denyButton' => array('f_overtime', 'Department Head <strong>Denied</strong> your <strong>Overtime Request</strong>. Please wait for the approval of Human Resource.'),
			'ut_denyButton' => array('f_undertime', 'Department Head <strong>Denied</strong> your <strong>Undertime Request</strong>. Please wait for the approval of Human Resource.'),
			'ob_denyButton' => array('f_off_bussiness', 'Department Head <strong>Denied</strong> your <strong>Off Business Request</strong>. Please wait for the approval of Human Resource.')
		);


		if (isset($validSources[$source])) {
			$tableName = $validSources[$source][0];
			$message = $validSources[$source][1];

			if (strpos($source, '_denyButton') !== false) {
				$head_status = 'denied';
			} else {
				$head_status = 'approved';
			}

			// Fetch emp_id of the updated rows
			$this->db->select('emp_id');
			$this->db->from($tableName);
			$this->db->where('id', $rowId);
			$query = $this->db->get();
			$updated_rows = $query->result();

			foreach ($updated_rows as $row) {
				$emp_id = $row->emp_id;

				// Update row
				$this->db->set('head_status', $head_status);
				$this->db->set('head_id', $head_Id);
				$this->db->set('head_status_date', 'CURDATE()', false);
				$this->db->where('id', $rowId);
				$this->db->update($tableName);

				// Insert message into notifications table
				$request_type = 'Update on request'; // Set this to the appropriate request type
				$current_datetime = date('Y-m-d H:i:s');

				$notification_data = array(
					'user_id' => $emp_id,
					'message' => $message,
					'created_at' => $current_datetime,
					'title' => $request_type
				);

				$this->db->insert('notifications', $notification_data);
			}
			// Show a message in the console
			echo "<script>console.log('Inserted into notifications table');</script>";

			echo 'Operation successful. Row ID: ' . $rowId . ', Table Name: ' . $tableName . ', Employee ID: ' . $head_Id;
		} else {
			echo 'Failed: Invalid source';
		}
	}






	public function barchart()
	{

		$query = $this->db->query("SELECT d.acro_dept as dept, COUNT(dr.department) as count FROM department_roles dr inner join department d on dr.department = d.id GROUP BY d.department");
		$result = $query->result();

		$data['labels'] = [];
		$data['counts'] = [];

		foreach ($result as $row) {
			$data['labels'][] = $row->dept;
			$data['counts'][] = $row->count;
		}

		echo json_encode($data);
	}


	// new code for attendance status
	public function attendance_status()
	{
		$query = $this->db->query("SELECT MONTH(date) as month, 
									   SUM(CASE WHEN status = '0' THEN 1 ELSE 0 END) as late_count,
									   SUM(CASE WHEN status = '1' THEN 1 ELSE 0 END) as ontime_count
									   FROM attendance
									   GROUP BY MONTH(date)");

		$data['labels'] = [];
		$data['lateCounts'] = [];
		$data['ontimeCounts'] = [];

		for ($i = 1; $i <= 12; $i++) {
			$data['labels'][] = date('M', mktime(0, 0, 0, $i, 1));
			$data['lateCounts'][] = 0;
			$data['ontimeCounts'][] = 0;
		}

		foreach ($query->result() as $row) {
			$month = $row->month;
			$data['lateCounts'][$month - 1] = $row->late_count;
			$data['ontimeCounts'][$month - 1] = $row->ontime_count;
		}

		echo json_encode($data);
	}

	public function deleteEmployee()
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('emp_id')) {
			$empId = $this->input->post('emp_id');

			// Check if there are related records in department_roles table
			$this->db->where('assigned_emp', $empId);
			$query = $this->db->get('department_roles');
			$numRows = $query->num_rows();

			if ($numRows > 0) {
				// Delete related records in department_roles table first
				$this->db->where('assigned_emp', $empId);
				$this->db->delete('department_roles');
			}

			// Proceed with deleting the employee record
			$this->db->where('id', $empId);
			$this->db->delete('employee');

			if ($this->db->affected_rows() > 0) {
				echo json_encode(['status' => 'success', 'message' => 'Employee deleted successfully']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to delete employee']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
		}
	}

	public function C_hr_dashboard()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Dashboard';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_dashboard');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}
	public function fetch_notifications()
	{
		// Start by loading the database library
		$this->load->database();

		// Check if there are notifications
		$total_rows = 0; // Initialize total_rows variable
		$id1 = $_SESSION['id']; // Corrected syntax for accessing session variable
		$notifications = array(); // Initialize notifications array
		$html = ''; // Initialize HTML variable

		// Perform the database query
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('user_id', $id1);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit(10);
		$latest_notifications_query = $this->db->get();

		// Check if there are notifications
		if ($latest_notifications_query->num_rows() > 0) {
			// Fetch notifications into an array
			$notifications = $latest_notifications_query->result_array();
			$total_rows = count($notifications);
		}

		// Generate HTML for the notification list
		if ($total_rows > 0) {
			// Add notification sound
			$html .= '<audio id="notification-sound" src="' . base_url('assets/audio/tink.mp3') . '" preload="auto"></audio>';

			foreach ($notifications as $notification) {
				$notif_time = date('Y-m-d H:i:s', strtotime($notification['created_at']));

				$unread_style = $notification['status'] == "unread" ? 'style="background-color: #f2f2f2;"' : ''; // Check if status is 0 for unread
				$html .= '<li class="notification-message" ' . $unread_style . '>';
				$html .= '<a href="' . base_url('employee/notification') . '">';
				$html .= '<div class="list-item" style="position: relative;">'; // Add relative positioning
				$html .= '<div class="list-left">';
				$html .= '<span class="avatar">';
				// Remove the image tag
				$html .= '<span class="message-author">';

				// Check if it's an "Update on request" or an "Event"
				if ($notification['title'] === 'Update on request') {
					// Add FontAwesome icon for request, adjust size
					$html .= '<i class="fas fa-handshake fa-lg primary-color"></i>'; // "fa-lg" class makes the icon larger
				} elseif ($notification['title'] === 'Event') {
					// Add FontAwesome icon for event, adjust size
					$html .= '<i class="fas fa-calendar-alt fa-lg primary-color"></i>'; // "fa-lg" class makes the icon larger
				} else {
					// Add FontAwesome icon for happy face, adjust size
					$html .= '<i class="fas fa-file-export fa-xl" style="color: #ff9b44;"></i>'; // Adjust size and color for a file with sideways arrow icon

				}

				// Add the title text


				$html .= '</span>';
				$html .= '</span>';
				$html .= '</div>';
				$html .= '<div class="list-body" style="display: flex; flex-direction: column;">'; // Change to column layout
				$html .= '<div style="display: flex; flex-direction: column; align-items: flex-start;">'; // Align items vertically and to the left

				$html .= '<div class="clearfix"></div>';
				$html .= '<span class="message-content">' . $notification['message'] . '</span>';
				$notif_timestamp = strtotime($notif_time); // Convert notif_time to a Unix timestamp
				$current_timestamp = time(); // Get current Unix timestamp
				$time_diff = $current_timestamp - $notif_timestamp;

				// Define time intervals in seconds
				$minute = 60;
				$hour = 3600;
				$day = 86400;

				if ($time_diff < $minute) {
					$time_ago = 'Just now'; // Seconds ago
				} elseif ($time_diff < $hour) {
					$time_ago = floor($time_diff / $minute) . 'm ago'; // Minutes ago
				} elseif ($time_diff < $day) {
					$time_ago = floor($time_diff / $hour) . 'h ago'; // Hours ago
				} elseif ($time_diff < 30 * $day) {
					$time_ago = floor($time_diff / $day) . 'd ago'; // Days ago
				} else {
					$time_ago = date('F j, Y', $notif_timestamp); // Display notif_date instead
				}
				$html .= '<span class="message-time">' . $time_ago . '</span>'; // Display time ago below the message
				$html .= '</div>'; // Close the div for message and time ago
				$html .= '<span class="status" style="position: absolute; bottom: 0; right: 0;">'; // Keep status at bottom-right

				// Check status and choose appropriate icon with hover title and style

				$html .= '</span>'; // Close the span for status
				$html .= '</div>'; // Close the list-body div
				$html .= '</div>'; // Close the list-item div
				$html .= '</a>'; // Close the anchor tag
				$html .= '</li>'; // Close the list item


			}
		} else {
			$html = '<li>No notifications.</li>'; // Output if there are no notifications
		}

		// Prepare the JSON response
		$response = array(
			'html' => $html,
			'total_rows' => $total_rows
		);

		// Output the JSON response
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function fetchnotifications2()
	{
		$id = $this->session->userdata('id');
		$latestTimestamp = $this->input->get('latestTimestamp'); // Get the latest timestamp sent from AJAX

		// Fetch notifications newer than the latest timestamp
		$this->db->select('*');
		$this->db->from('notifications');
		$this->db->where('user_id', $id);
		$this->db->where('created_at >', date('Y-m-d H:i:s', $latestTimestamp)); // Fetch notifications newer than the latest timestamp
		$this->db->order_by('created_at', 'desc');
		$notifications_query = $this->db->get();

		if ($notifications_query->num_rows() > 0) {
			$notifications = $notifications_query->result_array();
			$html = '';

			foreach ($notifications as $notification) {
				$notif_time = date('F j, Y g:i A', strtotime($notification['created_at']));
				$html .= '<li>';
				$html .= '<div class="activity-user">';
				$html .= '<span class="avatar"> ';

				// Check if it's an "Update on request" or an "Event"
				if ($notification['title'] === 'Update on request') {
					$html .= '<i class="fas fa-handshake fa-lg primary-color"></i>';
				} elseif ($notification['title'] === 'Event') {
					$html .= '<i class="fas fa-calendar-alt fa-lg primary-color"></i>';
				} else {
					$html .= '<i class="fas fa-file-export fa-xl" style="color: #ff9b44;"></i>';
				}

				$html .= '</span>';
				$html .= '</div>';
				$html .= '<div class="activity-content">';
				$html .= '<div class="timeline-content">';
				$html .= '<div class="name-and-action">';
				$html .= '<span class="message-author">';
				$html .= '<a href="#" class="message">' . $notification['message'] . '</a>';
				$html .= '</div>';
				$html .= '<div class="time-wrapper">';
				$html .= '<span class="time">' . $notif_time . '</span>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</li>';
			}

			// Get the timestamp of the latest notification
			$latestNotificationTimestamp = strtotime($notifications[0]['created_at']);

			// Return JSON response with HTML and the timestamp of the latest notification
			echo json_encode(array(
				'html' => $html,
				'latestTimestamp' => $latestNotificationTimestamp
			));
		} else {
			// If there are no new notifications, return empty response
			echo json_encode(array(
				'html' => '',
				'latestTimestamp' => $latestTimestamp // Send back the same latest timestamp
			));
		}
	}

	public function timestamp_format($timestamp)
	{
		date_default_timezone_set('Asia/Singapore'); // Set the timezone to SGT

		$new_timestamp = strtotime($timestamp); // Convert $timestamp to a Unix timestamp
		$current_timestamp = time(); // Get current Unix timestamp

		if ($current_timestamp < $new_timestamp) {
			// If current time is less than provided time, return "Future time"
			return 'Future time';
		}

		$time_diff = $current_timestamp - $new_timestamp;

		// Define time intervals in seconds
		$minute = 60;
		$hour = 3600;
		$day = 86400;

		if ($time_diff < $minute) {
			$time_ago = $time_diff . 's ago'; // Show time difference in seconds
		} elseif ($time_diff < $hour) {
			$minutes_ago = floor($time_diff / $minute);
			$time_ago = $minutes_ago . ($minutes_ago > 1 ? 'm' : 'm') . ' ago'; // Minutes ago
		} elseif ($time_diff < $day) {
			$hours_ago = floor($time_diff / $hour);
			$time_ago = $hours_ago . ($hours_ago > 1 ? 'hrs' : 'hr') . ' ago'; // Hours ago
		} elseif ($time_diff < 30 * $day) {
			$days_ago = floor($time_diff / $day);
			$time_ago = $days_ago . ($days_ago > 1 ? 'd' : 'd') . ' ago'; // Days ago
		} else {
			$time_ago = date('M j, Y', $new_timestamp);
			// Display notif_date instead
		}

		return $time_ago;
	}



	public function show_latest_messages()
	{
		// Get the current user's ID from the session
		$current_user_id = $this->session->userdata('id');

		// Execute the query with proper parameter binding
		$result = $this->db->query("
			(
				-- Query for individual conversations
				SELECT 
					cm.id,
					cm.message AS last_message,
					cm.timestamp AS last_timestamp,
					cm.is_read,
					e.id AS emp_id,
					CONCAT(e.fname, ' ', e.lname) AS emp_name,
					'individual' AS conversation_type,
					NULL AS group_id,
					NULL AS group_name,
					cm.from_ AS last_message_sender_id,
					CONCAT(sender.fname, ' ', sender.lname) AS last_message_sender_name,
					e.pfp AS profile_picture_base64
				FROM 
					chat_messages AS cm
				JOIN 
					(
						SELECT 
							MAX(timestamp) AS max_timestamp,
							CASE
								WHEN from_ = ? THEN to_
								ELSE from_
							END AS other_employee_id
						FROM 
							chat_messages
						WHERE 
							from_ = ? OR to_ = ?
						GROUP BY 
							CASE
								WHEN from_ = ? THEN to_
								ELSE from_
							END
					) AS last_msg ON cm.timestamp = last_msg.max_timestamp
				JOIN 
					employee AS e ON last_msg.other_employee_id = e.id
				JOIN 
					employee AS sender ON cm.from_ = sender.id
			)
			UNION
			(
				-- Query for group conversations
				SELECT 
					cm.id,
					cm.message AS last_message,
					cm.timestamp AS last_timestamp,
					cm.is_read,
					e.id AS emp_id,
					cg.group_name AS emp_name,
					'group' AS conversation_type,
					cm.to_group AS group_id,
					cg.group_name,
					cm.from_ AS last_message_sender_id,
					CONCAT(sender.fname, ' ', sender.lname) AS last_message_sender_name,
					cg.group_cover_pic AS profile_picture_base64
				FROM 
					chat_messages AS cm
				JOIN 
					(
						SELECT 
							MAX(timestamp) AS max_timestamp,
							to_group
						FROM 
							chat_messages
						WHERE 
							to_group IN (
								SELECT group_id
								FROM chat_group_members
								WHERE member = ?
							)
						GROUP BY 
							to_group
					) AS last_group_msg ON cm.timestamp = last_group_msg.max_timestamp AND cm.to_group = last_group_msg.to_group
				JOIN 
					employee AS e ON cm.from_ = e.id
				JOIN 
					employee AS sender ON cm.from_ = sender.id
				JOIN 
					chat_group AS cg ON cm.to_group = cg.id
			)
			ORDER BY last_timestamp DESC;
		", array($current_user_id, $current_user_id, $current_user_id, $current_user_id, $current_user_id));

		// Check if the query executed successfully
		if ($result) {
			// Fetch the result set
			$messages = $result->result_array();

			// Array to hold HTML messages
			$html_messages = array();
			$conversation_type = array();


			// Loop through each message to generate HTML
			foreach ($messages as $message) {
				// Construct HTML for the message
				$html = '<li class="notification-message" data-emp-id="' . $message['emp_id'] . '" data-type = "'.$message['conversation_type'].'"
				style="background-color:' . ($message['is_read'] === null ? '#f2f2f2' : '#ffffff') . ';">';
				$html .= '<a href="chat.html">';
				$html .= '<div class="list-item">';
				$html .= '<div class="row">';
				$html .= '<div class="col-2 text-center my-auto">';

				$html .= '<span class="avatar">';
				if ($message['profile_picture_base64'] != NULL) {
					$html .= '<img src="data:image/jpeg;base64,' . base64_encode($message['profile_picture_base64']) . '" alt="User Image" class = "img-pfp">';
				} else {
					$html .= '<img src="' . base_url('assets/img/user.png') . '" alt="User Image" class = "img-pfp">';
				}
				$html .= '</span>';
				$html .= '</div>';

				$html .= '<div class="list-body col-10" style="padding-left:0;">'; // Adjusted column width to reduce space
				$html .= '<div class="row p-0 m-0 w-100">';

				// Output the first word in a span element
				if ($message['conversation_type'] == 'group') {
					$html .= '<span class="message-author col p-0">' . $message['group_name'] . '</span>';
				} else {
					$html .= '<span class="message-author col p-0">' . $message['emp_name'] . '</span>';
				}

				$timestamp = $message['last_timestamp'];
				// Use timestamp_format() function to get human-readable time
				$time_ago = $this->timestamp_format($timestamp);

				$html .= '<span class="message-time col-3">' . $time_ago . '</span>';
				$html .= '</div>';

				$html .= '<div class="clearfix"></div>';

				if ($message['last_message_sender_id'] == $current_user_id) {
					$html .= '<span class="message-content text-ellipsis col-12">You : ' . $message['last_message'] . '</span>'; // Adjusted column width to occupy full width
				} else {
					$sender_fname = explode(' ', $message['last_message_sender_name']);
					$html .= '<span class="message-content text-ellipsis col-12">' . $sender_fname[0] . ': ' . $message['last_message'] . '</span>'; // Adjusted column width to occupy full width
				}

				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</a>';
				$html .= '</li>';

				// $html = "<li>". $message['last_message'] ."</li>";	
				// Add the HTML message to the array
				array_push($html_messages, array('html' => $html, 'type' => $message['conversation_type'], 'emp_id' => $message['emp_id']));
				// $conversation_type[] = $message['conversation_type'];
			}


			// Return the JSON response with HTML messages
			// $this->output->set_output(json_encode(array('success' => true, 'response' => ['html_messages' => $html_messages, 'type' => $conversation_type])));
			$this->output->set_output(json_encode(array('success' => true, 'html_messages' => $html_messages)));
		} else {
			// Log the database error
			$error = $this->db->error();
			log_message('error', 'Database error: ' . $error['message']);


			// Return the JSON error response
			$this->output->set_output(json_encode(array('success' => false, 'error' => 'Database error')));
		}


		// Set the appropriate content type
		$this->output->set_content_type('application/json');
	}



	public function C_hr_assets()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Assets';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_assets');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_profile()
	{


		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Profile';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_profile');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_settings()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Settings';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_settings');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_announcement()
	{

		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Announcements';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_announcement');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}



	public function C_hr_employees()
	{


		$data['title'] = 'HR | Employees';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_employees');
		$this->load->view('templates/footer');
	}


	public function C_hr_departments()
	{


		$data['title'] = 'HR | Departments';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_departments');
		$this->load->view('templates/footer');
	}


	public function import()
	{
		if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			if ($_FILES["file"]["size"] > 0) {
				$file = fopen($path, "r");
				$firstRowSkipped = false;
				while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
					if (!$firstRowSkipped) {
						$firstRowSkipped = true;
						continue; // Skip the first row
					}

					// Modify the data mapping according to your CSV structure
					$data = array(
						'id' => generateEmployeeCode($getData[0] . ' ' . $getData[1] . ' ' . $getData[2]), // Assuming employee ID is in column index 0
						'fname' => $getData[0], // First name
						'mname' => $getData[1], // Middle name
						'lname' => $getData[2], // Last name
						'nickn' => $getData[3], // Nickname (assuming it's in column index 3)
						'contact_no' => $getData[4], // Contact number (assuming it's in column index 4)
						'current_add' => $getData[5], // Current address (assuming it's in column index 5)
						'perm_add' => $getData[6], // Permanent address (assuming it's in column index 6)
						'dob' => $getData[7], // Date of birth (assuming it's in column index 7)
						'age' => $getData[8], // Age (assuming it's in column index 8)
						'religion' => $getData[9], // Religion (assuming it's in column index 9)
						'sex' => $getData[10], // Sex (assuming it's in column index 10)
						'civil_status' => $getData[11], // Civil status (assuming it's in column index 11)
						'pob' => $getData[12], // Place of birth (assuming it's in column index 12)
						'email' => $getData[13]

					);

					// Insert data into the database
					$this->db->insert('employee', $data);
				}
				fclose($file);
				echo "CSV File has been successfully Imported.";
			} else {
				echo "Invalid File: Please Upload CSV File.";
			}
		}
	}


	public function export_csv()
	{
		// Select all columns from the database
		$employees = $this->db->get('employee')->result_array();

		// Set CSV headers
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment;filename="employee_data.csv"');
		header('Cache-Control: max-age=0');

		// Open output stream
		$output = fopen('php://output', 'w');
		fwrite($output, "\xEF\xBB\xBF"); // UTF-8 BOM

		// Write CSV headers
		fputcsv($output, array('ID', 'First Name', 'Middle Name', 'Last Name', 'Nickname', 'Contact No', 'Current Address', 'Permanent Address', 'Date of Birth', 'Age', 'Religion', 'Sex', 'Civil Status', 'Place of Birth', 'Email', 'Date Created'));

		// Write employee data to CSV
		foreach ($employees as $employee) {
			// Map the database column names to CSV column order
			$csvData = array(
				$employee['id'],
				$employee['fname'],
				$employee['mname'],
				$employee['lname'],
				$employee['nickn'],
				$employee['contact_no'],
				$employee['current_add'],
				$employee['perm_add'],
				$employee['dob'],
				$employee['age'],
				$employee['religion'],
				$employee['sex'],
				$employee['civil_status'],
				$employee['pob'],
				$employee['email'],
				$employee['date_created']
			);
			fputcsv($output, $csvData);
		}

		// Close output stream
		fclose($output);
	}





	public function import_csv()
	{


		$data['title'] = 'HR | Importing';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/import_csv');
		$this->load->view('templates/footer');
	}

	public function C_hr_employees_list()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_list');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_employees_designation()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Departments';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_designation');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}


	public function C_hr_emp_attendace()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Attendance';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_attendance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_shifts()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Shifts';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_shift');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_performance_evaluation()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Performance Evaluation';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employees_performance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_emp_leaves()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Employees | Leaves';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_employee_leaves');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_calendar()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Calendar';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_calendar');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_shifts()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Shifts';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_shifts');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_leaves()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Leaves';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_leaves');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_timesheet()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Timesheet';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_timesheet');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_emp_performance()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Employee Performance';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_emp_performance');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_report_salary()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_report_salary');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_rate()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_salary_rate');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_bonus()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_bonuses');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_hr_payroll_deduction()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Reports | Salary';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll_deductions');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function C_formshistory()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'Employee | Request History';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/employee/form_request_history');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function adduser()
	{
		$response = array();
		// Extract data from POST request
		$fname = format_text($this->input->post('fname'));
		$lname = format_text($this->input->post('lname'));
		$mname = format_text($this->input->post('mname'));
		$nickn = format_text($this->input->post('nickn'));
		$current_add = format_text($this->input->post('current_address'));
		$perm_add = format_text($this->input->post('perm_add'));
		$dob = $this->input->post('dob');
		$pob = format_text($this->input->post('pob'));
		$religion = format_text($this->input->post('religion'));
		$sex = format_text($this->input->post('sex'));
		$civil_status = format_text($this->input->post('civil_status'));
		$email = $this->input->post('email');

		$password = md5($this->input->post('password'));

		// Handle image upload
		if (isset($_FILES['capturedImage']) && $_FILES['capturedImage']['error'] == UPLOAD_ERR_OK) {
			// Process the uploaded image
			$image_data = file_get_contents($_FILES['capturedImage']['tmp_name']);
			// Add image data to the data array
			$pfp = $image_data;
		}
		$full_name = $fname . ' ' . $mname . ' ' . $lname;

		// Add other form data to the data array
		$data = array(
			'id' => generateEmployeeCode($full_name),
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'nickn' => $nickn,
			'current_add' => $current_add,
			'perm_add' => $perm_add,
			'dob' => $dob,
			'pob' => $pob,
			'religion' => $religion,
			'sex' => $sex,
			'civil_status' => $civil_status,
			'email' => $email,
			'password' => $password,
			'pfp' => $pfp,

		);

		$sql = $this->db->insert('employee', $data);

		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'User added successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add user';
		}
		echo json_encode($response);
	}

	public function delete()
	{
		$emp_id = $this->input->post('emp_id');
		$this->load->database();
		$this->db->where('emp_id', $emp_id);
		$result = $this->db->delete('employee');

		if ($result) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' => false, 'message' => 'Failed to delete employee.'));
		}
	}

	public function showUserdetails()
	{
		try {
			$emp_id = $this->input->post('emp_id');
			log_message('debug', 'Employee ID: ' . $emp_id);
			$employee = $this->db->get_where('employee', array('id' => $emp_id));

			if ($employee->num_rows() > 0) {
				$data = array();
				$data['status'] = "success";

				foreach ($employee->result() as $row) {
					$row_data = array(
						'id' => $row->id,
						'fname' => $row->fname,
						'mname' => $row->mname,
						'lname' => $row->lname,
						'nickn' => $row->nickn,
						'current_add' => $row->current_add,
						'perm_add' => $row->perm_add,
						'dob' => $row->dob,
						'religion' => $row->religion,
						'sex' => $row->sex,
						'civil_status' => $row->civil_status,
						'pob' => $row->pob,
						'email' => $row->email,
						'contact_no' => $row->contact_no

					);
					$data['data'] = $row_data;
				}

				echo json_encode($data);
			} else {
				$data['status'] = "failed";
				$data['detail'] = "Employee ID not found.";
				echo json_encode($data);
			}
		} catch (\Throwable $th) {
			$data['status'] = "error";
			$data['detail'] = $th;
			echo json_encode($data);
			// throw $th;
		}
	}

	public function updateUser()
	{
		$emp_id = $this->input->post('emp_id');
		$data = array(
			'fname' => format_text($this->input->post('fname')),
			'mname' => format_text($this->input->post('mname')),
			'lname' => format_text($this->input->post('lname')),
			'nickn' => format_text($this->input->post('nickn')),
			'current_add' => format_text($this->input->post('current_add')),
			'perm_add' => format_text($this->input->post('perm_add')),
			'dob' => $this->input->post('dob'),
			'religion' => format_text($this->input->post('religion')),
			'sex' => format_text($this->input->post('sex')),
			'civil_status' => format_text($this->input->post('civil_status')),
			'pob' => format_text($this->input->post('pob')),
			'contact_no' => $this->input->post('contact_no'),
			'email' => $this->input->post('email'),
			// 'password' => $this->input->post('password')
		);
		$this->db->where('id', $emp_id);
		$sql = $this->db->update('employee', $data);
		$response = array();
		if ($sql) {
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
			$response['status'] = 1;
			$response['msg'] = 'Employee data updated successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update employee data';
		}
		echo json_encode($response);
	}

	public function dash()
	{
		if ($this->session->userdata('logged_in') === TRUE) {
			$data['title'] = 'TItle';

			$this->load->view('pages/hr_home');
		} else {
			redirect('pages/login');
		}
	}

	public function add_announce()
	{
		$datetime = date('Y-m-d H:i:s', time());
		$response = array();

		// Retrieve selected departments
		$selected_departments = explode(',', $this->input->post('selected_dept'));

		// Check if "all" is selected
		$to_all = (in_array('all', $selected_departments)) ? 1 : 0;

		// Prepare data for announcement table
		$announcement_data = array(
			'author' => $this->input->post('author'),
			'title' => $this->input->post('title'),
			'to_all' => $to_all,
			'content' => $this->input->post('editor_content'),
			'date_created' => $this->input->post('postdate')
		);

		// Insert data into announcement table
		$announcement_insert = $this->db->insert('announcement', $announcement_data);

		if ($announcement_insert) {
			// Get the ID of the inserted announcement
			$announcement_id = $this->db->insert_id();

			if (!$to_all) {
				// Prepare data for announce_to table only if "all" is not selected
				$announce_to_data = array();
				foreach ($selected_departments as $dept_id) {
					$announce_to_data[] = array(
						'ann_id' => $announcement_id,
						'dept_id' => $dept_id
					);
				}

				// Insert data into announce_to table
				$announce_to_insert = $this->db->insert_batch('announce_to', $announce_to_data);

				if (!$announce_to_insert) {
					// Rollback if insert into announce_to fails
					$this->db->delete('announcement', array('id' => $announcement_id));
					$response['status'] = 0;
					$response['msg'] = 'Error inserting departments.';
					echo json_encode($response);
					return;
				}
			}

			$response['status'] = 1;
			$response['inserted_id'] = $announcement_id;
			$response['msg'] = 'Announcement inserted successfully.';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error inserting announcement.';
		}

		echo json_encode($response);
	}





	public function add_dept()
	{
		$response = array();
		$department = $this->input->post('dept_name');
		$data = array(
			/*column name*/
			'department' => $department
		);

		$sql = $this->db->insert('department', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}



	//add 
	public function addroles()
	{
		// Initialize response array
		$response = array();

		// Get input data
		$department = $this->input->post('department_id');
		$role_name = $this->input->post('role_name');
		$salary = $this->input->post('salary');
		$salary_type = $this->input->post('salary_type');

		// Prepare data for insertion
		$data = array(
			'department' => $department,
			'roles' => $role_name,
			'salary' => $salary,
			'salary_type' => $salary_type
		);

		// Insert data using Query Builder to prevent SQL injection
		$inserted = $this->db->insert('department_roles', $data);

		// Check if insertion was successful
		if ($inserted) {
			$response['status'] = 1;
			$response['msg'] = 'Role added successfully';
			http_response_code(200); // OK
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to add role';
			http_response_code(500); // Internal Server Error
		}

		// Return JSON response
		echo json_encode($response);
	}



	public function add_assets()
	{
		$response = array();

		$asset_name = $this->input->post('assetname');
		$purchase_date = $this->input->post('purchdate');
		$model = $this->input->post('model');
		$serial_number = $this->input->post('serial');
		$assetcondition = $this->input->post('condition');
		$warranty_start = $this->input->post('warranty');
		$amount = $this->input->post('amount');


		$data = array(

			'asset_name' => $asset_name,
			'purchase_date' => $purchase_date,
			'warranty_start' => $warranty_start,
			'amount' => $amount,
			'assetCondition' => $assetcondition,
			'model' => $model,
			'serial_number' => $serial_number

		);

		$sql = $this->db->insert('assets', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Done';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error';
		}

		echo json_encode($response);
	}

	public function getUserCount()
	{
		// Load the model for accessing the database
		$this->load->model('hr');

		// Get the count of users from the model
		$userCount = $this->User_model->getUserCount();

		// Send the count as JSON response
		echo json_encode(['userCount' => $userCount]);
	}

	public function pending_req()
	{
		$data['title'] = 'HR | Pendings';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/request_pending');
		$this->load->view('templates/footer');
	}

	public function history_req()
	{
		$data['title'] = 'HR | History';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/hr/hr_req_history');
		$this->load->view('templates/footer');
	}
	public function modal1()
	{

		$this->load->view('templates/header');
		$this->load->view('modal_view');
		$this->load->view('templates/footer');
	}

	public function update_leave_status()
	{
		// Retrieve emp_id from POST data
		$leave_id = $this->input->post('vq_leave_id');

		// Define data to be updated
		$data = array(
			// 'id' => ucwords($this->input->post('vq_leave_id')),
			'status' => ucwords($this->input->post('vq_leave_status'))

		);

		// Update the employee record
		$this->db->where('id', $leave_id);
		$sql = $this->db->update('f_leaves', $data);

		// Prepare response
		$response = array();
		if ($sql) {

			$response['status'] = 1;
			$response['msg'] = 'Leave data updated successfully';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Failed to update Leave data';
		}

		// Echo JSON response
		echo json_encode($response);
	}

	public function fetch_data()
	{
		// Handle AJAX request to fetch data
		$requestType = $this->input->post('requestType');
		$id = $this->input->post('id');

		// Perform query based on request type
		if ($requestType === 'LEAVE REQUEST') {
			$query = $this->db->get_where('f_leaves', array('id' => $id));
		} elseif ($requestType === 'offbusiness') {
			$query = $this->db->get_where('offbusiness_table', array('id' => $id));
		} else {
			// Handle invalid request type
			echo "Invalid request type humanr";
			return;
		}

		// Check if query was successful
		if ($query->num_rows() > 0) {
			$data['row'] = $query->row_array();
			$data['requestType'] = $requestType; // Pass request type to the view
			// Load the view and pass fetched data
			$this->load->view('modal_view', $data);
		} else {
			echo "No data found";
		}
	}
}
