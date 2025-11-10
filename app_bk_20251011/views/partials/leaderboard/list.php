        <template id="leaderboardList">
		<div>
    
	<div id="wrapper">
	<div id="openPicsModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Bid Picture</h4>
						</div>
						<div class="modal-body" style="display: grid;justify-content: center;align-items: center;">
							<img width="520" height="397" :src="modalimage" data-ll-status="loaded">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>

			<div id="openBidModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Make your Bid</h4>
						</div>
						<div class="modal-body" style="display: grid;justify-content: center;align-items: center;">
								<form class="register" name="loginForm" action="<?php print_link('home/postbid_info'); ?>" @submit.prevent="postbid_info()" method="post">
									<b-alert class="animated shake" variant="danger" :show="showError" @dismissed="showError=false" dismissible>{{errorMsg}}</b-alert>
										<p v-if="user.msisdn == null" class="form-row form-row-wide">
											<label for="username">Enter Phone Number:
												<i class="im im-icon-Male"></i>
												<input type="number" class="input-text" v-model="user.msisdn" name="msisdn"  value="" />
											</label>
										</p>

										<p class="form-row form-row-wide">
											<label for="username">Enter Bid Number:
												<!--<i class="im im-icon-Male"></i>-->
												<input type="number" class="input-text" v-model="user.points" name="points"  required="required"  value="" />
											</label>
										</p>

										<div class="form-row">
											<button class="button border margin-top-5" type="submit">
														<i class="load-indicator">
															<clip-loader :loading="loading" color="#fff" size="14px"></clip-loader>
														</i>
														Submit <i class="fa fa-arrow-right"></i>
											</button>
										</div>
										
								</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>			

<!-- Content
================================================== -->
<div class="fs-container">
	
	<div class="container content">
		<div class="fs-content">


		<section class="listings-container margin-top-30">
			<h2 style="text-align: center;">Top Bid Leaders</h2>
		<!--<textarea  id="getListDate" cols="40" rows="9" class="search-field" type="hidden" :value="test"></textarea>-->
		<!-- <input type="hidden" id="getListDate" />
			Sorting / Layout Switcher 
				<div class="row fs-switcher">

					<div class="col-md-6">
						<p class="showing-results">{{records.length}} Results Found </p>
					</div>

				</div>-->

						<div class="row fs-listings"  v-if="records.length">
								<div class="col-lg-12 col-md-12" v-for="(data,index) in records">

									<div class="listing-item-container listing-geo-data list-layout listing-type-service"  data-listing-type="service" data-campaign-placement="home">
									<div class="listing-item ">
										<div class="listing-small-badges-container">
										</div>
										<!-- Image -->
										<div class="listing-item-image"  @click="showpop(data.image)">
											<!--<img width="520" height="397" :src="data.image" data-ll-status="loaded">-->
											<niceimg :path="data.image" width="520" height="397" data-toggle="modal" data-target="#openBidModal"></niceimg>
											<span class="tag"><a :href="data.url" target="_blank" style="color:white;">Website Link</a></span>
										</div>
										<!-- Content -->
										<div class="listing-item-content">
											<div class="listing-badge now-opened" v-if="data.status ==0" style="color:white;background-color:green;">Bid Open</div>
											<div class="listing-badge now-closed" v-if="data.status !=0" style="color:red;background-color:#000;">Bid Closed</div>
											<div class="listing-item-inner">
												<h3><router-link style="text-decoration:none;" :to="'/leaderboardbid/index/name/' +  data.id">{{data.name}}</router-link></h3>
												
												<div class="listing-list-small-badges-container">
													<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>&#8358;{{data.price}}</div>
													<div class="listing-small-badge shop-badge"><i class="fa fa-store"></i> Bid Points {{data.open_points}}</div>

													<div  v-if="data.status ==0" class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>Bid Open</div>
													<div style="color:red;" v-if="data.status !=0" class="listing-small-badge pricing-badge"><i style="color:red;background-color:white;" class="fa fa-tag"></i>Bid Closed</div>
												</div>
												<span>{{data.bid_entry_points}} Current Highest Bidded Points <strong> by {{maskedPhoneNumber(data.msisdn)}}</strong></span>
												
											</div>
													<span v-if="data.status == 0" style="color:white;background-color:white;position: absolute;z-index: 101;right: 30px;bottom: 5px;cursor: normal;display: block;height: 44px;width: 44px;transition: all 0.4s;" >
													<h2 style="color:grey;"><button data-toggle="modal" data-target="#openBidModal" @click="setBidid(data.id,data.open_points,data.open_date)" class="button border margin-top-5" type="button">Bid</button></h2></span>

											
										</div>
									</div>
									</div>


								</div>
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

		</section>

		</div>
	</div>
</div>



</div>
<!-- Wrapper / End -->


    </div>
        </template>
        <script>
			var LeaderboardListComponent = Vue.component('leaderboardList', {
				template : '#leaderboardList',
				mixins: [ListPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'leaderboard',
			},
			routename : {
				type : String,
				default : 'leaderboard',
			},
			apipath : {
				type : String,
				default : 'leaderboard/list',
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
				user : {points : '',msisdn : '',bidid:'',open_date:'',open_points:''},
				modalimage:''
			}
		},
		computed : {
			pageTitle: function(){
				return 'leaderboard';
			},
			filterGroupChange: function(){
				return ;
			},
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
		maskedPhoneNumber(msisdn) {
         const visibleDigits = 3; // Number of visible digits at the beginning and end
         const numToMask = msisdn.length - 2 * visibleDigits;
         if (msisdn.length <= visibleDigits * 2) {
           return msisdn; // Not enough digits to mask
         }

         const firstPart = msisdn.slice(0, visibleDigits);
         const maskedPart = '*'.repeat(numToMask);
         const lastPart = msisdn.slice(-visibleDigits);

         return `${firstPart}${maskedPart}${lastPart}`;
       },
			load:function(){
				this.records = [];
				this.test = [];
				if (this.loading == false){
					this.ready = false;
					this.loading = true;
					var url = this.apiUrl;
					this.$http.get(url).then(function (response) {
						var data = response.body;
						console.log(data)
						if(data && data.records){
							this.totalrecords = data.total_records ;
							if(this.pagelimit  > data.records.length){
								this.loadcompleted = true;
							}
							this.user.points = data.records2.user_points;
							this.user.msisdn = data.records2.user;
							this.records = data.records;
							
							//foo();
							
						}
						else{
							console.log(response)
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
			showpop: function(img){ 
					//alert(img)
					this.modalimage = img
					$('#openPicsModal').modal();
        			},
			setBidid(id,open_points,open_date) {
				this.user.bidid = id;
				this.user.open_date = open_date;
				this.user.open_points = open_points;
			},
			postbid_info : function(e){
						var payload = this.user;
						console.log(payload)
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('home/postbid_info');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							alert('You have successfully bidded')
							//window.location = response.body;
							location.reload();
						},
						function (response) {
							this.loading = false;
							this.showError = false
							this.errorMsg = response.statusText;
							console.log(response)
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					},
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
