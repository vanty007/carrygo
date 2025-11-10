    <template id="carrygo_bid_winnersEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Carrygo Bid Winners</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'carrygo_bid_winners/edit/' + data.id" method="post">
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
	var Carrygo_Bid_WinnersEditComponent = Vue.component('carrygo_bid_winnersEdit', {
		template : '#carrygo_bid_winnersEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'carrygo_bid_winners',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_winnersedit',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_winners/edit',
			},
		},
		data: function() {
			return {
				data : { msisdn: '',total_points: '',bid: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Carrygo Bid Winners';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/carrygo_bid_winners');
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
