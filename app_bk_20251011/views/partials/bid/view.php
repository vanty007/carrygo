<template id="bidView">
	<div>
		<div id="wrapper">
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
						<h2 style="text-align: center;">Bid Items</h2>

						<div class="row fs-listings"  v-if="items.length">
							<div class="col-lg-12 col-md-12" v-for="(data,index) in items">
										<h3 style="text-align: center;color:#0047AB" v-if="timeLeft <= 0"></h3>
										<h3 style="text-align: center;color:#0047AB" v-else-if="timeLeft > 0">Time Left: {{ formattedTime }}</h3>
										<h3 style="text-align: center;color:#0047AB" v-else>Countdown finished!</h3>
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
										<div class="listing-badge now-closed" v-if="data.bid_active_points === null" style="color:white;background-color:green;">Bid Active</div>
										<div class="listing-badge now-closed" v-if="data.bid_active_points !== null && data.bid_winner_points === null" style="color:white;background-color:green;">Bid Open</div>
										<div class="listing-badge now-closed" v-if="data.bid_active_points !== null && data.bid_winner_points !== null" style="color:red;background-color:#000;">Bid Closed</div>
										<div class="listing-item-inner">
											<h3><router-link style="text-decoration:none;" :to="'/bid/view/' +  data.id">{{data.name}}</router-link></h3>
											
											<div class="listing-list-small-badges-container">
												<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>&#8358;{{data.price}}</div>
												<div class="listing-small-badge shop-badge"><i class="fa fa-store"></i> Bid Points {{data.open_points}}</div>

												<div v-if="data.bid_active_points === null"  class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>Bid Active</div>
												<div  v-if="data.bid_active_points !== null && data.bid_winner_points === null" class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>Bid Open</div>
												<div style="color:red;" v-if="data.bid_active_points !== null && data.bid_winner_points !== null" class="listing-small-badge pricing-badge"><i style="color:red;background-color:white;" class="fa fa-tag"></i>Bid Closed</div>
											</div>
											<span v-if="data.bid_entry_points !== null">({{data.bid_entry_points}} Bidded Points)</span>
											
										</div>
												<span v-if="data.bid_winner_points === null" style="color:white;background-color:white;position: absolute;z-index: 101;right: 30px;bottom: 5px;cursor: normal;display: block;height: 44px;width: 44px;transition: all 0.4s;" >
												<h2 style="color:grey;"><button data-toggle="modal" data-target="#openBidModal" @click="setBidid(data.id,data.open_points,data.open_date)" class="button border margin-top-5" type="button">Bid</button></h2></span>

										
									</div>
								</div>
								</div>


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
	var BidViewComponent = Vue.component('bidView', {
		template : '#bidView',
		mixins: [ListPageMixin2],
		props: {
            limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename: {
				type : String,
				default : 'bid',
			},
			routename : {
				type : String,
				default : 'bidview',
			},
			apipath: {
				type : String,
				default : 'bid/view',
			},
		},
		data: function() {
			return {
                user : {points : '',msisdn : '',bidid:'',open_date:'',open_points:''},
                items: [],
				intervals: [],
				timeLeft: 0, 
				timer: null,
			}
		},
		computed : {
			pageTitle: function(){
				return 'Propertylist';
			},
			filterGroupChange: function(){
				return ;
			},
			formattedTime() {
			const hours = Math.floor(this.timeLeft / 3600);
			const minutes = Math.floor((this.timeLeft % 3600) / 60);
			const seconds = this.timeLeft % 60;
			return `${String(hours).padStart(2, '0')}:
					${String(minutes).padStart(2, '0')}:
					${String(seconds).padStart(2, '0')}`;
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
			},
		},
		methods :{
			startCountdown(hours) {
			this.clearTimer();
			this.timeLeft = hours * 3600;
			//this.timeLeft = hours * 60;
			//console.log("timer: "+this.timeLeft)
			this.timer = setInterval(() => {
				if (this.timeLeft > 0) {
				this.timeLeft--;
				//console.log("timer2: "+this.timeLeft)
				if(this.timeLeft == 0) {
				alert("The Bidding time has expired");
				location.reload();
				}
				} else {
				this.clearTimer();
	
				}
			}, 1000);
			},
			clearTimer() {
			if (this.timer) {
				clearInterval(this.timer);
				this.timer = null;
				//location.reload();
			}
			},
			load:function(){
				this.records = [];
				if (this.loading == false){
					this.ready = false;
					this.loading = true;
					var url = this.apiUrl+'/'+this.id;
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
							this.startCountdown(data.records2.timer)
							
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
		},
  beforeUnmount() {
    this.clearTimer();
  }
	});
	</script>
