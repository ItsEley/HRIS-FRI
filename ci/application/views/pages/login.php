<div class="main-wrapper">

	<!-- <h1>LOGINN</h1> -->

	<div class="account-content">
		<!-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> -->
		<div class="container">


			<!-- Account Logo -->
			<div class="account-logo">
				<a href="admin-dashboard.html">
					<img src="<?php echo base_url('assets/img/famco_logo_clear.png')?>" alt="" style="width: 200px;padding: 10px;">
				</a>
			</div>
			<!-- /Account Logo -->

			<div class="account-box">
				<div class="account-wrapper">
				
					<h3 class="account-title">Login</h3>
					<p class="account-subtitle"></p>



					<!-- Account Form -->
					<form id="login-form" method="post">
						<div class="input-block mb-4">
							<label class="col-form-label">Email Address</label>
							<input type="text" class="form-control form-control-lg" placeholder="Email" name="email" id="email" autocomplete="username">
						</div>
						<div class="input-block mb-4">
							<div class="row align-items-center">
								<div class="col">
									<label class="col-form-label">Password</label>
								</div>
								<div class="col-auto">
									<a class="text-muted" href="forgot-password.html">
										Forgot password?
									</a>
								</div>
							</div>
							<div class="position-relative">
								<input type="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password" autocomplete="current-password" value="password">
								<span class="fa-solid fa-eye-slash" id="toggle-password"></span>
							</div>
						</div>
						<div class="input-block text-center">
							<button type="submit" class="btn btn-primary w-100">Login</button>
						</div>
						<div class="account-footer">
							<!-- <p>Don't have an account yet? <a href="register.html">Register</a></p> -->
						</div>
					</form>
					<div id="alert"></div>

					<!-- /Account Form -->



				</div>
			</div>
		</div>
	</div>
</div>