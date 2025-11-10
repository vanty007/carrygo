    <template id="myreservationList">
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

						<li onclick="fhome()"><a style="cursor: pointer;">Home</a></li>
						<li onclick="fpropertysearch()"><a style="cursor: pointer;">More Homes</a></li>
						<li onclick="fmyreservation()"><a style="cursor: pointer;" class="current">My Reservation</a></li>
						<li><a style="cursor: pointer;" href="info/contact">Contact</a></li>
						<li><a style="cursor: pointer;" href="#account/edit">Profile</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
					<!-- User Menu -->
					<?php
					if(user_login_status() == true){
						?>
					<div class="user-menu">
						<div class="user-name"><span><img src=" <?php echo USER_PHOTO ?>" alt=""></span>Hi, <?php echo FIRST_NAME ?>!</div>
						<ul>
							<li onclick="fmyreservation()"><a style="cursor: pointer;"><i class="sl sl-icon-book-open"></i> My Reservations</a></li>
							<li onclick="fmyfavourite()"><a style="cursor: pointer;"><i class="sl sl-icon-star"></i> My Favourite</a></li>
							<li onclick="fmessages()"><a style="cursor: pointer;"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
							<li onclick="fpayment()"><a style="cursor: pointer;"><i class="sl sl-icon-wallet"></i> My Payment</a></li>
							<li><a style="cursor: pointer;" href="#account/edit"><i class="sl sl-icon-user"></i>My Profile</a></li>
							<li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
					<?php

if(user_login_status() == true){
	if(ROLE_ID == 'administrator' || ROLE_ID == 'super'){
	//echo 'hjj'.ROLE_ID;
	?>
	<a style="cursor: pointer;" id="dashboard2"  onclick="fdashboard()" class="sign-in"><i class="sl sl-icon-screen-desktop"></i>Dashboard</a>
	<!--<li><a style="cursor: pointer;" id="dashboard2" href="#/dashboard">Dashboard</a></li>-->
	<?php
	}
else{
	?>
	<a style="cursor: pointer;" onclick="fownproperty()"><i class="sl sl-icon-briefcase"></i>Own Property</a>
	<?php
}
}


					}
					else{
						?>
					<a style="cursor: pointer;" href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
					<?php
					}
					?>
				</div>
			</div>
			<!-- Right Side Content / End -->

			<!-- Sign In Popup -->
			<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

				<div class="small-dialog-header">
					<h3>Sign In</h3>
				</div>

				<!--Tabs -->
				<div class="sign-in-form style-1">

					<ul class="tabs-nav">
						<li class=""><a style="cursor: pointer;" href="#tab1">Log In</a></li>
						<li><a style="cursor: pointer;" href="#tab2">Register</a></li>
					</ul>

					<div class="tabs-container alt">

						<!-- Login -->
						<div class="tab-content" id="tab1" style="display: none;">
						<form class="register" name="loginForm" action="<?php print_link('index/login'); ?>" @submit.prevent="login()" method="post">
                            <b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
								<p class="form-row form-row-wide">
									<label for="username">Username or Email:
										<i class="im im-icon-Male"></i>
										<input type="text" class="input-text" v-model="user.username" name="username"  required="required"  value="" />
									</label>
								</p>

								<p class="form-row form-row-wide">
									<label for="password">Password:
										<i class="im im-icon-Lock-2"></i>
										<input class="input-text" type="password" v-model="user.password" required="required" name="password" />
									</label>
								</p>
								
									<span class="lost_password">
										<a style="cursor: pointer;" href="#" class="link">Lost Your Password?</a>
									</span>

								<div class="form-row">
									<button class="button border margin-top-5" type="submit">
                                                <i class="load-indicator">
                                                    <clip-loader :loading="loading" color="#fff" size="14px"></clip-loader>
                                                </i>
                                                Login <i class="fa fa-key"></i>
                                    </button>
									<div class="checkboxes margin-top-10">
										<input type="checkbox" name="rememberme" value="true">
										<label for="remember-me">Remember Me</label>
									</div>
								</div>
								
						</form>
						</div>

						<!-- Register -->
						<div class="tab-content" id="tab2" style="display: none;">

							<form class="register" enctype="multipart/form-data" action="<?php print_link('index/register'); ?>" @submit.prevent="register()" method="post">

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
			</div>
			<!-- Sign In Popup / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>


