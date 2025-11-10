    <template id="ratingEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Rating</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'rating/edit/' + data.id" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('rate')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rate">Rate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rate"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Rate"
                                                    class="form-control "
                                                    type="number"
                                                    name="rate"
                                                    placeholder="Enter Rate"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('rate')" class="form-text text-danger">
                                                        {{ errors.first('rate') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('review')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="review">Review <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea
                                                        v-model="data.review"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Review"
                                                        placeholder="Enter Review" 
                                                        rows="5" 
                                                        name="review" 
                                                    class=" form-control"></textarea>
                                                    <small v-show="errors.has('review')" class="form-text text-danger">{{ errors.first('review') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('propertylist_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="propertylist_id">Propertylist Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.propertylist_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Propertylist Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="propertylist_id"
                                                    placeholder="Enter Propertylist Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('propertylist_id')" class="form-text text-danger">
                                                        {{ errors.first('propertylist_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('title_rate')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="title_rate">Title Rate <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.title_rate"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Title Rate"
                                                    class="form-control "
                                                    type="text"
                                                    name="title_rate"
                                                    placeholder="Enter Title Rate"
                                                    />
                                                    <small v-show="errors.has('title_rate')" class="form-text text-danger">
                                                        {{ errors.first('title_rate') }}
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
	var RatingEditComponent = Vue.component('ratingEdit', {
		template : '#ratingEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'rating',
			},
			routename : {
				type : String,
				default : 'ratingedit',
			},
			apipath : {
				type : String,
				default : 'rating/edit',
			},
		},
		data: function() {
			return {
				data : { user_id: '',rate: '',review: '',propertylist_id: '',title_rate: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Rating';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/rating');
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
