        <template id="mybidsList">
		<div>
    
	<div id="wrapper">

<header id="header-container">

<!-- Header -->
<div id="header">
   <div class="container">
	   
	   <!-- Left Side Content -->
	   <div class="left-side">
		   
		   <!-- Logo -->
		   <div id="logo">
			   <a style="cursor: pointer;" href="#"><img src="libb/assets/images/logo.png" alt=""></a>
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

						<li onclick="fhome()"><a style="cursor: pointer;">Home</a></li>
						<li onclick="ftrendingitems()"><a style="cursor: pointer;">Trending Items</a></li>
						<li onclick="fopenbids()"  class="current"><a style="cursor: pointer;">Open Bids</a></li>
						<!--<li onclick="fmyreservation()"><a style="cursor: pointer;">My Reservation</a></li>
						<li><a style="cursor: pointer;" href="info/contact">Contact</a></li>
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
						<div class="user-name"><span><img src="libb/assets/images/avatar_user.png" alt=""></span>My Points {{user.points}}</div>
						<ul >
						<li v-if="user.points == 0"><a style="cursor: pointer;" ><i class="sl sl-icon-user"></i> Get Points / Login</a></li>
						<li v-if="user.points != 0" onclick="fmybids()"><a style="cursor: pointer;"><i class="sl sl-icon-wallet"></i>My Bids</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Right Side Content / End -->
			<!-- Sign In Popup -->

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

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->

<!-- Content
================================================== -->
<div class="fs-container">
	<h2 style="text-align: center;">My Bids</h2>

	<div class="container content">
		<div class="fs-content">


		<section class="listings-container margin-top-30">
		<!--<textarea  id="getListDate" cols="40" rows="9" class="search-field" type="hidden" :value="test"></textarea>-->
		<!-- <input type="hidden" id="getListDate" />
			Sorting / Layout Switcher 
				<div class="row fs-switcher">

					<div class="col-md-6">
						<p class="showing-results">{{records.length}} Results Found </p>
					</div>

				</div>-->

				<div class="row fs-listings"  v-if="records.length">
					<!--<button type="button" class="btn btn-info btn-lg" id="openBidbtn">Open Modal</button>-->
					<div class="row margin-bottom-25">
						<div class="col-md-3">
							<div class="fullwidth-filters ajax-search">
								<!-- Sort by -->
								<div class="sort-by">
									<div class="sort-by-select">

									<!--<select @change="dosearch()" v-model="searchtext" name="searchtext" class="select2-sortby orderby select2-hidden-accessible"  data-select2-id="select2-data-1-bucr" tabindex="-1" aria-hidden="true">-->
										<!--ect @change="dosearch2()" id="what_property" form="listeo_core-search-form" data-placeholder="Default order" class="select2-sortby orderby select2-hidden-accessible" data-select2-id="select2-data-1-bucr" tabindex="-1" aria-hidden="true">
										<option selected="selected" value="date-desc" data-select2-id="select2-data-3-sk3e">All Category</option>
										<option value="Gadgets & Accessories">Gadgets & Accessories</option>
										<option value="Appliances">Appliances</option>
										<option value="Electronics">Electronics</option>
										<option value="Health & Beauty">Health & Beauty</option>
										<option value="Home & Office">Home & Office</option>
										<option value="Electronics">Fashion</option>
										<option value="Computing">Computing</option>
										<option value="Musical Instrument">Musical Instrument</option>
										<option value="Gaming">Gaming</option>
									</select>-->
									
									</div>
								</div>
								<!-- Sort by / End -->
							</div>
						</div>
					</div>
   
					<div class="col-lg-12 col-md-12" v-for="(data,index) in records">
						<div class="listing-item-container list-layout">
							<div class="listing-item">
								<!-- / -->
								<!-- Image -->
								<div class="listing-item-image">
									<img :src="data.image" alt="">
									<span class="tag"><a :href="data.url" target="_blank" style="color:white;">Website Link</a></span>
								</div>
								
								<!-- Content -->
								<div class="listing-item-content">
									<div class="listing-badge now-open">Active</div>

									<div class="listing-item-inner">
										<h3>{{data.name}}<i class="verified-icon"></i></h3>
										<span>Item Price: &#8358;{{data.price}}</span>
										<h4><a :href="data.url" target="_blank">Opening Points:{{data.open_points}}</a></h4>
										<h4 v-if="data.bid_entry_points !== null">Bidded Point {{data.points}}</h4>
										
										<!--<div v-if="data.avg_of_rate === null" class="star-rating" data-rating="1">({{data.count_of_review}} reviews)</div>
										<div v-if="data.avg_of_rate !== null" class="star-rating" :data-rating="data.avg_of_rate">({{data.count_of_review}} reviews)</div>
											<div v-if="data.invalidfrom != ''" class="btnCheckAvailabilitySearch"></div>
											<div v-if="data.invalidfrom != ''"  @click="setInvalidDate(data.invalidfrom)" class="call-btn rating-counter">Availability: {{data.invalidto.split(",")[0]}} <i class="call-btn fa fa-calendar-check-o"></i></div>
											<div v-if="data.invalidfrom == ''" class="rating-counter">Availability: Available Anytime<i class="verified-icon"></i></div>-->
											
										
									</div>
	
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
			var MybidsListComponent = Vue.component('mybidsList', {
				template : '#mybidsList',
				mixins: [ListPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'mybids',
			},
			routename : {
				type : String,
				default : 'mybids',
			},
			apipath : {
				type : String,
				default : 'mybids/list',
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
			postbid_info : function(e){
						var payload = this.user;
						console.log(payload)
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('home/postbid_info');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							alert('You have successfully bidded')
							window.location = response.body;
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
		}
	});
	</script>
