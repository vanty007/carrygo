    <template id="accountEdit">
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
                <a href="#"><img src="libb/assets/images/logo.png" alt=""></a>
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

                <li onclick="fhome()"><a>Home</a></li>
                <li onclick="fpropertysearch()"><a >More Homes</a></li>
                <li onclick="fmyreservation()"><a>My Reservation</a></li>
                <li><a href="info/contact">Contact</a></li>
                <li><a class="current" href="#account/edit">Profile</a></li>
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
							<li onclick="fmyreservation()"><a ><i class="sl sl-icon-book-open"></i> My Reservations</a></li>
							<li onclick="fmyfavourite()"><a><i class="sl sl-icon-star"></i> My Favourite</a></li>
							<li onclick="fmessages()"><a><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
							<li onclick="fpayment()"><a><i class="sl sl-icon-wallet"></i> My Payment</a></li>
							<li><a href="#account/edit"><i class="sl sl-icon-user"></i>My Profile</a></li>
							<li><a href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
					<?php

if(user_login_status() == true){
	if(ROLE_ID == 'administrator'){
	//echo 'hjj'.ROLE_ID;
	?>
	<a id="dashboard2"  onclick="fdashboard()" class="sign-in"><i class="sl sl-icon-screen-desktop"></i>Dashboard</a>
	<!--<li><a id="dashboard2" href="#/dashboard">Dashboard</a></li>-->
	<?php
	}
else{
	?>
	<a href="#/owner/add"><i class="sl sl-icon-briefcase"></i>Own Property</a>
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
        <!-- Right Side Content / End -->


    </div>
</div>
<!-- Header / End -->

</header>
<div class="clearfix"></div>
	<div class="dashboard-content">
		<div class="row">

			<!-- Profile -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4 class="gray">Profile Details</h4>
					<div class="dashboard-list-box-static">
						
                    <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'account/edit/' + data.id" method="post">
						<!-- Avatar -->
						<div class="edit-profile-photo" :class="{'has-error' : errors.has('profile_pics')}">
							<img v-if="data.profile_pics != null" :src="data.profile_pics" alt="">
                            <img v-if="data.profile_pics == null" src="libb/assets/images/avatar_user.png" alt="">
							<div class="change-photo-btn">
								<div class="photoUpload">
								    <span><i class="fa fa-upload"></i> Upload Photo</span>
								    <niceupload fieldname="profile_pics" control-class="upload-control"  dropmsg="Click to upload" uploadpath="uploads/files/" filenameformat="random" 
                                    extensions="jpg , png , gif , jpeg" :filesize="3" :maximum="1" name="profile_pics" v-model="data.profile_pics" v-validate="{required:true}"
                                    data-vv-as="Profile Pics"></niceupload>
                                    <small v-show="errors.has('profile_pics')" class="form-text text-danger">{{ errors.first('profile_pics') }}</small>          
								</div>
							</div>
						</div>
	
						<!-- Details -->
						<div class="my-profile">

                            <div class="form-group " :class="{'has-error' : errors.has('lastname')}">
							<label>Last Name</label>
							<input v-model="data.lastname" v-validate="{required:true}" data-vv-as="lastname" class="form-control " type="text" name="lastname" placeholder="last name">
                            <small v-show="errors.has('lastname')" class="form-text text-danger">{{ errors.first('lastname') }}</small>
                            </div>

                            <div class="form-group " :class="{'has-error' : errors.has('firstname')}">
							<label>First Name</label>
							<input v-model="data.firstname" v-validate="{required:true}" data-vv-as="firstname" class="form-control " type="text" name="firstname" placeholder="first name">
                            <small v-show="errors.has('firstname')" class="form-text text-danger">{{ errors.first('firstname') }}</small>
                            </div>

                            <div class="form-group " :class="{'has-error' : errors.has('title')}">
							<label>Title</label>
							<input v-model="data.title" v-validate="{required:true}" data-vv-as="title" class="form-control " type="text" name="title" placeholder="title">
                            <small v-show="errors.has('title')" class="form-text text-danger">{{ errors.first('title') }}</small>
                            </div>

                            <div class="form-group " :class="{'has-error' : errors.has('sex')}">
							<label>Sex</label>
							<input v-model="data.sex" v-validate="{required:true}" data-vv-as="sex" class="form-control " type="text" name="sex" placeholder="sex">
                            <small v-show="errors.has('sex')" class="form-text text-danger">{{ errors.first('sex') }}</small>
                            </div>
						</div>
                        <button @click="update()" :disabled="errors.any()" class="button margin-top-15" type="button">
                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>Update
                            <i class="fa fa-send"></i></button>
                    </form>
					</div>
				</div>
			</div>

			<!-- Change Password -->
			<div class="col-lg-6 col-md-12">
				<div class="dashboard-list-box margin-top-0">
					<h4 class="gray">Change Password</h4>
					<div class="dashboard-list-box-static">

						<!-- Change Password -->
                        <form enctype="multipart/form-data" name="changepassword" action="<?php print_link('auth/edit'); ?>" @submit.prevent="changepassword()" method="post">
                        <b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
						<div class="my-profile">
							<label class="margin-top-0">Current Password</label>
                            <div class="form-group " :class="{'has-error' : errors.has('password')}">
                                <input class="search-field" v-model="data2.password" v-validate="{required:true}" data-vv-as="password" type="password" name="password"/>
                                <small v-show="errors.has('password')" class="form-text text-danger">{{ errors.first('password') }}</small>
                            </div>

							<label>New Password</label>
                            <div class="form-group " :class="{'has-error' : errors.has('new_password')}">
                                <input class="search-field" v-model="data2.new_password" v-validate="{required:true}" data-vv-as="new_password" type="password" name="new_password"/>
                                <small v-show="errors.has('new_password')" class="form-text text-danger">{{ errors.first('new_password') }}</small>
                            </div>

							<label>Confirm New Password</label>
                            <div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
                                <input class="search-field" v-model="data2.confirm_password" v-validate="{required:true, confirmed:'new_password'}" data-vv-as="confirm_password" type="password" name="confirm_password"/>
                                <small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
                            </div>

                            <button class="button preview"  :disabled="errors.any()" type="submit">
                                 <i class="load-indicator">
                                    <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                 </i>
                                 Change Password
                                 <i class="fa fa-send"></i>
                              </button>
						</div>
                        </form>

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
	var AccountEditComponent = Vue.component('accountEdit', {
		template : '#accountEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'auth',
			},
			routename : {
				type : String,
				default : 'authaccountedit',
			},
			apipath : {
				type : String,
				default : 'account/edit',
			},
		},
		data: function() {
			return {
				data : { firstname: '',lastname: '',title: '', sex:''},
                data2 : {new_password: '',password: '',confirm_password: ''},
			}
		},
		computed: {
			pageTitle: function(){
				return 'My Account';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
								window.location.href = '#/account/edit';
								window.location.reload(); 
				}
			},

            changepassword : function(e){
						var payload = this.data2;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('auth/edit');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
						},
						function (response) {
                            window.location.href = '#/account/edit';
								window.location.reload(); 
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>
