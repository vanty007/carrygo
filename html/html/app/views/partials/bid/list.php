        <template id="bidList">
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

						<li><a href="#">Home</a></li>
						<!--<li onclick="fpropertysearch()"><a style="cursor: pointer;" class="current">More Homes</a></li>
						<li onclick="fmyreservation()"><a style="cursor: pointer;">My Reservation</a></li>
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
						<div class="user-name"><span><img src="libb/assets/images/avatar_user.png" alt=""></span>My Points {{points}}</div>
						<ul v-if="points == 0">
							<li onclick="fmyreservation()"><a style="cursor: pointer;" ><i class="sl sl-icon-wallet"></i> Get Points / Login</a></li>
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

<!-- Content
================================================== -->
<div class="fs-container">

	<div class="container content">
		<div class="fs-content">

		<section class="listings-container margin-top-30">
		<!--<textarea  id="getListDate" cols="40" rows="9" class="search-field" type="hidden" :value="test"></textarea>-->
		<input type="hidden" id="getListDate" />
			<!-- Sorting / Layout Switcher -->
				<div class="row fs-switcher">

					<div class="col-md-6">
						<!-- Showing Results -->
						<p class="showing-results">{{records.length}} Results Found </p>
					</div>

				</div>

				<div class="row fs-listings"  v-if="records.length">
					<div class="col-lg-12 col-md-12" v-for="(data,index) in records">
						<div class="listing-item-container list-layout" v-if="data.bid_winner_points === null">
							<div class="listing-item">
								<!-- / -->
								<!-- Image -->
								<div class="listing-item-image">
									<img :src="data.image" alt="">
									<span class="tag">Bidding Points {{data.open_points}}</span>
								</div>
								
								<!-- Content -->
								<div class="listing-item-content">
									<div class="listing-badge now-open"  v-if="data.bid_active_points !== null">Open</div>
									<div class="listing-badge now-close"  v-if="data.bid_active_points === null">Closed</div>

									<div class="listing-item-inner">
										<h3>{{data.name}}<i class="verified-icon"></i></h3>
										<span>Item Price: &#8358;{{data.price}}</span>
										<div><a :href="data.url" target="_blank">Item Website Link</a></div>
										<h4 v-if="data.bid_entry_points !== null">Total Bid Points {{data.bid_entry_points}}</h4>
										
										<!--<div v-if="data.avg_of_rate === null" class="star-rating" data-rating="1">({{data.count_of_review}} reviews)</div>
										<div v-if="data.avg_of_rate !== null" class="star-rating" :data-rating="data.avg_of_rate">({{data.count_of_review}} reviews)</div>
											<div v-if="data.invalidfrom != ''" class="btnCheckAvailabilitySearch"></div>
											<div v-if="data.invalidfrom != ''"  @click="setInvalidDate(data.invalidfrom)" class="call-btn rating-counter">Availability: {{data.invalidto.split(",")[0]}} <i class="call-btn fa fa-calendar-check-o"></i></div>
											<div v-if="data.invalidfrom == ''" class="rating-counter">Availability: Available Anytime<i class="verified-icon"></i></div>-->
											
										
									</div>

									<!--<span v-if="data.f_id === null && data.f_id !== -1" @click="addtoFavourite(data.id)" class="like-icon"></span>
									<span v-if="data.f_id !== null && data.f_id !== -1" @click="removetoFavourite(data.f_id)" style="color:white;background-color:red;" class="like-icon"></span>-->
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

		</section>

		</div>
	</div>
</div>



</div>
<!-- Wrapper / End -->


    </div>
        </template>
        <script>
			var BidListComponent = Vue.component('bidList', {
				template : '#bidList',
				mixins: [ListPageMixin],
				props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'bid',
			},
			routename : {
				type : String,
				default : 'bidlist',
			},
			apipath : {
				type : String,
				default : 'bid/list',
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
				points: '',
				msisdn:''
			}
		},
		computed : {
			pageTitle: function(){
				return 'bidlist';
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
						if(data && data.records.bid_info){
							this.totalrecords = data.total_records ;
							if(this.pagelimit  > data.records.bid_info.length){
								this.loadcompleted = true;
							}
							this.points = data.records.user_points;
							this.records = data.records.bid_info;
							//foo();
							
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
			login : function(e){
						var payload = this.user;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/login');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
						},
						function (response) {
							this.loading = false;
							this.showError = false
							this.errorMsg = response.statusText;
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					},
					register : function(e){
						var payload = this.data;
						this.loading = true;
						var self = this;
						var apiurl = setApiUrl('index/register');
						this.$http.post( apiurl , payload , {emulateJSON:true} ).then(function (response) {
							self.loading = false;
							window.location = response.body;
						},
						function (response) {
							this.loading = false;
							this.showError = false
							this.errorMsg = response.statusText;
							//Flashes messages
							setTimeout(function(){
								self.showError = true;
							}, 100);
						});
					},
			myBooking(view) {
				window.location.href = '#/propertylist/view/'+view;
				location.reload();
			},
			setInvalidDate(id) {
				//console.log(id);
				this.txtCheckAvailabilitySearch = id;
			},
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
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
