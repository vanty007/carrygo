    <template id="productsView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Products</h3>
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
                                                    <th class="title"> Name :</th>
                                                    <td class="value"> {{ data.name }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Price :</th>
                                                    <td class="value"> {{ data.price }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Period :</th>
                                                    <td class="value"> {{ data.period }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Description :</th>
                                                    <td class="value"> {{ data.description }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Productid :</th>
                                                    <td class="value"> {{ data.productid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Serviceid :</th>
                                                    <td class="value"> {{ data.serviceid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Spid :</th>
                                                    <td class="value"> {{ data.spid }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Auth :</th>
                                                    <td class="value"> {{ data.auth }} </td>
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
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/products/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/products/delete/' + data.id">
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
	var ProductsViewComponent = Vue.component('productsView', {
		template : '#productsView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'products',
			},
			routename : {
				type : String,
				default : 'productsview',
			},
			apipath: {
				type : String,
				default : 'products/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',name: '',price: '',period: '',description: '',productid: '',serviceid: '',spid: '',auth: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Products';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',name: '',price: '',period: '',description: '',productid: '',serviceid: '',spid: '',auth: '',created_at: '',
				}
			},
		},
	});
	</script>
