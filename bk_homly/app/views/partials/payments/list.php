    <template id="paymentsList">
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
				<li><a style="cursor: pointer;" onclick="freview()"><i class="sl sl-icon-star"></i> Review</a></li>
				<li><a style="cursor: pointer;" onclick="fbookings()"><i class="fa fa-calendar-check-o"></i> Bookings</a></li>
				<li><a style="cursor: pointer;" onclick="fpropertyavailabilityadd()"><i class="sl sl-icon-cloud-upload"></i> New Upload</a></li>
				<li><a style="cursor: pointer;" onclick="fpropertyavailabilitylist()"><i class="fa fa-building"></i>My Properties</a></li>
			</ul>

			<ul data-submenu-title="Account">
			    <li class="active"><a style="cursor: pointer;" onclick="fpayments()"><i class="sl sl-icon-wallet"></i>Payment Details</a></li>
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
            <h2>Payments</h2>
        </div>
    </div>
</div>

<div class="row" v-if="records.length">
    
    <!-- Listings -->
    <div class="col-lg-12 col-md-12">
        <div class="dashboard-list-box margin-top-0">
            
            <ul>

                <li class="pending-booking" v-for="(data,index) in records">
                    <div class="list-box-listing bookings">
                    <div class="list-box-listing-img"><niceimg :path="data.upload" width="100" height="100" ></niceimg> </div>
                        
                        <div class="list-box-listing-content">
                            <div class="inner">
                                <h3>{{data.firstname}} ({{data.lastname}}) 
                                <span class="booking-status pending" v-if="data.status == 0">Pending Approval</span>
                                    <span class="booking-status" style="background-color: #64bc36;" v-if="data.status == 1">Approved</span>

                                <div class="inner-booking-list">
                                    <h5>Payment Date:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">{{data.created_at}}</li>
                                    </ul>
                                </div>
                                            
                                <div class="inner-booking-list">
                                    <h5>Booking Details:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">{{data.type}}, {{data.rooms}} Rooms</li>
                                    </ul>
                                </div>		
                                            
                                <div class="inner-booking-list">
                                    <h5>Price:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">&#8358; {{data.price}}</li>
                                    </ul>
                                </div>	
                                <div class="inner-booking-list">
                                    <h5>Paid:</h5>
                                    <ul class="booking-list">
                                        <li class="highlighted">&#8358; {{data.amount}}</li>
                                    </ul>
                                </div>	

                               <!-- <div class="inner-booking-list">
                                    <h5>Customer:</h5>
                                    <ul class="booking-list">
                                        <li>{{data.title}} {{data.lastname}} {{data.firstname}}</li>
                                        <li>john@example.com</li>
                                        <li>123-456-789</li>
                                    </ul>
                                </div>-->

                                <!--<a style="cursor: pointer;" href="#small-dialog" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>-->

                            </div>
                        </div>
                    </div>
                    <div class="buttons-to-right">
                        <a style="cursor: pointer;" @click="acceptPaymentAdmin(data.id)" v-if="data.status == 0 && data.b_status==1" class="button gray accept"><i class="sl sl-icon-close" ></i> Approve Payment</a>
                                              
                    </div>
                </li>
                
            </ul>
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
	var PaymentsListComponent = Vue.component('paymentsList', {
		template: '#paymentsList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'payments',
			},
			routename : {
				type : String,
				default : 'paymentslist',
			},
			apipath : {
				type : String,
				default : 'payments/list',
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
				return 'Payments';
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
            acceptPaymentAdmin : function(id){
						var apiurl = setApiUrl('components/acceptPaymentAdmin/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
		}
	});
	</script>
