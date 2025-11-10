    <template id="questions_logView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Questions Log</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div v-show="!loading">
                                    <div ref="datatable" id="datatable">
                                        <table class="table table-hover table-borderless table-striped">
                                            <!-- Table Body Start -->
                                            <tbody>
                                                <tr>
                                                    <th class="title"> Tid :</th>
                                                    <td class="value"> {{ data.tid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Question Category :</th>
                                                    <td class="value"> {{ data.question_category }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Question :</th>
                                                    <td class="value"> {{ data.question }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created Date :</th>
                                                    <td class="value"> {{ data.created_date }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created By :</th>
                                                    <td class="value"> {{ data.created_by }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Valid Option :</th>
                                                    <td class="value"> {{ data.valid_option }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Quest Language :</th>
                                                    <td class="value"> {{ data.quest_language }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Wildanswers :</th>
                                                    <td class="value"> {{ data.wildanswers }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/questions_log/edit/'  + data.tid">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/questions_log/delete/' + data.tid">
                                            <i class="fa fa-times"></i> </button>
                                        </span>
                                        <button @click="exportRecord" class="btn btn-sm btn-primary" v-if="exportbutton">
                                            <i class="fa fa-save"></i> 
                                        </button>
                                    </div>
                                </div>
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
	var Questions_LogViewComponent = Vue.component('questions_logView', {
		template : '#questions_logView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'questions_log',
			},
			routename : {
				type : String,
				default : 'questions_logview',
			},
			apipath: {
				type : String,
				default : 'questions_log/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						tid: '',question_category: '',question: '',created_date: '',status: '',created_by: '',valid_option: '',quest_language: '',wildanswers: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Questions Log';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					tid: '',question_category: '',question: '',created_date: '',status: '',created_by: '',valid_option: '',quest_language: '',wildanswers: '',
				}
			},
		},
	});
	</script>
