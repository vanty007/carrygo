    <template id="categoryAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Category</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="category/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('type')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="type">Type <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.type"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Type"
                                                    class="form-control "
                                                    type="text"
                                                    name="type"
                                                    placeholder="Enter Type"
                                                    />
                                                    <small v-show="errors.has('type')" class="form-text text-danger">
                                                        {{ errors.first('type') }}
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
	var CategoryAddComponent = Vue.component('categoryAdd', {
		template : '#categoryAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'category',
			},
			routename : {
				type : String,
				default : 'categoryadd',
			},
			apipath : {
				type : String,
				default : 'category/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					name: '',type: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Category';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/category');
			},
			resetForm : function(){
				this.data = {name: '',type: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
