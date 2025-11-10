<template id="propertylistView">       
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
						<li onclick="fpropertysearch()"><a style="cursor: pointer;" class="current">More Homes</a></li>
						<li onclick="fmyreservation()"><a style="cursor: pointer;">My Reservation</a></li>
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


<!-- Slider
================================================== -->

<div class="listing-slider mfp-gallery-container margin-bottom-0">
	<!--<a style="cursor: pointer;" v-for="(datas,index) in data.pictures" :href="datas" :data-background-image="datas" class="item mfp-gallery" :title="'Title'+ index+1"></a>
	<a style="cursor: pointer;" v-for="(datas,index) in data.pictures" :href="datas" :title="'Title'+ index+1"><img class="item mfp-gallery"  :src="datas" alt=""></a>-->

	<a style="cursor: pointer;" v-for="(datas,index) in data.pictures" :href="datas" title="Title01" class="item mfp-gallery slick-slide slick-current slick-active slick-center" 
	 data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
	 <img  :src="datas" alt=""></a>

</div>


<!-- Content
================================================== -->
<div class="container">
					<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
						<div class="small-dialog-header">
							<h3>Send Message</h3>
						</div>
						<div class="message-reply margin-top-0">
						<form enctype="multipart/form-data" name="sendmessage" action="<?php print_link('message/add'); ?>" @submit.prevent="sendmessage()" method="post">
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
	<div class="row sticky-wrapper">
		<div class="col-lg-8 col-md-8 padding-right-30">

			<!-- Titlebar -->
			<div id="titlebar" class="listing-titlebar">
				<div class="listing-titlebar-title">
					<h2>{{data.records.type}} <span class="listing-tag" style="font-weight:bold;">At &#8358;{{data.records.price}}</span></h2>
					<span>
						<a style="cursor: pointer;" href="#listing-location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							{{data.records.landmark}}
						</a>
					</span>
					<div class="star-rating" :data-rating="data.rating_count.rate" v-if="data.rating_count.rate != null">
						<div class="rating-counter">
							<a style="cursor: pointer;" href="#listing-reviews" v-if="data.rating.length">({{data.rating.length}} Reviews)</a>
						</div>
					</div>
				</div>
			</div>

			
			<!-- Overview -->
			<div id="listing-overview" class="listing-section">

				<!-- Description -->
				<h3 class="listing-desc-headline">Description</h3>
				<p>{{data.records.description}}</p>

				<?php
				if(user_login_status() == true){
				?>
				<a style="cursor: pointer;" @click="setSender(data.records.auth_id)" href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
				<?php
				}
				?>
				
				<!-- Listing Contacts -->
				<div class="listing-links-container">

					<ul class="listing-links contact-links">
						<input type="hidden" id="invalidfrom" :value="data.propertyreservation"/>
						<input type="hidden" id="invalidto" :value="data.invalidto"/>
						<input type="hidden" id="rooms_qty" :value="data.records.rooms"/>
						<!--<li><a style="cursor: pointer;" href="tel:12-345-678" class="listing-links"><i class="fa fa-phone"></i>{{data.records.contactphone}}</a></li>
						<li><a style="cursor: pointer;" href="mailto:mail@example.com" class="listing-links"><i class="fa fa-envelope-o"></i>{{data.records.contactemail}}</a>-->
						</li>
						<!-- <li><a style="cursor: pointer;" href="#" target="_blank"  class="listing-links"><i class="fa fa-link"></i> www.example.com</a></li>-->
					</ul>

				</div>
				<div class="clearfix"></div>


				<!-- Amenities -->
				<h3 class="listing-desc-headline" v-if="data.facility.length">Amenities</h3>
				<ul class="listing-features checkboxes margin-top-0">
					<li v-for="(datas,index) in data.facility">{{datas}}</li>
				</ul>
				<h3>Service Charge: &#8358;{{data.records.service_charge}}</h3>
			</div>
				
			<!-- Reviews -->
			<div id="listing-reviews" class="listing-section">
				<h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews
					<span v-if="data.rating.length">({{data.rating.length}})</span>
				</h3>

				<!-- Rating Overview -->
				<div class="rating-overview">
					<div class="rating-overview-box">
						<span class="rating-overview-box-total" v-if="data.rating_count.rate != null">{{data.rating_count.rate}}</span>
						<span class="rating-overview-box-total" v-if="data.rating_count.rate == null">0</span>
						<span class="rating-overview-box-percent">out of 5.0</span>
						<div class="star-rating" v-if="data.rating_count.rate != null" :data-rating="data.rating_count.rate"></div>
						<div class="star-rating" v-if="data.rating_count.rate == null" data-rating="0"></div>
					</div>

				</div>
				<!-- Rating Overview / End -->


				<div class="clearfix"></div>

				<!-- Reviews -->
				<section class="comments listing-reviews" v-if="data.rating.length">
					<ul>
						<li v-for="(datas,index) in data.rating">
							<!--<div class="avatar" v-if="datas.profile_pics != ''"><img :src="datas.profile_pics" alt="" /></div>
							<div class="avatar" v-if="datas.profile_pics == ''"><img src="libb/assets/images/avatar_user.png" alt="" /></div>-->
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">{{datas.firstname}} {{datas.lastname}}<i class="tip" data-tip-content="Person who left this review actually was a customer"><div class="tip-content">Person who left this review actually was a customer</div></i> <span class="date">{{datas.created_at}}</span>
								<div class="star-rating" :data-rating="datas.rate"></div>
								</div>
								<p>{{datas.review}}</p>
								
								<!--<a style="cursor: pointer;" href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>12</span></a>-->
							</div>
						</li>
					 </ul>
				</section>

				<!-- Pagination 
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						
						<div class="pagination-container margin-top-30">
							<nav class="pagination">
								<ul>
									<li><a style="cursor: pointer;" href="#" class="current-page">1</a></li>
									<li><a style="cursor: pointer;" href="#">2</a></li>
									<li><a style="cursor: pointer;" href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>-->
				<!-- Pagination / End -->
			</div>
