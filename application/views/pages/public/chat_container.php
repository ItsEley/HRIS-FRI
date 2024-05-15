<div class="chat-window" id="chat-window" hidden>
	<div class="fixed-header">
		<div class="navbar">
			<div class="user-details me-auto">
				<div class="float-start user-img">
					<a class="avatar" href="profile.html" title="Mike Litorus">
						<img src="assets/img/profiles/avatar-05.jpg" alt="User Image" class="rounded-circle" id="talking_to_pfp">
						<span class="status online"></span>
					</a>
				</div>
				<div class="user-info float-start">
					<a href="profile.html" title="Mike Litorus"><span id="talking_to">Mike Litorus</span> <i class="typing-text" hidden>Typing...</i></a>
					<span class="last-seen" hidden>Last seen today at 7:50 AM</span>
				</div>
			</div>


			<div class="search-box" hidden>
				<div class="input-group input-group-sm">
					<input type="text" placeholder="Search" class="form-control">
					<button type="button" class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
				</div>
			</div>


			<ul class="nav custom-menu">
				<li class="nav-item">
					<a class="nav-link task-chat profile-rightbar float-end" id="task_chat" href="#task_window"><i class="fa-solid fa-user"></i></a>
				</li>
				<li class="nav-item" hidden>
					<a href="voice-call.html" class="nav-link"><i class="fa-solid fa-phone"></i></a>
				</li>
				<li class="nav-item" hidden>
					<a href="video-call.html" class="nav-link"><i class="fa-solid fa-video"></i></a>
				</li>
				<li class="nav-item dropdown dropdown-action" hidden>
					<a aria-expanded="false" data-bs-toggle="dropdown" class="nav-link dropdown-toggle" href="#"><i class="fa-solid fa-gear"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:void(0)" class="dropdown-item">Delete Conversations</a>
						<a href="javascript:void(0)" class="dropdown-item">Settings</a>
					</div>
				</li>
			</ul>
		</div>
	</div>


	<div class="chat-contents">
		<div class="chat-content-wrap">
			<div class="chat-wrap-inner">
				<div class="chat-box">
					<div class="chats message-container">





						<!-- 
											<div class="chat chat-right">
												<div class="chat-body">
													<div class="chat-bubble">
														<div class="chat-content">
															<p>Hello. What can I do for you?</p>
															<span class="chat-time">8:30 am</span>
														</div>

													</div>
												</div>
											</div>



											<div class="chat-line">
												<span class="chat-date">October 8th, 2018</span>
											</div>




											<div class="chat chat-left">
												<div class="chat-avatar">
													<a href="profile.html" class="avatar">
														<img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
													</a>
												</div>
												<div class="chat-body">
													<div class="chat-bubble">
														<div class="chat-content">
															<p>I'm just looking around.</p>
															<p>Will you tell me something about yourself? </p>
															<span class="chat-time">8:35 am</span>
														</div>

													</div>
													<div class="chat-bubble">
														<div class="chat-content">
															<p>Are you there? That time!</p>
															<span class="chat-time">8:40 am</span>
														</div>

													</div>
												</div>
											</div>

 -->






					</div>
				</div>
			</div>
		</div>
	</div>
	<form id="chatForm" method="post">


		<div class="chat-footer">
			<div class="message-bar">
				<div class="message-inner">
					<a class="link attach-icon" href="#" data-bs-toggle="modal" data-bs-target="#drag_files">
						<i class="fa-solid fa-paperclip"></i></a>
					<div class="message-area">
						<div class="input-group">
							<textarea class="form-control" placeholder="Type message..." id="chat_message_input" name="chat_message_input" onkeypress=""></textarea>
							<button class="btn btn-custom" type="submit" id="sendBtn"><i class="fa-solid fa-paper-plane"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>




<script>
	// Document ready function
	$(document).ready(function() {
		// Add event listener for keypress event
		$("#chat_message_input").keypress(function(event) {
			// Check if Enter key is pressed (keyCode 13) and Shift key is not pressed
			if (event.which === 13 && !event.shiftKey) {
				// Prevent the default behavior (adding a new line) of the Enter key
				event.preventDefault();

				// Get the value of the textarea
				var message = $(this).val().trim(); // Trim any leading/trailing whitespace

				// Check if the message is not empty
				if (message !== "") {


					// Do something with the message (e.g., send it to the server)
					// For example, submit the form

					// console.log("current_user :", current_user_id)
					// console.log("current_conversation_id :", current_conversation_id)
					// console.log("conversation_type :", conversation_type)

					$('#chatForm').submit();

					// Disable the input field to prevent spam
					$(this).prop('disabled', true);
					// Clear the textarea
					$(this).val("");

					// Re-enable the input field after 1 second
					setTimeout(function() {
						$("#chat_message_input").prop('disabled', false).focus(); // Re-enable and focus on the input field
					}, 1000);
				}
			}
		});
	});
</script>