<?php

$this->load->helper('my_gen_func_helper.php');
?>

<style>
	.sidebar .sidebar-vertical .list-body>* {
		color: white;
	}

	.sidebar .sidebar-vertical .list-body>.chat-content {
		/* color: #333333; */
		font-size: 13px;
		display: block;
		max-width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	#sidebar_menu .notification-message.active {
		background-color: #2d393f !important;
	}
</style>
<!-- Main Wrapper -->
<div class="main-wrapper">
	<?php $this->load->view('templates/nav_bar'); ?>
	<!-- /Header -->
	<!-- Sidebar -->

	<?php $this->load->view('pages\public\chat_sidebar.php'); ?>














	<!-- Page Wrapper -->
	<div class="page-wrapper" style="min-height: 100%">

		<!-- Chat Main Row -->
		<div class="chat-main-row">

			<!-- Chat Main Wrapper -->
			<div class="chat-main-wrapper">

				<!-- Chats View -->
				<div class="col-lg-9 message-view task-view">
					<?php $this->load->view('pages\public\chat_container.php'); ?>

					<div class="mx-auto text-center" id="dialog-no-message" style="
    margin-top: 20vh;padding:5rem;
">No messages selected. Select one conversation or initiate a new one to get started.</div>


				</div>
				<!-- /Chats View -->

				<!-- Chat Right Sidebar -->
				<div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="task_window" hidden>
					<?php $this->load->view('pages\public\chat_details_private.php'); ?>
					<?php $this->load->view('pages\public\chat_details_group.php'); ?>


				</div>
				<!-- /Chat Right Sidebar -->

			</div>
			<!-- /Chat Main Wrapper -->

		</div>
		<!-- /Chat Main Row -->

		<!-- Drogfiles Modal -->
		<div id="drag_files" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Drag and drop files upload</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="js-upload-form">
							<div class="upload-drop-zone" id="drop-zone">
								<i class="fa fa-cloud-upload fa-2x"></i> <span class="upload-text">Just drag and drop files here</span>
							</div>
							<h4>Uploading</h4>
							<ul class="upload-list">
								<li class="file-list">
									<div class="upload-wrap">
										<div class="file-name">
											<i class="fa fa-photo"></i>
											photo.png
										</div>
										<div class="file-size">1.07 gb</div>
										<button type="button" class="file-close">
											<i class="fa fa-close"></i>
										</button>
									</div>
									<div class="progress progress-xs progress-striped">
										<div class="progress-bar bg-success w-65" role="progressbar"></div>
									</div>
									<div class="upload-process">37% done</div>
								</li>
								<li class="file-list">
									<div class="upload-wrap">
										<div class="file-name">
											<i class="fa fa-file"></i>
											task.doc
										</div>
										<div class="file-size">5.8 kb</div>
										<button type="button" class="file-close">
											<i class="fa fa-close"></i>
										</button>
									</div>
									<div class="progress progress-xs progress-striped">
										<div class="progress-bar bg-success w-65" role="progressbar"></div>
									</div>
									<div class="upload-process">37% done</div>
								</li>
								<li class="file-list">
									<div class="upload-wrap">
										<div class="file-name">
											<i class="fa fa-photo"></i>
											dashboard.png
										</div>
										<div class="file-size">2.1 mb</div>
										<button type="button" class="file-close">
											<i class="fa fa-close"></i>
										</button>
									</div>
									<div class="progress progress-xs progress-striped">
										<div class="progress-bar bg-success w-65" role="progressbar"></div>
									</div>
									<div class="upload-process">Completed</div>
								</li>
							</ul>
						</form>
						<div class="submit-section">
							<button class="btn btn-primary submit-btn">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Drogfiles Modal -->

		<!-- Add Group Modal -->
		<div id="add_group" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Create a group</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Groups are where your team communicates. They’re best when organized around a topic — #leads, for example.</p>
						<form>
							<div class="input-block mb-3">
								<label class="col-form-label">Group Name <span class="text-danger">*</span></label>
								<input class="form-control" type="text">
							</div>
							<div class="input-block mb-3">
								<label class="col-form-label">Send invites to: <span class="text-muted-light">(optional)</span></label>
								<input class="form-control" type="text">
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- /Add Group Modal -->

		<!-- Add Chat User Modal -->
		<?php $this->load->view('templates\modals\chat_add_user.php'); ?>

		<!-- /Add Chat User Modal -->


		<!-- Share Files Modal -->
		<div id="share_files" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Share File</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="files-share-list">
							<div class="files-cont">
								<div class="file-type">
									<span class="files-icon"><i class="fa-regular fa-file-pdf"></i></span>
								</div>
								<div class="files-info">
									<span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span>
									<span class="file-author"><a href="#">Bernardo Galaviz</a></span> <span class="file-date">May 31st at 6:53 PM</span>
								</div>
							</div>
						</div>
						<div class="input-block mb-3">
							<label class="col-form-label">Share With</label>
							<input class="form-control" type="text">
						</div>
						<div class="submit-section">
							<button class="btn btn-primary submit-btn">Share</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Share Files Modal -->

	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<audio controls id="audio_new_message">
	<source src="<?= base_url('assets/audio/tink.mp3') ?>" type="audio/mp3" />
	<source src="<?= base_url('assets/audio/tink.mp3') ?>" type="audio/mp3" />
	<source src="<?= base_url('assets/audio/tink.mp3') ?>" type="audio/mp3" />

