    <template id="propertypartEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Propertypart</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'propertypart/edit/' + data.id" method="post">
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
	var PropertypartEditComponent = Vue.component('propertypartEdit', {
		template : '#propertypartEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'propertypart',
			},
			routename : {
				type : String,
				default : 'propertypartedit',
			},
			apipath : {
				type : String,
				default : 'propertypart/edit',
			},
		},
		data: function() {
			return {
				data : { property_id: '',Name: '',quantity: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Propertypart';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/propertypart');
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
