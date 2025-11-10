    <template id="propertysearchList">
    <div>
    
    <div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="#"><img src="libb/assets/images/logo.png" alt=""></a>
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
					<ul id="responsive">

                        <li ><a id="home" href="#">Home</a></li>
						<li ><a id="propertysearch" class="current" href="#propertysearch">More Homes</a></li>
						<li><a id="myreservation" href="#myreservation">My Reservation</a></li>
						<li><a href="info/contact">Contact</a></li>
						<li><a href="#account/edit">Profile</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->

			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
                <?php
					if(user_login_status() == true){
						?>
					<div class="user-menu">
						<div class="user-name"><span><img src=" <?php echo USER_PHOTO ?>" alt=""></span>Hi, <?php echo FIRST_NAME ?>!</div>
						<ul>
							<li><a href="#myreservation"><i class="sl sl-icon-settings"></i> My Reservations</a></li>
                            <li><a href="#myfavourite"><i class="sl sl-icon-settings"></i> My Favourite</a></li>
							<li><a href="#account/edit"><i class="sl sl-icon-envelope-open"></i>My Profile</a></li>
							<li><a href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
					<?php
					}
					?>
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
<div class="container" v-if="records.length">
	<div class="row">

		<div class="col-lg-9 col-md-8 padding-right-30">

			<!-- Sorting / Layout Switcher -->
			<div class="row margin-bottom-25">

				<div class="col-md-6 col-xs-6">
					<!-- Sort by 
					<div class="sort-by">
						<div class="sort-by-select">
							<select data-placeholder="Default order" class="chosen-select-no-single">
								<option>Default Order</option>	
								<option>Highest Rated</option>
								<option>Most Reviewed</option>
								<option>Newest Listings</option>
								<option>Oldest Listings</option>
							</select>
						</div>
					</div>-->
				</div>
			</div>
			<!-- Sorting / Layout Switcher / End -->


			<div class="row">

				<!-- Listing Item -->
				<div class="col-lg-12 col-md-12" v-for="(data,index) in records">
					<div class="listing-item-container list-layout">
						<a onclick="myBooking('2')" class="listing-item">
							
							<!-- Image -->
							<div class="listing-item-image">
								<img :src="data.thumbnail" alt="">
								<span class="tag">{{data.name}}</span>
							</div>
							
							<!-- Content -->
							<div class="listing-item-content">
								<div class="listing-badge now-open"  v-if="data.status == 0">Now Open</div>
								<div class="listing-badge now-open"  v-if="data.status == 1">Closed</div>

								<div class="listing-item-inner">
									<h3>{{data.name}}<i class="verified-icon"></i></h3>
									<span>{{data.address}}</span>
									<div class="star-rating" :data-rating="data.avg_of_rate">
										<div class="rating-counter">(12 reviews)</div>
									</div>
								</div>

								<span class="like-icon"></span>
							</div>
						</a>
					</div>
				</div>
				<!-- Listing Item / End -->

			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
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

					<!-- Pagination -->
					<div class="pagination-container margin-top-20 margin-bottom-40">
						<nav class="pagination">
							<ul>
								<li><a href="#" class="current-page">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!-- Pagination / End -->

		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-3 col-md-4">
			<div class="sidebar">

				<!-- Widget -->
				<div class="widget margin-bottom-40">
					<h3 class="margin-top-0 margin-bottom-30">Filters</h3>

					<!-- Row -->
                    <form class="hero-form form" action="#propertysearch" method="GET">
					<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">
							<input type="text" @keyup.enter="dosearch()" v-model="what_property" placeholder="What are you looking for?" name="tagss" class="tagss" value=""/>
						</div>
					</div>
					<!-- Row / End -->
					<!-- Row -->
					<div class="row with-forms">
						<!-- Cities -->
						<div class="col-md-12">

							<div class="input-with-icon location">
								<div id="autocomplete-container">
									<input name="tags_location" class="tags_location"  type="text" placeholder="Location">
								</div>
								<a href="#"><i class="fa fa-map-marker"></i></a>
							</div>

						</div>
					</div>
					<!-- Row / End -->
					<br><button type="submit" class="button fullwidth margin-top-25">Search</button>
                    </form>

				</div>
				<!-- Widget / End -->

			</div>
		</div>
		<!-- Sidebar / End -->
	</div>
</div>
<div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center container">
                                        <h4><i class="fa fa-ban"></i> {{emptyrecordmsg}}</h4>
                                    </div>
                                    <div v-show="loading" class="load-indicator static-center">
                                        <span class="animator">
                                            <clip-loader :loading="loading" color="gray" size="20px">
                                            </clip-loader>
                                        </span>
                                        <h4 style="color:gray" class="loading-text"></h4>
</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->


    </div>
    </template>
    <script>
	var PropertysearchListComponent = Vue.component('propertysearchList', {
		template: '#propertysearchList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'propertysearch',
			},
			routename : {
				type : String,
				default : 'propertysearchlist',
			},
			apipath : {
				type : String,
				default : 'propertysearch/list',
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
                what_property:'',
                data:{what_property:'',},
			}
		},
		computed : {
			pageTitle: function(){
				return 'Propertysearch';
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
			filterGroup: function(){
				var filters = {};
				this.filterMsgs = [];
				this.filter(filters);
			},
		}
	});
	</script>
