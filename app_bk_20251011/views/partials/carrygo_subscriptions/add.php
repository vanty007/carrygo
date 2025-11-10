    <template id="carrygo_subscriptionsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Carrygo Subscriptions</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="carrygo_subscriptions/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('action')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="action">Action <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.action"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Action"
                                                    class="form-control "
                                                    type="text"
                                                    name="action"
                                                    placeholder="Enter Action"
                                                    />
                                                    <small v-show="errors.has('action')" class="form-text text-danger">
                                                        {{ errors.first('action') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('subid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="subid">Subid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.subid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Subid"
                                                    class="form-control "
                                                    type="text"
                                                    name="subid"
                                                    placeholder="Enter Subid"
                                                    />
                                                    <small v-show="errors.has('subid')" class="form-text text-danger">
                                                        {{ errors.first('subid') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pcode')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pcode">Pcode <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pcode"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pcode"
                                                    class="form-control "
                                                    type="text"
                                                    name="pcode"
                                                    placeholder="Enter Pcode"
                                                    />
                                                    <small v-show="errors.has('pcode')" class="form-text text-danger">
                                                        {{ errors.first('pcode') }}
                                                    </small>
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
                                    <div class="form-group " :class="{'has-error' : errors.has('expirydate')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="expirydate">Expirydate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.expirydate"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Expirydate"
                                                    name="expirydate"
                                                    placeholder="Enter Expirydate"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('expirydate')" class="form-text text-danger">{{ errors.first('expirydate') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('requestdate')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="requestdate">Requestdate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.requestdate"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Requestdate"
                                                    name="requestdate"
                                                    placeholder="Enter Requestdate"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('requestdate')" class="form-text text-danger">{{ errors.first('requestdate') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('others')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="others">Others <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.others"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Others"
                                                    class="form-control "
                                                    type="text"
                                                    name="others"
                                                    placeholder="Enter Others"
                                                    />
                                                    <small v-show="errors.has('others')" class="form-text text-danger">
                                                        {{ errors.first('others') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('others1')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="others1">Others1 <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.others1"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Others1"
                                                    class="form-control "
                                                    type="text"
                                                    name="others1"
                                                    placeholder="Enter Others1"
                                                    />
                                                    <small v-show="errors.has('others1')" class="form-text text-danger">
                                                        {{ errors.first('others1') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('others2')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="others2">Others2 <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.others2"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Others2"
                                                    class="form-control "
                                                    type="text"
                                                    name="others2"
                                                    placeholder="Enter Others2"
                                                    />
                                                    <small v-show="errors.has('others2')" class="form-text text-danger">
                                                        {{ errors.first('others2') }}
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
                                    <div class="form-group " :class="{'has-error' : errors.has('cptransid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cptransid">Cptransid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.cptransid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Cptransid"
                                                    class="form-control "
                                                    type="text"
                                                    name="cptransid"
                                                    placeholder="Enter Cptransid"
                                                    />
                                                    <small v-show="errors.has('cptransid')" class="form-text text-danger">
                                                        {{ errors.first('cptransid') }}
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
	var Carrygo_SubscriptionsAddComponent = Vue.component('carrygo_subscriptionsAdd', {
		template : '#carrygo_subscriptionsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'carrygo_subscriptions',
			},
			routename : {
				type : String,
				default : 'carrygo_subscriptionsadd',
			},
			apipath : {
				type : String,
				default : 'carrygo_subscriptions/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					msisdn: '',action: '',subid: '',pcode: '',amount: '',expirydate: '',requestdate: '',others: '',others1: '',others2: '',status: '0',cptransid: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Carrygo Subscriptions';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/carrygo_subscriptions');
			},
			resetForm : function(){
				this.data = {msisdn: '',action: '',subid: '',pcode: '',amount: '',expirydate: '',requestdate: '',others: '',others1: '',others2: '',status: '0',cptransid: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
