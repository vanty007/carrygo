<template id="propertymaintenanceEdit">
<div>
	<div id="wrapper">
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
								<li class="active"><a>Reports</a>
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
<!-- Header Container / End -->


<!-- Dashboard -->
		<div id="dashboard">
			<a style="cursor: pointer;" id="dashboard-responsive-nav-trigger" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

			<div class="dashboard-nav">
				<div class="dashboard-nav-inner">

					<ul data-submenu-title="Main">
						<li><a style="cursor: pointer;" onclick="fdashboard()"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
						<li><a style="cursor: pointer;" onclick="fmessage()"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
						<li><a style="cursor: pointer;" onclick="freview()"><i class="sl sl-icon-star"></i> Review</a></li>
						<li><a style="cursor: pointer;" onclick="fbookings()"><i class="fa fa-calendar-check-o"></i> Bookings</a></li>
						<li ><a style="cursor: pointer;" onclick="fpropertyavailabilityadd()"><i class="sl sl-icon-cloud-upload"></i> New Upload</a></li>
						<li class="active"><a style="cursor: pointer;" onclick="fpropertyavailabilitylist()"><i class="fa fa-building"></i>My Properties</a></li>
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
			<div class="dashboard-content">

			    <div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
								<h6 class="text-white text-capitalize ps-3" style="font-size:13px;" >Facilities Maintenance <span style="color:red;font-size:13px;">({{data.name}})</span></h6>
							</div>
							</div>
							<div class="card-body px-0 pb-2">
								
                               <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'propertymaintenance/edit/' + data.property_id" method="post">  

									<div class="row with-forms" style="font-size:13px;">
										<div class="col-md-6">
											<h5>Property Facility Name <i class="tip" data-tip-content="Property Location Name"></i></h5>
											<div class="form-group " :class="{'has-error' : errors.has('facilityname')}">
												<div class="" style="font-size:13px;">
													<dataselect style="font-size:13px;"
															v-model="data.facilityname"
															data-vv-value-path="data.facilityname"
															data-vv-as="Facilityname"
															v-validate="{required:true}"
															placeholder="Select A Value ... " name="facilityname" :multiple="false" 
															:datapath="'components/propertyfacility_facilityname_option_list/'+ this.id"
															>
													</dataselect>
													<small v-show="errors.has('facilityname')" class="form-text text-danger">{{ errors.first('facilityname') }}</small>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h5>Maintenance Times <i class="tip" data-tip-content="Property Location Name"></i></h5>
											<div class="form-group " :class="{'has-error' : errors.has('frequency')}">
												<input v-model="data.frequency" v-validate="{required:true}" data-vv-as="frequency" type="number" name="frequency"/>
												<small v-show="errors.has('frequency')" class="form-text text-danger">{{ errors.first('frequency') }}</small>
											</div>
										</div>
									</div>
									<div class="row with-forms">
										<div class="col-md-6">
											<h5>Service Description <i class="tip" data-tip-content="Service Description"></i></h5>
											<div class="form-group " :class="{'has-error' : errors.has('description')}">
												<textarea  name="description" cols="40" rows="3" v-model="data.description" v-validate="{required:true}" data-vv-as="description" type="text"></textarea>
												<small v-show="errors.has('description')" class="form-text text-danger">{{ errors.first('description') }}</small>
											</div>
										</div>
										<div class="col-md-6">
											<h5>Maintenance Cost <i class="tip" data-tip-content="Maintenance Cost "></i></h5>
											<div class="form-group " :class="{'has-error' : errors.has('cost')}">
												<input v-model="data.cost" v-validate="{required:true}" data-vv-as="cost" type="number" name="cost"/>
												<small v-show="errors.has('cost')" class="form-text text-danger">{{ errors.first('cost') }}</small>
											</div>
										</div>
									</div>


									<div class="form-group text-center">
                                        <button class="button preview"  :disabled="errors.any()" type="button" @click="update()">
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
	var PropertymaintenanceEditEditComponent = Vue.component('propertymaintenanceEdit', {
		template : '#propertymaintenanceEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'propertymaintenance',
			},
			routename : {
				type : String,
				default : 'propertymaintenanceedit',
			},
			apipath : {
				type : String,
				default : 'propertymaintenance/edit',
			},
		},
		data: function() {
			return {
				data : {property_id:'',facilityname: '',facilitytype: '',frequency: '',description: '',cost: '', name:''},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Propertyavailability';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					//this.$router.push('/propertyavailability');
				window.location.href = '#/propertymaintenance/';
				location.reload();
				}
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
