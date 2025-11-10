        <template id="Home">
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
					<?php
					if(ROLE_ID == 'user' || ROLE_ID == ''){
						?>
							<li style="cursor: pointer;" onclick="fownproperty()"><a><i class="sl sl-icon-briefcase"></i>Own Property</a></li>
					<?php
					}
					?>
							<li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
					<?php
					}
					else{
						?>
					<a style="cursor: pointer;" onclick="floginpage()" class="sign-in "><i class="sl sl-icon-login"></i> Sign In</a>
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
<!-- Header Container / End -->


<!-- Banner
================================================== -->
<div class="main-search-container full-height alt-search-box centered" data-background-image="libb/assets/images/listeo_bg3.jpg">
	<div class="main-search-inner">

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="main-search-input">
					
						<div class="main-search-input-headline">
							<h2>Find  place of rest</h2>
							<h4>From cozy country homes to funky city apartments!</h4>
						</div>
						<form class="hero-form form">
						<div class="main-search-input-item">
							<div>
								<input name="what_property" class="tagss" type="text" placeholder="What type of house?">
							</div>
							<a style="cursor: pointer;" href="#"><i class="fa fa-map-house"></i></a>
						</div>

						<div class="main-search-input-item location">
							<div id="autocomplete-container">
								<input name="where_property" class="tags_location" type="text" placeholder="Which location?">
							</div>
							<a style="cursor: pointer;" href="#"><i class="fa fa-map-marker"></i></a>
						</div>

						<!--<div class="main-search-input-item search-input-icon">
							<input type="text" placeholder="Check-In - Check-Out" id="booking-date-search" >
							<i class="fa fa-calendar"></i>
						</div>

						<div class="main-search-input-item">
							<select data-placeholder="All Categories" class="chosen-select" >
								<option>All Categories</option>	
								<option>Shops</option>
								<option>Hotels</option>
								<option>Restaurants</option>
								<option>Fitness</option>
								<option>Events</option>
							</select>
						</div>@onclick="dosearch()"-->

						<button type="button"  class="button btnsearch">Search</button>
						</form>
					
					</div>
				</div>
			</div>
			
		</div>

	</div>
</div>


<!-- Content
================================================== -->

<!-- Container -->
<div class="container">
	<div class="row">

		<div class="col-md-12">
			<h3 class="headline centered margin-bottom-35 margin-top-70">
				<strong class="headline-with-separator">Trending Destinations</strong>
				<span>Top Destinations to Visit in 2025</span></h3>
		</div>
		
		<div class="col-md-6" v-for="(data,index) in records">

			<!-- Image Box -- onclick="mySearch()"--> 
			<a style="cursor: pointer;" @click="mySearch(data.landmark)"  class="img-box alternative-imagebox">
				<figure style="height:100%;width:100%;">
    				<img :src="data.thumbnail" style="height:100%;width:100%;display: inline-block;position: relative;overflow: hidden;z-index: 90;margin: 10px 0;border-radius: 3px;outline: none !important;transition: color 0.2s;box-sizing: border-box;">
				</figure>
					<div class="img-box-content visible">
						<h4>{{data.state}} - {{data.landmark}} </h4>
						<span>{{data.listing}} Listings</span>
					</div>
			</a>
		</div>			
	</div>
</div>
<!-- Container / End -->



<!-- Most Visited Places -->
<section class="fullwidth border-top margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#fff">

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h3 class="headline centered margin-bottom-45">
					<strong class="headline-with-separator">Most Visited Places</strong>
					<span>Discover top-rated Homes</span>
				</h3>
			</div>
		</div>
	</div>

	<!-- Carousel / Start -->
	<div class="simple-fw-slick-carousel dots-nav">

		<!-- Listing Item -->
		<div class="fw-carousel-item">
			<a style="cursor: pointer;" href="listings-single-page.html" class="listing-item-container compact">
				<div class="listing-item">
					<img src="libb/assets/images/listing-item-01.jpg" alt="">

					<div class="listing-badge now-open">Now Open</div>

					<div class="listing-item-content">
						<div class="numerical-rating" data-rating="3.5"></div>
						<h3>Lekki Admiralty Moore House</h3>
						<span>Lekki</span>
					</div>
					<span class="like-icon"></span>
				</div>
			</a>
		</div>
		<!-- Listing Item / End -->

		<!-- Listing Item -->
		<div class="fw-carousel-item">
			<a style="cursor: pointer;" href="listings-single-page.html" class="listing-item-container compact">
				<div class="listing-item">
					<img src="libb/assets/images/listing-item-02.jpg" alt="">
					<div class="listing-item-details">
						<ul>
							<li>Friday, August 10</li>
						</ul>
					</div>
					<div class="listing-item-content">
						<div class="numerical-rating" data-rating="5.0"></div>
						<h3>ishop Court</h3>
						<span>Bishop Avenue, Ikoyi</span>
					</div>
					<span class="like-icon"></span>
				</div>
			</a>
		</div>
		<!-- Listing Item / End -->		

		<!-- Listing Item -->
		<div class="fw-carousel-item">
			<a style="cursor: pointer;" href="listings-single-page.html" class="listing-item-container compact">
				<div class="listing-item">
					<img src="libb/assets/images/listing-item-03.jpg" alt="">
					<div class="listing-item-details">
						<ul>
							<li>Starting from $59 per night</li>
						</ul>
					</div>
					<div class="listing-item-content">
						<div class="numerical-rating" data-rating="2.0"></div>
						<h3>Hotel Govendor</h3>
						<span>Abuja - Guzape</span>
					</div>
					<span class="like-icon"></span>
				</div>

			</a>
		</div>
		<!-- Listing Item / End -->

		<!-- Listing Item -->
		<div class="fw-carousel-item">
			<a style="cursor: pointer;" href="listings-single-page.html" class="listing-item-container compact">
				<div class="listing-item">
					<img src="libb/assets/images/listing-item-04.jpg" alt="">

					<div class="listing-badge now-open">Now Open</div>

					<div class="listing-item-content">
						<div class="numerical-rating" data-rating="5.0"></div>
						<h3>Burger House</h3>
						<span>Bucks lane, Foreshore - Lekki</span>
					</div>
					<span class="like-icon"></span>
				</div>
			</a>
		</div>
		<!-- Listing Item / End -->


	</div>
	<!-- Carousel / End -->


</section>
<!-- Fullwidth Section / End -->



<!-- Info Section -->
<section class="fullwidth padding-top-75 padding-bottom-70" data-background-color="#f9f9f9">
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="headline centered headline-extra-spacing">
				<strong class="headline-with-separator">Plan The Vacation of Your Dreams</strong>
				<span class="margin-top-25">Explore some of the best tips from around the world from our partners and friends. Discover some of the most popular listings!</span>
			</h3>
		</div>
	</div>

	<div class="row icons-container">
		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2 with-line">
				<i class="im im-icon-Map2"></i>
				<h3>Find Interesting Place</h3>
				<p> These places could include historical landmarks, natural wonders, hidden gems in cities, or lesser-known attractions.</p>
			</div>
		</div>

		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2 with-line">
				<i class="im im-icon-Mail-withAtSign"></i>
				<h3>Contact a Few Owners</h3>
				<p>Whether it's for renting a vacation home, buying an item, or seeking a partnership, contacting several owners allows for comparison, better decision-making, and potentially finding the best option that meets one's needs.</p>
			</div>
		</div>

		<!-- Stage -->
		<div class="col-md-4">
			<div class="icon-box-2">
				<i class="im im-icon-Checked-User"></i>
				<h3>Make a Reservation</h3>
				<p>Reservations can be made online, by phone, or in person, and often require providing personal details and payment information.</p>
			</div>
		</div>
	</div>

</div>
</section>
<!-- Info Section / End -->



<!-- Back To Top Button -->
<div id="backtotop"><a style="cursor: pointer;" href="#"></a></div>


</div>

	</div>
        </template>
        <script>
			var HomeComponent = Vue.component('HomeComponent', {
				template : '#Home',
				mixins: [ListPageMixin, AddPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'propertylist',
			},
			routename : {
				type : String,
				default : 'propertylist',
			},
			apipath : {
				type : String,
				default : 'propertylist/list',
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
						loading : false,
						ready: false,
						errorMsg : '',
						showError : false,
						data : {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
						what_property:'',where_property:'',
					
			}
		},
		computed : {
			pageTitle: function(){
				return 'Propertylist';
			},
			filterGroupChange: function(){
				return ;
			},
		},
		watch : {
			allSelected: function(){
				//toggle selected record
				this.selected = [];
				if(this.allSelected == true){
					for (var i in this.records){
						var id = this.records[i].id;
						this.selected.push(id);
					}
				}
			}
		},
		methods:{
			load: function(){
				this.currentpage = (Math.ceil(this.records.length / this.pagelimit) + 1 ) || 1;
				if (this.loading == false){
					this.loading = true;
					var url = this.apiUrl;
					console.log(url);
					this.$http.get(url).then(function (response) {
						var data = response.body;
						if(data && data.records){
							this.totalrecords = data.total_records;
							if(this.pagelimit  > data.records.length){
								this.loadcompleted = true;
							}
							this.records = this.records.concat(data.records);
						}
						else{
							this.$root.$emit('pageError' , response);
						}
						this.loading = false
						this.ready = true
					},
					function (response) {
						this.loading = false;
						this.$root.$emit('pageError' , response);
					});
				}
			},
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
			mySearch : function(val){
						//alert(val)
						window.location = '#/propertysearch/index/landmark/'+val
						location.reload();
					},
			login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/login');
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
					}
		}
	});
	</script>
