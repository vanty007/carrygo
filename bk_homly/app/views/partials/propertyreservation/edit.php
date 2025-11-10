    <template id="propertyreservationEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Propertyreservation</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'propertyreservation/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('property_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="property_id">Property Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.property_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Property Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="property_id"
                                                    placeholder="Enter Property Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('property_id')" class="form-text text-danger">
                                                        {{ errors.first('property_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('user_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.user_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="User Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="user_id"
                                                    placeholder="Enter User Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('user_id')" class="form-text text-danger">
                                                        {{ errors.first('user_id') }}
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
                                    <div class="form-group " :class="{'has-error' : errors.has('propertyavailability_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="propertyavailability_id">Propertyavailability Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.propertyavailability_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Propertyavailability Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="propertyavailability_id"
                                                    placeholder="Enter Propertyavailability Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('propertyavailability_id')" class="form-text text-danger">
                                                        {{ errors.first('propertyavailability_id') }}
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
                                                    <input v-model="data.status"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Status"
                                                    class="form-control "
                                                    type="number"
                                                    name="status"
                                                    placeholder="Enter Status"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('status')" class="form-text text-danger">
                                                        {{ errors.first('status') }}
                                                    </small>
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
        </section>
    </template>
    <script>
	var PropertyreservationEditComponent = Vue.component('propertyreservationEdit', {
		template : '#propertyreservationEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'propertyreservation',
			},
			routename : {
				type : String,
				default : 'propertyreservationedit',
			},
			apipath : {
				type : String,
				default : 'propertyreservation/edit',
			},
		},
		data: function() {
			return {
				data : { property_id: '',user_id: '',price: '',propertyavailability_id: '',status: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Propertyreservation';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/propertyreservation');
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
