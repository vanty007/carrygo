    <template id="propertypartAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Propertypart</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="propertypart/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('property_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="property_id">Property Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.property_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Property Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="property_id"
                                                    placeholder="Enter Property Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('property_id')" class="form-text text-danger">
                                                        {{ errors.first('property_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('Name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="Name">Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.Name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="Name"
                                                    placeholder="Enter Name"
                                                    />
                                                    <small v-show="errors.has('Name')" class="form-text text-danger">
                                                        {{ errors.first('Name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('quantity')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.quantity"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Quantity"
                                                    class="form-control "
                                                    type="number"
                                                    name="quantity"
                                                    placeholder="Enter Quantity"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('quantity')" class="form-text text-danger">
                                                        {{ errors.first('quantity') }}
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
	var PropertypartAddComponent = Vue.component('propertypartAdd', {
		template : '#propertypartAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'propertypart',
			},
			routename : {
				type : String,
				default : 'propertypartadd',
			},
			apipath : {
				type : String,
				default : 'propertypart/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					property_id: '',Name: '',quantity: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Propertypart';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/propertypart');
			},
			resetForm : function(){
				this.data = {property_id: '',Name: '',quantity: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
