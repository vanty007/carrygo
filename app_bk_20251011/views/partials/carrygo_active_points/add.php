    <template id="carrygo_active_pointsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Carrygo Active Points</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="carrygo_active_points/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('msisdn')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="msisdn">Msisdn <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.msisdn"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Msisdn"
                                                    class="form-control "
                                                    type="text"
                                                    name="msisdn"
                                                    placeholder="Enter Msisdn"
                                                    />
                                                    <small v-show="errors.has('msisdn')" class="form-text text-danger">
                                                        {{ errors.first('msisdn') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('points')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="points">Points <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.points"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Points"
                                                    class="form-control "
                                                    type="number"
                                                    name="points"
                                                    placeholder="Enter Points"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('points')" class="form-text text-danger">
                                                        {{ errors.first('points') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('updated_at')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="updated_at">Updated At <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.updated_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Updated At"
                                                    name="updated_at"
                                                    placeholder="Enter Updated At"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('updated_at')" class="form-text text-danger">{{ errors.first('updated_at') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
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
	var Carrygo_Active_PointsAddComponent = Vue.component('carrygo_active_pointsAdd', {
		template : '#carrygo_active_pointsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'carrygo_active_points',
			},
			routename : {
				type : String,
				default : 'carrygo_active_pointsadd',
			},
			apipath : {
				type : String,
				default : 'carrygo_active_points/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					msisdn: '',points: '',updated_at: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Carrygo Active Points';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/carrygo_active_points');
			},
			resetForm : function(){
				this.data = {msisdn: '',points: '',updated_at: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
