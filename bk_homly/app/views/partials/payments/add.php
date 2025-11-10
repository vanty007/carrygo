    <template id="paymentsAdd">
    <div>
    <header id="header-container" class="fullwidth">

<!-- Header -->
<div id="header">
   <div class="container">
      
      <!-- Left Side Content -->
      <div class="left-side">
         
         <!-- Logo -->
         <div id="logo">
            <a style="cursor: pointer;" href=""><img src="libb/images/logo2.png" data-sticky-logo="libb/images/logo.png" alt=""></a>
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
               <li onclick="fmyreservation()"><a style="cursor: pointer;" class="current">My Reservation</a></li>
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
                  <li><a style="cursor: pointer;" href="#account/edit"><i class="sl sl-icon-user"></i>My Profile</a></li>
                  <li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
               </ul>
            </div>
            <?php

if(user_login_status() == true){
if(ROLE_ID == 'administrator'){
//echo 'hjj'.ROLE_ID;
?>
<a style="cursor: pointer;" id="dashboard2"  href="#/dashboard" class="sign-in"><i class="sl sl-icon-screen-desktop"></i>Dashboard</a>
<!--<li><a style="cursor: pointer;" id="dashboard2" href="#/dashboard">Dashboard</a></li>-->
<?php
}
else{
?>
<li><a style="cursor: pointer;" href="#/owner/add">Own Property? <span class="nav-tag messages" style="font-size:25px;color:red;font-weigth:bold;">*</span></a></li>
<?php
}
}


            }
            else{
               ?>
            <a style="cursor: pointer;" href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
            <?php
            }
            ?>
         </div>
      </div>
            <!-- Header / End -->
         </header>
         <div class="clearfix"></div>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            
               <div id="add-listing">
                  <!-- Section -->
                  <div class="add-listing-section margin-top-45">
                     <!-- Headline -->
                     <div class="add-listing-headline">
                        <h3><i class="sl sl-icon-location"></i> Payment information</h3>
                     </div>
                     <div class="submit-section">
                        <form enctype="multipart/form-data" @submit="save" class="form form-default" action="payments/add" method="post">
                           <div class="row with-forms">
                              <div class="col-md-6">
                                 <h5>Amount Paid <i class="tip" data-tip-content="Amount Paid "></i></h5>
                                 <div class="form-group " :class="{'has-error' : errors.has('amount')}">
                                    <input class="search-field" v-model="data.amount" v-validate="{required:true}" data-vv-as="Amount" type="text" name="amount"/>
                                    <small v-show="errors.has('amount')" class="form-text text-danger">{{ errors.first('amount') }}</small>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                    <h3><i class="sl sl-icon-picture"></i> Upload</h3>
                                 <!-- Dropzone -->
                                 <input type="text" v-model="data.propertyavai_id">
                                 <div class="submit-section">
                                    <div class="form-group " :class="{'has-error' : errors.has('upload')}">
                                       <div class="row">
                                          <div class="col-sm-4">
                                             <label class="control-label" for="upload">Upload Prove <span class="text-danger">*</span></label>
                                          </div>
                                          <div class="col-sm-8">
                                             <div class="">
                                                <niceupload
                                                   fieldname="upload"
                                                   control-class="upload-control"
                                                   dropmsg="Drop files here to upload"
                                                   uploadpath="uploads/images/"
                                                   filenameformat="random" 
                                                   :filesize="3" 
                                                   :maximum="1" 
                                                   name="upload"
                                                   v-model="data.upload"
                                                   v-validate="{required:true}"
                                                   data-vv-as="Upload Payment Prove"
                                                   >
                                                </niceupload>
                                                <small v-show="errors.has('upload')" class="form-text text-danger">{{ errors.first('upload') }}</small>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Row / End -->
                           <div class="form-group text-center">
                              <button class="button preview"  :disabled="errors.any()" type="submit">
                                 <i class="load-indicator">
                                    <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                 </i>
                                 Submit
                                 <i class="fa fa-send"></i>
                              </button>
                           </div>
                        </form>
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
	var PaymentsAddComponent = Vue.component('paymentsAdd', {
		template : '#paymentsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'payments',
			},
			routename : {
				type : String,
				default : 'paymentsadd',
			},
			apipath : {
				type : String,
				default : 'payments/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
                loading : false,
				ready: false,
				errorMsg : '',
				showError : false,
				data : {
					status: '0',upload: '',amount: '',propertyavai_id: document.querySelector("input[name=property_id2]").value,
				},
                data2 : {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
                user : {username : '',password : '',},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Payments';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/myreservation');
			},
			resetForm : function(){
				this.data = {status: '0',upload: '',amount: '',};
                this.data2 = {email: '',firstname: '',lastname: '',password: '',confirm_password: ''},
				this.$validator.reset();
			},
            login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
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
					register : function(e){
						var payload = this.data2;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/register');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
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
					}
		},
		mounted : function() {
            const field = document.querySelector("input[name=property_id2]").value
        console.log(field)
		},
	});
	</script>
