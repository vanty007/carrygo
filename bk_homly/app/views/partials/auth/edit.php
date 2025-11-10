    <template id="authEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Auth</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'auth/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('login_system')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="login_system">Login System <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.login_system"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Login System"
                                                    class="form-control "
                                                    type="text"
                                                    name="login_system"
                                                    placeholder="Enter Login System"
                                                    />
                                                    <small v-show="errors.has('login_system')" class="form-text text-danger">
                                                        {{ errors.first('login_system') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('role_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="role_id">Role Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.role_id"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Role Id"
                                                    class="form-control "
                                                    type="text"
                                                    name="role_id"
                                                    placeholder="Enter Role Id"
                                                    />
                                                    <small v-show="errors.has('role_id')" class="form-text text-danger">
                                                        {{ errors.first('role_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('profile_pics')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="profile_pics">Profile Pics <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <niceupload
                                                        fieldname="profile_pics"
                                                        control-class="upload-control"
                                                        dropmsg="Drop files here to upload"
                                                        uploadpath="uploads/files/"
                                                        filenameformat="random" 
                                                        extensions="jpg , png , gif , jpeg"  
                                                        :filesize="3" 
                                                        :maximum="1" 
                                                        name="profile_pics"
                                                        v-model="data.profile_pics"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Profile Pics"
                                                        >
                                                    </niceupload>
                                                    <small v-show="errors.has('profile_pics')" class="form-text text-danger">{{ errors.first('profile_pics') }}</small>
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
	var AuthEditComponent = Vue.component('authEdit', {
		template : '#authEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'auth',
			},
			routename : {
				type : String,
				default : 'authedit',
			},
			apipath : {
				type : String,
				default : 'auth/edit',
			},
		},
		data: function() {
			return {
				data : { login_system: '',role_id: '',profile_pics: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Auth';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/auth');
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
