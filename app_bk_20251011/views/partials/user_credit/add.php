    <template id="user_creditAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New User Credit</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="user_credit/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('refid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="refid">Refid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.refid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Refid"
                                                    class="form-control "
                                                    type="text"
                                                    name="refid"
                                                    placeholder="Enter Refid"
                                                    />
                                                    <small v-show="errors.has('refid')" class="form-text text-danger">
                                                        {{ errors.first('refid') }}
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
	var User_CreditAddComponent = Vue.component('user_creditAdd', {
		template : '#user_creditAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'user_credit',
			},
			routename : {
				type : String,
				default : 'user_creditadd',
			},
			apipath : {
				type : String,
				default : 'user_credit/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					msisdn: '',amount: '',refid: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New User Credit';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/user_credit');
			},
			resetForm : function(){
				this.data = {msisdn: '',amount: '',refid: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
