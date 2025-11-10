<template id="Login">
	<div class="main-container">
		<section class="section-sm">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="mx-auto mt-5" style="max-width: 420px;">
							<div class="content mb-5">
								</br></br></br>
								<h2 id="we-would-love-to-hear-from-you">Login to your account</h2>
							</div>
							<form name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
								<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>
									{{errorMsg}}
								</b-alert>
								<div class="form-group">
									<label for="username">Email or Phone Number <span class="text-danger">*</span></label>
									<input id="username" type="text" name="username" v-model="user.username" class="form-control" placeholder="you@example.com" required style="border:1px solid #000;border-radius:9999px;">
								</div>
								<!-- <div class="form-group">
									<label for="login_type">Login Type</label>
									<select id="login_type" class="form-control" style="border:1px solid #000;border-radius:9999px;">
										<option value="user" selected>User</option>
										<option value="rider">Rider</option>
									</select>
								</div> -->
								<div class="form-group">
									<label for="password">Password <span class="text-danger">*</span></label>
									<input id="password" type="password" name="password" class="form-control" v-model="user.password" placeholder="•••••••••••••" required style="border:1px solid #000;border-radius:9999px;">
								</div>
								<div class="d-flex justify-content-between align-items-center" style="margin-top: 5px !important;">
									<a href="<?php print_link('passwordmanager') ?>" class="text-danger">Forgot Password?</a>
									<div class="checkboxes mb-0">
										<input style="transition: box-shadow 0.2s !important; box-sizing: border-box; padding: 0;" name="rememberme" type="checkbox" id="remember-me" value="true">
										<label for="remember-me" style="margin-left: 4px;">Remember me</label>
									</div>
								</div>
								<div class="form-row mt-2">
									<button class="btn btn-primary btn-block" type="submit">
										<i class="load-indicator"><clip-loader :loading="loading" color="#fff" size="14px"></clip-loader></i>Login <i class="fa fa-key"></i>
									</button>
								</div>
								<div style="margin-top: 12px; text-align: center;">
									Don't have an account?
									<router-link to="/register">Register</router-link>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</template>
<script>
	var LoginComponent = Vue.component('LoginComponent', {
		template: '#Login',
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
						this.errorMsg = response.statusText ? response.statusText : "Invalid username or password";
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
	.main-container {
		background-color: #FFFFFF;
		background-image: radial-gradient(#28a745 1.1px, transparent 1.1px), radial-gradient(#28a745 1.1px, #FFFFFF 1.1px);
		background-size: 44px 44px;
		background-position: 0 0, 22px 22px;
		padding-bottom: 100px;
	}
</style>