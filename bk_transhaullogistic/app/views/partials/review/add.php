    <template id="reviewAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Review</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="review/add" method="post">
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
	var ReviewAddComponent = Vue.component('reviewAdd', {
		template : '#reviewAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'review',
			},
			routename : {
				type : String,
				default : 'reviewadd',
			},
			apipath : {
				type : String,
				default : 'review/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					user_id: '',rating: '',comment: '',pickup_request_id: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Review';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/review');
			},
			resetForm : function(){
				this.data = {user_id: '',rating: '',comment: '',pickup_request_id: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
