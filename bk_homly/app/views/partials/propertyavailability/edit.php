    <template id="propertyavailabilityEdit">
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
					<h2>Edit Property</h2> 
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
            <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'propertyavailability/edit/' + data.id" method="post">
            <div id="add-listing">

<!-- Section -->
<div class="add-listing-section margin-top-45">

<!-- Headline -->
<div class="add-listing-headline">
<h3><i class="sl sl-icon-location"></i> Property Location</h3>
</div>

<div class="submit-section">

<!-- Row -->
<div class="row with-forms">
<!--<div class="col-md-6">
<h5>Property Address <i class="tip" data-tip-content="Address of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('address')}">
<input class="search-field" v-model="data.address" v-validate="{required:true}" data-vv-as="Property Address" type="text" name="address"/>
<small v-show="errors.has('address')" class="form-text text-danger">{{ errors.first('address') }}</small>
</div>
</div>-->
<div class="col-md-6">
<h5>Property Location Name <i class="tip" data-tip-content="Property Location Name"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('landmark')}">
<input class="search-field" v-model="data.landmark" v-validate="{required:true}" data-vv-as="Property Landmark" type="text" name="landmark"/>
<small v-show="errors.has('landmark')" class="form-text text-danger">{{ errors.first('landmark') }}</small>
</div>
</div>
<div class="col-md-6">
<h5>City <i class="tip" data-tip-content="City"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('city')}">
<input class="search-field" v-model="data.city" v-validate="{required:true}" data-vv-as="city" type="text" name="city"/>
<small v-show="errors.has('city')" class="form-text text-danger">{{ errors.first('city') }}</small>
</div>
</div>

<div class="col-md-6">
<h5>State <i class="tip" data-tip-content="State"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('state')}">
<input class="search-field" v-model="data.state" v-validate="{required:true}" data-vv-as="state" type="text" name="state"/>
<small v-show="errors.has('state')" class="form-text text-danger">{{ errors.first('state') }}</small>
</div>
</div>
<!-- City -->
<div class="col-md-6">
<h5>Country</h5>
<div class="form-group " :class="{'has-error' : errors.has('country')}">
<div>
<dataselect v-model="data.country" data-vv-value-path="data.country" data-vv-as="Type" v-validate="{required:true}" placeholder="Select A Value ... " 
name="country" :multiple="false" :datasource="countryOptionList" style="">
</dataselect>
<small v-show="errors.has('country')" class="form-text text-danger">{{ errors.first('country') }}</small>
</div>
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
<h3><i class="sl sl-icon-doc"></i> Basic Informations</h3>
</div>

<!-- Title -->
<div class="row with-forms">
<div class="col-md-6">
<h5>Property Name <i class="tip" data-tip-content="Name of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('name')}">
<input class="search-field" v-model="data.name" v-validate="{required:true}" data-vv-as="Property Name" 
type="text" name="name"/>
<small v-show="errors.has('name')" class="form-text text-danger">{{ errors.first('name') }}</small>
</div>
</div>
<div class="col-md-6">
<h5>Property Type <i class="tip" data-tip-content="Type of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('type')}">
<input class="search-field" v-model="data.type" v-validate="{required:true}" data-vv-as="Property Type" 
type="text" name="type"/>
<small v-show="errors.has('type')" class="form-text text-danger">{{ errors.first('type') }}</small>
</div>
</div>

</div>
<div class="row with-forms">
<div class="col-md-6">
<h5>Property Contactemail <i class="tip" data-tip-content="Contactemail of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('contactemail')}">
<input class="search-field" v-model="data.contactemail" v-validate="{required:true}" data-vv-as="Property Contactemail" 
type="text" name="contactemail"/>
<small v-show="errors.has('contactemail')" class="form-text text-danger">{{ errors.first('contactemail') }}</small>
</div>
</div>
<div class="col-md-6">
<h5>Property Contactphone <i class="tip" data-tip-content="Contactphone of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('contactphone')}">
<input class="search-field" v-model="data.contactphone" v-validate="{required:true}" data-vv-as="Property Contactphone" 
type="text" name="contactphone"/>
<small v-show="errors.has('contactphone')" class="form-text text-danger">{{ errors.first('contactphone') }}</small>
</div>
</div>
</div>
<div class="row with-forms">
<div class="col-md-6">
<h5>Property Price <i class="tip" data-tip-content="Price of your property"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('price')}">
<input class="search-field" v-model="data.price" v-validate="{required:true, numeric:true}" data-vv-as="Property Price" 
type="text" name="price"/>
<small v-show="errors.has('price')" class="form-text text-danger">{{ errors.first('price') }}</small>
</div>
</div>
<div class="col-md-6">
								<h5>Property Service Charge <i class="tip" data-tip-content="service charge of your property"></i></h5>
                                <div class="form-group " :class="{'has-error' : errors.has('service_charge')}">
								<input class="search-field" v-model="data.service_charge" data-vv-as="Property service_charge" 
                                 type="text" name="service_charge"/>
                                 <small v-show="errors.has('service_charge')" class="form-text text-danger">{{ errors.first('service_charge') }}</small>
                                </div>
							</div>
							<!--<div class="col-md-6">
								<h5>Charge Rate <i class="tip" data-tip-content="Charge Rate"></i></h5>
                                <div class="form-group " :class="{'has-error' : errors.has('rooms')}">
								<dataselect v-model="data.rooms" data-vv-value-path="data.rooms" data-vv-as="Type" v-validate="{required:true}" placeholder="Select A Value ... " 
									name="rooms" :multiple="false" :datasource="chargerateOptionList" style="">
								</dataselect>
                                 <small v-show="errors.has('rooms')" class="form-text text-danger">{{ errors.first('rooms') }}</small>
                                </div>
							</div>-->
