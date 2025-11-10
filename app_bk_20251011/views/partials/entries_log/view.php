    <template id="entries_logView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Entries Log</h3>
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
                                                    <th class="title"> Session Id :</th>
                                                    <td class="value"> {{ data.session_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Msisdn :</th>
                                                    <td class="value"> {{ data.msisdn }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> First Question :</th>
                                                    <td class="value"> {{ data.first_question }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> First Answer :</th>
                                                    <td class="value"> {{ data.first_answer }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Second Question :</th>
                                                    <td class="value"> {{ data.second_question }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Second Answer :</th>
                                                    <td class="value"> {{ data.second_answer }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Third Question :</th>
                                                    <td class="value"> {{ data.third_question }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Third Answer :</th>
                                                    <td class="value"> {{ data.third_answer }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Entrie Date :</th>
                                                    <td class="value"> {{ data.entrie_date }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Last Answer Date :</th>
                                                    <td class="value"> {{ data.last_answer_date }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Question Category :</th>
                                                    <td class="value"> {{ data.question_category }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Entry Info :</th>
                                                    <td class="value"> {{ data.entry_info }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Entry Qualification :</th>
                                                    <td class="value"> {{ data.entry_qualification }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Location :</th>
                                                    <td class="value"> {{ data.location }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/entries_log/edit/'  + data.tid">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/entries_log/delete/' + data.tid">
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
	var Entries_LogViewComponent = Vue.component('entries_logView', {
		template : '#entries_logView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'entries_log',
			},
			routename : {
				type : String,
				default : 'entries_logview',
			},
			apipath: {
				type : String,
				default : 'entries_log/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						tid: '',session_id: '',msisdn: '',first_question: '',first_answer: '',second_question: '',second_answer: '',third_question: '',third_answer: '',entrie_date: '',last_answer_date: '',question_category: '',entry_info: '',entry_qualification: '',status: '',location: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Entries Log';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					tid: '',session_id: '',msisdn: '',first_question: '',first_answer: '',second_question: '',second_answer: '',third_question: '',third_answer: '',entrie_date: '',last_answer_date: '',question_category: '',entry_info: '',entry_qualification: '',status: '',location: '',
				}
			},
		},
	});
	</script>
