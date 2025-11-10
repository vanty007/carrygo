    <template id="propertylocationsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Propertylocations</h3>
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
                                                    <th class="title"> Location Name :</th>
                                                    <td class="value"> {{ data.location_name }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Area :</th>
                                                    <td class="value"> {{ data.area }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> City :</th>
                                                    <td class="value"> {{ data.city }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> State :</th>
                                                    <td class="value"> {{ data.state }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Country :</th>
                                                    <td class="value"> {{ data.country }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/propertylocations/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/propertylocations/delete/' + data.id">
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
	var PropertylocationsViewComponent = Vue.component('propertylocationsView', {
		template : '#propertylocationsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'propertylocations',
			},
			routename : {
				type : String,
				default : 'propertylocationsview',
			},
			apipath: {
				type : String,
				default : 'propertylocations/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',location_name: '',area: '',city: '',state: '',country: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Propertylocations';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',location_name: '',area: '',city: '',state: '',country: '',
				}
			},
		},
	});
	</script>
