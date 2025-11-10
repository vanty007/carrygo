    <template id="productsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Products</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="products/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('period')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="period">Period <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.period"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Period"
                                                    class="form-control "
                                                    type="text"
                                                    name="period"
                                                    placeholder="Enter Period"
                                                    />
                                                    <small v-show="errors.has('period')" class="form-text text-danger">
                                                        {{ errors.first('period') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('description')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="description">Description <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.description"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Description"
                                                    class="form-control "
                                                    type="text"
                                                    name="description"
                                                    placeholder="Enter Description"
                                                    />
                                                    <small v-show="errors.has('description')" class="form-text text-danger">
                                                        {{ errors.first('description') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('productid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="productid">Productid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.productid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Productid"
                                                    class="form-control "
                                                    type="text"
                                                    name="productid"
                                                    placeholder="Enter Productid"
                                                    />
                                                    <small v-show="errors.has('productid')" class="form-text text-danger">
                                                        {{ errors.first('productid') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('serviceid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="serviceid">Serviceid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.serviceid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Serviceid"
                                                    class="form-control "
                                                    type="text"
                                                    name="serviceid"
                                                    placeholder="Enter Serviceid"
                                                    />
                                                    <small v-show="errors.has('serviceid')" class="form-text text-danger">
                                                        {{ errors.first('serviceid') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('spid')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="spid">Spid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.spid"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Spid"
                                                    class="form-control "
                                                    type="text"
                                                    name="spid"
                                                    placeholder="Enter Spid"
                                                    />
                                                    <small v-show="errors.has('spid')" class="form-text text-danger">
                                                        {{ errors.first('spid') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('auth')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="auth">Auth <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.auth"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Auth"
                                                    class="form-control "
                                                    type="text"
                                                    name="auth"
                                                    placeholder="Enter Auth"
                                                    />
                                                    <small v-show="errors.has('auth')" class="form-text text-danger">
                                                        {{ errors.first('auth') }}
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
	var ProductsAddComponent = Vue.component('productsAdd', {
		template : '#productsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'products',
			},
			routename : {
				type : String,
				default : 'productsadd',
			},
			apipath : {
				type : String,
				default : 'products/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					name: '',price: '',period: '',description: '',productid: '',serviceid: '',spid: '',auth: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Products';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/products');
			},
			resetForm : function(){
				this.data = {name: '',price: '',period: '',description: '',productid: '',serviceid: '',spid: '',auth: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
