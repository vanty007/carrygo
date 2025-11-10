<template id="Home">
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
                           <li onclick="fhome()"><a style="cursor: pointer;">Home</a></li>
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
                     <li><a href="#content" ><i class="sl sl-icon-cloud-upload"></i>Contents</a></li>
                     <li><a href="#triviaquestions" ><i class="sl sl-icon-cloud-upload"></i>Trivia Questions</a></li>
                  </ul>
                  <ul data-submenu-title="Account">
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
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Total Properties</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-The-WhiteHouse"></i></div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="dashboard-stat color-2">
                        <div class="dashboard-stat-content">
                           &#8358; 
                           <h4></h4>
                           <span>Total Revenue</span>
                        </div>
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
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Pending Payment Approval</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-Money-Bag"></i></div>
                     </div>
                  </div>
                  <!-- Item -->
                  <div class="col-lg-3 col-md-6">
                     <div class="dashboard-stat color-4">
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Times Bookmarked</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-Heart"></i></div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="dashboard-stat color-1">
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Total Bookings</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-Open-Book"></i></div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="dashboard-stat color-2">
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Bookings Pending Approval</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-Open-Book"></i></div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-6">
                     <div class="dashboard-stat color-3">
                        <div class="dashboard-stat-content">
                           <h4></h4>
                           <span>Total Reviews</span>
                        </div>
                        <div class="dashboard-stat-icon"><i class="im im-icon-Edit"></i></div>
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
			var HomeComponent = Vue.component('HomeComponent', {
				template : '#Home',
				mixins: [ListPageMixin],
				props: {
					resetgrid : {
						type : Boolean,
						default : false,
					},
					routename : {
				type : String,
				default : 'dashboard',
			},
				apipath : {
				type : String,
				default : 'dashboard/list',
			},
				},
				data : function() {
					return {
				pagelimit : defaultPageLimit,
				records :{
					messages: {unread_messages: ''},total_properties: {total_properties: ''},total_payments: {total_payments: ''},pending_payments_list: {pending_payments_list: ''},
								myfavourite: {myfavourite: ''},total_booking: {total_booking: ''},pending_booking: {pending_booking: ''},total_reviews: {total_reviews: ''},
								total_owner: {total_owner: ''},pending_owner: {pending_owner: ''},top_reviews: '',pending_payments_list:''
					},
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
					load:function(){

					},	
				},
				mounted : function() {
					this.ready = true;
				},
			});
		</script>
	