</audio>


<script>
	var current_user_id = <?= $this->session->userdata('id'); ?>;
	var current_conversation_id;
	var conversation_type; // group or private
	var message_limit = 200;
	var conversation_selected = false;
	var fetch_active = false;


	// function update_windows() {
	// 	//check if there is selected conversation

	// 	if (current_conversation_id != null && conversation_type != null) {
	// 		$("#chat-window").removeAttr("hidden");
	// 		$("#dialog-no-message").attr("hidden", "true");


	// 		if (fetch_active == false) { // Poll for new messages every 5 seconds
	// 			setInterval(fetchMessages, 5000);
	// 			// Initial fetch when the page loads
	// 			fetchMessages();
	// 			fetch_active = true;
	// 		}
	// 		console.log("Message Loaded");

	// 		scrollToBottom();


	// 	} else {
	// 		$("#chat-window").attr("hidden", "true");
	// 		$("#dialog-no-message").removeAttr("hidden");


	// 	}
	// }



	// $(".conversation-private").on('click', function() {

	// 	current_conversation_id = $(this).data('employee-id');
	// 	conversation_type = "private";
	// 	console.log($(this).find(".conversation-title").html())
	// 	$("#talking_to").html($(this).find(".conversation-title").html())
	// 	console.log(conversation_type, " : ", current_conversation_id)

	// 	update_windows();
	// });


	// $(".conversation-group").on('click', function() {

	// 	current_conversation_id = $(this).data('group-id');
	// 	conversation_type = "group";
	// 	console.log($(this).find(".conversation-title").html())
	// 	$("#talking_to").html($(this).find(".conversation-title").html())
	// 	console.log(conversation_type, " : ", current_conversation_id)

	// 	update_windows();
	// });



	// chat messagess
	var audio = document.getElementById('audio_new_message');

	function play_new_message() {
		console.log("Playing audio")

		audio.play();
	}

	// Function to scroll the chat container to the bottom
	function scrollToBottom() {
		var chatContainer = $('.chat-wrap-inner')[0]; // Access the native DOM element
		setTimeout(function() {
			chatContainer.scrollTop = chatContainer.scrollHeight; // Scroll to the bottom
		}, 100); // Adjust the delay as needed
	}


	// Function to display messages in the chat container
	function displayMessages(messages, message_container) {
		// Loop through each message
		console.log("display messages", messages);
		let new_mess_counter = 0;



		messages.forEach(function(message) {
			// Check if message already exists in the chat container
			var existingMessage = $('' + message_container).find('[data-message-id="' + message.id + '"]');

			if (existingMessage.length > 0) {
				// Message already exists, compare its content with fetched data
				var existingContent = existingMessage.find('.chat-content p').text();
				if (existingContent !== message.message) {
					// Update the content of the existing message if there's a difference
					// existingMessage.find('.chat-content p').text(message.message);
					// console.log("displayMessages chat-time")
					// existingMessage.find('.chat-time').text(message.timestamp);
					// ! DISMISSED UPDATING MESSAGE UNTIL NEEDED



				}
			} else {
				// Message does not exist, append it to the chat container
				new_mess_counter++;

				// Append my messages
				// console.log(messages)
				if (message.from_ == current_user_id) {
					var messageHTML = '<div class="chat chat-right" data-message-id="' + message.id + '" ' +
						'data-sender-id="' + message.from_ + '" data-receiver-id="' + message.to_ + '">' +
						'<div class="chat-body">' +
						'<div class="chat-bubble">' +
						'<div class="chat-content">' +
						'<p style= "text-wrap: wrap; word-wrap: break-word;">' + message.message + '</p>' +
						'<span class="chat-time">' + formatDateTime(message.timestamp) + '</span>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</div>';




					$('' + message_container).append(messageHTML);
				} else {
					// Append NOT my messages
					var messageHTML = '<div class="chat chat-left" data-message-id="' + message.id + '" ' +
						'data-sender-id="' + message.from_ + '" data-receiver-id="' + message.to_ + '">' +
						'<div class="chat-body">' +
						'<div class="chat-bubble">' +
						'<div class="chat-content">' +
						'<p style= "text-wrap: wrap; word-wrap: break-word;">' + message.message + '</p>' +
						'<span class="chat-time">' + formatDateTime(message.timestamp) + '</span>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</div>';
					$('' + message_container).append(messageHTML);
					console.log("new_mess_counter", new_mess_counter);

					if (new_mess_counter < 3) {
						// play audio if it's not too much
						play_new_message();

					}

				}
				scrollToBottom();
				// update_window();

				// fetchLatestMessages();

			}
		});
	}

	// Function to handle updates and deletes in the chat container
	function handleUpdates(messages) {
		// Iterate through each message in the chat container
		$('.message-container .message').each(function() {
			var messageId = $(this).data('message-id');
			var messageContent = $(this).find('.chat-content').text();
			var messageExists = false;

			// Check if the message exists in the fetched data
			messages.forEach(function(message) {
				if (message.id == messageId) {
					messageExists = true;
					// Check if the content has changed
					if (message.message != messageContent) {
						// Update the message content
						$(this).find('.chat-content').text(message.message);
						console.log("handleUpdates chat-time")

						$(this).find('.chat-time').text(message.timestamp);

					} else {
						console.log("Doing nothing")
					}
				}
			});

			// If the message does not exist in the fetched data, delete it from the chat container
			if (!messageExists) {
				$(this).remove();
			}
		});

	}



	// Function to fetch chat messages via AJAX
	function fetchMessages() {
		let formData = [];

		// Add additional parameters to the serialized form data
		formData.push({
			name: 'from_',
			value: current_user_id
		});

		formData.push({
			name: 'limit',
			value: message_limit
		});

		if (conversation_type == 'group') {
			formData.push({
				name: 'to_group',
				value: current_conversation_id
			});
		} else if (conversation_type == 'individual') {
			formData.push({
				name: 'to_',
				value: current_conversation_id
			});
		}

		$.ajax({
			url: '<?= base_url('datatable_fetchers/fetch_messages') ?>',
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function(data) {
				// console.log("fetchMessages", data);
				// Display fetched messages in the chat container
				displayMessages(data, ".chats.message-container");
				// Handle updates and deletes in the chat container
				handleUpdates(data);
			},
			error: function(xhr, status, error) {
				console.error('Error fetching messages:', error);
			}
		});
	}




	// new conversation modal
	$("#btn_new_direct_message").on('click', function() {
		// console.log("getting new people")
		getNewPeople()
	})


	$('#chatForm').submit(function(event) {
		event.preventDefault(); // Prevent the default form submission behavior

		// Get the message entered by the user
		var formData = $('#chatForm').serializeArray(); // Serialize form data as an array

		// Add additional parameters to the serialized form data
		formData.push({
			name: 'from_',
			value: current_user_id
		});

		if (conversation_type == 'group') {
			formData.push({
				name: 'to_group',
				value: current_conversation_id
			});

		} else if (conversation_type == 'individual') {
			formData.push({
				name: 'to_',
				value: current_conversation_id
			});

		}

		// Send the message to the server using Ajax
		$.ajax({
			url: '<?= base_url('datatable_fetchers/send_message') ?>', // Specify the URL of the server-side script
			method: 'POST', // Use POST method to send data
			data: formData, // Send serialized form data along with additional parameters
			success: function(response) {
				// Handle the success response from the server
				console.log('Message sent successfully');
				// Optionally, you can clear the input field after sending the message
				$('#chat_message_input').val('');
				fetchMessages();
				// play_new_message();

			},
			error: function(xhr, status, error) {
				// Handle any errors that occur during the Ajax request
				console.error('Error sending message:', error);
			}
		});
	});


	$(document).ready(function() {




	});
</script>