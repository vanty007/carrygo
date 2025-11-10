    <template id="reviewEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Review</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'review/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('user_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.user_id"
                                                    v-validate="{required:true}"
                                                    data-vv-as="User Id"
                                                    class="form-control "
                                                    type="text"
                                                    name="user_id"
                                                    placeholder="Enter User Id"
                                                    />
                                                    <small v-show="errors.has('user_id')" class="form-text text-danger">
                                                        {{ errors.first('user_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('rating')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rating">Rating <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rating"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Rating"
                                                    class="form-control "
                                                    type="number"
                                                    name="rating"
                                                    placeholder="Enter Rating"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('rating')" class="form-text text-danger">
                                                        {{ errors.first('rating') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('comment')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="comment">Comment <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.comment"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Comment"
                                                        placeholder="Enter Comment" 
                                                        rows="5" 
                                                        name="comment" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('comment')" class="form-text text-danger">{{ errors.first('comment') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pickup_request_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pickup_request_id">Pickup Request Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pickup_request_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Pickup Request Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="pickup_request_id"
                                                    placeholder="Enter Pickup Request Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('pickup_request_id')" class="form-text text-danger">
                                                        {{ errors.first('pickup_request_id') }}
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
	var ReviewEditComponent = Vue.component('reviewEdit', {
		template : '#reviewEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'review',
			},
			routename : {
				type : String,
				default : 'reviewedit',
			},
			apipath : {
				type : String,
				default : 'review/edit',
			},
		},
		data: function() {
			return {
				data : { user_id: '',rating: '',comment: '',pickup_request_id: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Review';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/review');
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
