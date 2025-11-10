    <template id="dashboardList">
        <div>
		<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container" class="fixed fullwidth dashboard">

	<!-- Header -->
	<div id="header" class="not-sticky">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a style="cursor: pointer;" href="#dashboard"><img src="libb/assets/images/logo2.png" data-sticky-logo="libb/assets/images/logo.png" alt=""></a>
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
					<li><a>Reports</a>
						<ul class="sub-menu">
							<li onclick="fpropertyreport()"><a style="cursor: pointer;">Property Listing</a></li>
							<li onclick="fpropertyrevenue()"><a style="cursor: pointer;">Property Revenue</a></li>
							<li onclick="fpropertyoccupancy()"><a style="cursor: pointer;">Property Occupancy</a></li>
							<li onclick="fpropertymaintenance()"><a style="cursor: pointer;">Property Maintenance</a></li>
							<li onclick="fpropertysoa()"><a style="cursor: pointer;">Statement of Account</a>
						</ul>
					</li>
						<!--<li><a style="cursor: pointer;" href="info/contact">Contact</a></li>
						<li><a style="cursor: pointer;" href="#account/edit">Profile</a></li>-->
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
					<div class="user-menu">
						<div class="user-name"><span><img src=" <?php echo USER_PHOTO ?>" alt=""></span>Hi, <?php echo FIRST_NAME ?>!</div>
						<ul>
							<li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Dashboard -->
