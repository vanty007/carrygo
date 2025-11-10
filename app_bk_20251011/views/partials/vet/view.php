    <template id="vetView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  Vet</h3>
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
                                                    <th class="title"> Name :</th>
                                                    <td class="value"> {{ data.name }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Contactname :</th>
                                                    <td class="value"> {{ data.contactname }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Contactphone :</th>
                                                    <td class="value"> {{ data.contactphone }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Address :</th>
                                                    <td class="value"> {{ data.address }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Document :</th>
                                                    <td class="value"> {{ data.document }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Dum1 :</th>
                                                    <td class="value"> {{ data.dum1 }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Dum2 :</th>
                                                    <td class="value"> {{ data.dum2 }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Referalname :</th>
                                                    <td class="value"> {{ data.referalname }} </td>
                                                </tr>
                                                <tr>
                                                    <th class="title"> Referalphoneno :</th>
                                                    <td class="value"> {{ data.referalphoneno }} </td>
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
                                            <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/vet/edit/'  + data.id">
                                            <i class="fa fa-edit"></i> 
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/vet/delete/' + data.id">
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
	var VetViewComponent = Vue.component('vetView', {
		template : '#vetView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'vet',
			},
			routename : {
				type : String,
				default : 'vetview',
			},
			apipath: {
				type : String,
				default : 'vet/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',user_id: '',name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Vet';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',user_id: '',name: '',contactname: '',contactphone: '',address: '',document: '',dum1: '',dum2: '',referalname: '',referalphoneno: '',status: '',created_at: '',
				}
			},
		},
	});
	</script>
