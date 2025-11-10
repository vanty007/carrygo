    <template id="paymentList">
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
					<?php
					}
					?>
				</div>
			</div>

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
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
								<!--<a style="cursor: pointer;" @click="setSender(data.user_id)" href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>-->

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
					
                </li>
                
            </ul>
        </div>
    </div>

</div>
</div>

</div>

	</div>
    </template>
    <script>
	var PaymentListComponent = Vue.component('paymentList', {
		template: '#paymentList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'paymentList',
			},
			routename : {
				type : String,
				default : 'paymentlist',
			},
			apipath : {
				type : String,
				default : 'payment/list',
			},
			tablestyle: {
				type: String,
				default: ' table-striped table-sm',
			},
		},
		data: function(){
			return {
				pagelimit : defaultPageLimit,
				message:{message:'',sender:''},
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
					sendmessage : function(){
						//var payload = this.message;
                  var payload_json = '{"subject": "payment","message": "'+this.message.message+'","message_id": "0","sender": "'+this.message.sender+'"}';
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
					},

					
		}
	});
	</script>
