    <template id="propertymaintenanceList">
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
			<div class="clearfix"></div>
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
						<li><a style="cursor: pointer;" onclick="fpropertyavailabilityadd()"><i class="sl sl-icon-cloud-upload"></i> New Upload</a></li>
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
               <!-- Titlebar -->
               <div id="titlebar">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="col-sm-3 comp-grid" :class="setGridSize">Search Any Field
                            <input @keyup.enter="dosearchReportAll()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" id="theCheckFacility"/>
                        </div>
						<div class="col-sm-3 comp-grid" :class="setGridSize">Search Date Range
                            <input  class="form-control" v-model="price_slider_min" type="text" name="search" placeholder="Date From" id="price_slider_min"/>
                        </div>
						<div class="col-sm-3 comp-grid" :class="setGridSize">&nbsp;
                            <input @keyup.enter="dosearchReportDateRange()" v-model="price_slider_max" class="form-control" type="text" name="search" placeholder="Date To" id="price_slider_max"/>
                        </div>

							<div class="col-sm-3 comp-grid" style="margin-right:30px"> Search by Grouping
								<div class="sort-by-select">
									<select @change="dosearchReportSorts()" id="what_property" >
										<option selected="selected" value="all" data-select2-id="select2-data-3-sk3e">All Category</option>
										<option value="cost">Facility Total Cost</option>
										<option value="costdate">Facility Total Cost by Date</option>
									</select>
								</div>
							</div>	
									<div class="col-sm-3 comp-grid" :class="setGridSize">Filter Based on Properties
										<a style="text-decoration:none;" @click="togglePropertyCheck()" class="myButton">Filter <i class="fa fa-arrow-down"></i></a>
										<div v-for="name in uniqueNames" :key="name"  class="form-group" v-if="showCheckProperties">
											<div class="checkboxes checkbox-inline margin-top-10">
												<input @change="checkPropertySearch()" class="checkbox-inline" name="rememberme" type="checkbox" :id="name" :value="name" v-model="selectedRecords"/>
												<label @change="checkPropertySearch()" class="checkbox-inline" :for="name">{{name}}</label>
											</div>
										</div>
									</div>
                        <!-- Breadcrumbs 
                        <nav id="breadcrumbs">
                           <ul>
                              <li><a style="cursor: pointer;" href="#/dashboard">Dashboard</a></li>
                              <li>Property Revenue</li>
                           </ul>
                        </nav>-->
                     </div>
                  </div>
               </div>
				<div class="chart-area">
					<canvas id="chartLinePurple"></canvas>
				</div>
			   <div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
								<h6 class="text-white text-capitalize ps-3" style="font-size:13px;">Property Facility Maintenance</h6>
							</div>
							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0" v-if="records.length" ref="datatable">
									<table class="table align-items-center mb-0" style="font-size:13px;">
									<thead>
										<tr>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property</Data></th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Property Facility</Data></th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Maintenance Cost</th>
											<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(data,index) in records">
											<td>{{ data.name }}</td>
                                            <td>{{ data.facilityname }}</td>
                                            <td>{{ data.cost }}</td>
											<td>{{ data.created_at }}</td>
										<!--<td class="align-middle">
											<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
											Edit
											</a>
										</td>-->
										</tr>
                                        <tr>
                                          <td colspan="2" class="grand-total-label" style="font-weight: bold;">Total:</td>
                                          <td class="grand-total" style="font-weight: bold;">N{{ grandTotal_Amount }}</td>
                                        </tr>
									</tbody>
									</table>
								</div>
									<div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
                                        <h4><i class="fa fa-ban"></i> {{emptyrecordmsg}}</h4>
                                    </div>
                                    <div v-show="loading" class="load-indicator static-center">
                                        <span class="animator">
                                            <clip-loader :loading="loading" color="gray" size="20px">
                                            </clip-loader>
                                        </span>
                                        <h4 style="color:gray" class="loading-text"></h4>
                                    </div>
                                    <div v-if="paginate" class="page-header" >
                                        <div v-if="paginate" style="font-size:13px;">
                                            <pagination
                                                :total-items="totalrecords"
                                                :current-items-count="currentItemsCount"
                                                :items-per-page="limit"
                                                :offset="5"
                                                :show-record-count="true"
                                                :show-page-count="true"
                                                :show-page-limit="true"
                                                @limit-changed="limitChanged"
                                                @changepage="changepage">
                                            </pagination>
                                        </div>
                                    </div>
                                    <div class="page-footer">
                                        <button @click="exportRecord()" class="btn btn-sm btn-primary"><i style="font-size:13px;" class="fa fa-save"></i> </button>
                                    </div>

							</div>
						</div>
					</div>
      			</div>

            </div>
		</div>
<!-- Dashboard / End -->


</div>
<!-- Wrapper / End -->

    <div>
    </template>
    <script>
		
	var PropertymaintenanceListComponent = Vue.component('propertymaintenanceList', {
		template: '#propertymaintenanceList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'propertymaintenance',
			},
			routename : {
				type : String,
				default : 'propertymaintenance',
			},
			apipath : {
				type : String,
				default : 'propertymaintenance/list',
			},
			tablestyle: {
				type: String,
				default: ' table-striped table-sm',
			},
		},
		data: function(){
			return {
				pagelimit : defaultPageLimit,
				selectedRecords: [],
				showCheckProperties: false,
				v_propertylistRecords:'',
				records_new:[],
			}
		},
		computed : {
         grandTotal_Amount() {
            let sum = 0;
            this.records.forEach(item => sum += parseInt(item.cost));
        return sum.toLocaleString();
        },
			pageTitle: function(){
				return 'Propertyavailability';
			},
			filterGroupChange: function(){
				return ;
			},
			uniqueNames() {
      		return [...new Set(this.records_new.map(r => r.name))];
			}
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
			checkPropertySearch: function () {
				var propertylistRecords = this.selectedRecords.join(", ");
				//console.log(propertylistRecords);
				this.v_propertylistRecords = propertylistRecords;
				this.dosearchReportProperties();
				//console.log(checkedVals.join(","))
				//this.data.facilities = checkedVals.join(",");
			},
			togglePropertyCheck:function(){
				if(this.showCheckProperties==true){
					this.showCheckProperties=false;
				}
				else if(this.showCheckProperties==false){
					this.showCheckProperties=true;
				}

			},
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
							this.records_new = data.records_new;
							let arr_labels = [];
							let arr_value = [];
							for(var i=0;i<data.records.length;i++){
								//console.log(data.records[i]);
								arr_labels.push(data.records[i]['created_at']);
								arr_value.push(data.records[i]['cost']);
							}
							window.loaddashboard(arr_labels, arr_value);
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
			loadHref : function(id){
			window.location.href = "#/propertyavailability/view/"+id;
			location.reload();
					}, 
			loadHrefedit : function(id){
			window.location.href = "#/propertyavailability/edit/"+id;
			location.reload();
					}, 
		}
	});
	</script>
