    <template id="propertysearchList">
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

						<li><a a href='#/'>Home</a></li>
						<!--<li onclick="fhome()"><a style="cursor: pointer;">Home</a></li>-->
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
							<li onclick="fmyreservation()"><a style="cursor: pointer;" ><i class="sl sl-icon-book-open"></i> My Reservations</a></li>
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
<!-- Header Container / End -->

<!-- Content
================================================== -->
<div class="fs-container">

	<div class="fs-inner-container content">
		<div class="fs-content">

			<!-- Search -->
			<section class="search">

				<div class="row">
					<div class="col-md-12">
								<div class="row with-forms">
									<!-- Cities -->
									<div class="col-fs-6">
									<p class="showing-results">What are you looking for?</p>
										<input type="text" id="what_property" v-model="what_property" placeholder="What type of property are you looking for?" name="tagss" class="tagss" value=""/>
									</div>
								</div>

								<div class="row with-forms">
									<!-- Cities -->
									<div class="col-fs-6">
										<p class="showing-results">Search by location?</p>
										<div class="input-with-icon location">
											<div id="autocomplete-container">
												<input id="tags_location" name="tags_location" v-model="where_property" class="tags_location"  type="text" placeholder="Location">
											</div>
											<a style="cursor: pointer;" href="#"><i class="fa fa-map-marker"></i></a>
										</div>

									</div>
								</div>
								<!-- Filters -->
								<div class="col-fs-12">

									<!-- Panel Dropdown / End -->
									<div class="panel-dropdown">
										<a style="cursor: pointer;">Facilities</a>
										<div class="panel-dropdown-content checkboxes categories">
											
											<!-- Checkboxes -->
											<div class="row">

												<div class="col-md-6">
													<input id="theCheckFacility" v-model="facilities_property"  type="hidden">
													<input class="theCheckFacilityClass" id="check-2" type="checkbox" value="All Day Power Supply" name="check">
													<label for="check-2">All Day Power Supply</label>

													<input class="theCheckFacilityClass" id="check-3" type="checkbox" value="All Day Security" name="check">
													<label for="check-3">All Day Security</label>
												</div>	

												<div class="col-md-6">
													<input class="theCheckFacilityClass" id="check-4" type="checkbox" value="Free High-Speed Internet" name="check" >
													<label for="check-4">Free High-Speed Internet</label>

													<input class="theCheckFacilityClass" id="check-5" type="checkbox" value="Premium Sound Bar" name="check">
													<label for="check-5">Premium Sound Bar</label>	

													<input class="theCheckFacilityClass" id="check-6" type="checkbox" value="Smart lock-Code" name="check">
													<label for="check-6">Smart lock-Code</label>

													<input class="theCheckFacilityClass" id="check-7" type="checkbox" value="Air Conditioning" name="check">
													<label for="check-7">Air Conditioning</label>

													<input class="theCheckFacilityClass" id="check-8" type="checkbox" value="DSTV Netflix & YouTube" name="check">
													<label for="check-8">DSTV Netflix & YouTube</label>

													<input class="theCheckFacilityClass" id="check-9" type="checkbox" value="Fully Fitted Kitchen" name="check">
													<label for="check-9">Fully Fitted Kitchen</label>

													<input class="theCheckFacilityClass" id="check-10" type="checkbox" value="Chef on Request" name="check">
													<label for="check-10">Chef on Request</label>

													<input class="theCheckFacilityClass" id="check-11" type="checkbox" value="Housekeeping Services" name="check">
													<label for="check-11">Housekeeping Services</label>

													<input class="theCheckFacilityClass" id="check-12" type="checkbox" value="Spa On Request" name="check">
													<label for="check-12">Spa On Request</label>

													<input class="theCheckFacilityClass" id="check-13" type="checkbox" value="Property Manager" name="check">
													<label for="check-13">Property Manager</label>

													<input class="theCheckFacilityClass" id="check-14" type="checkbox" value="All Rooms En-Suite" name="check">
													<label for="check-14">All Rooms En-Suite</label>

													<input class="theCheckFacilityClass" id="check-15" type="checkbox" value="Ample Parking Space" name="check">
													<label for="check-15">Ample Parking Space</label>

												</div>
											</div>
											
											<!-- Buttons -->
											<div class="panel-buttons">
												<button class="panel-cancel">Cancel</button>
												<button id="btnCheckFacility" class="panel-apply">Apply</button>
											</div>

										</div>
									</div>
									<!-- Panel Dropdown / End -->

									<!-- Panel Dropdown -->
									<div class="panel-dropdown">
										<a style="cursor: pointer;">Price Range</a>
										<div class="panel-dropdown-content">
										<input id="price_slider_min" v-model="price_slider_min"  type="hidden">
										<input id="price_slider_max" v-model="price_slider_max"  type="hidden">
											<h3 class="data-radius-title">Minimum Amount</h3>
											<input class="distance-radius" type="range" min="10000" max="1000000" step="1" value="10000" data-title="">
											<h3 class="data-radius-title">Maximum Amount</h3>
											<input class="distance-radius1" type="range" min="10000" max="1000000" step="1" value="10000" data-title="">
											<div class="panel-buttons">
												<button class="panel-cancel">Disable</button>
												<button class="panel-apply">Apply</button>
											</div>
										</div>
									</div>
									<!-- Panel Dropdown / End -->
									
								</div>
								<!-- Filters / End -->
								<button id="btndosearchMap" type="button" @click="dosearch()" class="button fullwidth margin-top-25">Search</button>
                    		
					</div>
				</div>

			</section>
			<!-- Search / End -->


		<section class="listings-container margin-top-30">
		<!--<textarea  id="getListDate" cols="40" rows="9" class="search-field" type="hidden" :value="test"></textarea>-->
		<input type="hidden" id="getListDate" />
			<!-- Sorting / Layout Switcher -->
				<div class="row fs-switcher">

					<div class="col-md-6">
						<!-- Showing Results -->
						<p class="showing-results">{{records.length}} Results Found </p>
					</div>

				</div>

				<div class="row fs-listings"  v-if="records.length">
					<input type="hidden" id="txtCheckAvailabilitySearch" v-model="txtCheckAvailabilitySearch">
					<div class="col-lg-12 col-md-12" v-for="(data,index) in records">
						<div class="listing-item-container list-layout">
							<div class="listing-item">
								<!-- / -->
								<!-- Image -->
								<div class="listing-item-image" @click="myBooking(data.id)">
									<img :src="data.thumbnail" alt="">
									<span class="tag">{{data.name}}</span>
								</div>
								
								<!-- Content -->
								<div class="listing-item-content">
									<div class="listing-badge now-open"  v-if="data.status == 0">Now Open</div>
									<div class="listing-badge now-open"  v-if="data.status == 1">Closed</div>

									<div class="listing-item-inner">
										<h3>{{data.type}} At &#8358; {{data.price}}/{{data.rooms}}<i class="verified-icon"></i></h3>
										<span>{{data.landmark}}</span>
										
										<div v-if="data.avg_of_rate === null" class="star-rating" data-rating="1">({{data.count_of_review}} reviews)</div>
										<div v-if="data.avg_of_rate !== null" class="star-rating" :data-rating="data.avg_of_rate">({{data.count_of_review}} reviews)</div>
											<!--<div v-if="data.invalidfrom != ''" class="btnCheckAvailabilitySearch"></div>
											<div v-if="data.invalidfrom != ''"  @click="setInvalidDate(data.invalidfrom)" class="call-btn rating-counter">Availability: {{data.invalidto.split(",")[0]}} <i class="call-btn fa fa-calendar-check-o"></i></div>
											<div v-if="data.invalidfrom == ''" class="rating-counter">Availability: Available Anytime<i class="verified-icon"></i></div>-->
											
										
									</div>

									<span v-if="data.f_id === null && data.f_id !== -1" @click="addtoFavourite(data.id)" class="like-icon"></span>
									<span v-if="data.f_id !== null && data.f_id !== -1" @click="removetoFavourite(data.f_id)" style="color:white;background-color:red;" class="like-icon"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
					<div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
						<h4><i class="fa fa-ban"></i> {{emptyrecordmsg}}</h4>
					</div>
					<div v-show="loading" class="load-indicator static-center">
						<span class="animator">
							<clip-loader :loading="loading" color="gray" size="20px">
							</clip-loader>
						</span>
						<h4 style="color:gray" class="loading-text"></h4>
					</div>

		</section>

		</div>
	</div>
	<div class="fs-inner-container map-fixed">

		<!-- Map -->
		<div class="map-container">
		    <div id="map" data-map-zoom="9" data-map-scroll="true">
		        <!-- map goes here -->
		    </div>
		</div>

	</div>
