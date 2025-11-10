    <template id="pickup_requestEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Pickup Request</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'pickup_request/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_name">Receiver Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.receiver_name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Receiver Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="receiver_name"
                                                    placeholder="Enter Receiver Name"
                                                    />
                                                    <small v-show="errors.has('receiver_name')" class="form-text text-danger">
                                                        {{ errors.first('receiver_name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_phoneno')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_phoneno">Receiver Phoneno <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.receiver_phoneno"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Receiver Phoneno"
                                                    class="form-control "
                                                    type="text"
                                                    name="receiver_phoneno"
                                                    placeholder="Enter Receiver Phoneno"
                                                    />
                                                    <small v-show="errors.has('receiver_phoneno')" class="form-text text-danger">
                                                        {{ errors.first('receiver_phoneno') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_email')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_email">Receiver Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.receiver_email"
                                                    v-validate="{required:true,  email:true}"
                                                    data-vv-as="Receiver Email"
                                                    class="form-control "
                                                    type="email"
                                                    name="receiver_email"
                                                    placeholder="Enter Receiver Email"
                                                    />
                                                    <small v-show="errors.has('receiver_email')" class="form-text text-danger">
                                                        {{ errors.first('receiver_email') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pickup_address')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pickup_address">Pickup Address <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pickup_address"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pickup Address"
                                                    class="form-control "
                                                    type="text"
                                                    name="pickup_address"
                                                    placeholder="Enter Pickup Address"
                                                    />
                                                    <small v-show="errors.has('pickup_address')" class="form-text text-danger">
                                                        {{ errors.first('pickup_address') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pickup_city')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pickup_city">Pickup City <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pickup_city"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pickup City"
                                                    class="form-control "
                                                    type="text"
                                                    name="pickup_city"
                                                    placeholder="Enter Pickup City"
                                                    />
                                                    <small v-show="errors.has('pickup_city')" class="form-text text-danger">
                                                        {{ errors.first('pickup_city') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pickup_state')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pickup_state">Pickup State <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.pickup_state"
                                                        data-vv-value-path="data.pickup_state"
                                                        data-vv-as="Pickup State"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="pickup_state" :multiple="false" 
                                                        :datasource="pickup_stateOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('pickup_state')" class="form-text text-danger">{{ errors.first('pickup_state') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_address')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_address">Receiver Address <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.receiver_address"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Receiver Address"
                                                    class="form-control "
                                                    type="text"
                                                    name="receiver_address"
                                                    placeholder="Enter Receiver Address"
                                                    />
                                                    <small v-show="errors.has('receiver_address')" class="form-text text-danger">
                                                        {{ errors.first('receiver_address') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_city')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_city">Receiver City <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.receiver_city"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Receiver City"
                                                    class="form-control "
                                                    type="text"
                                                    name="receiver_city"
                                                    placeholder="Enter Receiver City"
                                                    />
                                                    <small v-show="errors.has('receiver_city')" class="form-text text-danger">
                                                        {{ errors.first('receiver_city') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('receiver_state')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="receiver_state">Receiver State <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.receiver_state"
                                                        data-vv-value-path="data.receiver_state"
                                                        data-vv-as="Receiver State"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="receiver_state" :multiple="false" 
                                                        :datasource="receiver_stateOptionList"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('receiver_state')" class="form-text text-danger">{{ errors.first('receiver_state') }}</small>
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
                                                        uploadpath="uploads/images/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="3" 
                                                        :multiple="true"
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
                                    <div class="form-group " :class="{'has-error' : errors.has('delivery_option_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="delivery_option_id">Delivery Option Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.delivery_option_id"
                                                        data-vv-value-path="data.delivery_option_id"
                                                        data-vv-as="Delivery Option Id"
                                                        v-validate="{required:true}"
                                                        placeholder="Select A Value ... " name="delivery_option_id" :multiple="false" 
                                                        :datapath="'components/pickup_request_delivery_option_id_option_list/'"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('delivery_option_id')" class="form-text text-danger">{{ errors.first('delivery_option_id') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('totalamount')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="totalamount">Totalamount <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.totalamount"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Totalamount"
                                                    class="form-control "
                                                    type="text"
                                                    name="totalamount"
                                                    placeholder="Enter Totalamount"
                                                    />
                                                    <small v-show="errors.has('totalamount')" class="form-text text-danger">
                                                        {{ errors.first('totalamount') }}
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
	var Pickup_RequestEditComponent = Vue.component('pickup_requestEdit', {
		template : '#pickup_requestEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'pickup_request',
			},
			routename : {
				type : String,
				default : 'pickup_requestedit',
			},
			apipath : {
				type : String,
				default : 'pickup_request/edit',
			},
		},
		data: function() {
			return {
				data : { receiver_name: '',receiver_phoneno: '',receiver_email: '',pickup_address: '',pickup_city: '',pickup_state: '',receiver_address: '',receiver_city: '',receiver_state: '',picture: '',delivery_option_id: '',totalamount: '', },
				pickup_stateOptionList: [{"label":"Anambra","value":"Anambra"},{"label":"Abia","value":"Abia"},{"label":"Adamawa","value":"Adamawa"}],
				receiver_stateOptionList: [{"label":"Abia","value":"Abia"},{"label":"Adamawa","value":"Adamawa"},{"label":"Akwa-Ibom","value":"Akwa-Ibom"}],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Pickup Request';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/pickup_request');
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
