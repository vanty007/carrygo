    <template id="propertylocationsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Propertylocations</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="propertylocations/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('location_name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="location_name">Location Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.location_name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Location Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="location_name"
                                                    placeholder="Enter Location Name"
                                                    />
                                                    <small v-show="errors.has('location_name')" class="form-text text-danger">
                                                        {{ errors.first('location_name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('area')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="area">Area <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.area"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Area"
                                                    class="form-control "
                                                    type="text"
                                                    name="area"
                                                    placeholder="Enter Area"
                                                    />
                                                    <small v-show="errors.has('area')" class="form-text text-danger">
                                                        {{ errors.first('area') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('city')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="city">City <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.city"
                                                    v-validate="{required:true}"
                                                    data-vv-as="City"
                                                    class="form-control "
                                                    type="text"
                                                    name="city"
                                                    placeholder="Enter City"
                                                    />
                                                    <small v-show="errors.has('city')" class="form-text text-danger">
                                                        {{ errors.first('city') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('state')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="state">State <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.state"
                                                    v-validate="{required:true}"
                                                    data-vv-as="State"
                                                    class="form-control "
                                                    type="text"
                                                    name="state"
                                                    placeholder="Enter State"
                                                    />
                                                    <small v-show="errors.has('state')" class="form-text text-danger">
                                                        {{ errors.first('state') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('country')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="country">Country <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.country"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Country"
                                                    class="form-control "
                                                    type="text"
                                                    name="country"
                                                    placeholder="Enter Country"
                                                    />
                                                    <small v-show="errors.has('country')" class="form-text text-danger">
                                                        {{ errors.first('country') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary"  :disabled="errors.any()" type="submit">
                                            <i class="load-indicator">
                                                <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                            </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var PropertylocationsAddComponent = Vue.component('propertylocationsAdd', {
		template : '#propertylocationsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'propertylocations',
			},
			routename : {
				type : String,
				default : 'propertylocationsadd',
			},
			apipath : {
				type : String,
				default : 'propertylocations/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					location_name: '',area: '',city: '',state: '',country: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Propertylocations';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/propertylocations');
			},
			resetForm : function(){
				this.data = {location_name: '',area: '',city: '',state: '',country: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
