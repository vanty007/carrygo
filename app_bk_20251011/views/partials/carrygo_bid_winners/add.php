    <template id="carrygo_bid_winnersAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Carrygo Bid Winners</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="carrygo_bid_winners/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('msisdn')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="msisdn">Msisdn <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.msisdn"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Msisdn"
                                                    class="form-control "
                                                    type="number"
                                                    name="msisdn"
                                                    placeholder="Enter Msisdn"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('msisdn')" class="form-text text-danger">
                                                        {{ errors.first('msisdn') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('total_points')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="total_points">Total Points <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.total_points"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Total Points"
                                                    class="form-control "
                                                    type="number"
                                                    name="total_points"
                                                    placeholder="Enter Total Points"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('total_points')" class="form-text text-danger">
                                                        {{ errors.first('total_points') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('bid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="bid">Bid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.bid"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Bid"
                                                    class="form-control "
                                                    type="number"
                                                    name="bid"
                                                    placeholder="Enter Bid"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('bid')" class="form-text text-danger">
                                                        {{ errors.first('bid') }}
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
	var Carrygo_Bid_WinnersAddComponent = Vue.component('carrygo_bid_winnersAdd', {
		template : '#carrygo_bid_winnersAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'carrygo_bid_winners',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_winnersadd',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_winners/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					msisdn: '',total_points: '',bid: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Carrygo Bid Winners';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/carrygo_bid_winners');
			},
			resetForm : function(){
				this.data = {msisdn: '',total_points: '',bid: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
