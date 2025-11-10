<template id="messagesView">

<div>
<div id="wrapper">

<!-- Header Container
================================================== -->
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
	<div class="row">
	<div class="col-lg-12 col-md-12">

<div class="messages-container margin-top-0">
	<div class="messages-headline">
		<!--<h4>{{data[0].lastname}} {{data[0].firstname}}</h4>-->
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


</div>
<!-- Wrapper / End -->
</div>

</template>
    <script>
	var MessagesViewComponent = Vue.component('messagesView', {
		template : '#messagesView',
		mixins: [ViewPageMixin,AddPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'messages',
			},
			routename : {
				type : String,
				default : 'messages',
			},
			apipath: {
				type : String,
				default : 'messages/view',
			},
		},
		data: function() {
			return {
				data : {
					firstname: '',lastname: '',
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
