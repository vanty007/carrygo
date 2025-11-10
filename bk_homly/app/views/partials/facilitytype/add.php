    <template id="facilitytypeAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Facilitytype</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="facilitytype/add" method="post">
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
	var FacilitytypeAddComponent = Vue.component('facilitytypeAdd', {
		template : '#facilitytypeAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'facilitytype',
			},
			routename : {
				type : String,
				default : 'facilitytypeadd',
			},
			apipath : {
				type : String,
				default : 'facilitytype/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					facilitytype_name: '',category: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Facilitytype';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/facilitytype');
			},
			resetForm : function(){
				this.data = {facilitytype_name: '',category: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
