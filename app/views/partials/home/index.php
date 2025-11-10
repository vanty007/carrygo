        <template id="Home">
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

		<div class="container winners-section" v-if="newsflash.length" >
			<div class="winners-title">Latest Winners</div>
			<div class="winners-slider">
				<div class="winner-card" v-for="(data,index) in newsflash">
					<div>{{maskedPhoneNumber(data.msisdn)}} won</div>
					<h4>{{truncateName(data.name)}}</h4>
					<div>with total points {{data.bid_winner_points}}</div>
					<small>{{ timeAgo(data.created_at) }}</small>
				</div>
			</div>
		</div>
<div class="fs-container">
	<div class="container content">
		<div class="fs-content">

		<section class="listings-container margin-top-30">

							<div class="sort-by" data-select2-id="select2-data-5-o4c5" style="margin-right:30px">
								<div class="sort-by-select">
									<select @change="dosearch2()" id="what_property" >
										<option selected="selected" value="all" data-select2-id="select2-data-3-sk3e">All Category</option>
										<option value="Gadgets & Accessories">Gadgets & Accessories</option>
										<option value="Appliances">Appliances</option>
										<option value="Electronics">Electronics</option>
										<option value="Health & Beauty">Health & Beauty</option>
										<option value="Home & Office">Home & Office</option>
										<option value="Fashion">Fashion</option>
										<option value="Computing">Computing</option>
										<option value="Musical Instrument">Musical Instrument</option>
										<option value="Gaming">Gaming</option>
									</select>
								</div>
							</div>	

			<h2 style="text-align: center;">Bid Items</h2>
								
				</br>
					<div class="row fs-listings">
                        <div v-if="searchfield" class="col-sm-5 comp-grid input-group mb-3" :class="setGridSize">
                            <input @keyup.enter="dosearch()" id="where_property" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" />
							<button class="btn btn-primary" type="button" id="button-addon2" @click="dosearch()">Search</button>
                        </div>

						<div id="listeo-listings-container" class=" compact-layout row" v-if="items.length">
							<div class="loader-ajax-container" >
								<div class="loader-ajax"></div>
							</div>
							<!-- Listing Item -->

							<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" v-for="(data,index) in items">
									<div  class="listing-item-container listing-geo-data compact" :data-image="data.image">
										<div class="listing-item  featured-listing" @click="showpop(data.image)">
											<div class="listing-small-badges-container" style="float:left;width:250px">
												<div class="listing-small-badge featured-badge" v-if="data.bid_active_points === null"><i class="fa fa-tag" style="color:white;background-color:red;"></i>{{data.open_points}} Points to Unlock</div>
												<div class="listing-small-badge featured-badge" v-if="data.bid_active_points !== null"><i class="fa fa-tag" style="color:white;background-color:green;"></i>{{data.bid_entry_points-data.open_points}} Points to Win</div>
												<div class="listing-small-badge featured-badge" v-if="data.bid_entry_points !== null"><i class="fa fa-tag" style="color:white;background-color:green;"></i>{{data.bid_entry_points}} Bidded Points</div>
											</div>
											<img  :src="data.image" alt="Sunny Apartment" class="listing-thumbnail" data-toggle="modal" data-target="#openBidModal">
											<div class="listing-item-content">
												<div class="numerical-rating high" :data-rating="data.rating"><i class="fa fa-star"></i></div>
												<span class="tag" style="width: 100px"><a :href="data.url" target="_blank" style="color:white;">Item Link</a></span>
											</div>
											
										</div>
										</br>
										<div class="listing-small-badge" style="padding-left: 8px;background-color:transparent;border-radius:0px;font-size:16px;"><router-link style="text-decoration:none;" :to="'/bid/view/' +  data.id">{{data.name}}</router-link> 
											<div class="listing-small-badge pricing-badge"><i class="fa fa-money"></i>&#8358;{{data.price}}</div>
										</div>
										</br></br></br>
										<center><button data-toggle="modal" data-target="#openBidModal"  @click="setBidid(data.id,data.open_points,data.open_date)" class="button border margin-top-5" type="button">Bid</button></center>

									</div>
								
							</div>
						</div>					
					</div>
					<div v-if="!items.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
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

				<div id="myForm" class="panel panel-info chat1 chat-popup" style="margin-bottom:0px;border-radius: 15px;max-width:350px;width:100%;">
					<div class="panel-heading" style="border-radius: 15px 15px 0 0; background-color: #17a2b8; color: white;">
						<div class="row mb-4">
							<!--<div class="col-xs-2">
					  			<a style="cursor: pointer;color:#fff;" onclick="closeForm()"><i class="glyphicon glyphicon-chevron-left" ></i></a>
							</div>-->
							<div class="col-xs-8" style="width:67%;">
								<!--<p class="panel-title" style="font-weight: bold; margin: 0;">Promotional Offers</p>-->
								<p class="panel-title" style="font-weight: bold; margin: 0;">⚠️ Important Notice!</p>
							</div>
							<div class="col-xs-4" style="width:33%;text-align:right;">
								<a style="cursor: pointer;color:#fff;" onclick="closeForm()"><i class="glyphicon glyphicon-remove" ></i></a>
							</div>
						</div>
					</div>
					<div class="panel-body">
		  
					  <!--<div class="row">
						<div class="col-xs-12">
							<img src="asset/images/offers.jpg" alt="avatar 1" class="img-circle" style="justify-content: center;align-items: center;border-radius: 50px;width: 250px;height: 250px;margin: 0 auto;overflow: hidden;object-fit: fill;display: block;margin: auto;">
						</div>
					  </div>-->
					  <!--<div class="row">
						<div class="col-xs-12" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2); padding: 15px;">
							<article class="promo-card" role="region" aria-label="Subscribe and Win Promotion">
								<div style="font-size:12px;" class="badge">🎉 Don't Miss Out!</div>
								<h3>Subscribe & Stand a Chance to WIN Airtime!</h3>
								<p class="lead">Subscribe to M-Health by dialing the USSD code below and you could qualify to get N1,000 Airtime. The more you stay subscribed, the greater your chance to win!</p>

								<div>
								<a class="cta" href="tel:*20570#">Subscribe Now — Dial *20790#</a>
								</div>

								<p class="note">T&Cs apply. Winners will be announced via SMS and our official channels.</p>
							</article>
						</div>
					  </div>-->
						<div class="row">
						<div class="col-xs-12" style="border-radius: 15px; background-color: rgba(57, 192, 237, .2); padding: 15px;">
							<article class="promo-card" role="region" aria-label="Bid Points Expiry Notice">
							<h3>Utilize Your Carrygo Bid Points Before December Ends!</h3>
							<p class="lead">
								Dear CarryGo users, please ensure you use your available bid points before the end of <strong>December</strong>.  
								After this month, <strong>all unused bid points will be cleared from the system</strong>.
							</p>

							<div>
								<a class="cta" href="#" style="pointer-events: none; cursor: default; opacity: 0.7;">Use Your Points Now</a>
							</div>

							<p class="note">Don’t miss out — bid early and make your points count!</p>
							</article>
						</div>
						</div>
		  
					</div>
				</div>
    </div>
        </template>
        <script>
			var HomeComponent = Vue.component('HomeComponent', {
				template : '#Home',
				mixins: [ListPageMixin, AddPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'home',
			},
			routename : {
				type : String,
				default : 'home',
			},
			apipath : {
				type : String,
				default : 'home/index',
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
				items: [],
				intervals: [],
				newsflash:[],
				modalimage:''
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
			},
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
							this.items = data.records;
							this.newsflash = data.records3;
							
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
			setBidid(id,open_points,open_date) {
				this.user.bidid = id;
				this.user.open_date = open_date;
				this.user.open_points = open_points;
			},
			addtoFavourite : function(id){
						var apiurl = setApiUrl('components/addtoFavourite/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							//window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
			removetoFavourite : function(id){
						var apiurl = setApiUrl('components/removetoFavourite/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							//window.location.href = response.body;
							location.reload();
						},
						function (response) {
							console.log(response)
						});
					},
					showpop: function(img){ 
					//alert(img)
					this.modalimage = img
					$('#openPicsModal').modal();
        			},
        timeAgo(dateString) {
          const now = new Date();
          const past = new Date(dateString.replace(" ", "T"));
          const diff = now - past;

          const seconds = Math.floor(diff / 1000);
          const minutes = Math.floor(seconds / 60);
          const hours = Math.floor(minutes / 60);
          const days = Math.floor(hours / 24);

          if (days > 0) return `${days} day${days > 1 ? 's' : ''} ago`;
          if (hours > 0) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
          if (minutes > 0) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
          return `${seconds} second${seconds > 1 ? 's' : ''} ago`;
        },
		truncateName(name) {
		// Remove extra quotes, handle undefined, then truncate
		if (!name) return "";
		name = name.replace(/^['"]|['"]$/g, "");
		return name.length > 11 ? name.substring(0, 11) + "..." : name;
		},
		},
      mounted() {
        // Refresh every minute so "time ago" stays accurate
        setInterval(() => this.$forceUpdate(), 60000);
      }
	});
	</script>
