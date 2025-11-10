<template id="Login">
	<div>
    
		<div id="wrapper">
			<header id="header-container">
				<!-- Header -->
				<div id="header">
						<div class="container">
					
							<!-- Left Side Content -->
							<div class="left-side">
								
								<!-- Logo -->
								<div id="logo">
									<a style="cursor: pointer;" href="#"><img src="libb/assets/images/logo.png" alt=""></a>
								</div>
							</div>
							
						</div>
				</div>
					<!-- Header / End -->
			</header>
			<div class="clearfix"></div>
			<!-- Header Container / End -->

			<!-- Content
			================================================== -->
			<div class="fs-container">

				<div class="container content">
					<div class="fs-content">
						<section class="listings-container margin-top-30">
							<div class="mail-grids">
								<div>
										<h2 style="text-align: center;">Log in</h2>
									<div id="question-container">
										<form name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
											<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>
												{{errorMsg}}
											</b-alert>

											<!-- Email input -->
											<div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">

											<div class="divider d-flex align-items-center my-4">
											<p class="text-center fw-bold mx-3 mb-0"></p>
											</div>
											</div>

											<div class="form-group px-md-1">
											<label class="form-label" for="form3Example3">Phone Number</label>
											<input placeholder="Phone Number" v-model="user.username" name="username"  required="required" class="form-control" type="text"
												placeholder="Enter Phone Number" />
											
											</div>
											

											<!-- Password input 
											<div class="form-group px-md-1">
											<input placeholder="Password" required="required" v-model="user.password" name="password" class="form-control" type="password"
												placeholder="Enter Password" />
											<label class="form-label" for="form3Example3">Password</label>
											</div>-->

											<div class="form-group text-center">
												<button class="btn btn-primary btn-block btn-md" type="submit">
													<i class="load-indicator"><clip-loader :loading="loading" color="#fff" size="14px"></clip-loader></i>
														Login <i class="fa fa-key"></i>
												</button>
											</div>




										</form>
									</div>
									<!-- <div class="quiz-footer">
										<div class="row">
											<div class="col-sm-7">
												<router-link to="/register" class="btn btn-success">Subscribe to Create Account<i class="fa fa-user"></i></router-link>
											</div>
											<div class="col-sm-5">
												<a href="<?php print_link('passwordmanager') ?>" class="text-danger">Forgot Password? </a>
											</div>
										</div>
									</div>-->
								</div>
							</div>

						</section>
					</div>
				</div>
			</div>
		</div>
		<!-- Wrapper / End -->
    </div>
</template>
        <script>
			var LoginComponent = Vue.component('LoginComponent', {
				template : '#Login',
				data : function() {
					return {
						user : {
							username : '',
							//password : '',
						},
						loading : false,
						ready: false,
						errorMsg : '',
						showError : false,
					}
				},
				computed: {
					setGridSize: function(){
						if(this.resetgrid){
							return 'col-sm-12 col-md-12 col-lg-12';
						}
					}
				},
				methods : {
					login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('login/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
							location.reload();
						},
						function (response) {
							this.loading = false;
							this.showError = false
							this.errorMsg = response.statusText;
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					}
				},
				mounted : function() {
					this.ready = true;
				},
			});
		</script>
