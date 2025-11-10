    <template id="chargetypeAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Chargetype</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="chargetype/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('frequency')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="frequency">Frequency <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.frequency"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Frequency"
                                                    class="form-control "
                                                    type="text"
                                                    name="frequency"
                                                    placeholder="Enter Frequency"
                                                    />
                                                    <small v-show="errors.has('frequency')" class="form-text text-danger">
                                                        {{ errors.first('frequency') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('rate')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rate">Rate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rate"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Rate"
                                                    class="form-control "
                                                    type="text"
                                                    name="rate"
                                                    placeholder="Enter Rate"
                                                    />
                                                    <small v-show="errors.has('rate')" class="form-text text-danger">
                                                        {{ errors.first('rate') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('price')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="price">Price <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.price"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Price"
                                                    class="form-control "
                                                    type="text"
                                                    name="price"
                                                    placeholder="Enter Price"
                                                    />
                                                    <small v-show="errors.has('price')" class="form-text text-danger">
                                                        {{ errors.first('price') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('discount')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="discount">Discount <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.discount"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Discount"
                                                    class="form-control "
                                                    type="number"
                                                    name="discount"
                                                    placeholder="Enter Discount"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('discount')" class="form-text text-danger">
                                                        {{ errors.first('discount') }}
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
	var ChargetypeAddComponent = Vue.component('chargetypeAdd', {
		template : '#chargetypeAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'chargetype',
			},
			routename : {
				type : String,
				default : 'chargetypeadd',
			},
			apipath : {
				type : String,
				default : 'chargetype/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					frequency: '',rate: '',price: '',discount: '0',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Chargetype';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/chargetype');
			},
			resetForm : function(){
				this.data = {frequency: '',rate: '',price: '',discount: '0',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
