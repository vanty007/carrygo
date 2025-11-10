    <template id="vetAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Vet</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="vet/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="name"
                                                    placeholder="Enter Name"
                                                    />
                                                    <small v-show="errors.has('name')" class="form-text text-danger">
                                                        {{ errors.first('name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contactname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contactname">Contactname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.contactname"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Contactname"
                                                    class="form-control "
                                                    type="text"
                                                    name="contactname"
                                                    placeholder="Enter Contactname"
                                                    />
                                                    <small v-show="errors.has('contactname')" class="form-text text-danger">
                                                        {{ errors.first('contactname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contactphone')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contactphone">Contactphone <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.contactphone"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Contactphone"
                                                    class="form-control "
                                                    type="text"
                                                    name="contactphone"
                                                    placeholder="Enter Contactphone"
                                                    />
                                                    <small v-show="errors.has('contactphone')" class="form-text text-danger">
                                                        {{ errors.first('contactphone') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('address')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="address">Address <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.address"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Address"
                                                    class="form-control "
                                                    type="text"
                                                    name="address"
                                                    placeholder="Enter Address"
                                                    />
                                                    <small v-show="errors.has('address')" class="form-text text-danger">
                                                        {{ errors.first('address') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('document')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="document">Document <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.document"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Document"
                                                        placeholder="Enter Document" 
                                                        rows="5" 
                                                        name="document" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('document')" class="form-text text-danger">{{ errors.first('document') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('dum1')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="dum1">Dum1 <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.dum1"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Dum1"
                                                    class="form-control "
                                                    type="text"
                                                    name="dum1"
                                                    placeholder="Enter Dum1"
                                                    />
                                                    <small v-show="errors.has('dum1')" class="form-text text-danger">
                                                        {{ errors.first('dum1') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('dum2')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="dum2">Dum2 <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.dum2"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Dum2"
                                                    class="form-control "
                                                    type="text"
                                                    name="dum2"
                                                    placeholder="Enter Dum2"
                                                    />
                                                    <small v-show="errors.has('dum2')" class="form-text text-danger">
                                                        {{ errors.first('dum2') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('referalname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="referalname">Referalname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.referalname"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Referalname"
                                                    class="form-control "
                                                    type="text"
                                                    name="referalname"
                                                    placeholder="Enter Referalname"
                                                    />
                                                    <small v-show="errors.has('referalname')" class="form-text text-danger">
                                                        {{ errors.first('referalname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('referalphoneno')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="referalphoneno">Referalphoneno <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.referalphoneno"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Referalphoneno"
                                                    class="form-control "
                                                    type="text"
                                                    name="referalphoneno"
                                                    placeholder="Enter Referalphoneno"
                                                    />
                                                    <small v-show="errors.has('referalphoneno')" class="form-text text-danger">
                                                        {{ errors.first('referalphoneno') }}
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
	var VetAddComponent = Vue.component('vetAdd', {
		template : '#vetAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'vet',
			},
			routename : {
				type : String,
				default : 'vetadd',
			},
			apipath : {
				type : String,
				default : 'vet/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					user_id: '',name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '0',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Vet';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/vet');
			},
			resetForm : function(){
				this.data = {user_id: '',name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '0',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
