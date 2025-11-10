    <template id="userAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New User</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="user/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('phoneno')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="phoneno">Phoneno <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.phoneno"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Phoneno"
                                                    class="form-control "
                                                    type="text"
                                                    name="phoneno"
                                                    placeholder="Enter Phoneno"
                                                    />
                                                    <small v-show="errors.has('phoneno')" class="form-text text-danger">
                                                        {{ errors.first('phoneno') }}
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
                                                    v-validate="{required:true,  max:255}"
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
                                    <div class="form-group " :class="{'has-error' : errors.has('firstname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.firstname"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Firstname"
                                                    class="form-control "
                                                    type="text"
                                                    name="firstname"
                                                    placeholder="Enter Firstname"
                                                    />
                                                    <small v-show="errors.has('firstname')" class="form-text text-danger">
                                                        {{ errors.first('firstname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('lastname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.lastname"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Lastname"
                                                    class="form-control "
                                                    type="text"
                                                    name="lastname"
                                                    placeholder="Enter Lastname"
                                                    />
                                                    <small v-show="errors.has('lastname')" class="form-text text-danger">
                                                        {{ errors.first('lastname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('title')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.title"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Title"
                                                    class="form-control "
                                                    type="text"
                                                    name="title"
                                                    placeholder="Enter Title"
                                                    />
                                                    <small v-show="errors.has('title')" class="form-text text-danger">
                                                        {{ errors.first('title') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('sex')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="sex">Sex <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataradio
                                                        v-model="data.sex"
                                                        data-vv-value-path="data.sex"
                                                        data-vv-as="Sex"
                                                        v-validate="{required:true}"
                                                        name="sex" 
                                                        :datasource="sexOptionList"
                                                        >
                                                    </dataradio>
                                                    <small v-show="errors.has('sex')" class="form-text text-danger">{{ errors.first('sex') }}</small>
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
	var UserAddComponent = Vue.component('userAdd', {
		template : '#userAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'user',
			},
			routename : {
				type : String,
				default : 'useradd',
			},
			apipath : {
				type : String,
				default : 'user/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					email: '',phoneno: '',password: '',confirm_password: '',role_id: 'user',firstname: '',lastname: '',title: '',sex: '',profile_pics: '',
				},
				sexOptionList: ["Male","Female"],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New User';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/user');
			},
			resetForm : function(){
				this.data = {email: '',phoneno: '',password: '',confirm_password: '',role_id: 'user',firstname: '',lastname: '',title: '',sex: '',profile_pics: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
