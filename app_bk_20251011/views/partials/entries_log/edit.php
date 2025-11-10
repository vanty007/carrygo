    <template id="entries_logEdit">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Edit  Entries Log</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'entries_log/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('session_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="session_id">Session Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.session_id"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Session Id"
                                                    class="form-control "
                                                    type="text"
                                                    name="session_id"
                                                    placeholder="Enter Session Id"
                                                    />
                                                    <small v-show="errors.has('session_id')" class="form-text text-danger">
                                                        {{ errors.first('session_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('msisdn')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="msisdn">Msisdn <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.msisdn"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Msisdn"
                                                    class="form-control "
                                                    type="text"
                                                    name="msisdn"
                                                    placeholder="Enter Msisdn"
                                                    />
                                                    <small v-show="errors.has('msisdn')" class="form-text text-danger">
                                                        {{ errors.first('msisdn') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('first_question')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="first_question">First Question <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.first_question"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="First Question"
                                                    class="form-control "
                                                    type="number"
                                                    name="first_question"
                                                    placeholder="Enter First Question"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('first_question')" class="form-text text-danger">
                                                        {{ errors.first('first_question') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('first_answer')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="first_answer">First Answer <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.first_answer"
                                                    v-validate="{required:true}"
                                                    data-vv-as="First Answer"
                                                    class="form-control "
                                                    type="text"
                                                    name="first_answer"
                                                    placeholder="Enter First Answer"
                                                    />
                                                    <small v-show="errors.has('first_answer')" class="form-text text-danger">
                                                        {{ errors.first('first_answer') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('second_question')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="second_question">Second Question <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.second_question"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Second Question"
                                                    class="form-control "
                                                    type="number"
                                                    name="second_question"
                                                    placeholder="Enter Second Question"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('second_question')" class="form-text text-danger">
                                                        {{ errors.first('second_question') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('second_answer')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="second_answer">Second Answer <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.second_answer"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Second Answer"
                                                    class="form-control "
                                                    type="text"
                                                    name="second_answer"
                                                    placeholder="Enter Second Answer"
                                                    />
                                                    <small v-show="errors.has('second_answer')" class="form-text text-danger">
                                                        {{ errors.first('second_answer') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('third_question')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="third_question">Third Question <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.third_question"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Third Question"
                                                    class="form-control "
                                                    type="number"
                                                    name="third_question"
                                                    placeholder="Enter Third Question"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('third_question')" class="form-text text-danger">
                                                        {{ errors.first('third_question') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('third_answer')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="third_answer">Third Answer <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.third_answer"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Third Answer"
                                                    class="form-control "
                                                    type="text"
                                                    name="third_answer"
                                                    placeholder="Enter Third Answer"
                                                    />
                                                    <small v-show="errors.has('third_answer')" class="form-text text-danger">
                                                        {{ errors.first('third_answer') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('question_category')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="question_category">Question Category <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.question_category"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Question Category"
                                                    class="form-control "
                                                    type="number"
                                                    name="question_category"
                                                    placeholder="Enter Question Category"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('question_category')" class="form-text text-danger">
                                                        {{ errors.first('question_category') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('entry_info')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="entry_info">Entry Info <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.entry_info"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Entry Info"
                                                    class="form-control "
                                                    type="text"
                                                    name="entry_info"
                                                    placeholder="Enter Entry Info"
                                                    />
                                                    <small v-show="errors.has('entry_info')" class="form-text text-danger">
                                                        {{ errors.first('entry_info') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('entry_qualification')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="entry_qualification">Entry Qualification <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.entry_qualification"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Entry Qualification"
                                                    class="form-control "
                                                    type="text"
                                                    name="entry_qualification"
                                                    placeholder="Enter Entry Qualification"
                                                    />
                                                    <small v-show="errors.has('entry_qualification')" class="form-text text-danger">
                                                        {{ errors.first('entry_qualification') }}
                                                    </small>
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
                                    <div class="form-group " :class="{'has-error' : errors.has('location')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="location">Location <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.location"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Location"
                                                    class="form-control "
                                                    type="text"
                                                    name="location"
                                                    placeholder="Enter Location"
                                                    />
                                                    <small v-show="errors.has('location')" class="form-text text-danger">
                                                        {{ errors.first('location') }}
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
	var Entries_LogEditComponent = Vue.component('entries_logEdit', {
		template : '#entries_logEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'entries_log',
			},
			routename : {
				type : String,
				default : 'entries_logedit',
			},
			apipath : {
				type : String,
				default : 'entries_log/edit',
			},
		},
		data: function() {
			return {
				data : { session_id: '',msisdn: '',first_question: '',first_answer: '',second_question: '',second_answer: '',third_question: '',third_answer: '',question_category: '',entry_info: '',entry_qualification: '',status: '',location: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Entries Log';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/entries_log');
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
