    <template id="ownerEdit">
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
                <li class="active"><a style="cursor: pointer;" onclick="fowneredit()"><i class="fa fa-group "></i>Company Profile</a></li>
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
				<div class="col-md-4">
					<h2>Company Details</h2> 
				</div>

				<div class="col-md-3">
					<div v-if="data.status == 1" data-tip-content="Listing has been verified and belongs the business owner or manager." class="verified-badge with-tip"><i class="sl sl-icon-check"></i> Verified Listing
					<div class="tip-content" style="width: 510px; max-width: 510px;">Listing has been verified and belongs the business owner or manager.</div></div>

					<div v-if="data.status == 0" style="background-color:gold;" data-tip-content="Listing has been verified and belongs the business owner or manager." class="verified-badge with-tip"><i class="sl sl-icon-check"></i> Pending Verification
					<div class="tip-content" style="width: 510px; max-width: 510px;">Listing pending verification.</div></div>

					<div v-if="data.status == 2" style="background-color:red;" data-tip-content="Listing has been verified and belongs the business owner or manager." class="verified-badge with-tip"><i class="sl sl-icon-check"></i> Verification Restricted
					<div class="tip-content" style="width: 510px; max-width: 510px;">Listing verification restricted.</div></div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
            <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'owner/edit/' + data.id" method="post">
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
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->
</div>
    </template>
    <script>
	var OwnerEditComponent = Vue.component('ownerEdit', {
		template : '#ownerEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'owner',
			},
			routename : {
				type : String,
				default : 'owneredit',
			},
			apipath : {
				type : String,
				default : 'owner/edit',
			},
		},
		data: function() {
			return {
				data : { name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Owner';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
                location.reload();
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
