<template id="profileView">
    <div>
        	</br></br></br>
			<div id="openReviewModal" class="modal fade" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
              <h4 class="modal-title">Rate this Pick Up</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
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
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class=" col-lg-8 mb-5 mb-lg-0">
                        </br></br></br>
                        <div class="widget">
                                <h4 class="widget-title">Pick Up Details</h4>
                                <article>
                                    <img class="card-img-sm" :src="data.picture" style="justify-content: center;align-items: center;border-radius: 50px;width: 400px;height: 350px;margin: 0 auto;overflow: hidden;object-fit: fill;display: block;margin: auto;">
                                    <div class="card-body">
                                        <h3 class="mb-3"><a class="post-title">{{data.item_name}}</a></h3>
                                        <i class="fa fa-solid fa-calendar"></i> {{data.created_at}}</br>
                                        <i class="fa fa-solid fa-map-marker" style="color:#077A07"></i>{{data.pickup_address}}, {{data.pickup_city}}, {{data.pickup_state}}
                                        <div>|</div>
                                        <i class="fa fa-flag" style="color:#B50202"></i>{{data.receiver_address}}, {{data.receiver_city}}, {{data.receiver_state}}
                                        <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a class="card-meta-author" v-if="data.driver_id == null">
                                            <span><i class="fa fa-user"></i> Rider Pending</span>
                                            </a>
                                            <a href="author-single.html" class="card-meta-author" v-if="data.driver_id != null">
                                            <span><i class="fa fa-user"></i> {{data.firstname}} {{data.lastname}}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item" v-if="data.driver_id != null">
                                            <i class="fa fa-phone" style="font-size:14px;color:#077A07"></i><a :href="'tel: '+ data.phoneno"> {{data.phoneno}}</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="fa fa-road"></i>{{data.distance}} KM
                                        </li>
                                        </ul>
                                        <p>{{data.notes}}</p>
                                        <?php
                                        if(ROLE_ID=="user" ){
		                                ?>
                                        <li class="list-inline-item"><i class="fa fa-road"></i>{{data.distance}} KM</li>
                                            <ul class="card-meta-tag list-inline" v-if="data.pickup_status == 0 && data.driver_id == null">
                                            <li class="list-inline-item" style="color:red;">Processing</li>
                                            <li @click="cancelPickup(data.records.id)" class="list-inline-item"><a>Cancel Pick Up <i class="fa fa-ban"></i></a></li>
                                            </ul>
                                            <ul class="card-meta-tag list-inline" v-if="data.payment_status == 0 && data.payments == false && data.driver_id != null">
                                            <li class="list-inline-item" style="color:red;">Pending Payment</li>
                                            <!--<li class="list-inline-item" @click="showPopOpenPaymentModal(data)"><a>Make Payment <i class="fa fa-money-bill"></i></a></li>-->
                                            </ul>
                                            <ul class="card-meta-tag list-inline" v-if="data.pickup_status == 1">
                                            <li class="list-inline-item" style="color:red;">Pending Pick Up</li>
                                            </ul>
                                            <ul class="card-meta-tag list-inline" v-if="data.pickup_status == 2">
                                            <li class="list-inline-item" style="color:red;">In Transit</li>
                                            </ul>
                                            <ul class="card-meta-tag list-inline" v-if="data.pickup_status == 3 && data.rate == 0">
                                            <li class="list-inline-item" style="color:red;">Delivered</li>
                                            <li class="list-inline-item" @click="showPopOpenReviewModal(data.id)"><a> Rate Delivery <i class="fa fa-star"></i></a></li>
                                            </ul>
                                            <ul class="card-meta-tag list-inline" v-if="data.pickup_status == 3 && data.rate != 0">
                                            	<li class="list-inline-item" style="color:red;">Delivered</li>
												<li class="list-inline-item">
													<i v-for="(star, index) in data.rate" :key="index"
														class="fa fa-star list-inline-item"
														:style="{color: 'gold',fontSize: '20px' }">
													</i>
												</li>  
											</ul>
                                        </li>
                                        <?php } else {?>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                <li class="list-inline-item" v-if="data.pickup_status == 0" style="color:red;">Pick Up Assigned</li>
                                                <li class="list-inline-item" v-if="data.pickup_status == 0" @click="acceptPickup(data.id)"><a>Accept <i style="color:green;" class="fa fa-check"></i></a></li>
                                                <li class="list-inline-item" v-if="data.pickup_status == 0" @click="rejectPickup(data.id)"><a>Reject <i style="color:red;" class="fa fa-times"></i></a></li>
                                                
                                                <li class="list-inline-item" v-if="data.pickup_status == 1" style="color:red;">Pickup Accepted</li>
                                                <li class="list-inline-item" v-if="data.pickup_status == 1" @click="startPickup(data.id)"><a>Start Journey<i style="color:green;" class="fa fa-shopping-basket"></i></a></li>
                                                <li class="list-inline-item" v-if="data.pickup_status == 1 && data.payment_status == 0" @click="confirmPayment(data.id)"><a>Confirm Payment<i style="color:green;" class="fa fa-money"></i></a></li>
												<ul class="card-meta-tag list-inline" v-if="data.pickup_status == 3 && data.rate == 0">
													<li class="list-inline-item" style="color:red;">Delivered</li>
												</ul>
												<ul class="card-meta-tag list-inline" v-if="data.pickup_status == 3 && data.rate != 0">
													<li class="list-inline-item" style="color:red;">Delivered</li>
													<li class="list-inline-item">
														<i v-for="(star, index) in data.rate" :key="index"
															class="fa fa-star list-inline-item"
															:style="{color: 'gold',fontSize: '20px' }">
														</i>
													</li>  
												</ul>		
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </div>
                                </article>
                        </div>
                    </div>
                    <aside class="col-lg-4 @@sidebar">
                        </br></br></br>
                        <div class="widget">
                        <h4 class="widget-title" v-if="records.length">Recent Pick Up Requests</h4>
                        <!-- post-item -->
                        <article class="widget-card"  v-for="(data1,index) in records">
                            <div class="d-flex">
                                <img class="card-img-sm" :src="data1.picture">
                                <div class="ml-3">
                                    <h5><router-link  title="View Record" :to="'/pickup_request/view/' + data1.id">{{data1.item_name}}</router-link></h5>
                                    <i class="fa fa-flag" style="color:#B50202"></i>{{data1.receiver_address}}, {{data1.receiver_city}}, {{data1.receiver_state}}
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a class="card-meta-author" v-if="data1.pickup_status == 0 && data1.driver_id == null">
                                            <span><i class="fa fa-user"></i> Rider Pending</span>
                                            </a>
                                            <a class="card-meta-author" v-if="data1.pickup_status == 0 && data1.driver_id != null">
                                            <span><i class="fa fa-user"></i> Rider Pending</span>
                                            </a>
                                            <a href="author-single.html" class="card-meta-author" v-if="data1.pickup_status == 1 && data1.driver_id != null">
                                            <span><i class="fa fa-user"></i> {{data1.firstname}} {{data1.lastname}} to begin Delivery</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </div>

</template>
    <script>
	var ProfileViewComponent = Vue.component('profileView', {
		template : '#profileView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'profileView',
			},
			routename : {
				type : String,
				default : 'profileView',
			},
			apipath: {
				type : String,
				default : 'pickup_request/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
                    id:'' ,item_name:'',category:'' ,tracking_id:'' ,pickup_userid:'' ,distance:'',receiver_userid:'' ,receiver_name:'' ,receiver_phoneno:'' ,
                    receiver_email:'' ,driver_id:'' ,pickup_address:'' ,pickup_state:'' ,pickup_city:'' ,receiver_address:'' ,receiver_city:'' ,
		            receiver_state:'' ,picture:'' ,pickup_code:'' ,delivery_option_id:'' ,totalamount:'' ,created_at:'' ,delivery_status:'' ,pickup_status:'' ,
                    payment_status:'',email:'',phoneno:'',role_id:'',firstname:'',lastname:'',profile_pics:'',items:'', delivery_category:'',delivery_option:'',
		            pricing_per_km:'', pricing_higher_km:'',delivery_amount:''
					},
				},
                records:[],
				reviewcomment:'',reviewid:'',selectedStars: 0
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Pickup Request';
			},
		},
		methods :{
		load : function(){
			this.resetData();
			this.loading = true;
			this.showError = false;
			this.ready = false;
            this.records = [];
			this.$http.get(this.apiUrl).then(function (response) {
				this.loading = false;
				this.ready = true;
				if(response.body){
					this.data = response.body.data;
                    this.records = response.body.records;
				}
				else{
					this.$root.$emit('requestError' , response);
				}
				
			},
			function (response) {
				this.loading = false;
				this.$root.$emit('requestError' , response);
			});
		},
        rejectPickup : function(id){
						var apiurl = setApiUrl('components/rejectPickup/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					acceptPickup : function(id){
						var apiurl = setApiUrl('components/acceptPickup/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					startPickup : function(id){
						var apiurl = setApiUrl('components/startPickup/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
          setPaymentInfo : function(val){
            console.log(val)
						this.paymentsinfo=val;
            $('#openPaymentInfoModal').modal();
					},
					confirmPayment : function(id){
						var apiurl = setApiUrl('components/confirmPayment/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
              //$('#openPaymentInfoModal').modal("hide");
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					driverStatus : function(id){
						var apiurl = setApiUrl('components/driverStatus/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					endPickup : function(id){
						var apiurl = setApiUrl('components/endPickup/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					cancelPickup : function(id){
						var apiurl = setApiUrl('components/cancelPickup/'+id);
						this.$http.get( apiurl).then(function (response) {
							console.log(response)
							this.load()
						},
						function (response) {
							console.log(response)
						});
					},
					showPopOpenReviewModal: function(id){ 
					//alert(img)
					//this.modalimage = img
					this.reviewid = id;
					//this.user.payer = "requester";
					$('#openReviewModal').modal();
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
            if(!this.reviewid || !this.reviewcomment || this.selectedStars==0){
              alert("Please fill up the review and rating items")
            }
            else{
                  var payload_json = '{"review": "'+this.reviewcomment+'","rate": "'+this.selectedStars+'"}';
                  console.log(payload_json)
						this.loading1 = true;
						var self = this;
						var apiurl = setApiUrl('Pickup_request/edit/'+this.reviewid);
						this.$http.post( apiurl , payload_json ).then(function (response) {
							console.log(response)
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
			resetData : function(){
				this.data = {
					id:'' ,item_name:'',category:'' ,tracking_id:'' ,pickup_userid:'' ,distance:'',receiver_userid:'' ,receiver_name:'' ,receiver_phoneno:'' ,
                    receiver_email:'' ,driver_id:'' ,pickup_address:'' ,pickup_state:'' ,pickup_city:'' ,receiver_address:'' ,receiver_city:'' ,
		            receiver_state:'' ,picture:'' ,pickup_code:'' ,delivery_option_id:'' ,totalamount:'' ,created_at:'' ,delivery_status:'' ,pickup_status:'' ,
                    payment_status:'',email:'',phoneno:'',role_id:'',firstname:'',lastname:'',profile_pics:'',items:'', delivery_category:'',delivery_option:'',
		            pricing_per_km:'', pricing_higher_km:'',delivery_amount:'',
				}
			},

		},
	});
	</script>
