  <template id="messagesList">
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
	<div class="row">
	<div class="col-lg-12 col-md-12">

<div class="messages-container margin-top-0">
	<div class="messages-headline">
		<h4>Inbox</h4>
	</div>
	
	<div class="messages-inbox" v-if="records.length">

		<ul>
			<li class="unread" v-for="(data,index) in records">
				<a style="cursor: pointer;" @click="gotomessages(data.message_id)">
					<div v-if="data.profile_pics != null" class="message-avatar"><img :src="data.profile_pics" alt="" /></div>
					<div v-if="data.profile_pics == null" class="message-avatar"><img src="libb/assets/images/avatar_user.png" alt="" /></div>

					<div class="message-by">
						<div class="message-by-headline">
							<h5 v-if="data.receipt == 0 && data.sender == <?php echo USER_ID; ?>">Me</h5>
							<h5 v-if="data.receipt == 0 && data.sender != <?php echo USER_ID; ?>">{{data.lastname}} {{data.firstname}} <i>Unread</i></h5>
							<h5 v-if="data.receipt == 1 && data.sender == <?php echo USER_ID; ?>">Me </h5>
							<h5 v-if="data.receipt == 1 && data.sender != <?php echo USER_ID; ?>">{{data.lastname}} {{data.firstname}} </h5>
							<span v-if="data.days != 0">{{data.days}} days ago </span>
							<span v-if="data.days == 0 && data.hours != 0">{{data.hours}} hours ago </span>
							<span v-if="data.days == 0 && data.hours == 0 && data.minutes != 0">{{data.minutes}} minutes ago </span>
							<span v-if="data.days == 0 && data.hours == 0 && data.minutes == 0 && data.seconds != 0">{{data.seconds}} seconds ago </span>
						</div>
						<p>{{ truncate(data.message,100) }} </p>
					</div>
				</a>
			</li>
		</ul>
		
	</div>
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
</div>-->
<!-- Pagination / End -->

</div>
	</div>
</div>

</div>

	</div>
    </template>
    <script>
	var MessagesListComponent = Vue.component('messagesList', {
		template: '#messagesList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'messages',
			},
			routename : {
				type : String,
				default : 'messages',
			},
			apipath : {
				type : String,
				default : 'messages/list',
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
				return 'message';
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
			truncate: function(data,num){ 
            const reqdString =  
              data.split("").slice(0, num).join(""); 
            return reqdString; 
        },
		gotomessages : function(id){
			//alert(id)
			window.location.href = '#/messages/view/'+id
			location.reload();
					},

		}
	});
	</script>
