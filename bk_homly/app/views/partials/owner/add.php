    <template id="ownerAdd">
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
	<!-- Content
	================================================== -->
	<div class="dashboard-content">

		<!-- Titlebar -->
		<div id="titlebar">
			<div class="row">
				<div class="col-md-12">
					<h2>Setup Company Details</h2> 
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
            <form enctype="multipart/form-data" @submit="save" class="form form-default" action="owner/add" method="post">
				<div id="add-listing">

                					<!-- Section -->
					<div class="add-listing-section margin-top-45">

<!-- Headline -->
<div class="add-listing-headline">
    <h3><i class="sl sl-icon-doc"></i> Company Basic Informations</h3>
</div>

<div class="submit-section">

    <!-- Row -->
    <div class="row with-forms">
    <div class="col-md-6">
			<h5>Company Name <i class="tip" data-tip-content="Company Name"></i></h5>
            <div class="form-group " :class="{'has-error' : errors.has('name')}">
			<input class="search-field" v-model="data.name" v-validate="{required:true}" data-vv-as="Company Name" type="text" name="name"/>
            <small v-show="errors.has('name')" class="form-text text-danger">{{ errors.first('name') }}</small>
            </div>
		</div>
		<div class="col-md-6">
			<h5>Company Address <i class="tip" data-tip-content="Address of your Company"></i></h5>
            <div class="form-group " :class="{'has-error' : errors.has('address')}">
			<input class="search-field" v-model="data.address" v-validate="{required:true}" data-vv-as="Company Address" type="text" name="address"/>
            <small v-show="errors.has('address')" class="form-text text-danger">{{ errors.first('address') }}</small>
            </div>
		</div>

		<div class="col-md-6">
			<h5>Contact Name <i class="tip" data-tip-content="City"></i></h5>
            <div class="form-group " :class="{'has-error' : errors.has('contactname')}">
			<input class="search-field" v-model="data.contactname" data-vv-as="contactname" type="text" name="contactname"/>
            <small v-show="errors.has('contactname')" class="form-text text-danger">{{ errors.first('contactname') }}</small>
            </div>
		</div>

		<div class="col-md-6">
			<h5>Contact Phone No <i class="tip" data-tip-content="Contact Phone No"></i></h5>
            <div class="form-group " :class="{'has-error' : errors.has('contactphone')}">
			<input class="search-field" v-model="data.contactphone" v-validate="{required:true}" data-vv-as="contactphone" type="text" name="contactphone"/>
            <small v-show="errors.has('contactphone')" class="form-text text-danger">{{ errors.first('contactphone') }}</small>
            </div>
		</div>
    </div>
    <!-- Row / End -->

</div>
</div>
<!-- Section / End -->

					<!-- Section -->
					<div class="add-listing-section">

						<!-- Headline -->
						<div class="add-listing-headline">
							<h3><i class="sl sl-icon-doc"></i> Company Verification Details</h3>
						</div>

						<!-- Title -->
						<div class="row with-forms">
							<div class="col-md-6">
								<h5>Referral Name <i class="tip" data-tip-content="Name of Referal"></i></h5>
                                <div class="form-group " :class="{'has-error' : errors.has('referalname')}">
								<input class="search-field" v-model="data.referalname" v-validate="{required:true}" data-vv-as="Referal Name" 
                                 type="text" name="referalname"/>
                                 <small v-show="errors.has('referalname')" class="form-text text-danger">{{ errors.first('referalname') }}</small>
                                </div>
							</div>
							<div class="col-md-6">
								<h5>Referral Contact No <i class="tip" data-tip-content="Referral Contact No "></i></h5>
                                <div class="form-group " :class="{'has-error' : errors.has('referalphoneno')}">
								<input class="search-field" v-model="data.referalphoneno" v-validate="{required:true}" data-vv-as="Referral Contact No " 
                                 type="text" name="referalphoneno"/>
                                 <small v-show="errors.has('referalphoneno')" class="form-text text-danger">{{ errors.first('referalphoneno') }}</small>
                                </div>
							</div>

						</div>
                        <div class="row with-forms">
							<div class="col-md-6">
								<h5>Upload Verifiable Document (International Passport or Driver License) <i class="tip" data-tip-content="Contactemail of your property"></i></h5>
                                <div class="submit-section">
                                    <div class="form-group " :class="{'has-error' : errors.has('document')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="document">Document <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="document"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/images/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        :multiple="true"
                                                        name="document"
                                                        v-model="data.document"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Document"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('document')" class="form-text text-danger">{{ errors.first('document') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>							
                              
						</div>
							</div>
						</div>

					</div>
<!-- Section / End -->
                    <div class="form-group text-center">
                                        <button class="button preview"  :disabled="errors.any()" type="submit">
                                            <i class="load-indicator">
                                                <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                            </i>
                                            Submit
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
				</div>
                </form>
			</div>


		</div>

	</div>
	<!-- Content / End -->



</div>
<!-- Wrapper / End -->
</div>
    </template>
    <script>
	var OwnerAddComponent = Vue.component('ownerAdd', {
		template : '#ownerAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'owner',
			},
			routename : {
				type : String,
				default : 'owneradd',
			},
			apipath : {
				type : String,
				default : 'owner/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '0',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Owner';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/dashboard');
				location.reload();
			},
			resetForm : function(){
				this.data = {name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '0',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
