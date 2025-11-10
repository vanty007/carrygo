    <template id="carrygo_bid_activeAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Carrygo Bid Active</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="carrygo_bid_active/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('bidid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="bidid">Bidid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.bidid"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Bidid"
                                                    class="form-control "
                                                    type="number"
                                                    name="bidid"
                                                    placeholder="Enter Bidid"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('bidid')" class="form-text text-danger">
                                                        {{ errors.first('bidid') }}
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
	var Carrygo_Bid_ActiveAddComponent = Vue.component('carrygo_bid_activeAdd', {
		template : '#carrygo_bid_activeAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'carrygo_bid_active',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_activeadd',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_active/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					msisdn: '',bidid: '',points: '',status: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Carrygo Bid Active';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/carrygo_bid_active');
			},
			resetForm : function(){
				this.data = {msisdn: '',bidid: '',points: '',status: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
