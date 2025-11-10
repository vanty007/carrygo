_    <template id="reviewList">
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
				<li><a style="cursor: pointer;" onclick="fdashboard()"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
				<li><a style="cursor: pointer;" onclick="fmessage()"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
				<li class="active" ><a style="cursor: pointer;" onclick="freview()"><i class="sl sl-icon-star"></i> Review</a></li>
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
					<h2>Reviews</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a style="cursor: pointer;" href="#">Home</a></li>
							<li><a style="cursor: pointer;" href="#/dashboard">Dashboard</a></li>
							<li>Reviews</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="row">
			
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">

				<div class="dashboard-list-box margin-top-0">

					<h4>Visitor Reviews</h4> 

					<!-- Reply to review popup -->
					<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
						<div class="small-dialog-header">
							<h3>Reply to review</h3>
						</div>
						<div class="message-reply margin-top-0">
							<textarea cols="40" rows="3"></textarea>
							<button class="button">Reply</button>
						</div>
					</div>

					<ul class="comments listing-reviews" v-if="records.length!=0">

						<li v-for="(data,index) in records">
							<div>
								<ul>
									<li>
										<div class="avatar" v-if="data.profile_pics != null"><img :src="data.profile_pics" alt="" /></div>
										<div class="avatar" v-if="data.profile_pics == null"><img src="libb/assets/images/avatar_user.png" alt="" /></div>
										
										<div class="comment-content"><div class="arrow-comment"></div>
											<div class="comment-by">{{data.lastname}} {{data.firstname}} <div class="comment-by-listing">on <a style="cursor: pointer;" :href="'#/propertylist/view/'+data.id">{{data.name}}</a></div> <span class="date">{{data.created_at}}</span>
												<div class="star-rating" data-rating="5"></div>
											</div>
											<p>{{data.review}}</p>
											<!--<a style="cursor: pointer;" href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-action-undo"></i> Reply to this review</a>-->
										</div>
									</li>
								</ul>
							</div>
						</li>

					</ul>
					<ul v-if="records.length==0">
					<center><h4>No Recent Reviews</h4></center>
					</ul>
				</div>

				<!-- Pagination
				<div class="clearfix"></div>
				<div class="pagination-container margin-top-30 margin-bottom-0">
					<nav class="pagination">
						<ul>
							<li><a style="cursor: pointer;" href="#" class="current-page">1</a></li>
							<li><a style="cursor: pointer;" href="#">2</a></li>
							<li><a style="cursor: pointer;" href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
						</ul>
					</nav>
				</div> -->
				<!-- Pagination / End -->

			</div>

		</div>

	</div>


</div>
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->

        </div>
    </template>
    <script>
	var ReviewListComponent = Vue.component('reviewList', {
		template: '#reviewList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'review',
			},
			routename : {
				type : String,
				default : 'reviewlist',
			},
			apipath : {
				type : String,
				default : 'review/list',
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
			}
		},
		computed : {
			pageTitle: function(){
				return 'bookings';
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

			approvePayment : function(id){
						var apiurl = setApiUrl('components/approvePayment/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
					approveBooking : function(id){
						var apiurl = setApiUrl('components/approveBooking/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
					rejectBooking : function(id){
						var apiurl = setApiUrl('components/rejectBooking/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
					
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
