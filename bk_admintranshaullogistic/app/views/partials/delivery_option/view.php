    <template id="delivery_optionView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Delivery Option</h3>
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
                                                    <th class="title"> Items :</th>
                                                    <td class="value"> {{ data.items }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Delivery Option :</th>
                                                    <td class="value"> {{ data.delivery_option }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Pricing Per Km :</th>
                                                    <td class="value"> {{ data.pricing_per_km }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Pricing Higher Km :</th>
                                                    <td class="value"> {{ data.pricing_higher_km }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Totalamount :</th>
                                                    <td class="value"> {{ data.totalamount }} </td>
                                                </tr>
                                            </tbody>
                                            <!-- Table Body End -->
                                        </table>
                                    </div>
                                    <div v-if="editbutton || deletebutton || exportbutton" class="py-3">
                                        <span >
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/delivery_option/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/delivery_option/delete/' + data.id">
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
	var Delivery_OptionViewComponent = Vue.component('delivery_optionView', {
		template : '#delivery_optionView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'delivery_option',
			},
			routename : {
				type : String,
				default : 'delivery_optionview',
			},
			apipath: {
				type : String,
				default : 'delivery_option/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',items: '',delivery_option: '',pricing_per_km: '',pricing_higher_km: '',totalamount: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Delivery Option';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',items: '',delivery_option: '',pricing_per_km: '',pricing_higher_km: '',totalamount: '',
				}
			},
		},
	});
	</script>
