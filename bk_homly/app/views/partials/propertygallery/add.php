    <template id="propertygalleryAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Propertygallery</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="propertygallery/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('pictures')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pictures">Pictures <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="pictures"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        :multiple="true"
                                                        name="pictures"
                                                        v-model="data.pictures"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Pictures"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('pictures')" class="form-text text-danger">{{ errors.first('pictures') }}</small>
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
                                                    <textarea
                                                        v-model="data.description"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Description"
                                                        placeholder="Enter Description" 
                                                        rows="5" 
                                                        name="description" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('description')" class="form-text text-danger">{{ errors.first('description') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('thumbnail')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.thumbnail"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Thumbnail"
                                                        placeholder="Enter Thumbnail" 
                                                        rows="5" 
                                                        name="thumbnail" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('thumbnail')" class="form-text text-danger">{{ errors.first('thumbnail') }}</small>
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
	var PropertygalleryAddComponent = Vue.component('propertygalleryAdd', {
		template : '#propertygalleryAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'propertygallery',
			},
			routename : {
				type : String,
				default : 'propertygalleryadd',
			},
			apipath : {
				type : String,
				default : 'propertygallery/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					property_id: '',pictures: '',description: '',thumbnail: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Propertygallery';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/propertygallery');
			},
			resetForm : function(){
				this.data = {property_id: '',pictures: '',description: '',thumbnail: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
