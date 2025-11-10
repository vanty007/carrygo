    <template id="reviewView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Review</h3>
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
                                                    <th class="title"> User Id :</th>
                                                    <td class="value"> {{ data.user_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Rating :</th>
                                                    <td class="value"> {{ data.rating }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Comment :</th>
                                                    <td class="value"> {{ data.comment }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Pickup Request Id :</th>
                                                    <td class="value"> {{ data.pickup_request_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created At :</th>
                                                    <td class="value"><router-link :to="'/review/view/' +  data.id">{{data.created_at}}</router-link></td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/review/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/review/delete/' + data.id">
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
	var ReviewViewComponent = Vue.component('reviewView', {
		template : '#reviewView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'review',
			},
			routename : {
				type : String,
				default : 'reviewview',
			},
			apipath: {
				type : String,
				default : 'review/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',user_id: '',rating: '',comment: '',pickup_request_id: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Review';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',user_id: '',rating: '',comment: '',pickup_request_id: '',created_at: '',
				}
			},
		},
	});
	</script>
