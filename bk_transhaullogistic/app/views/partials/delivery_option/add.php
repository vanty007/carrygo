    <template id="delivery_optionAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Delivery Option</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="delivery_option/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('items')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="items">Items <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.items"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Items"
                                                    class="form-control "
                                                    type="text"
                                                    name="items"
                                                    placeholder="Enter Items"
                                                    />
                                                    <small v-show="errors.has('items')" class="form-text text-danger">
                                                        {{ errors.first('items') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('delivery_option')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="delivery_option">Delivery Option <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.delivery_option"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Delivery Option"
                                                    class="form-control "
                                                    type="text"
                                                    name="delivery_option"
                                                    placeholder="Enter Delivery Option"
                                                    />
                                                    <small v-show="errors.has('delivery_option')" class="form-text text-danger">
                                                        {{ errors.first('delivery_option') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pricing_per_km')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pricing_per_km">Pricing Per Km <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pricing_per_km"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pricing Per Km"
                                                    class="form-control "
                                                    type="text"
                                                    name="pricing_per_km"
                                                    placeholder="Enter Pricing Per Km"
                                                    />
                                                    <small v-show="errors.has('pricing_per_km')" class="form-text text-danger">
                                                        {{ errors.first('pricing_per_km') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pricing_higher_km')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pricing_higher_km">Pricing Higher Km <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pricing_higher_km"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pricing Higher Km"
                                                    class="form-control "
                                                    type="text"
                                                    name="pricing_higher_km"
                                                    placeholder="Enter Pricing Higher Km"
                                                    />
                                                    <small v-show="errors.has('pricing_higher_km')" class="form-text text-danger">
                                                        {{ errors.first('pricing_higher_km') }}
                                                    </small>
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
	var Delivery_OptionAddComponent = Vue.component('delivery_optionAdd', {
		template : '#delivery_optionAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'delivery_option',
			},
			routename : {
				type : String,
				default : 'delivery_optionadd',
			},
			apipath : {
				type : String,
				default : 'delivery_option/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					items: '',delivery_option: '',pricing_per_km: '',pricing_higher_km: '',totalamount: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Delivery Option';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/delivery_option');
			},
			resetForm : function(){
				this.data = {items: '',delivery_option: '',pricing_per_km: '',pricing_higher_km: '',totalamount: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
