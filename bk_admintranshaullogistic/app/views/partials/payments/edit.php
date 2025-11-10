    <template id="paymentsEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Payments</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'payments/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('request_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="request_id">Request Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.request_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Request Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="request_id"
                                                    placeholder="Enter Request Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('request_id')" class="form-text text-danger">
                                                        {{ errors.first('request_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('payer')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="payer">Payer <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.payer"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Payer"
                                                    class="form-control "
                                                    type="text"
                                                    name="payer"
                                                    placeholder="Enter Payer"
                                                    />
                                                    <small v-show="errors.has('payer')" class="form-text text-danger">
                                                        {{ errors.first('payer') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('picture')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="picture">Picture <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="picture"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="picture"
                                                        v-model="data.picture"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Picture"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('picture')" class="form-text text-danger">{{ errors.first('picture') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('payment_method')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="payment_method">Payment Method <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.payment_method"
                                                        data-vv-value-path="data.payment_method"
                                                        data-vv-as="Payment Method"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="payment_method" :multiple="false" 
                                                        :datasource="payment_methodOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('payment_method')" class="form-text text-danger">{{ errors.first('payment_method') }}</small>
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
	var PaymentsEditComponent = Vue.component('paymentsEdit', {
		template : '#paymentsEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'payments',
			},
			routename : {
				type : String,
				default : 'paymentsedit',
			},
			apipath : {
				type : String,
				default : 'payments/edit',
			},
		},
		data: function() {
			return {
				data : { request_id: '',payer: '',picture: '',payment_method: '', },
				payment_methodOptionList: ["Cash","Transfer","POS","ATM","QRCODE"],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Payments';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/payments');
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
