    <template id="questions_logAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Questions Log</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="questions_log/add" method="post">
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
                                    <div class="form-group " :class="{'has-error' : errors.has('question')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="question">Question <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.question"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Question"
                                                    class="form-control "
                                                    type="text"
                                                    name="question"
                                                    placeholder="Enter Question"
                                                    />
                                                    <small v-show="errors.has('question')" class="form-text text-danger">
                                                        {{ errors.first('question') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('created_date')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="created_date">Created Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.created_date"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Created Date"
                                                    name="created_date"
                                                    placeholder="Enter Created Date"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('created_date')" class="form-text text-danger">{{ errors.first('created_date') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
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
                                    <div class="form-group " :class="{'has-error' : errors.has('created_by')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="created_by">Created By <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.created_by"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Created By"
                                                    class="form-control "
                                                    type="text"
                                                    name="created_by"
                                                    placeholder="Enter Created By"
                                                    />
                                                    <small v-show="errors.has('created_by')" class="form-text text-danger">
                                                        {{ errors.first('created_by') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('valid_option')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="valid_option">Valid Option <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.valid_option"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Valid Option"
                                                    class="form-control "
                                                    type="text"
                                                    name="valid_option"
                                                    placeholder="Enter Valid Option"
                                                    />
                                                    <small v-show="errors.has('valid_option')" class="form-text text-danger">
                                                        {{ errors.first('valid_option') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('quest_language')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="quest_language">Quest Language <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.quest_language"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Quest Language"
                                                    class="form-control "
                                                    type="number"
                                                    name="quest_language"
                                                    placeholder="Enter Quest Language"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('quest_language')" class="form-text text-danger">
                                                        {{ errors.first('quest_language') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('wildanswers')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="wildanswers">Wildanswers <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.wildanswers"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Wildanswers"
                                                    class="form-control "
                                                    type="text"
                                                    name="wildanswers"
                                                    placeholder="Enter Wildanswers"
                                                    />
                                                    <small v-show="errors.has('wildanswers')" class="form-text text-danger">
                                                        {{ errors.first('wildanswers') }}
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
	var Questions_LogAddComponent = Vue.component('questions_logAdd', {
		template : '#questions_logAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'questions_log',
			},
			routename : {
				type : String,
				default : 'questions_logadd',
			},
			apipath : {
				type : String,
				default : 'questions_log/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					question_category: '',question: '',created_date: '',status: '0',created_by: '',valid_option: '',quest_language: '0',wildanswers: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Questions Log';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/questions_log');
			},
			resetForm : function(){
				this.data = {question_category: '',question: '',created_date: '',status: '0',created_by: '',valid_option: '',quest_language: '0',wildanswers: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
