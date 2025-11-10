    <template id="user_creditView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  User Credit</h3>
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
                                                    <th class="title"> Id :</th>
                                                    <td class="value"> {{ data.id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Msisdn :</th>
                                                    <td class="value"> {{ data.msisdn }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Amount :</th>
                                                    <td class="value"> {{ data.amount }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Refid :</th>
                                                    <td class="value"> {{ data.refid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created At :</th>
                                                    <td class="value"> {{ data.created_at }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/user_credit/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/user_credit/delete/' + data.id">
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
	var User_CreditViewComponent = Vue.component('user_creditView', {
		template : '#user_creditView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'user_credit',
			},
			routename : {
				type : String,
				default : 'user_creditview',
			},
			apipath: {
				type : String,
				default : 'user_credit/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',msisdn: '',amount: '',refid: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  User Credit';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',msisdn: '',amount: '',refid: '',created_at: '',
				}
			},
		},
	});
	</script>
