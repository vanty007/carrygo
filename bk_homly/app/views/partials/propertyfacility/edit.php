    <template id="propertyfacilityEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Propertyfacility</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'propertyfacility/edit/' + data.id" method="post">
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
	var PropertyfacilityEditComponent = Vue.component('propertyfacilityEdit', {
		template : '#propertyfacilityEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'propertyfacility',
			},
			routename : {
				type : String,
				default : 'propertyfacilityedit',
			},
			apipath : {
				type : String,
				default : 'propertyfacility/edit',
			},
		},
		data: function() {
			return {
				data : { property_id: '',facilityname: '',facilitytype: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Propertyfacility';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/propertyfacility');
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
