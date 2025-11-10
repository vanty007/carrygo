        <template id="openbidList">
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
        										<input type="number" class="input-text" v-model="user.msisdn" name="msisdn" value="" />
        									</label>
        								</p>

        								<p class="form-row form-row-wide">
        									<label for="username">Enter Bid Number:
        										<!--<i class="im im-icon-Male"></i>-->
        										<input type="number" class="input-text" v-model="user.points" name="points" required="required" value="" />
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
        							<h2 style="text-align: center;">Open Bids</h2>

        							<div class="row fs-listings">
        								<div id="listeo-listings-container" class=" compact-layout row" v-if="records.length">
        									<div class="loader-ajax-container">
        										<div class="loader-ajax"></div>
        									</div>
        									<!-- Listing Item -->
        									<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" v-for="(data,index) in records">
        										<div v-if="data.bid_active_points !== null" class="listing-item-container listing-geo-data compact" :data-image="data.image">
        											<div class="listing-item  featured-listing" @click="showpop(data.image)">
        												<div class="listing-small-badges-container" style="float:left;width:250px">
        													<div class="listing-small-badge featured-badge" v-if="data.bid_active_points === null"><i class="fa fa-tag" style="color:white;background-color:red;"></i>{{data.open_points}} Points to Unlock</div>
        													<div class="listing-small-badge featured-badge" v-if="data.bid_active_points !== null"><i class="fa fa-tag" style="color:white;background-color:green;"></i>{{data.bid_active_points-data.open_points}} Points to Win</div>
        													<div class="listing-small-badge featured-badge" v-if="data.bid_active_points !== null"><i class="fa fa-tag" style="color:white;background-color:green;"></i>{{data.bid_active_points}} Bidded Points</div>
        												</div>
        												<img :src="data.image" alt="Sunny Apartment" class="listing-thumbnail" data-toggle="modal" data-target="#openBidModal">
        												<div class="listing-item-content">
        													<div class="numerical-rating high" :data-rating="data.rating"><i class="fa fa-star"></i></div>
        													<span class="tag" style="width: 100px"><a :href="data.url" target="_blank" style="color:white;">Item Link</a></span>
        												</div>

        											</div>
        											</br>
        											<div class="listing-small-badge" style="padding-left: 8px;background-color:transparent;border-radius:0px;font-size:16px;"><router-link style="text-decoration:none;" :to="'/bid/view/' +  data.id">{{data.name}}</router-link>
        												<div class="listing-small-badge pricing-badge"><i class="fa fa-money"></i>&#8358;{{data.price}}</div>
        											</div>
        											<div class="listing-small-badge pricing-badge"><i class="fa fa-clock-o"></i>Time Left: {{getTimeleft(data.created_at,data.open_date-1)}}</div>

        											<div class="listing-small-badge pricing-badge"><i class="fa fa-tag"></i>({{data.bid_active_points}} Bidded Points)</div>
        											</br></br>
        											<center><button data-toggle="modal" data-target="#openBidModal" @click="setBidid(data.id,data.open_points,data.open_date)" class="button border margin-top-5" type="button">Bid</button></center>

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
        	var OpenbidListComponent = Vue.component('openbidList', {
        		template: '#openbidList',
        		mixins: [ListPageMixin],
        		props: {
        			limit: {
        				type: Number,
        				default: defaultPageLimit,
        			},
        			pagename: {
        				type: String,
        				default: 'openbid',
        			},
        			routename: {
        				type: String,
        				default: 'openbid',
        			},
        			apipath: {
        				type: String,
        				default: 'openbid/list',
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
        		data: function() {
        			return {
        				pagelimit: defaultPageLimit,
        				user: {
        					points: '',
        					msisdn: '',
        					bidid: '',
        					open_date: '',
        					open_points: ''
        				},
        			}
        		},
        		computed: {
        			pageTitle: function() {
        				return 'Propertylist';
        			},
        			filterGroupChange: function() {
        				return;
        			},
        		},
        		watch: {
        			allSelected: function() {
        				//toggle selected record
        				this.selected = [];
        				if (this.allSelected == true) {
        					for (var i in this.records) {
        						var id = this.records[i].id;
        						this.selected.push(id);
        					}
        				}
        			}
        		},
        		methods: {
        			formatCustom(date) {
        				const yyyy = date.getFullYear();
        				const mm = String(date.getMonth() + 1).padStart(2, '0');
        				const dd = String(date.getDate()).padStart(2, '0');
        				const yy = String(yyyy).slice(-2); // last two digits of the year
        				const hh = String(date.getHours()).padStart(2, '0');
        				const ii = String(date.getMinutes()).padStart(2, '0');
        				const ss = String(date.getSeconds()).padStart(2, '0');

        				return `${yyyy}-${mm}-${yy} ${hh}:${ii}:${ss}`;
        			},
        			getTimeleft(timestamp, open_date) {
        				const startDate = new Date(timestamp);
        				const endDate = new Date();

        				const formattedStart = this.formatCustom(startDate);
        				const formattedEnd = this.formatCustom(endDate);

        				console.log("Formatted Start:", formattedStart);
        				console.log("Formatted End:  ", formattedEnd);

        				const diffInMs = endDate - startDate;
        				const totalMinutes = Math.floor(diffInMs / (1000 * 60));
        				const hours = Math.floor(totalMinutes / 60);
        				let minutes = totalMinutes % 60;
						let remHours = open_date-hours;
						if (remHours < 0) {
							remHours = 0;
							minutes = 0;
						}
						return `${remHours} hour(s), ${minutes} minute(s)`;
        			},

        			load: function() {
        				this.records = [];
        				this.test = [];
        				if (this.loading == false) {
        					this.ready = false;
        					this.loading = true;
        					var url = this.apiUrl;
        					this.$http.get(url).then(function(response) {
        							var data = response.body;
        							console.log(data)
        							if (data && data.records) {
        								this.totalrecords = data.total_records;
        								if (this.pagelimit > data.records.length) {
        									this.loadcompleted = true;
        								}
        								this.user.points = data.records2.user_points;
        								this.user.msisdn = data.records2.user;
        								this.records = data.records;

        								//foo();

        							} else {
        								console.log(response)
        								this.$root.$emit('requestError', response);
        							}
        							this.loading = false
        							this.ready = true
        						},
        						function(response) {
        							this.loading = false;
        							this.$root.$emit('requestError', response);
        						});
        				}
        			},
        			postbid_info: function(e) {
        				var payload = this.user;
        				console.log(payload)
        				this.loading = true;
        				var self = this;
        				var apiurl = setApiUrl('home/postbid_info');
        				this.$http.post(apiurl, payload, {
        					emulateJSON: true
        				}).then(function(response) {
        						self.loading = false;
        						alert('You have successfully bidded')
        						//window.location = response.body;
        						location.reload();
        					},
        					function(response) {
        						this.loading = false;
        						this.showError = false
        						this.errorMsg = response.statusText;
        						console.log(response)
        						//Flashes messages
        						setTimeout(function() {
        							self.showError = true;
        						}, 100);
        					});
        			},

        			filterGroup: function() {
        				var filters = {};
        				this.filterMsgs = [];
        				this.filter(filters);
        			},
        			setBidid(id, open_points, open_date) {
        				this.user.bidid = id;
        				this.user.open_date = open_date;
        				this.user.open_points = open_points;
        			},
        			addtoFavourite: function(id) {
        				var apiurl = setApiUrl('components/addtoFavourite/' + id);
        				this.$http.get(apiurl).then(function(response) {
        						console.log(response)
        						//window.location.href = response.body;
        						location.reload();
        					},
        					function(response) {
        						console.log(response)
        					});
        			},
        			removetoFavourite: function(id) {
        				var apiurl = setApiUrl('components/removetoFavourite/' + id);
        				this.$http.get(apiurl).then(function(response) {
        						console.log(response)
        						//window.location.href = response.body;
        						location.reload();
        					},
        					function(response) {
        						console.log(response)
        					});
        			},
        		}
        	});
        </script>