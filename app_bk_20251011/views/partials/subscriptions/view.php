    <template id="subscriptionsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Subscriptions</h3>
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
                                                    <th class="title"> Msisdn :</th>
                                                    <td class="value"> {{ data.msisdn }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Action :</th>
                                                    <td class="value"> {{ data.action }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Subid :</th>
                                                    <td class="value"> {{ data.subid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Pcode :</th>
                                                    <td class="value"> {{ data.pcode }} </td>
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
                                                    <th class="title"> Requestdate :</th>
                                                    <td class="value"> {{ data.requestdate }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Others :</th>
                                                    <td class="value"> {{ data.others }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Others1 :</th>
                                                    <td class="value"> {{ data.others1 }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Others2 :</th>
                                                    <td class="value"> {{ data.others2 }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Status :</th>
                                                    <td class="value"> {{ data.status }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Cptransid :</th>
                                                    <td class="value"> {{ data.cptransid }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/subscriptions/edit/'  + data.tid">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/subscriptions/delete/' + data.tid">
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
	var SubscriptionsViewComponent = Vue.component('subscriptionsView', {
		template : '#subscriptionsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'subscriptions',
			},
			routename : {
				type : String,
				default : 'subscriptionsview',
			},
			apipath: {
				type : String,
				default : 'subscriptions/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						tid: '',msisdn: '',action: '',subid: '',pcode: '',amount: '',expirydate: '',requestdate: '',others: '',others1: '',others2: '',status: '',cptransid: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Subscriptions';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					tid: '',msisdn: '',action: '',subid: '',pcode: '',amount: '',expirydate: '',requestdate: '',others: '',others1: '',others2: '',status: '',cptransid: '',
				}
			},
		},
	});
	</script>
