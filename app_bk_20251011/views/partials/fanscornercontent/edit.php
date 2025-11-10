<template id="questions_logEdit">
    <div>
      <div id="wrapper">
         <!-- Header Container
            ================================================== -->
         <header id="header-container" class="fixed fullwidth dashboard">
            <!-- Header -->

            <!-- Header / End -->
         </header>
         <div class="clearfix"></div>
         <!-- Header Container / End -->
         <!-- Dashboard -->
         <div id="dashboard">
            <!-- Navigation
               ================================================== -->
            <!-- Responsive Navigation Trigger -->
            <a style="cursor: pointer;" id="dashboard-responsive-nav-trigger" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>
            <div class="dashboard-nav">
               <div class="dashboard-nav-inner">
                  <ul data-submenu-title="Main">
                  <li  onclick="fhome()"><a style="cursor: pointer;"><i class="sl sl-icon-screen-desktop"></i> Dashboard</a></li>
					 <li class="active">
						<a><i class="sl sl-icon-layers"></i>M-Health Service</a>
						<ul>
							<li onclick="fsubscriptions()"><a style="cursor: pointer;">Subscriptions</a></li>
							<li onclick="fcontents()"><a style="cursor: pointer;">Contents</a></li>
							<li onclick="fquestions_log()"><a style="cursor: pointer;">Question & Answer Content</a></li>
							<li onclick="fentries_log()"><a style="cursor: pointer;">Trivia Results</a></li>
							<li onclick="fuser_credit()"><a style="cursor: pointer;">Daily Winners</a></li>
						</ul>
					</li>
					<li>
						<a><i class="sl sl-icon-layers"></i>Carry Go Service</a>
						<ul>
							<li onclick="fcarrygo_bid()"><a style="cursor: pointer;">Bid Contents</a></li>
							<!--<li><a href="#contents">Bid Contents</a></li>
							<li><a href="#entry_logs">Bid Results</a></li>
							<li><a href="#user_airtime">Daily Winners</a></li>-->
						</ul>
					</li>
                  </ul>
                  <ul data-submenu-title="Account">
                     <li><a style="cursor: pointer;" href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
                  </ul>
               </div>
            </div>
            <!-- Navigation / End -->
            <!-- Content
               ================================================== -->
            <div class="dashboard-content">
               <!-- Titlebar -->
               <div id="titlebar">
                  <div class="row">
                     <div class="col-md-12">
                        <div v-if="searchfield" class="col-sm-5 comp-grid" :class="setGridSize">
                            <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control" type="text" name="search" placeholder="Search" />
                        </div>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                           <ul>
                              <li><a style="cursor: pointer;" href="#">Home</a></li>
                              <li>Question and Answers</li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>

			   <div class="row">
					<div class="col-12">
						<div class="card my-4">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
							<div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
								<h6 class="text-white text-capitalize ps-3">Edit Trivia Question and Answers</h6>
							</div>
							</div>
							<div class="card-body px-0 pb-2">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'questions_log/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('question_category')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="question_category">Animal Category <span class="text-danger">*</span></label>
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
                                                <label class="control-label" for="quest_language">Question Number Position <span class="text-danger">*</span></label>
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
                                                <label class="control-label" for="wildanswers">Options Structure <span class="text-danger">*</span></label>
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
            <!-- Content / End -->
         </div>
         <!-- Dashboard / End -->
      </div>
   </div>
</template>
    <script>
	var Questions_LogEditComponent = Vue.component('questions_logEdit', {
		template : '#questions_logEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'questions_log',
			},
			routename : {
				type : String,
				default : 'questions_logedit',
			},
			apipath : {
				type : String,
				default : 'questions_log/edit',
			},
		},
		data: function() {
			return {
				data : { question_category: '',question: '',valid_option: '',quest_language: '',wildanswers: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Questions Log';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/questions_log');
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
