
<!-- Main Wrapper -->
<div class="main-wrapper">
	<!-- Header -->
	<?php $this->load->view('templates/nav_bar'); ?>
	<!-- /Header -->
	<!-- Sidebar -->
	<?php $this->load->view('templates/sidebar') ?>
	<!-- /Sidebar -->


	<!-- Page Wrapper -->
	<div class="page-wrapper" style="margin-left:0px;">
		<!-- Page Content -->
		<div class="content container-fluid">
			<!-- Page Header -->
			<div class="page-header">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">Pending Requests</h3>
						<!-- <ul class="breadcrumb">
								<li class="breadcrumb-item">
									<a href="admin-dashboard.html">Dashboard</a>
								</li>
								<li class="breadcrumb-item active">Blank Page</li>
							</ul> -->
					</div>
				</div>
			</div>
			<!-- /Page Header -->

			<!-- Content Starts -->

		









			<!-- /Content End -->
		</div>
		<!-- /Page Content -->
	</div>
	<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->


<script>
	document.addEventListener('DOMContentLoaded', function() {
		$("li > a[href='<?= base_url('resources/forms') ?>']").parent().addClass("active");


	})
</script>