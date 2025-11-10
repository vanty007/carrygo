    <template id="riders_availabilityAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Riders Availability</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="riders_availability/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('rider_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rider_id">Rider Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rider_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Rider Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="rider_id"
                                                    placeholder="Enter Rider Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('rider_id')" class="form-text text-danger">
                                                        {{ errors.first('rider_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('location')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="location">Location <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.location"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Location"
                                                    class="form-control "
                                                    type="text"
                                                    name="location"
                                                    placeholder="Enter Location"
                                                    />
                                                    <small v-show="errors.has('location')" class="form-text text-danger">
                                                        {{ errors.first('location') }}
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
	var Riders_AvailabilityAddComponent = Vue.component('riders_availabilityAdd', {
		template : '#riders_availabilityAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'riders_availability',
			},
			routename : {
				type : String,
				default : 'riders_availabilityadd',
			},
			apipath : {
				type : String,
				default : 'riders_availability/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					rider_id: '',location: '',status: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Riders Availability';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/riders_availability');
			},
			resetForm : function(){
				this.data = {rider_id: '',location: '',status: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
