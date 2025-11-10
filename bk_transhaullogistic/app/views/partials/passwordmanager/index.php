<div>
	<section class="page-header">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h1 class="page-title">Reset Your Password</h1>
					<p class="page-subtitle">Please provide the valid email address you used to register. A link to reset your password will be sent to you.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section-sm">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto">
					<div class="mx-auto" style="max-width: 550px;">
						<div class="card p-4 p-md-5">
							<?php
							// This is where your PHP error display function will output messages.
							$this::display_page_errors();
							?>
							<form method="post" action="<?php print_link("passwordmanager/postresetlink"); ?>">
								<div class="form-group">
									<label for="email">Enter Your Email Address</label>
									<div class="input-group">
										<input value="<?php echo get_form_field_value('email'); ?>" placeholder="you@example.com" required="required" class="form-control" name="email" type="email" style="border-radius: 9999px 0 0 9999px;" />
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit" style="border-radius: 0 9999px 9999px 0;">Send Link <i class="ti-arrow-right"></i></button>
										</div>
									</div>
								</div>
							</form>
							<div class="text-center mt-3">
								<a href="/">Back to Login</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>