<!-- Dashboard -->
<div id="dashboard">
	<!-- Content
	================================================== -->
	<div class="dashboard-content">
					<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
						<div class="small-dialog-header">
							<h3>Send Message</h3>
						</div>
						<div class="message-reply margin-top-0">
						<form enctype="multipart/form-data" name="sendmessage" action="<?php print_link('message/add'); ?>" @submit.prevent="sendmessage()" method="post">
							<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
							<div class="message-reply" :class="{'has-error' : errors.has('message')}">
							<textarea cols="40" rows="3" placeholder="Your Message" v-model="message.message" v-validate="{required:true}" data-vv-as="message" type="text" name="message"></textarea>
                        <small v-show="errors.has('message')" class="form-text text-danger">{{ errors.first('message') }}</small>
                        <button class="button preview"  :disabled="errors.any()" type="submit">
                           <i class="load-indicator"></i>Send Message<i class="fa fa-send"></i>
                        </button>
							</div>
                     </form>
						</div>
					</div>
		<div class="row">
			
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">

					<h4>Booking Requests</h4>
					<div class="row" v-if="records.length">
			
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					
					<ul>

						<li class="pending-booking" v-for="(data,index) in records">
							<div class="list-box-listing bookings">
								<div class="list-box-listing-img" v-if="data.profile_pics != null"><img :src="data.profile_pics" alt=""></div>
								<div class="list-box-listing-img" v-if="data.profile_pics == null"><img src="libb/assets/images/avatar_user.png" alt=""></div>
								<div class="list-box-listing-content">
									<div class="inner">
										<h3>{{data.name}} ({{data.type}}) 
											<span class="booking-status pending" v-if="data.booking_status == 0">Booking Pending Approval</span>
											<span class="booking-status" style="background-color: #64bc36;" v-if="data.booking_status == 1">Booking Approved</span>
											<span class="booking-status unpaid" v-if="data.booking_status == 2">Booking Canceled</span>
											<span class="booking-status unpaid" v-if="data.chargestatus == 0 && data.booking_status == 1">unpaid</span>
											<span class="booking-status unpaid" v-if="data.chargestatus == 1 && data.booking_status == 1 && data.chargestatus1 == 0">Payment Approval Pending</span>
											<!--<span class="booking-status" style="background-color: gold;" v-if="data.chargestatus == 1">Payment Approval Pending</span>-->
											<span class="booking-status" style="background-color: #64bc36;" v-if="data.chargestatus1 == 1">Payment Approved</span>

										<div class="inner-booking-list">
											<h5>Booking Date:</h5>
											<ul class="booking-list">
												<li class="highlighted">{{data.validdatestart}} to {{data.validdateend}}</li>
											</ul>
										</div>
													
										<!--<div class="inner-booking-list">
											<h5>Booking Details:</h5>
											<ul class="booking-list">
												<li class="highlighted">{{data.rooms}} Rooms</li>
											</ul>
										</div>-->		
													
										<div class="inner-booking-list">
											<h5>Price:</h5>
											<ul class="booking-list">
												<li class="highlighted">&#8358; {{data.price}}</li>
											</ul>
										</div>		

										<div class="inner-booking-list">
											<h5>Customer:</h5>
											<ul class="booking-list">
												<li>{{data.title}} {{data.lastname}} {{data.firstname}}</li>
											</ul>
										</div>
										<a style="cursor: pointer;" @click="setSender(data.user_id)" href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
										

									</div>
								</div>
							</div>
							<div class="buttons-to-right">
								<a style="cursor: pointer;" @click="rejectBooking(data.id)" v-if="data.booking_status == 0" class="button gray reject"><i class="sl sl-icon-close" ></i> Cancel Booking</a>
								<!--<a style="cursor: pointer;" class="button gray approve" :href="'#/myreservation/view/'+data.id" v-if="data.chargestatus == 0 && data.booking_status == 0"><i class="sl sl-icon-check"></i> Confirm Payment</a>-->
								<a style="cursor: pointer;" class="button gray approve" :href="'#/myreservation/view/'+data.id" v-if="data.chargestatus == 0 && data.booking_status == 1"><i class="sl sl-icon-check"></i> Confirm Payment</a>
							</div>
						</li>
						
					</ul>
				</div>
			</div>

		</div>
				</div>
			</div>

		</div>

	</div>
	<!-- Content / End -->


</div>
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->



        </div>
    </template>
    <script>
	var MyreservationListComponent = Vue.component('myreservationList', {
		template: '#myreservationList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'myreservation',
			},
			routename : {
				type : String,
				default : 'myreservationlist',
			},
			apipath : {
				type : String,
				default : 'myreservation/list',
			},
			exportbutton: {
				type: Boolean,
				default: false,
			},
			importbutton: {
				type: Boolean,
				default: false,
			},
			tablestyle: {
				type: String,
				default: ' table-striped table-sm',
			},
		},
		data: function(){
			return {
				pagelimit : defaultPageLimit,
				user : {username : '',password : '',},
				data : {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
				message:{message:'',sender:''}
			}
		},
		computed : {
			pageTitle: function(){
				return 'Myreservation';
			},
			filterGroupChange: function(){
				return ;
			},
		},
		watch : {
		},
		methods:{
			load:function(){
				this.records = [];
				if (this.loading == false){
					this.ready = false;
					this.loading = true;
					var url = this.apiUrl;
					this.$http.get(url).then(function (response) {
						var data = response.body;
						if(data && data.records){
							this.totalrecords = data.total_records ;
							if(this.pagelimit  > data.records.length){
								this.loadcompleted = true;
							}
							this.records = data.records;
						}
						else{
							this.$root.$emit('requestError' , response);
						}
						this.loading = false
						this.ready = true
					},
					function (response) {
						this.loading = false;
						this.$root.$emit('requestError' , response);
					});
				}
			},	
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},

			login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
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
					rejectBooking : function(id){
						var apiurl = setApiUrl('components/rejectBooking/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							window.location.href = '#/myreservation';
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
					approvePayment : function(id){
						    //property_id = id;
							//console.log(id)
							document.querySelector("input[name=property_id2]").value=id;
							window.location.href = '#/payments/add';
							//location.reload();
					},

					sendmessage : function(){
						//var payload = this.message;
                  var payload_json = '{"subject": "booking","message": "'+this.message.message+'","message_id": "0","sender": "'+this.message.sender+'"}';
                  console.log(payload_json)
						this.loading1 = true;
						var self = this;
						var apiurl = setApiUrl('message/add');
						this.$http.post( apiurl , payload_json ).then(function (response) {
							self.loading1 = false;
							this.message.message = '',
							alert('Message sent')
						},
						function (response) {
							this.loading1 = false;
							this.showError = false
							this.errorMsg = response.statusText;
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					},
					setSender : function(id){
						this.message.sender = id;
						//alert(this.message.sender)
					},
					
		}
	});
	</script>
