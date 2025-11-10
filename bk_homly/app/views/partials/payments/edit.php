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
                                    <div class="form-group " :class="{'has-error' : errors.has('propertyavai_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="propertyavai_id">Propertyavai Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.propertyavai_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Propertyavai Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="propertyavai_id"
                                                    placeholder="Enter Propertyavai Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('propertyavai_id')" class="form-text text-danger">
                                                        {{ errors.first('propertyavai_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('user_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.user_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="User Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="user_id"
                                                    placeholder="Enter User Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('user_id')" class="form-text text-danger">
                                                        {{ errors.first('user_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('type')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="type">Type <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.type"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Type"
                                                    class="form-control "
                                                    type="text"
                                                    name="type"
                                                    placeholder="Enter Type"
                                                    />
                                                    <small v-show="errors.has('type')" class="form-text text-danger">
                                                        {{ errors.first('type') }}
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
                                    <div class="form-group " :class="{'has-error' : errors.has('upload')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="upload">Upload Payment Prove <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="upload"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/images/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="upload"
                                                        v-model="data.upload"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Upload Payment Prove"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('upload')" class="form-text text-danger">{{ errors.first('upload') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('amount')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="amount">Amount <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.amount"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Amount"
                                                    class="form-control "
                                                    type="text"
                                                    name="amount"
                                                    placeholder="Enter Amount"
                                                    />
                                                    <small v-show="errors.has('amount')" class="form-text text-danger">
                                                        {{ errors.first('amount') }}
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
				data : { propertyavai_id: '',user_id: '',type: '',status: '',upload: '',amount: '', },
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
