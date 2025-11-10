<template id="carrygo_bidEdit">
    <div>
      <div id="wrapper">
         <!-- Header Container
            ================================================== -->
         <header id="header-container" class="fixed fullwidth dashboard">
            <!-- Header -->

            <!-- Header / End -->
         </header>
         <div class="clearfix"></div>
         <!-- Header Container / End -->
         <!-- Dashboard -->
         <div id="dashboard">
            <!-- Navigation
               ================================================== -->
            <!-- Responsive Navigation Trigger -->
            <a style="cursor: pointer;" id="dashboard-responsive-nav-trigger" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>
            <div class="dashboard-nav">
               <div class="dashboard-nav-inner">
                  <ul data-submenu-title="Main">
                  <li  onclick="fhome()"><a style="cursor: pointer;"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
					 <li>
						<a><i class="sl sl-icon-layers"></i>M-Health Service</a>
						<ul>
							<li onclick="fsubscriptions()"><a style="cursor: pointer;">Subscriptions</a></li>
							<li onclick="fcontents()"><a style="cursor: pointer;">Contents</a></li>
							<li onclick="fquestions_log()"><a style="cursor: pointer;">Question & Answer Content</a></li>
							<li onclick="fentries_log()"><a style="cursor: pointer;">Trivia Results</a></li>
							<li onclick="fuser_credit()"><a style="cursor: pointer;">Daily Winners</a></li>
						</ul>
					</li>
					<li class="active">
						<a><i class="sl sl-icon-layers"></i>Carry Go Service</a>
						<ul>
							<li onclick="fcarrygo_bid()"><a style="cursor: pointer;">Bid Contents</a></li>
							<!--<li><a href="#contents">Bid Contents</a></li>
							<li><a href="#entry_logs">Bid Results</a></li>
							<li><a href="#user_airtime">Daily Winners</a></li>-->
						</ul>
					</li>
                  </ul>
                  <ul data-submenu-title="Account">
                     <li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
                  </ul>
               </div>
            </div>
            <!-- Navigation / End -->
            <!-- Content
               ================================================== -->
            <div class="dashboard-content">
               <!-- Titlebar -->
               <div id="titlebar">
                  <div class="row">
                     <div class="col-md-12">

                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                           <ul>
                              <li><a style="cursor: pointer;" href="#">Home</a></li>
                              <li>Update Bid Item</li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>

			   <div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
								<h6 class="text-white text-capitalize ps-3">Update Bid Item</h6>
							</div>
							</div>
							<div class="card-body px-0 pb-2">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'carrygo_bid/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="name"
                                                    placeholder="Enter Name"
                                                    />
                                                    <small v-show="errors.has('name')" class="form-text text-danger">
                                                        {{ errors.first('name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('image')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="image">Image <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="image"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        extensions="jpg , png , gif , jpeg"  
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="image"
                                                        v-model="data.image"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Image"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('image')" class="form-text text-danger">{{ errors.first('image') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <!-- <div class="form-group " :class="{'has-error' : errors.has('description')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.description"
                                                        data-vv-as="description"
                                                        placeholder="Enter description" 
                                                        rows="5" 
                                                        name="description" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('description')" class="form-text text-danger">{{ errors.first('description') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('specification')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="specification">Specification <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.specification"
                                                        data-vv-as="specification"
                                                        placeholder="Enter specification" 
                                                        rows="5" 
                                                        name="specification" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('specification')" class="form-text text-danger">{{ errors.first('specification') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group " :class="{'has-error' : errors.has('category')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="category">Category <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.category"
                                                        data-vv-value-path="data.category"
                                                        data-vv-as="category"
                                                        placeholder="Select A Value ... " name="category" :multiple="false" 
                                                        :datasource="categoryOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('category')" class="form-text text-danger">{{ errors.first('category') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('open_date')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="open_date">Expiry Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.open_date"
                                                        data-vv-value-path="data.open_date"
                                                        data-vv-as="open_date"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="open_date" :multiple="false" 
                                                        :datasource="open_dateOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('open_date')" class="form-text text-danger">{{ errors.first('open_date') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('url')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="url">Url <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.url"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Url"
                                                    class="form-control "
                                                    type="text"
                                                    name="url"
                                                    placeholder="Enter Url"
                                                    />
                                                    <small v-show="errors.has('url')" class="form-text text-danger">
                                                        {{ errors.first('url') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('price')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="price">Price <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.price"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Price"
                                                    class="form-control "
                                                    type="text"
                                                    name="price"
                                                    placeholder="Enter Price"
                                                    />
                                                    <small v-show="errors.has('price')" class="form-text text-danger">
                                                        {{ errors.first('price') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('open_points')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="open_points">Open Points <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.open_points"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Open Points"
                                                    class="form-control "
                                                    type="text"
                                                    name="open_points"
                                                    placeholder="Enter Open Points"
                                                    />
                                                    <small v-show="errors.has('open_points')" class="form-text text-danger">
                                                        {{ errors.first('open_points') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group " :class="{'has-error' : errors.has('status')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.status"
                                                        data-vv-value-path="data.status"
                                                        data-vv-as="Status"
                                                        placeholder="Select A Value ... " name="status" :multiple="false" 
                                                        :datasource="statusOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('status')" class="form-text text-danger">{{ errors.first('status') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text"></h4>
                                </div>

							</div>
						</div>
					</div>
      			</div>

            </div>
            <!-- Content / End -->
         </div>
         <!-- Dashboard / End -->
      </div>
   </div>
</template>
    <script>
	var Carrygo_BidEditComponent = Vue.component('carrygo_bidEdit', {
		template : '#carrygo_bidEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'carrygo_bid',
			},
			routename : {
				type : String,
				default : 'carrygo_bidedit',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid/edit',
			},
		},
		data: function() {
			return {
				data : { name: '',image: '',url: '',price: '',open_points: '',open_date: '',description: '',specification: '',category: '',status: ''},
                statusOptionList: [{"label":"Enabled","value":"0"},{"label":"Disabled","value":"1"}],
                categoryOptionList: [{"label":"Gadgets & Accessories","value":"Gadgets & Accessories"},{"label":"Appliances","value":"Appliances"}
                    ,{"label":"Electronics","value":"Electronics"},{"label":"Health & Beauty","value":"Health & Beauty"},{"label":"Home & Office","value":"Home & Office"}
                    ,{"label":"Fashion","value":"Fashion"},{"label":"Computing","value":"Computing"},{"label":"Musical Instrument","value":"Musical Instrument"},{"label":"Supermarket","value":"Supermarket"}
                    ,{"label":"Gaming","value":"Gaming"}],
                open_dateOptionList: [{"label":"24 Hours","value":"24"},{"label":"48 Hours","value":"48"},{"label":"72 Hours","value":"72"},{"label":"96 Hours","value":"96"}
                    ,{"label":"120 Hours","value":"120"},{"label":"144 Hours","value":"144"},{"label":"168 Hours","value":"168"}
                ],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Carrygo Bid';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/carrygo_bid');
				}
			},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>
