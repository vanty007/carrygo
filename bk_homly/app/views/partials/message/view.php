<template id="messageView">

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
				<li class="active"><a style="cursor: pointer;" onclick="fmessage()"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
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
	<!-- Navigation / E


	<!-- Content
	================================================== -->
	<div class="dashboard-content">

		<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<h2>Messages</h2>
					<!-- Breadcrumbs -->
					<nav id="breadcrumbs">
						<ul>
							<li><a style="cursor: pointer;" href="#">Home</a></li>
							<li><a style="cursor: pointer;" href="#/dashboard">Dashboard</a></li>
							<li><a style="cursor: pointer;" href="#/message">Messages</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="row">
			
			<!-- Listings -->
			<div class="col-lg-12 col-md-12">

				<div class="messages-container margin-top-0">
					<div class="messages-headline">
						<h4>{{data[0].lastname}} {{data[0].firstname}}</h4>
						<!--<a style="cursor: pointer;" href="#" class="message-action"><i class="sl sl-icon-trash"></i> Delete Conversation</a>-->
					</div>

					<div class="messages-container-inner" v-if="data.length">

						<!-- Message Content -->
						<div class="message-content">
                     <div v-for="(datas,index) in data">
							<div class="message-bubble" v-if="datas.sender != '<?php echo USER_ID; ?>'">
                        <div v-if="datas.profile_pics != null" class="message-avatar"><img :src="datas.profile_pics" alt="" /></div>
								<div v-if="datas.profile_pics == null" class="message-avatar"><img src="libb/assets/images/avatar_user.png" alt="" /></div>
								<div class="message-text">
                                 <h5 v-if="datas.days != 0">{{datas.lastname}} {{datas.firstname}} - {{datas.days}} days ago </h5>
											<h5 v-if="datas.days == 0 && datas.hours != 0">{{datas.lastname}} {{datas.firstname}}  - {{datas.hours}} hours ago </h5>
											<h5 v-if="datas.days == 0 && datas.hours == 0 && datas.minutes != 0">{{datas.lastname}} {{datas.firstname}}  - {{datas.minutes}} minutes ago </h5>
											<h5 v-if="datas.days == 0 && datas.hours == 0 && datas.minutes == 0 && data.seconds != 0">{{datas.lastname}} {{datas.firstname}}  - {{datas.seconds}} seconds ago </h5>   
                         <p>{{datas.message}}</p>
                        </div>
                           
							</div>

                     <div class="message-bubble me" v-if="datas.sender == '<?php echo USER_ID; ?>'">
                     <div v-if="datas.profile_pics != null" class="message-avatar"><img :src="datas.profile_pics" alt="" /></div>
								<div v-if="datas.profile_pics == null" class="message-avatar"><img src="libb/assets/images/avatar_user.png" alt="" /></div>
                        <div class="message-text">
						<h5 v-if="datas.days != 0">Me - {{datas.days}} days ago </h5>
						<h5 v-if="datas.days == 0 && datas.hours != 0">Me  - {{datas.hours}} hours ago </h5>
						<h5 v-if="datas.days == 0 && datas.hours == 0 && datas.minutes != 0">Me  - {{datas.minutes}} minutes ago </h5>
						<h5 v-if="datas.days == 0 && datas.hours == 0 && datas.minutes == 0 && data.seconds != 0">Me  - {{datas.seconds}} seconds ago </h5>     
                         <p>{{datas.message}}</p>
                        </div>
							</div>
                  </div>
							
							<!-- Reply Area -->
							<div class="clearfix"></div>
                     <form enctype="multipart/form-data" name="sendmessage" action="<?php print_link('message/add'); ?>" @submit.prevent="sendmessage()" method="post">
						<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
                     <!--<input   :value="data[0].sender"/>
                     <input  :value="data[0].message_id"/>-->
							<div class="message-reply" :class="{'has-error' : errors.has('message')}">
								<textarea cols="40" rows="3" placeholder="Your Message" v-model="message.message" v-validate="{required:true}" data-vv-as="message" type="text" name="message"></textarea>
                        <small v-show="errors.has('message')" class="form-text text-danger">{{ errors.first('message') }}</small>
                        <button class="button preview"  :disabled="errors.any()" type="submit">
                           <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="15px"></clip-loader></i>Send Message<i class="fa fa-send"></i>
                        </button>
							</div>
                     </form>
							
						</div>
						<!-- Message Content -->

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
	var MessageViewComponent = Vue.component('messageView', {
		template : '#messageView',
		mixins: [ViewPageMixin,AddPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'message',
			},
			routename : {
				type : String,
				default : 'message',
			},
			apipath: {
				type : String,
				default : 'message/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						firstname: '',lastname: '',title: '',profile_pics: '',id: '',message_id: '',sender: '',receiver: '',message: '',created_at:'',subject:''
					},
				},
            message:{
               message:'',message_id:'',sender:''
            }
			}
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/myreservation');
				location.reload();
			},
			resetData : function(){
				this.data = {
					firstname: '',lastname: '',title: '',profile_pics: '',id: '',message_id: '',sender: '',receiver: '',message: '',created_at:'',subject:''
				}
			},
			sendmessage : function(e){
						//var payload = this.message;
						var sender="";
						var user_id = '<?php echo (USER_ID!=null) ? USER_ID: "";?>';
						console.log("|||"+user_id+"|||")
						if(this.data[0].receiver==user_id)
						{
							sender = this.data[0].sender;
						}
						else{
							sender = this.data[0].receiver;
						}

                  var payload_json = '{"subject": "'+this.data[0].subject+'","message": "'+this.message.message+'","message_id": "'+this.data[0].message_id+'","sender": "'+sender+'"}';
                  console.log(payload_json)
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('message/add');
						this.$http.post( apiurl , payload_json ).then(function (response) {
							self.loading = false;
							//window.location = response.body;
                     this.load();
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
		},
	});
	</script>
