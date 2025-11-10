    <template id="chargetypeEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Chargetype</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'chargetype/edit/' + data.id" method="post">
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
	var ChargetypeEditComponent = Vue.component('chargetypeEdit', {
		template : '#chargetypeEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'chargetype',
			},
			routename : {
				type : String,
				default : 'chargetypeedit',
			},
			apipath : {
				type : String,
				default : 'chargetype/edit',
			},
		},
		data: function() {
			return {
				data : { frequency: '',rate: '',price: '',discount: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Chargetype';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/chargetype');
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