</div>

</div>
<!-- Section / End -->

<!-- Section 
<div class="add-listing-section margin-top-45">


<div class="add-listing-headline">
<h3><i class="sl sl-icon-location"></i> Location</h3>
</div>

<div class="submit-section">


<div class="row with-forms">


<div class="col-md-6">
<h5>City</h5>
<select class="chosen-select-no-single" >
    <option label="blank">Select City</option>	
    <option>New York</option>
    <option>Los Angeles</option>
    <option>Chicago</option>
    <option>Houston</option>
    <option>Phoenix</option>
    <option>San Diego</option>
    <option>Austin</option>
</select>
</div>


<div class="col-md-6">
<h5>Address</h5>
<input type="text" placeholder="e.g. 964 School Street">
</div>


<div class="col-md-6">
<h5>State</h5>
<input type="text">
</div>


<div class="col-md-6">
<h5>Zip-Code</h5>
<input type="text">
</div>

</div>


</div>
</div>-->
<!-- Section / End -->


<!-- Section -->
<div class="add-listing-section margin-top-45">

<!-- Headline -->
<div class="add-listing-headline">
<h3><i class="sl sl-icon-picture"></i> Gallery</h3>
</div>

<!-- Dropzone -->
<div class="submit-section">

<div class="form-group " :class="{'has-error' : errors.has('pictures')}">
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label" for="pictures">Pictures <span class="text-danger">*</span></label>
        </div>
        <div class="col-sm-8">
            <div class="">
                <niceupload
                    fieldname="pictures"
                    control-class="upload-control"
                    dropmsg="Drop files here to upload"
                    uploadpath="uploads/files/"
                    filenameformat="random" 
                    extensions="jpg , png , gif , jpeg"  
                    :filesize="10" 
                    :maximum="8" 
                    :multiple="true"
                    name="pictures"
                    v-model="data.pictures"
                    v-validate="{required:true}"
                    data-vv-as="Pictures"
                    >
                </niceupload>
                <small v-show="errors.has('pictures')" class="form-text text-danger">{{ errors.first('pictures') }}</small>
            </div>
        </div>
    </div>
</div>
</div>
<div class="add-listing-headline">
<h3><i class="sl sl-icon-picture"></i> Thumbnail</h3>
</div>

<!-- Dropzone -->
<div class="submit-section">

<div class="form-group " :class="{'has-error' : errors.has('thumbnail')}">
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label" for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
        </div>
        <div class="col-sm-8">
            <div class="">
                <niceupload
                    fieldname="thumbnail"
                    control-class="upload-control"
                    dropmsg="Drop files here to upload"
                    uploadpath="uploads/files/"
                    filenameformat="random" 
                    :filesize="10" 
                    :maximum="1" 
                    name="thumbnail"
                    v-model="data.thumbnail"
                    v-validate="{required:true}"
                    data-vv-as="Thumbnail"
                    >
                </niceupload>
                <small v-show="errors.has('thumbnail')" class="form-text text-danger">{{ errors.first('thumbnail') }}</small>
            </div>
        </div>
    </div>
</div>
</div>
<div id="add-comment" class="add-comment">
<fieldset>

<h5>Description <i class="tip" data-tip-content="description"></i></h5>
<div class="form-group " :class="{'has-error' : errors.has('description')}">
<textarea  name="description" cols="40" rows="3" class="search-field" v-model="data.description" v-validate="{required:true}" data-vv-as="description" 
type="text"></textarea>
<small v-show="errors.has('description')" class="form-text text-danger">{{ errors.first('description') }}</small>
</div>

