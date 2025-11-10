    <template id="paymentsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Payments</h3>
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
                                                    <th class="title"> Request Id :</th>
                                                    <td class="value"> {{ data.request_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Payer :</th>
                                                    <td class="value"> {{ data.payer }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Picture :</th>
                                                    <td class="value"> {{ data.picture }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created At :</th>
                                                    <td class="value"> {{ data.created_at }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Payment Method :</th>
                                                    <td class="value"><router-link :to="'/payments/view/' +  data.id">{{data.payment_method}}</router-link></td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/payments/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/payments/delete/' + data.id">
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
	var PaymentsViewComponent = Vue.component('paymentsView', {
		template : '#paymentsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'payments',
			},
			routename : {
				type : String,
				default : 'paymentsview',
			},
			apipath: {
				type : String,
				default : 'payments/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',request_id: '',payer: '',picture: '',status: '',created_at: '',payment_method: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Payments';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',request_id: '',payer: '',picture: '',status: '',created_at: '',payment_method: '',
				}
			},
		},
	});
	</script>
