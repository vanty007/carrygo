    <template id="contentsAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Contents</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="contents/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('vet_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="vet_id">Vet Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.vet_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Vet Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="vet_id"
                                                    placeholder="Enter Vet Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('vet_id')" class="form-text text-danger">
                                                        {{ errors.first('vet_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('user_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.user_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="User Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="user_id"
                                                    placeholder="Enter User Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('user_id')" class="form-text text-danger">
                                                        {{ errors.first('user_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('subject')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="subject">Subject <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.subject"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Subject"
                                                    class="form-control "
                                                    type="text"
                                                    name="subject"
                                                    placeholder="Enter Subject"
                                                    />
                                                    <small v-show="errors.has('subject')" class="form-text text-danger">
                                                        {{ errors.first('subject') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contents')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contents">Contents <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.contents"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Contents"
                                                        placeholder="Enter Contents" 
                                                        rows="5" 
                                                        name="contents" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('contents')" class="form-text text-danger">{{ errors.first('contents') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('category_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="category_id">Category Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.category_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Category Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="category_id"
                                                    placeholder="Enter Category Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('category_id')" class="form-text text-danger">
                                                        {{ errors.first('category_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('picture')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="picture">Picture <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.picture"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Picture"
                                                        placeholder="Enter Picture" 
                                                        rows="5" 
                                                        name="picture" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('picture')" class="form-text text-danger">{{ errors.first('picture') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('status')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.status"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Status"
                                                    class="form-control "
                                                    type="number"
                                                    name="status"
                                                    placeholder="Enter Status"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('status')" class="form-text text-danger">
                                                        {{ errors.first('status') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('created_at')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="created_at">Created At <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.created_at"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Created At"
                                                    name="created_at"
                                                    placeholder="Enter Created At"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('created_at')" class="form-text text-danger">{{ errors.first('created_at') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
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
	var ContentsAddComponent = Vue.component('contentsAdd', {
		template : '#contentsAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'contents',
			},
			routename : {
				type : String,
				default : 'contentsadd',
			},
			apipath : {
				type : String,
				default : 'contents/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					vet_id: '',user_id: '',subject: '',contents: '',category_id: '',picture: '',status: '',created_at: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Contents';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/contents');
			},
			resetForm : function(){
				this.data = {vet_id: '',user_id: '',subject: '',contents: '',category_id: '',picture: '',status: '',created_at: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
