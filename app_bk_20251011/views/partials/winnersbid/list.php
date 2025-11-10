        <template id="winnersbidList">
		<div>
    
	<div id="wrapper">
				

<!-- Content
================================================== -->
<div class="fs-container">
	
	<div class="container content">
		<div class="fs-content">


		<section class="listings-container margin-top-30">
			<h2 style="text-align: center;">History of Bids Won</h2>
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
										<div class="listing-item-image">
												<img width="520" height="397" :src="data.image" data-ll-status="loaded">
											<span class="tag"><a :href="data.url" target="_blank" style="color:white;">Website Link</a></span>
										</div>
										<!-- Content -->
										<div class="listing-item-content">
											<div class="listing-badge now-closed" v-if="data.bid_active_points === null" style="color:white;background-color:green;">Bid Open</div>
											<div class="listing-badge now-closed" v-if="data.bid_active_points !== null && data.bid_winner_points === null" style="color:white;background-color:green;">Bid Open</div>
											<div class="listing-badge now-closed" v-if="data.bid_active_points !== null && data.bid_winner_points !== null" style="color:red;background-color:#000;">Bid Closed</div>
											<div class="listing-item-inner">
												<h3><router-link style="text-decoration:none;" :to="'/bid/view/' +  data.id">{{data.name}}</router-link></h3>
												
												<div class="listing-list-small-badges-container">
													<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>&#8358;{{data.price}}</div>
													<div class="listing-small-badge shop-badge"><i class="fa fa-store"></i> Bid Points {{data.open_points}}</div>

													<div v-if="data.bid_active_points === null"  class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>Bid Open</div>
													<div  v-if="data.bid_active_points !== null && data.bid_winner_points === null" class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>Bid Open</div>
													<div style="color:red;" v-if="data.bid_active_points !== null && data.bid_winner_points !== null" class="listing-small-badge pricing-badge"><i style="color:red;background-color:white;" class="fa fa-tag"></i>Bid Closed</div>
												</div>
												<span v-if="data.bid_entry_points !== null">({{data.bid_entry_points}} Bidded Points) <strong>won by {{maskedPhoneNumber(data.msisdn)}}</strong></span>
												
											</div>
													<span v-if="data.bid_winner_points === null" style="color:white;background-color:white;position: absolute;z-index: 101;right: 30px;bottom: 5px;cursor: normal;display: block;height: 44px;width: 44px;transition: all 0.4s;" >
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
			var WinnersbidListComponent = Vue.component('winnersbidList', {
				template : '#winnersbidList',
				mixins: [ListPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'winnersbid',
			},
			routename : {
				type : String,
				default : 'winnersbid',
			},
			apipath : {
				type : String,
				default : 'winnersbid/list',
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
			}
		},
		computed : {
			pageTitle: function(){
				return 'Propertylist';
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
	
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
