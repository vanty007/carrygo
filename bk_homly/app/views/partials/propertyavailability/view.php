    <template id="propertyavailabilityView">
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
					<a style="cursor: pointer;" href="#"><img src="libb/assets/images/logo2.png" data-sticky-logo="libb/assets/images/logo.png" alt=""></a>
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
					}
					else{
						?>
					<?php
					}
					?>
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
				<li class="active"><a style="cursor: pointer;" onclick="fpropertyavailabilityadd()"><i class="sl sl-icon-cloud-upload"></i> New Upload</a></li>
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
					<h2>{{data.records.name}}</h2>
				</div>
			</div>
		</div>


<niceimg v-for="(datas,index) in data.pictures" :path="datas" width="200" height="200" ></niceimg> 
<!--<div class="listing-slider mfp-gallery-container margin-bottom-0">
   <a style="cursor: pointer;" v-for="(datas,index) in data.pictures" :href="datas" title="Title01" class="item mfp-gallery slick-slide slick-current slick-active slick-center" 
      data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
   <img  :src="datas" alt=""></a>
</div>-->
<!-- Content
   ================================================== -->
<div class="container">
   <div class="row sticky-wrapper">
      <div class="col-lg-8 col-md-8 padding-right-30">
         <!-- Titlebar -->
         <div id="titlebar" class="listing-titlebar">
            <div class="listing-titlebar-title">
               <h2>{{data.records.type}} <span class="listing-tag">At &#8358;{{data.records.price}}</span></h2>
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
            <!-- Listing Contacts -->
            <div class="listing-links-container">
               <ul class="listing-links contact-links">
                  <input type="hidden" id="invalidfrom" :value="data.records.invalidfrom"/>
                  <input type="hidden" id="invalidto" :value="data.records.invalidto"/>
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
                     <div class="comment-content">
                        <div class="arrow-comment"></div>
                        <div class="comment-by">
                           {{datas.firstname}} {{datas.lastname}}
                           <i class="tip" data-tip-content="Person who left this review actually was a customer">
                              <div class="tip-content">Person who left this review actually was a customer</div>
                           </i>
                           <span class="date">{{datas.created_at}}</span>
                           <div class="star-rating" v-if="data.rating_count.rate != null" :data-rating="data.rating_count.rate"><span class="star"></span></div>
                           <div class="star-rating" v-if="data.rating_count.rate == null" data-rating="0"><span class="star"></span></div>
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
      </div>
   </div>
</div>



    </div>
</div>
</div>
</div>
    </template>
    <script>
	var PropertyavailabilityViewComponent = Vue.component('propertyavailabilityView', {
		template : '#propertyavailabilityView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'propertyavailability',
			},
			routename : {
				type : String,
				default : 'propertyavailabilityview',
			},
			apipath: {
				type : String,
				default : 'propertyavailability/view',
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
				user : {username : '',password : '',},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Propertyavailability';
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
		},
	});
	</script>
