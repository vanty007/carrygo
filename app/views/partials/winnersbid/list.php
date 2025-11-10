        <template id="winnersbidList">
		<div>
    
	<div id="wrapper">
		<div id="openReviewModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Rate this Bid</h4>
					<button type="button" class="close" style="margin-top:-25px;" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="display: grid;justify-content: center;align-items: center;">
					<div class="container">
					<ul class="card-meta list-inline">
						<li class="list-inline-item">
						<i v-for="(star, index) in 5" :key="index"
							class="fa fa-star list-inline-item"
							:style="{color: index < selectedStars ? 'gold' : '#ccc',fontSize: '40px' }"
							@click="toggleStar(index)">
						</i>
						</li>
					</ul>
					<p>
					<textarea  name="notes" cols="25" rows="3" v-model="reviewcomment" data-vv-as="notes" type="text"></textarea>
					</br>
					<button @click="sendReview()" class="btn btn-primary" type="submit">Submit<i class="fa fa-send"></i></button>                               
					</div>
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
			<h2 style="text-align: center;">History of Bids Won</h2>




							<div class="row fs-listings">
								<div id="listeo-listings-container" class=" compact-layout row" v-if="records.length">
									<div class="loader-ajax-container" >
										<div class="loader-ajax"></div>
									</div>
									<!-- Listing Item -->
									<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" v-for="(data,index) in records">
											<div v-if="data.bid_entry_points !== null"  class="listing-item-container listing-geo-data compact" :data-image="data.image">
												<div class="listing-item  featured-listing" @click="showpop(data.image)">
													<div class="listing-small-badges-container" style="float:left;width:250px">
														<div class="listing-small-badge featured-badge" v-if="data.bid_active_points !== null"><i class="fa fa-tag" style="color:white;background-color:green;"></i>{{data.bid_entry_points}} Points Bidded</div>
													</div>
													<img  :src="data.image" alt="Sunny Apartment" class="listing-thumbnail" data-toggle="modal" data-target="#openBidModal">
													<div class="listing-item-content">
														<div class="numerical-rating high" :data-rating="data.rating"><i class="fa fa-star"></i></div>
														<span class="tag" style="width: 100px"><a :href="data.url" target="_blank" style="color:white;">Item Link</a></span>
													</div>
													
												</div>
												</br>
												<div class="listing-small-badge" style="padding-left: 8px;background-color:transparent;border-radius:0px;font-size:16px;"><router-link style="text-decoration:none;" :to="'/bid/view/' +  data.id">{{data.name}}</router-link> 
													
												</div>
												</br></br></br></br>
												<div class="listing-small-badge pricing-badge"><i class="fa fa-money"></i>&#8358;{{data.price}}</div>
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i><strong>won by {{maskedPhoneNumber(data.msisdn)}}</strong></div>

												</br></br>
												<center><button data-toggle="modal" data-target="#openReviewModal"  @click="setBidid(data.id,data.open_points,data.open_date)" class="button border margin-top-5" type="button">Send Review</button></center>
											
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
				reviewcomment:'',reviewid:'',selectedStars: 0
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
          toggleStar(index) {
          if (this.selectedStars === index + 1) {
            this.selectedStars = 0;
          } else {
            this.selectedStars = index + 1;
          }
        },
        sendReview : function(){
						//var payload = this.message;
            console.log(this.reviewid +" "+this.reviewcomment+" "+this.selectedStars)
            if(!this.user.bidid || !this.reviewcomment || this.selectedStars==0){
              alert("Please fill up the review and rating items")
            }
          else{
                  var payload_json = '{"rating": "'+this.selectedStars+'","comment": "'+this.reviewcomment+'","bidid": "'+this.user.bidid+'"}';
                  console.log(payload_json)
						this.loading1 = true;
						var self = this;
						var apiurl = setApiUrl('components/addReview');
						this.$http.post( apiurl , payload_json ).then(function (response) {
							console.log(response)
              				//this.load()
							$('#openReviewModal').modal("hide");
						},
						function (response) {
							console.log(response)
              				$('#openReviewModal').modal("hide");
							//Flashes messages
							setTimeout(function(){
								self.showError = false;
							}, 100);
						});
					}
        },
			setBidid(id,open_points,open_date) {
				this.user.bidid = id;
				this.user.open_date = open_date;
				this.user.open_points = open_points;
			},
	
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
