    <template id="carrygo_bid_activeEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Carrygo Bid Active</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'carrygo_bid_active/edit/' + data.id" method="post">
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
	var Carrygo_Bid_ActiveEditComponent = Vue.component('carrygo_bid_activeEdit', {
		template : '#carrygo_bid_activeEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'carrygo_bid_active',
			},
			routename : {
				type : String,
				default : 'carrygo_bid_activeedit',
			},
			apipath : {
				type : String,
				default : 'carrygo_bid_active/edit',
			},
		},
		data: function() {
			return {
				data : { msisdn: '',bidid: '',points: '',status: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Carrygo Bid Active';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/carrygo_bid_active');
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
