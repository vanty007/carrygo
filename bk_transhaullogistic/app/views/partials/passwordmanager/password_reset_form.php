<div>
	<section class="page-header">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h1 class="page-title">Set a New Password</h1>
					<p class="page-subtitle">Please choose a new password for your account. Make sure it's secure.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section-sm" style="background-color: #f7f9fc;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<div class="mx-auto" style="max-width: 450px;">
						<div class="card p-4 p-md-5">
							<?php
							// This is where your PHP error display function will output messages.
							$this::display_page_errors();
							?>
							<form method="post" action="<?php print_link(get_current_url()); ?>">
								<div class="form-group">
									<label for="txtpass">New Password</label>
									<input placeholder="Your New Password" required="required" value="" class="form-control" name="password" id="txtpass" type="password" style="border-radius: 9999px;" />
									<small class="form-text text-muted">Hint: Must be at least 6 characters long.</small>
								</div>
								<div class="form-group">
									<label for="txtcpass">Confirm New Password</label>
									<input placeholder="Confirm Password" required="required" class="form-control" name="cpassword" id="txtcpass" type="password" style="border-radius: 9999px;" />
								</div>
								<div class="form-group text-center mt-4">
									<button class="btn btn-primary btn-block" type="submit" style="border-radius: 9999px; padding: 12px;">
										Change Password
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>