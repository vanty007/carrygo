<template id="carrygo_bid_entryList">

    <div>
      <div id="wrapper">
         <!-- Header Container
            ================================================== -->
         <header id="header-container" class="fixed fullwidth dashboard">
            <!-- Header -->

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
                  <li  onclick="fhome()"><a style="cursor: pointer;"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
					 <li>
						<a><i class="sl sl-icon-layers"></i>M-Health Service</a>
						<ul>
							<li onclick="fsubscriptions()"><a style="cursor: pointer;">Subscriptions</a></li>
							<li onclick="fcontents()"><a style="cursor: pointer;">Contents</a></li>
							<li onclick="fquestions_log()"><a style="cursor: pointer;">Question & Answer Content</a></li>
							<li onclick="fentries_log()"><a style="cursor: pointer;">Trivia Results</a></li>
							<li onclick="fuser_credit()"><a style="cursor: pointer;">Daily Winners</a></li>
						</ul>
					</li>
					<li class="active">
						<a><i class="sl sl-icon-layers"></i>Carry Go Service</a>
						<ul>
							<li onclick="fcarrygo_bid_subscription()"><a style="cursor: pointer;">Carrygo Subscription</a></li>
							<li onclick="fcarrygo_bid()"><a style="cursor: pointer;">Bid Contents</a></li>
							<li onclick="fcarrygo_bid_winners()"><a style="cursor: pointer;">Bid Winners</a></li>
                     		<li onclick="fcarrygo_bid_entry()"><a style="cursor: pointer;">Bid Entry</a></li>
							<li onclick="fcarrygo_bid_points()"><a style="cursor: pointer;">User Points</a></li>
							<li onclick="fcarrygo_bid_active()"><a style="cursor: pointer;">Open Bids</a></li>
						</ul>
					</li>
                  </ul>
                  <ul data-submenu-title="Account">
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

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                           <ul>
                              <li><a style="cursor: pointer;" href="#">Home</a></li>
                              <li>Bid Entries</li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>

			   <div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h6 class="text-white text-capitalize ps-3">Bid Entries</h6>
                                </div>
                                <div class="col-8" style="float:right;">
                                    <div v-if="searchfield" class="col-sm-6 comp-grid" :class="setGridSize" style="float:right;">
                                        <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" />
                                    </div>
                                </div>
                            </div>
							</div>



							</div>
							<div class="card-body px-0 pb-2">
								<div class="table-responsive p-0" v-if="records.length" ref="datatable">
									<table class="table align-items-center mb-0">
									<thead>
										<tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" v-if="listsequence" class="td-sno">#</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Phone No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Bid Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Item Price</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Points</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Date</th>
                                            <th  class="td-btn"></th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(data,index) in records">
                                                    <th v-if="listsequence" class="td-sno">{{index + 1}}</th>
                                                    <td> {{ data.msisdn }} </td>
                                                    <td> {{ truncate(data.name,20) }} </td>
                                                    <td> {{ data.price }} </td>
                                                    <td> {{ data.points }} </td>
                                                    <td> {{ data.created_at }} </td>
										<!--<td class="align-middle">
											<a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
											Edit
											</a>
										</td>-->
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
                                    <div v-if="paginate" class="page-header">
                                        <div v-if="paginate">
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
                                    <div v-if="showfooter" class="page-footer">
                                        <button @click="exportRecord()" v-if="exportbutton" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> </button>
                                    </div>

							</div>
						</div>
					</div>
      			</div>

            </div>
            <!-- Content / End -->
         </div>
         <!-- Dashboard / End -->
      </div>
   </div>
</template>
    <script>
	var Carrygo_Bid_EntryListComponent = Vue.component('carrygo_bid_entryList', {
		template: '#carrygo_bid_entryList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'carrygo_bid_entry',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_entrylist',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_entry/list',
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
				return 'Carrygo Bid Entry';
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
            truncate: function(data,num){ 
					const reqdString =  
					data.split("").slice(0, num).join(""); 
					return reqdString; 
        },
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
