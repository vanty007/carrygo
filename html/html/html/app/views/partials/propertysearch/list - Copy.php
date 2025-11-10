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
<div class="container">
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


			<div v-if="records.length" ref="datatable">
                                        <div class="row">
                                            <div class="col-sm-4" v-for="(data,index) in records" >
                                                <div class="card p-2 mb-4">
                                                    <div>
                                                        <router-link :to="'/propertyavailability/view/' +  data.id">{{data.id}}</router-link>
                                                    </div>
                                                    <div>
                                                        <strong>Property Id</strong> :  {{ data.price }} 
                                                    </div>
                                                    <div>
                                                        <strong>Type</strong> :  {{ data.name }} 
                                                    </div>
                                                    <div>
                                                        <strong>Quantity</strong> :  {{ data.quantity }} 
                                                    </div>
                                                    <div>
                                                        <strong>Price</strong> :  {{ data.address }} 
                                                    </div>
                                                    <div>
                                                        <strong>Rooms</strong> :  {{ data.thumbnail }} 
                                                    </div>
                                                    <div>
                                                        <strong>Description</strong> :  {{ data.location_name }} 
                                                    </div>
                                                    <div >
                                                        <router-link v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" :to="'/propertyavailability/view/' + data.id">
                                                        <i class="fa fa-eye"></i> 
                                                        </router-link>
                                                        <router-link v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" :to="'/propertyavailability/edit/' + data.id">
                                                        <i class="fa fa-edit"></i> 
                                                        </router-link>
                                                        <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id,index)" title="Delete This Record">
                                                            <span v-show="deleting != data.id"><i class="fa fa-times"></i></span>
                                                            <clip-loader :loading="deleting == data.id" color="#fff" size="14px"></clip-loader>
                                                        </button>
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
                                        <div class="text-center py-3">
                                            <mugen-scroll :handle-on-mount="false" :handler="load" :should-handle="shouldLoad" :threshold="0.5">
                                            </mugen-scroll>
                                            <div class="text-center"><button class="btn btn-light btn-sm" v-if="!loadcompleted && !loading" @click="load"></button></div>
                                            <h5 v-if="loadcompleted && !loading && records.length" class="text-muted">ok</h5>
                                        </div>
                                    </div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">


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