<div id="dashboard">

	<!-- Navigation
	================================================== -->

	<!-- Responsive Navigation Trigger -->
	<a style="cursor: pointer;" id="dashboard-responsive-nav-trigger" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

	<div class="dashboard-nav">
		<div class="dashboard-nav-inner">

			<ul data-submenu-title="Main">
				<li class="active"><a style="cursor: pointer;" onclick="fdashboard()"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
				<li v-if="records.messages.unread_messages != 0"><a style="cursor: pointer;" onclick="fmessage()"><i class="sl sl-icon-envelope-open"></i> Messages<span class="nav-tag messages">{{records.messages.unread_messages}}</span></a></li>
				<li v-if="records.messages.unread_messages == 0"><a style="cursor: pointer;" onclick="fmessage()"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
				<li><a style="cursor: pointer;" onclick="freview()"><i class="sl sl-icon-star"></i> Review</a></li>
				<li><a style="cursor: pointer;" onclick="fbookings()"><i class="fa fa-calendar-check-o"></i> Bookings</a></li>
				<li><a style="cursor: pointer;" onclick="fpropertyavailabilityadd()"><i class="sl sl-icon-cloud-upload"></i> New Upload</a></li>
				<li><a style="cursor: pointer;" onclick="fpropertyavailabilitylist()"><i class="fa fa-building"></i>My Properties</a></li>
			</ul>

			<ul data-submenu-title="Account">
			    <li><a style="cursor: pointer;" onclick="fpayments()"><i class="sl sl-icon-wallet"></i>Payment Details</a></li>
				<?php
					if(user_login_status() == true){
						if(ROLE_ID == 'super'){
						//echo 'hjj'.ROLE_ID;
				?>
				<li><a style="cursor: pointer;" onclick="fowner()"><i class="im im-icon-Post-Sign"></i>Property Upload Request</a></li>
				<?php
						}
						}
				?>
                <li><a style="cursor: pointer;" onclick="fowneredit()"><i class="fa fa-group "></i>Company Profile</a></li>
				<li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
			</ul>
			
		</div>
	</div>
	<!-- Navigation / End -->


	<!-- Content
	================================================== -->
	<div class="dashboard-content">

		<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<h2>Howdy, <?php echo LAST_NAME.' '.FIRST_NAME ?></h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a style="cursor: pointer;" href="#">Home</a></li>
							<li>Dashboard</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<!-- Notice 
		<div class="row">
			<div class="col-md-12">
				<div class="notification success closeable margin-bottom-30">
					<p>Your listing <strong>Hotel Govendor</strong> has been approved!</p>
					<a style="cursor: pointer;" class="close" href="#"></a>
				</div>
			</div>
		</div>-->

		<!-- Content -->
		<div class="row">

			<!-- Item -->
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-1">
					<div class="dashboard-stat-content"><h4>{{records.total_properties.total_properties}}</h4> <span>Total Properties</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-The-WhiteHouse"></i></div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-2">
					<div class="dashboard-stat-content">&#8358; <h4>{{records.total_payments.total_payments}}</h4> <span>Total Revenue</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Money-Bag"></i></div>
				</div>
			</div>
			<!-- Item 
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-2">
					<div class="dashboard-stat-content"><h4>{{records.total_reviews.total_reviews}}</h4> <span>Total Views</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Line-Chart"></i></div>
				</div>
			</div>-->

			
			<!-- Item -->
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-3">
					<div class="dashboard-stat-content"><h4>{{records.pending_payments_list.pending_payments_list}}</h4> <span>Pending Payment Approval</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Money-Bag"></i></div>
				</div>
			</div>

			<!-- Item -->
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-4">
					<div class="dashboard-stat-content"><h4>{{records.myfavourite.myfavourite}}</h4> <span>Times Bookmarked</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-1">
					<div class="dashboard-stat-content"><h4>{{records.total_booking.total_booking}}</h4> <span>Total Bookings</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Open-Book"></i></div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-2">
					<div class="dashboard-stat-content"><h4>{{records.pending_booking.pending_booking}}</h4> <span>Bookings Pending Approval</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Open-Book"></i></div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-3">
					<div class="dashboard-stat-content"><h4>{{records.total_reviews.total_reviews}}</h4> <span>Total Reviews</span></div>
					<div class="dashboard-stat-icon"><i class="im im-icon-Edit"></i></div>
				</div>
			</div>
			<?php
					if(user_login_status() == true){
						if(ROLE_ID == 'super'){
						//echo 'hjj'.ROLE_ID;
				?>
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-3">
					<div class="dashboard-stat-content"><h4>{{records.total_owner.total_owner}}</h4> <span>Total Owner's Account</span></div>
					<div class="dashboard-stat-icon"><i class="im-icon-Add-UserStar"></i></div>
				</div>
			</div>
			<?php
						}
						}
				?>
			<?php
					if(user_login_status() == true){
						if(ROLE_ID == 'super'){
						//echo 'hjj'.ROLE_ID;
				?>
			<div class="col-lg-3 col-md-6">
				<div class="dashboard-stat color-5">
					<div class="dashboard-stat-content"><h4>{{records.pending_owner.pending_owner}}</h4> <span>Accounts Pending Approval</span></div>
					<div class="dashboard-stat-icon"><i class="im-icon-Add-UserStar"></i></div>
				</div>
			</div>
			<?php
						}
						}
				?>
		</div>


		<div class="row">
			
			<!-- Recent Activity -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box with-icons margin-top-20">
					<h4>Recent Reviews</h4>
					<ul v-if="records.top_reviews.length!=0">
						<li v-for="(data,index) in records.top_reviews">
							<strong>{{data.name}}</strong>
							<p>
							<a style="cursor: pointer;" href="#review"><i class="list-box-icon sl sl-icon-layers"></i> {{data.review}} </a> <strong>by {{data.lastname}} {{data.firstname}}</strong>
					        </p>
						</li>
					</ul>
					<ul v-if!="records.top_reviews.length==0">
						<center><h4>No Recent Reviews</h4></center>
					</ul>
				</div>
			</div>
			
			<!-- Invoices -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box invoices with-icons margin-top-20">
					<h4>Pending Payments Approval</h4>
					<ul v-if="records.pending_payments_list.length!=0">
						
						<li v-for="(data,index) in records.pending_payments_list"><i class="list-box-icon sl sl-icon-doc"></i>
							<strong>{{data.lastname}} {{data.firstname}}</strong>
							<ul>
								<li class="unpaid">Pending Approval</li>
								<li>Amount: &#8358;{{data.amount}}</li>
								<li>Date: {{data.created_at}}</li>
							</ul>
							<div class="buttons-to-right">
								<a style="cursor: pointer;" href="#payments" class="button gray">View Payments Status</a>
							</div>
						</li>
					</ul>
					<ul v-if="records.pending_payments_list.length==0">
					<center><h4>No Payments Pending Approval</h4></center>
					</ul>						
				</div>
			</div>

		</div>

	</div>
	<!-- Content / End -->


</div>
<!-- Dashboard / End -->
</div>
        </div>
    </template>
    <script>
	var DashboardListComponent = Vue.component('dashboardList', {
		template: '#dashboardList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'dashboard',
			},
			routename : {
				type : String,
				default : 'dashboard',
			},
			apipath : {
				type : String,
				default : 'dashboard/list',
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
				records :{
					messages: {unread_messages: ''},total_properties: {total_properties: ''},total_payments: {total_payments: ''},pending_payments_list: {pending_payments_list: ''},
								myfavourite: {myfavourite: ''},total_booking: {total_booking: ''},pending_booking: {pending_booking: ''},total_reviews: {total_reviews: ''},
								total_owner: {total_owner: ''},pending_owner: {pending_owner: ''},top_reviews: '',pending_payments_list:''
					},
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
		}
	});
	</script>
