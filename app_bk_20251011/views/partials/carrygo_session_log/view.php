    <template id="carrygo_session_logView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Carrygo Session Log</h3>
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
                                                    <th class="title"> Pcode :</th>
                                                    <td class="value"> {{ data.pcode }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Session Date :</th>
                                                    <td class="value"> {{ data.session_date }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Session Duration Millis :</th>
                                                    <td class="value"> {{ data.session_duration_millis }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Subid :</th>
                                                    <td class="value"> {{ data.subid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Amount :</th>
                                                    <td class="value"> {{ data.amount }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Expirydate :</th>
                                                    <td class="value"> {{ data.expirydate }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Doiflag :</th>
                                                    <td class="value"> {{ data.doiflag }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Channel :</th>
                                                    <td class="value"> {{ data.channel }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/carrygo_session_log/edit/'  + data.tid">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/carrygo_session_log/delete/' + data.tid">
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
	var Carrygo_Session_LogViewComponent = Vue.component('carrygo_session_logView', {
		template : '#carrygo_session_logView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'carrygo_session_log',
			},
			routename : {
				type : String,
				default : 'carrygo_session_logview',
			},
			apipath: {
				type : String,
				default : 'carrygo_session_log/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						tid: '',session_id: '',msisdn: '',pcode: '',session_date: '',status: '',session_duration_millis: '',subid: '',amount: '',expirydate: '',doiflag: '',channel: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Carrygo Session Log';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					tid: '',session_id: '',msisdn: '',pcode: '',session_date: '',status: '',session_duration_millis: '',subid: '',amount: '',expirydate: '',doiflag: '',channel: '',
				}
			},
		},
	});
	</script>