</fieldset>
<div class="clearfix"></div>
</div>
<div id="add-comment" class="add-comment">
						<fieldset>
							
								<h5>Facilities (separated with ,) <i class="tip" data-tip-content="facilities"></i></h5>
							<!--<div class="form-group " :class="{'has-error' : errors.has('facilities')}">
								<textarea  name="facilities" cols="40" rows="3" class="search-field" v-model="data.facilities" data-vv-as="description" 
                                 type="text"></textarea>
								 <small v-show="errors.has('facilities')" class="form-text text-danger">{{ errors.first('facilities') }}</small>
							</div>-->
							<div class="row panel-dropdown-content checkboxes categories">
													<input v-model="data.facilities"  type="hidden">
			
												<div class="col-md-6">
													<input @change="check($event)" class="theCheckFacilityClass" id="check-2" type="checkbox" value="All Day Power Supply" name="check">
													<label for="check-2" @change="check($event)">All Day Power Supply</label>

													<input class="theCheckFacilityClass" id="check-3" type="checkbox" value="All Day Security" name="check">
													<label for="check-3">All Day Security</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-4" type="checkbox" value="Free High-Speed Internet" name="check" >
													<label @change="check($event)" for="check-4">Free High-Speed Internet</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-5" type="checkbox" value="Premium Sound Bar" name="check">
													<label @change="check($event)" for="check-5">Premium Sound Bar</label>	

													<input @change="check($event)" class="theCheckFacilityClass" id="check-6" type="checkbox" value="Smart lock-Code" name="check">
													<label @change="check($event)" for="check-6">Smart lock-Code</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-7" type="checkbox" value="Air Conditioning" name="check">
													<label @change="check($event)" for="check-7">Air Conditioning</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-8" type="checkbox" value="DSTV Netflix & YouTube" name="check">
													<label @change="check($event)" for="check-8">DSTV Netflix & YouTube</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-9" type="checkbox" value="Fully Fitted Kitchen" name="check">
													<label @change="check($event)" for="check-9">Fully Fitted Kitchen</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-10" type="checkbox" value="Chef on Request" name="check">
													<label @change="check($event)" for="check-10">Chef on Request</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-11" type="checkbox" value="Housekeeping Services" name="check">
													<label @change="check($event)" for="check-11">Housekeeping Services</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-12" type="checkbox" value="Spa On Request" name="check">
													<label @change="check($event)" for="check-12">Spa On Request</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-13" type="checkbox" value="Property Manager" name="check">
													<label @change="check($event)" for="check-13">Property Manager</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-14" type="checkbox" value="All Rooms En-Suite" name="check">
													<label @change="check($event)" for="check-14">All Rooms En-Suite</label>

													<input @change="check($event)" class="theCheckFacilityClass" id="check-15" type="checkbox" value="Ample Parking Space" name="check">
													<label @change="check($event)" for="check-15">Ample Parking Space</label>

												</div>
											</div>
						</fieldset>
						<div class="clearfix"></div>
					</div>
</div>
<!-- Section / End -->

                    <!-- Section -->
<div class="add-listing-section margin-top-45">

<div class="add-listing-headline">
<h3><i class="sl sl-icon-location"></i> Property Availability</h3>
</div>

<div class="submit-section">

<!-- Row -->
<div class="row with-forms">
						<div class="col-md-6">
							<h5>Property Available From & To <i class="tip" data-tip-content="Property Available From"></i></h5>
							<div class="row">
								<div class="col-md-9">
									<input class="search-field date-picker2" type="text"/>
									<input id="idinvalidfrom" v-model="data.invalidfrom"  data-vv-as="Property Available From" type="text" name="idinvalidfrom"/>
									<input id="idinvalidto" v-model="data.invalidto"  data-vv-as="Property Available To" type="text" name="idinvalidto"/>
								</div>
								<div class="col-md-3">
								<!--<button class="button preview" type="submit">Add<i class="fa fa-send"></i></button>-->
									<a style="cursor: pointer;" id="btnAddAvailabilityDate" style="margin-top:5px;" class="rate-review"><i class="sl sl-icon-plus"></i>Add</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h5>Available Date List</h5>
							<div class="row">
								<div class="col-md-9">
									<textarea readonly id="idAvailability" v-model="data.invalidto" name="idAvailability" cols="40" rows="3" class="search-field"type="text"></textarea>
								</div>
								<div class="col-md-3">
								<!--<button class="button preview" type="submit">Add<i class="fa fa-send"></i></button>-->
									<a style="cursor: pointer;" id="btnClearAvailabilityDate" style="margin-top:5px;" class="rate-review"><i class="sl sl-icon-close"></i>Remove</a>
								</div>
							</div>
						</div>
					</div>

