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
						<!-- Mobile Navigation -->
						<div class="mmenu-trigger">
							<button class="hamburger hamburger--collapse" type="button">
							<span class="hamburger-box">
							<span class="hamburger-inner"></span>
							</span>
							</button>
						</div>
						<!-- Main Navigation -->
						<nav id="navigation" class="style-1">
							<ul id="responsive" >
								<li onclick="fhome()"><a style="cursor: pointer;" class="current">Home</a></li>
								<li onclick="fpropertysearch()"><a style="cursor: pointer;">More Homes</a></li>
								<li><a style="cursor: pointer;" href="info/contact">Contact</a></li>
							</ul>
						</nav>
						<div class="clearfix"></div>
						<!-- Main Navigation / End -->
					</div>
					</div>
				</div>
				<!-- Header / End -->
			</header>
			<div class="clearfix"></div>
			<!-- Header Container / End -->
			<div id="titlebar" class="solid">
				<div style="text-align:center;" class="container">
					<h1 style="text-align:center;" >Login</h1>
				</div>
			</div>
			<div class="container full-width">
				<div class="row">
					<article id="post-38" class="col-md-12 post-38 page type-page status-publish hentry">
						<div class="col-lg-5 col-md-4 col-md-offset-3 sign-in-form style-1 margin-bottom-45">
							<ul class="tabs-nav">
							<li id="listeo-logintab-btn" class=""><a href="#tab1">Log In</a></li>
							<li id="listeo-registration-btn"><a href="#tab2">Register</a></li>
							</ul>
							<div class="tabs-container alt">
							<!-- Login -->
							<div class="tab-content" id="tab1" style="display: none;">
								<form class="login" name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
									<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
									<p class="form-row form-row-wide">
										<label for="user_login">
										<i class="sl sl-icon-user"></i>
										<input placeholder="Username/Email" v-model="user.username" type="text" class="input-text" name="username" value="" required="required" />
										</label>
									</p>
									<p class="form-row form-row-wide">
										<label for="user_pass">
										<i class="sl sl-icon-lock"></i>
										<input placeholder="Password" class="input-text" v-model="user.password"  type="password" name="password" required="required" />
										</label>
										<span class="lost_password">
										<a href="#">Lost Your Password?</a>
										</span>
									</p>
									<div class="form-row">
										<input type="hidden" id="login_security" name="login_security" value="f3c21dce0c" /><input type="hidden" name="_wp_http_referer" value="/dashboard/" />					
										<input type="submit" class="button border margin-top-5" name="login" value="Login" />
										<div class="checkboxes margin-top-10">
										<input name="rememberme" type="checkbox" id="remember-me" value="true" v-model="user.rememberme"/>
										<label for="remember-me">Login as Property Owner</label>
										</div>
									</div>
								</form>
							</div>
							<!-- Register -->
							<div class="tab-content" id="tab2" style="display: none;">
								<!--<form class="register" enctype="multipart/form-data" action="<?php print_link('index/register'); ?>" @submit.prevent="register()" method="post">-->
								<form enctype="multipart/form-data" @submit="save" class="form form-default" action="" method="post">
									<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
									<div class="form-group " :class="{'has-error' : errors.has('firstname')}">
										<p class="form-row form-row-wide">
											<label for="firstname">Firstname:
												<i class="im im-icon-Male"></i>
												<input type="text" v-model="data.firstname" v-validate="{required:true}" 
												data-vv-as="Firstname" name="firstname" class="input-text" value="" />
											</label>
										</p>
										<small v-show="errors.has('firstname')" class="form-text text-danger">{{ errors.first('firstname') }}</small>
									</div>
										
									<div class="form-group " :class="{'has-error' : errors.has('lastname')}">
										<p class="form-row form-row-wide">
											<label for="lastname">Lastname:
												<i class="im im-icon-Male"></i>
												<input type="text" v-model="data.lastname" v-validate="{required:true}" 
												data-vv-as="Lastname" name="lastname" class="input-text" value="" />
											</label>
										</p>
										<small v-show="errors.has('lastname')" class="form-text text-danger">{{ errors.first('lastname') }}</small>
									</div>

									<div class="form-group " :class="{'has-error' : errors.has('email')}">
										<p class="form-row form-row-wide">
											<label for="email">Email:
												<i class="im im-icon-Male"></i>
												<input type="email" v-model="data.email" v-validate="{required:true,  email:true}" 
												data-vv-as="Email" name="email" class="input-text" value="" />
											</label>
										</p>
										<small v-show="errors.has('email')" class="form-text text-danger">{{ errors.first('email') }}</small>
									</div>

									<div class="form-group " :class="{'has-error' : errors.has('password')}">
										<p class="form-row form-row-wide">
											<label for="password">Password:
												<i class="im im-icon-Male"></i>
												<input type="password" v-model="data.password" v-validate="{required:true}" 
												data-vv-as="Password" name="password" class="input-text" value="" />
											</label>
										</p>
										<small v-show="errors.has('password')" class="form-text text-danger">{{ errors.first('password') }}</small>
									</div>

									<div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
										<p class="form-row form-row-wide">
											<label for="confirm_password">Confirm Password:
												<i class="im im-icon-Male"></i>
												<input type="password"  v-model="data.confirm_password" v-validate="{required:true}" 
												data-vv-as="Confirm Password" name="confirm_password" class="input-text" value="" />
											</label>
										</p>
										<small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
									</div>
									<button class="button border fw margin-top-10" type="submit">
														<i class="load-indicator">
															<clip-loader :loading="loading" color="#fff" size="14px"></clip-loader>
														</i>
														Register <i class="fa fa-send"></i>
									</button>
	
								</form>
							</div>
							</div>
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</template>
        <script>
			var LoginComponent = Vue.component('LoginComponent', {
				template : '#Login',
				mixins: [AddPageMixin],
				props:{
					pagename : {
						type : String,
						default : 'user',
					},
					routename : {
						type : String,
						default : 'userregister',
					},
					apipath : {
						type : String,
						default : 'index/register',
					},
				},
				data : function() {
					return {
						user : {username : '',password : '',rememberme:''},
						data : {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
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
						var apiurl = setApiUrl('index/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
							if(!response.body.includes("index")){
							location.reload();
							}
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
					},
					register : function(e){
						var payload = this.data;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/register');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
							location.reload();
							//alert('Mail sent successfull! Please check your mailbox to verify your account.')
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
					},
					actionAfterSave : function(response){
						this.$root.$emit('requestCompleted' , this.msgaftersave);
						window.location = response.body;
						//location.reload();
					},
					resetForm : function(){
						//this.data = {username: '',email: '',password: '',confirm_password: '',role_id: '',category: '',};
						this.data = {email: '',firstname: '',lastname: '',password: '',confirm_password: ''};
						this.$validator.reset();
					},
				},
				mounted : function() {
					this.ready = true;
				},
			});
		</script>
