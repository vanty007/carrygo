<template id="Index">
	<div>
		<section class="page-header">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8 text-center">
						<h1 class="page-title">Admin Dashboard Login</h1>
						<p class="page-subtitle">Please enter your credentials to access the admin panel.</p>
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
								<form name="loginForm" @submit.prevent="login()" method="post">
									<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>
										{{errorMsg}}
									</b-alert>
									<div class="form-group">
										<label for="username">Email or Phone Number <span class="text-danger">*</span></label>
										<input id="username" type="text" name="username" v-model="user.username" class="form-control" placeholder="you@example.com" required style="border-radius:9999px;">
									</div>

									<div class="form-group">
										<label for="password">Password <span class="text-danger">*</span></label>
										<input id="password" type="password" name="password" class="form-control" v-model="user.password" placeholder="•••••••••••••" required style="border-radius:9999px;">
									</div>

									<div class="d-flex justify-content-between align-items-center mb-4">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" name="rememberme" id="remember-me" value="true">
											<label class="custom-control-label" for="remember-me">Remember me</label>
										</div>
										<a href="<?php print_link('passwordmanager') ?>" class="text-danger">Forgot Password?</a>
									</div>

									<div class="form-group text-center">
										<button class="btn btn-primary btn-block" type="submit" style="border-radius: 9999px; padding: 12px;">
											<i class="load-indicator"><clip-loader :loading="loading" color="#fff" size="14px"></clip-loader></i>
											Login <i class="ti-arrow-right"></i>
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
</template>

<script>
	var IndexComponent = Vue.component('IndexComponent', {
		template: '#Index',
		data: function() {
			return {
				user: {
					username: '',
					password: '',
				},
				loading: false,
				ready: false,
				errorMsg: '',
				showError: false,
			}
		},
		computed: {
			setGridSize: function() {
				if (this.resetgrid) {
					return 'col-sm-12 col-md-12 col-lg-12';
				}
			}
		},
		methods: {
			login: function(e) {
				var payload = this.user;
				this.loading = true;
				var self = this;
				var apiurl = setApiUrl('index/login');
				this.$http.post(apiurl, payload, {
					emulateJSON: true
				}).then(function(response) {
						self.loading = false;
						window.location = response.body;
					},
					function(response) {
						this.loading = false;
						this.showError = false;
						this.errorMsg = response.statusText || "Invalid username or password";
						//Flashes messages
						setTimeout(function() {
							self.showError = true;
						}, 100);
					});
			}
		},
		mounted: function() {
			this.ready = true;
		},
	});
</script>

<style scoped>
	.page-header {
		padding: 80px 0;
		text-align: center;
		border-bottom: 1px solid #dee2e6;
		background-color: #fff;
		margin-top: 50px;
	}

	.page-title {
		font-weight: 800;
		font-size: 4rem;
	}

	.page-subtitle {
		font-size: 1.1rem;
		color: #6c757d;
		max-width: 600px;
		margin: 0 auto;
	}
</style>