<style>
	.sidebar .sidebar-vertical .list-body>* {
		color: white;
	}

	.sidebar .sidebar-vertical .list-body>.message-content {
		/* color: #333333; */
		font-size: 13px;
		display: block;
		max-width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
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
		<div id="add_chat_user" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Direct Chat</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="input-group m-b-30">
							<input placeholder="Search to start a chat" class="form-control search-input" type="text">
							<button class="btn btn-primary">Search</button>
						</div>
						<div>
							<h5>Recent Conversations</h5>
							<ul class="chat-user-list">
								<li>
									<a href="#">
										<div class="chat-block d-flex">
											<span class="avatar align-self-center flex-shrink-0">
												<img src="assets/img/profiles/avatar-16.jpg" alt="User Image">
											</span>
											<div class="media-body align-self-center text-nowrap flex-grow-1">
												<div class="user-name">Jeffery Lalor</div>
												<span class="designation">Team Leader</span>
											</div>
											<div class="text-nowrap align-self-center">
												<div class="online-date">1 day ago</div>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="chat-block d-flex">
											<span class="avatar align-self-center flex-shrink-0">
												<img src="assets/img/profiles/avatar-13.jpg" alt="User Image">
											</span>
											<div class="media-body align-self-center text-nowrap flex-grow-1">
												<div class="user-name">Bernardo Galaviz</div>
												<span class="designation">Web Developer</span>
											</div>
											<div class="align-self-center text-nowrap">
												<div class="online-date">3 days ago</div>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="#">
										<div class="chat-block d-flex">
											<span class="avatar align-self-center flex-shrink-0">
												<img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
											</span>
											<div class="media-body text-nowrap align-self-center flex-grow-1">
												<div class="user-name">John Doe</div>
												<span class="designation">Web Designer</span>
											</div>
											<div class="align-self-center text-nowrap">
												<div class="online-date">7 months ago</div>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="submit-section">
							<button class="btn btn-primary submit-btn">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
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
<?php $this->load->view('components\modal-announcement-details.php'); ?>


<script>
	var current_user_id;
	var current_conversation_id;
	var conversation_type; // group or private


	function update_windows() {
		//check if there is selected conversation

		if (current_conversation_id != null && conversation_type != null) {
			$("#chat-window").removeAttr("hidden");
			$("#dialog-no-message").attr("hidden", "true");
		} else {
			$("#chat-window").attr("hidden", "true");
			$("#dialog-no-message").removeAttr("hidden");


		}
	}



	$(".conversation-private").on('click', function() {

		current_conversation_id = $(this).data('employee-id');
		conversation_type = "private";
		console.log($(this).find(".conversation-title").html())
		$("#talking_to").html($(this).find(".conversation-title").html())
		console.log(conversation_type, " : ", current_conversation_id)

		update_windows();
	});


	$(".conversation-group").on('click', function() {

		current_conversation_id = $(this).data('group-id');
		conversation_type = "group";
		console.log($(this).find(".conversation-title").html())
		$("#talking_to").html($(this).find(".conversation-title").html())
		console.log(conversation_type, " : ", current_conversation_id)

		update_windows();
	});



	document.addEventListener('DOMContentLoaded', function() {







	})
</script>