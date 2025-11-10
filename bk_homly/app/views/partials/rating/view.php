    <template id="ratingView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Rating</h3>
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
                                                    <th class="title"> Rate :</th>
                                                    <td class="value"> {{ data.rate }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Review :</th>
                                                    <td class="value"> {{ data.review }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Propertylist Id :</th>
                                                    <td class="value"> {{ data.propertylist_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Created At :</th>
                                                    <td class="value"> {{ data.created_at }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Title Rate :</th>
                                                    <td class="value"><router-link :to="'/rating/view/' +  data.id">{{data.title_rate}}</router-link></td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/rating/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/rating/delete/' + data.id">
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
	var RatingViewComponent = Vue.component('ratingView', {
		template : '#ratingView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'rating',
			},
			routename : {
				type : String,
				default : 'ratingview',
			},
			apipath: {
				type : String,
				default : 'rating/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',user_id: '',rate: '',review: '',propertylist_id: '',created_at: '',title_rate: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Rating';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',user_id: '',rate: '',review: '',propertylist_id: '',created_at: '',title_rate: '',
				}
			},
		},
	});
	</script>
