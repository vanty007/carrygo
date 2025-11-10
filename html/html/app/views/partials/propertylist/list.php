    <template id="propertylistList">
        <section class="page-component">
                            <div class=""><div class="landing-container2">
                                <section class="hero-section2">
                                    <div class="hero-content2">
                                        <img 
                                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/8840839ee113342140a4d71a7a2d785f98cfdf507478b2d3a4a222e275cf16ba?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                        alt="Hero background image showing a luxury apartment interior"
                                        class="hero-background2"
                                        />
                                        <nav class="nav-container2">
                                            <div class="nav-content2">
                                                <h1 class="brand-logo2">Homly</h1>
                                                <div class="nav-actions2">
                                                    <button class="list-property-btn2">List your property</button>
                                                    <button class="sign-in-btn2">Sign in</button>
                                                </div>
                                            </div>
                                        </nav>
                                        <div class="search-section2">
                                            <h2 class="search-title2">Your next home is ready, whether it's for days or months.</h2>
                                            <form class="search-form2" role="search">
                                                <div class="search-inputs2">
                                                    <div class="custom_input2">
                                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/b1ef94f580542f6506a0ebb88c2ed348da51ad0013a505ccbf2c6854e81915b0?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                        alt="" class="input-icon2"/>
                                                        <div class="svg_icon2">
                                                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/222ea64950091be162b0788949f79b2a897988752e418c1e041e515806561dcb?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                            alt="" class="input-icon2"/>
                                                        </div>
                                                        <div class="input-wrapper2">
                                                            <div class="ui-widget">
                                                                <input class="input2 tagss" type="text" placeholder="Location" style="width:200px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="divider2"></div>
                                                        <div class="custom_input2">
                                                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/eaeac73b73c5a5a2cc94423e01a1b9d1bd63ef02e727a025ee0255245c678ffe?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                            alt="" class="input-icon2"/>
                                                            <div class="svg_icon2">
                                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/222ea64950091be162b0788949f79b2a897988752e418c1e041e515806561dcb?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                                alt="" class="input-icon2"/>
                                                            </div>
                                                            <input class="input2" type="text" placeholder="Dates" style="width:200px;">
                                                            </div>
                                                            <div class="divider2"></div>
                                                            <div class="custom_input2">
                                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1df7d3270ad98103cc7ed74f3d77976b8e762392547cd6834f7bda94f6f770c0?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                                alt="" class="input-icon2"/>
                                                                <div class="svg_icon2">
                                                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/222ea64950091be162b0788949f79b2a897988752e418c1e041e515806561dcb?placeholderIfAbsent=true&apiKey=03b58dd5eec5426da77843f4110c36f8"
                                                                    alt="" class="input-icon2"/>
                                                                </div>
                                                                <div class="input-wrapper2">
                                                                    <!--<label for="guests" class="input-label">Guests</label>-->
                                                                    <div class="ui-widget">
                                                                        <input class="input2" type="text" placeholder="Guest" style="width:200px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="search-btn2" style="background-color:white;">
                                                                <router-link style="" class="btn btn btn-primary btn-block" :to="'/propertylist/add'">
                                                                <i class="fa fa-search"></i> Search
                                                                </router-link>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </section>
                        </div>
                        <div  class="pb-2 mb-3 border-bottom">
                            <div class="container-fluid">
                                <div class="row ">
                                    <div  class="col-md-12 comp-grid" :class="setGridSize">
                                    </br>
                                        <h3 class="record-title" style="margin-left:25px;">Top Search</h3>
                                        <div  class=" animated fadeIn">
                                            <div class="">
                                                <nav v-if="fieldname || filterMsgs.length" class="page-header-breadcrumbs mb-3" aria-label="breadcrumb">
                                                    <ul class="breadcrumb m-0 p-2">
                                                        <li v-if="fieldname" class="breadcrumb-item">
                                                            <router-link class="text-capitalize" to="/propertylist">Propertylist</router-link>
                                                        </li>
                                                        <li v-if="fieldvalue" class="breadcrumb-item active"  aria-current="page"> 
                                                            <span class="text-capitalize">{{ fieldname|makeRead }} </span> &raquo;
                                                            <span class="bold">{{ fieldvalue }}</span>
                                                        </li>
                                                        <li v-if="filterMsgs.length" v-for="msg in filterMsgs" class="breadcrumb-item active"  aria-current="page"> 
                                                            <span>{{ msg.label }} </span> 
                                                            &raquo;
                                                            <span class="bold">{{ msg.value }}</span> 
                                                        </li>
                                                    </ul>
                                                </nav>
                                                    </br>
                                                <div v-if="records.length" ref="datatable">
                                                    <div class="row">
                                                        <div class="col-sm-3" v-for="(data,index) in records" >
                                                            <div>
                                    

                                                                <div class="location-card" >
                                                                <div href="#" class="like-button" title="Like Button">
                                                                        <i class="fa fa-heart"></i>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="location-image-wrapper">
                                                                      <center><niceimg class="location-image"  :path="data.pictures" width="300" height="200"></niceimg> </center>
                                                                    </div>
                                                                    
                                                                        <div class="row">
                                                                            <div class="col-sm-6 col-md-6 col-xs-6">
                                                                            <a v-bind:href="'#propertylist/view/'+data.id">
                                                                                <div class="location-name">{{ data.name }}</div></a>
                                                                            </div>
                                                                            <div class="col-sm-6  col-md-6 col-xs-6">
                                                                                <i style="float:right;" class="fa fa-star "> 4.8 (23)</i>
                                                                            </div>
                                                                        </div>
                                                                    
                                                                    <div class="property-description">{{ data.description }} </div>
                                                                    <div class="property-beds">{{ data.location_name }} </div>
                                                                </div>

                                                               <!-- <div>
                                                                    <router-link :to="'/propertylist/view/' +  data.id">{{data.id}}</router-link>
                                                                </div>
                                                                <div>
                                                                    <strong>Propertytype Id</strong> :  {{ data.propertytype_id }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Name</strong> :  {{ data.name }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Chargetype Id</strong> :  {{ data.chargetype_id }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Rating Id</strong> :  {{ data.rating_id }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Address</strong> :  {{ data.address }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Location Id</strong> :  {{ data.location_id }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Landmark</strong> :  {{ data.landmark }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Longitude</strong> :  {{ data.longitude }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Latitude</strong> :  {{ data.latitude }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Status</strong> :  {{ data.status }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Created At</strong> :  {{ data.created_at }} 
                                                                </div>
                                                                <div>
                                                                    <niceimg :path="data.pictures" width="300" height="200" ></niceimg> 
                                                                </div>
                                                                <div>
                                                                    <strong>Description</strong> :  {{ data.description }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Frequency</strong> :  {{ data.frequency }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Rate</strong> :  {{ data.rate }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Price</strong> :  {{ data.price }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Discount</strong> :  {{ data.discount }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Location Name</strong> :  {{ data.location_name }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Area</strong> :  {{ data.area }} 
                                                                </div>
                                                                <div>
                                                                    <strong>City</strong> :  {{ data.city }} 
                                                                </div>
                                                                <div>
                                                                    <strong>State</strong> :  {{ data.state }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Country</strong> :  {{ data.country }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Propertytype Name</strong> :  {{ data.propertytype_name }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Type</strong> :  {{ data.type }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Rating User Id</strong> :  {{ data.rating_user_id }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Rating Rate</strong> :  {{ data.rating_rate }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Review</strong> :  {{ data.review }} 
                                                                </div>
                                                                <div>
                                                                    <strong>Auth Id</strong> :  {{ data.auth_id }} 
                                                                </div>
                                                                <div>
                                                                    <niceimg :path="data.profile_pics" width="100" height="100" ></niceimg> 
                                                                </div>
                                                                <div >
                                                                    <router-link v-if="viewbutton" class="btn btn-sm btn-outline-primary" title="View Record" :to="'/propertylist/view/' + data.id">
                                                                    <i class="fa fa-eye"></i> 
                                                                    </router-link>
                                                                    <router-link v-if="editbutton" class="btn btn-sm btn-outline-success" title="Edit This Record" :to="'/propertylist/edit/' + data.id">
                                                                    <i class="fa fa-edit"></i> 
                                                                    </router-link>
                                                                    <button  v-if="deletebutton" class="btn btn-outline-danger btn-sm" @click="deleteRecord(data.id,index)" title="Delete This Record">
                                                                        <span v-show="deleting != data.id"><i class="fa fa-times"></i></span>
                                                                        <clip-loader :loading="deleting == data.id" color="#fff" size="14px"></clip-loader>
                                                                    </button>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="!records.length && emptyrecordmsg != '' && !loading" class="text-muted p-4 text-center">
                                                    <h4><i class="fa fa-ban"></i> {{emptyrecordmsg}}</h4>
                                                </div>
                                                <div v-show="loading" class="load-indicator static-center">
                                                    <span class="animator">
                                                        <clip-loader :loading="loading" color="blue" size="20px">
                                                        </clip-loader>
                                                    </span>
                                                    <h4 style="color:blue" class="loading-text"></h4>
                                                </div>
                                                <div v-if="paginate" class="page-header">
                                                    <div class="text-center py-3">
                                                        <button v-if="shouldLoad" class="btn btn-default" @click="load()">
                                                            More
                                                        </button>
                                                        <h5 v-if="loadcompleted && !loading && records.length" class="text-muted">Completed</h5>
                                                    </div>
                                                </div>
                                                <div v-if="showfooter" class="page-footer">
                                                    <button @click="deleteRecord()" v-if="selected.length" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i> 
                                                    </button>
                                                    <button @click="exportRecord()" v-if="exportbutton" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="showheader" class="bg-light p-3 mb-3">
                            <div class="container-fluid">
                                <div class="row ">
                                    <div  class="col-sm-4 comp-grid" :class="setGridSize">
                                    </div>
                                    <div  class="col-sm-3 comp-grid" :class="setGridSize">
                                        <router-link v-if="addbutton" class="btn btn btn-primary btn-block" :to="'/propertylist/add'">
                                        <i class="fa fa-plus"></i>
                                        Add New Propertylist
                                        </router-link>
                                    </div>
                                    <div v-if="searchfield" class="col-sm-5 comp-grid" :class="setGridSize">
                                        <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </template>
                <script>
	var PropertylistListComponent = Vue.component('propertylistList', {
		template: '#propertylistList',
		mixins: [ListPageMixin],
		props: {
			limit : {
				type : Number,
				default : defaultPageLimit,
			},
			pagename : {
				type : String,
				default : 'propertylist',
			},
			routename : {
				type : String,
				default : 'propertylistlist',
			},
			apipath : {
				type : String,
				default : 'propertylist/list',
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
			load: function(){
				this.currentpage = (Math.ceil(this.records.length / this.pagelimit) + 1 ) || 1;
				if (this.loading == false){
					this.loading = true;
					var url = this.apiUrl;
					this.$http.get(url).then(function (response) {
						var data = response.body;
						if(data && data.records){
							this.totalrecords = data.total_records;
							if(this.pagelimit  > data.records.length){
								this.loadcompleted = true;
							}
							this.records = this.records.concat(data.records);
						}
						else{
							this.$root.$emit('pageError' , response);
						}
						this.loading = false
						this.ready = true
					},
					function (response) {
						this.loading = false;
						this.$root.$emit('pageError' , response);
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
