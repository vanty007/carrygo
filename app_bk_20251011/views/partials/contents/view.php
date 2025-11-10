    <template id="contentsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Contents</h3>
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
                                                    <th class="title"> Vet Id :</th>
                                                    <td class="value"> {{ data.vet_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> User Id :</th>
                                                    <td class="value"> {{ data.user_id }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Subject :</th>
                                                    <td class="value"> {{ data.subject }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Contents :</th>
                                                    <td class="value"> {{ data.contents }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Category Id :</th>
                                                    <td class="value"> {{ data.category_id }} </td>
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
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/contents/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/contents/delete/' + data.id">
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
	var ContentsViewComponent = Vue.component('contentsView', {
		template : '#contentsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'contents',
			},
			routename : {
				type : String,
				default : 'contentsview',
			},
			apipath: {
				type : String,
				default : 'contents/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',vet_id: '',user_id: '',subject: '',contents: '',category_id: '',picture: '',status: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Contents';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',vet_id: '',user_id: '',subject: '',contents: '',category_id: '',picture: '',status: '',created_at: '',
				}
			},
		},
	});
	</script>
