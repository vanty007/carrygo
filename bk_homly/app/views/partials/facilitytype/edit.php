    <template id="facilitytypeEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Facilitytype</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'facilitytype/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('facilitytype_name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="facilitytype_name">Facilitytype Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.facilitytype_name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Facilitytype Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="facilitytype_name"
                                                    placeholder="Enter Facilitytype Name"
                                                    />
                                                    <small v-show="errors.has('facilitytype_name')" class="form-text text-danger">
                                                        {{ errors.first('facilitytype_name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('category')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="category">Category <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.category"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Category"
                                                    class="form-control "
                                                    type="text"
                                                    name="category"
                                                    placeholder="Enter Category"
                                                    />
                                                    <small v-show="errors.has('category')" class="form-text text-danger">
                                                        {{ errors.first('category') }}
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
	var FacilitytypeEditComponent = Vue.component('facilitytypeEdit', {
		template : '#facilitytypeEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'facilitytype',
			},
			routename : {
				type : String,
				default : 'facilitytypeedit',
			},
			apipath : {
				type : String,
				default : 'facilitytype/edit',
			},
		},
		data: function() {
			return {
				data : { facilitytype_name: '',category: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Facilitytype';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/facilitytype');
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