<!-- Add Review 
			<form  enctype="multipart/form-data" action="rating/add" method="post">
			<div id="add-review" class="add-review-box">


				<h3 class="listing-desc-headline margin-bottom-10">Add Review</h3>
				<p class="comment-notes">Your email address will not be published.</p>

				<div class="sub-ratings-container">

					<div class="add-sub-rating">
						<div class="sub-rating-title">Service <i class="tip" data-tip-content="Quality of customer service and attitude to work with you"><div class="tip-content">Quality of customer service and attitude to work with you</div></i></div>
						<div class="sub-rating-stars">

							<div class="clearfix"></div>
							<div class="leave-rating">
									<input type="radio" name="rate" id="rating-1" value="1"/>
									<label for="rating-1" class="fa fa-star"></label>
									<input type="radio"  name="rate" id="rating-2" value="2"/>
									<label for="rating-2" class="fa fa-star"></label>
									<input type="radio" name="rate" id="rating-3" value="3"/>
									<label for="rating-3" class="fa fa-star"></label>
									<input type="radio" name="rate" id="rating-4" value="4"/>
									<label for="rating-4" class="fa fa-star"></label>
									<input type="radio" name="rate" id="rating-5" value="5"/>
									<label for="rating-5" class="fa fa-star"></label>
							</div>
						</div>
					</div>

				</div>-->
				<!-- Subratings Container / End -->

				<!-- Review Comment
					<div id="add-comment" class="add-comment">
						<fieldset>

							<div>
								<label>Review:</label>
								<textarea name="review" id="idreview" cols="40" rows="3"></textarea>
							</div>

						</fieldset>
						<button type="button" id="makeReview" class="button">Submit Review</button>
						<div class="clearfix"></div>
					</div> 
			</div>
			</form>-->


		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

				
			<!-- Verified Badge -->
			<div v-if="data.records.status == 0" class="verified-badge with-tip" data-tip-content="Listing has been verified and belongs the business owner or manager.">
				<i class="sl sl-icon-check"></i> Verified Listing
			</div>
			<div v-if="data.records.status == 1" class="verified-badge with-tip" style="background-color: #64bc36;">
				<i class="sl sl-icon-check"></i> Verified Listing Pending
			</div>
			<div v-if="data.records.status == 2" style="background-color: red;" class="verified-badge with-tip" >
				<i class="sl sl-icon-check"></i> Listing Restricted
			</div>

			<!-- Book Now -->
			<div id="booking-widget-anchor" class="boxed-widget booking-widget margin-top-35">
				<h3><i class="fa fa-calendar-check-o "></i> Booking</h3>
				<div class="row with-forms  margin-top-0">

					<!-- Date Range Picker - docs: https://www.daterangepicker.com/ -->
					
					<div class="col-lg-12">
						<p>Booking Date</p>
						<input type="text" class="date-picker" placeholder="Date" id="idvaliddate" >
						<p>Total Days</p>
						<input type="text" id="iddays"  placeholder="Total Days" readonly>
						<p>Total Amount (&#8358;)</p>
						<input type="text" id="idtotalprice"  placeholder="Total Amount" readonly>
					</div>

					<!-- Panel Dropdown 
					<div class="col-lg-12">
						<div class="panel-dropdown">
							<a style="cursor: pointer;" href="#">Available Rooms <span class="qtyTotal" name="qtyTotal">{{data.records.rooms}}</span></a>
							<div class="panel-dropdown-content">

								<div class="qtyButtons">
									<div class="qtyTitle">rooms</div>
									<input type="text" id="idrooms" name="qtyInput" value="1">
								</div>

							</div>
						</div>
					</div>-->
					<input type="hidden" id="idproperty_id" name="idproperty_id" :value="data.records.id">
					<input type="hidden" id="idprice" name="idprice" :value="data.records.price">
					<input type="hidden" id="idservice_charge" name="idprice" :value="data.records.service_charge">
					<input type="hidden" id="idtotalrooms" name="idtotalrooms" :value="data.records.rooms">
					<a style="cursor: pointer;" style="color:white;" id="makeBook" class="button book-now fullwidth margin-top-5">Request To Book</a>
					<!-- Panel Dropdown / End -->

				</div>
				
				<!-- Book Now -->
			</div>
			<!-- Book Now / End -->


			<!-- Opening Hours 
			<div class="boxed-widget opening-hours margin-top-35">
				<div class="listing-badge now-open">Additional information</div>
				<h3><i class="sl sl-icon-clock"></i> Clock-in</h3>
				<ul>
					<li>Monday <span>12 AM</span></li>
                <ul>
                <h3><i class="sl sl-icon-clock"></i> Clock-out</h3>
					<li>Tuesday <span>2PM</span></li>
				</ul>
			</div>-->
		</div>
		<!-- Sidebar / End -->

	</div>
</div>

<!-- Back To Top Button -->
<div id="backtotop"><a style="cursor: pointer;" href="#"></a></div>


</div>
<!-- Wrapper / End -->

</div>
</template>
    <script>
		
	var PropertylistViewComponent = Vue.component('propertylistView', {
		template : '#propertylistView',
		mixins: [ViewPageMixin,AddPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'propertylist',
			},
			routename : {
				type : String,
				default : 'propertylistview',
			},
			apipath: {
				type : String,
				default : 'propertylist/view',
			},
			editbutton: {
				type: Boolean,
				default: false,
			},
			deletebutton: {
				type: Boolean,
				default: false,
			},
			exportbutton: {
				type: Boolean,
				default: false,
			},
		},
		data: function() {
			return {
				data : {
					records :{
						id: '',type: '',name: '',address: '',landmark: '',longitude: '',latitude: '',status: '',
						pictures: '',description: '',frequency: '',rate: '',price: '',discount: '',location_name: '',
						area: '',city: '',state: '',country: '',propertytype_name: '',type: '',rating_rate: '',review: '',
						auth_id: '',profile_pics: '',contactname:'',contactemail:'',
					},
					rating_count :{
						rate: '',
					},
					rating: '',
					facility: {facilityname:''},
					email: '',firstname: '',lastname: '',password: '',confirm_password: '',
				},
				message:{message:'',sender:''},
				user : {username : '',password : '',},
				data2 : {
					property_id: '',rooms: '',price:'',propertyavailability_id:'',validdate: '',
				},
				user_login:'',
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Propertylist';
			},
			
		},
		methods :{
			
			resetData : function(){
				this.data = {
					records :{contactname:'',contactemail:'',id: '',type: '',name: '',address: '',landmark: '',longitude: '',latitude: '',status: '',pictures: '',description: '',frequency: '',rate: '',price: '',discount: '',location_name: '',area: '',city: '',state: '',country: '',propertytype_name: '',type: '',rating_rate: '',review: '',auth_id: '',profile_pics: ''},
					rating_count :{rate: '',},
					rating: '',
					facility: {facilityname:''},
				}
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
					sendmessage : function(){
						//var payload = this.message;
                  var payload_json = '{"subject": "listing","message": "'+this.message.message+'","message_id": "0","sender": "'+this.message.sender+'"}';
                  console.log(payload_json)
						this.loading1 = true;
						var self = this;
						var apiurl = setApiUrl('message/add');
						this.$http.post( apiurl , payload_json ).then(function (response) {
							console.log(response)
							self.loading1 = false;
							this.message.message = '',
							alert('Message sent')
						},
						function (response) {
							console.log(response)
							this.loading1 = false;
							this.showError = true
							this.errorMsg = response.statusText;
							alert(response.statusText)
							//Flashes messages
							setTimeout(function(){
								self.showError = false;
							}, 100);
						});
					},
					setSender : function(id){
						this.message.sender = id;
					},
		},
		mounted : function() {
			//this.user_login = <?php echo USER_ID; ?>"";
			//console.log(this.user_login)
		},
	});
	</script>