</div>



</div>
<!-- Wrapper / End -->


    </div>
    </template>
    <script>
		//testt2();
	var PropertysearchListComponent = Vue.component('propertysearchList', {
		template: '#propertysearchList',
		mixins: [ListPageMixin, AddPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'propertysearch',
			},
			routename : {
				type : String,
				default : 'propertysearchlist',
			},
			apipath : {
				type : String,
				default : 'propertysearch/list',
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
                what_property:'',
                data:{what_property:'',},
				txtCheckAvailabilitySearch:'',
				data : {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
				user : {username : '',password : '',},
			}
		},
		computed : {
			pageTitle: function(){
				return 'Propertysearch';
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
				this.test = [];
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
							this.test = JSON.stringify(this.records);
							console.log(this.where_property);
							setInputForMap(this.test);
							//foo();
							
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
			myBooking(view) {
				window.location.href = '#/propertylist/view/'+view;
				location.reload();
			},
			setInvalidDate(id) {
				//console.log(id);
				this.txtCheckAvailabilitySearch = id;
			},
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
			addtoFavourite : function(id){
						var apiurl = setApiUrl('components/addtoFavourite/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							//window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
			removetoFavourite : function(id){
						var apiurl = setApiUrl('components/removetoFavourite/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							//window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
		}
	});
	</script>
