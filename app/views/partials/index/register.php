    <template id="Register">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-6 comp-grid" :class="setGridSize">
                            <h3 class="record-title">User registration</h3>
                        </div>
                        <div  class="col-md-6 comp-grid" :class="setGridSize">
                            <div class="">
                                <div class="text-right">
                                    Already have an account?  <router-link class="btn btn-primary" to="/"> Login </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('email')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="email">Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.email"
                                                    v-validate="{required:true,  email:true}"
                                                    data-vv-as="Email"
                                                    class="form-control "
                                                    type="email"
                                                    name="email"
                                                    placeholder="Enter Email"
                                                    />
                                                    <small v-show="errors.has('email')" class="form-text text-danger">
                                                        {{ errors.first('email') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <div class="form-group " :class="{'has-error' : errors.has('password')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="password">Password <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.password"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Password"
                                                    class="form-control "
                                                    type="password"
                                                    name="password"
                                                    placeholder="Enter Password"
                                                    />
                                                    <small v-show="errors.has('password')" class="form-text text-danger">
                                                        {{ errors.first('password') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('confirm_password')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input
                                                    v-model="data.confirm_password"
                                                    v-validate="{ required:true, confirmed:'password' }"
                                                    data-vv-as="Confirm Password"
                                                    class="form-control "
                                                    type="password"
                                                    name="confirm_password"
                                                    placeholder="Confirm Password"
                                                    />
                                                    <small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
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
                                    <hr />
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
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
	var RegisterComponent = Vue.component('Register', {
		template : '#Register',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'auth',
			},
			routename : {
				type : String,
				default : 'authuserregister',
			},
			apipath : {
				type : String,
				default : 'index/register',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					email: '',login_system: '',role_id: '',password: '',confirm_password: '',profile_pics: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Auth';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				window.location = response.body;
			},
			resetForm : function(){
				this.data = {email: '',login_system: '',role_id: '',password: '',confirm_password: '',profile_pics: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
