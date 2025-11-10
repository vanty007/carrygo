    <template id="propertyfacilityAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Propertyfacility</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="propertyfacility/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('facilityname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="facilityname">Facilityname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.facilityname"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Facilityname"
                                                    class="form-control "
                                                    type="text"
                                                    name="facilityname"
                                                    placeholder="Enter Facilityname"
                                                    />
                                                    <small v-show="errors.has('facilityname')" class="form-text text-danger">
                                                        {{ errors.first('facilityname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('facilitytype')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="facilitytype">Facilitytype <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.facilitytype"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Facilitytype"
                                                    class="form-control "
                                                    type="number"
                                                    name="facilitytype"
                                                    placeholder="Enter Facilitytype"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('facilitytype')" class="form-text text-danger">
                                                        {{ errors.first('facilitytype') }}
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
	var PropertyfacilityAddComponent = Vue.component('propertyfacilityAdd', {
		template : '#propertyfacilityAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'propertyfacility',
			},
			routename : {
				type : String,
				default : 'propertyfacilityadd',
			},
			apipath : {
				type : String,
				default : 'propertyfacility/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					property_id: '',facilityname: '',facilitytype: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Propertyfacility';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/propertyfacility');
			},
			resetForm : function(){
				this.data = {property_id: '',facilityname: '',facilitytype: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