</div>


</div>
</div>
<!-- Section / End -->
                    <div class="form-group text-center">
                                        <button class="button preview"  :disabled="errors.any()" type="button" @click="update()">
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
	var PropertyavailabilityEditComponent = Vue.component('propertyavailabilityEdit', {
		template : '#propertyavailabilityEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'propertyavailability',
			},
			routename : {
				type : String,
				default : 'propertyavailabilityedit',
			},
			apipath : {
				type : String,
				default : 'propertyavailability/edit',
			},
		},
		data: function() {
			return {
				data : {service_charge:0, facilities:'',invalidto:'',invalidfrom:'',city:'',state:'',location_name:'',country:'',name:'',address:'',landmark:'',contactphone:'',contactemail:'',contactname:'',property_id: '',type: '',quantity: '',price: '',description: '',pictures: '',thumbnail: '',},
                countryOptionList: ["Afghanistan","Åland Islands","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua and Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas (the)","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia (Plurinational State of)","Bonaire Sint Eustatius and Saba","Bosnia and Herzegovina","Botswana","Bouvet Island","Brazil","British Indian Ocean Territory (the)","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cabo Verde","Cambodia","Cameroon","Canada","Cayman Islands (the)","Central African Republic (the)","Chad","Chile","China","Christmas Island","Cocos (Keeling) Islands (the)","Colombia","Comoros (the)","Congo (the Democratic Republic of the)","Congo (the)","Cook Islands (the)","Costa Rica","Croatia","Cuba","Curaçao","Cyprus","Czechia","Côte d'Ivoire","Denmark","Djibouti","Dominica","Dominican Republic (the)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Eswatini","Ethiopia","Falkland Islands (the) [Malvinas]","Faroe Islands (the)","Fiji","Finland","France","French Guiana","French Polynesia","French Southern Territories (the)","Gabon","Gambia (the)","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea","Guinea-Bissau","Guyana","Haiti","Heard Island and McDonald Islands","Holy See (the)","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran (Islamic Republic of)","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Korea (the Democratic People's Republic of)","Korea (the Republic of)","Kuwait","Kyrgyzstan","Lao People's Democratic Republic (the)","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macao","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands (the)","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia (Federated States of)","Moldova (the Republic of)","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands (the)","New Caledonia","New Zealand","Nicaragua","Niger (the)","Nigeria","Niue","Norfolk Island","Northern Mariana Islands (the)","Norway","Oman","Pakistan","Palau","Palestine State of","Panama","Papua New Guinea","Paraguay","Peru","Philippines (the)","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Republic of North Macedonia","Romania","Russian Federation (the)","Rwanda","Réunion","Saint Barthélemy","Saint Helena Ascension and Tristan da Cunha","Saint Kitts and Nevis","Saint Lucia","Saint Martin (French part)","Saint Pierre and Miquelon","Saint Vincent and the Grenadines","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Sint Maarten (Dutch part)","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Georgia and the South Sandwich Islands","South Sudan","Spain","Sri Lanka","Sudan (the)","Suriname","Svalbard and Jan Mayen","Sweden","Switzerland","Syrian Arab Republic","Taiwan (Province of China)","Tajikistan","Tanzania United Republic of","Thailand","Timor-Leste","Togo","Tokelau","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Turks and Caicos Islands (the)","Tuvalu","Uganda","Ukraine","United Arab Emirates (the)","United Kingdom of Great Britain and Northern Ireland (the)","United States Minor Outlying Islands (the)","United States of America (the)","Uruguay","Uzbekistan","Vanuatu","Venezuela (Bolivarian Republic of)","Viet Nam","Virgin Islands (British)","Virgin Islands (U.S.)","Wallis and Futuna","Western Sahara","Yemen","Zambia","Zimbabwe"],
				chargerateOptionList:  ["Hourly", "Daily", "Weekly", "Monthly", "Yearly"],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Propertyavailability';
			},
		},
		methods: {
			check: function (e) {
				var checkedVals = $('.theCheckFacilityClass:checkbox:checked').map(function() {
			return this.value;
		}).get();
		console.log(checkedVals.join(","))
		this.data.facilities = checkedVals.join(",");
		
      //console.log(e.srcElement.defaultValue)
    },
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					//this.$router.push('/propertyavailability');
				window.location.href = '#/propertyavailability/';
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
