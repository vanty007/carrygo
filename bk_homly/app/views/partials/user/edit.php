    <template id="userEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  User</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'user/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('auth_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="auth_id">Auth Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.auth_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Auth Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="auth_id"
                                                    placeholder="Enter Auth Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('auth_id')" class="form-text text-danger">
                                                        {{ errors.first('auth_id') }}
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
	var UserEditComponent = Vue.component('userEdit', {
		template : '#userEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'user',
			},
			routename : {
				type : String,
				default : 'useredit',
			},
			apipath : {
				type : String,
				default : 'user/edit',
			},
		},
		data: function() {
			return {
				data : { auth_id: '',firstname: '',lastname: '',title: '',sex: '', },
				sexOptionList: ["Male","Female"],
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  User';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/user');
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
