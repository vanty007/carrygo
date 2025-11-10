    <template id="userView">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">View  User</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-12 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <div class="profile-bg mb-2">
                                    <div class="profile">
                                        <div class="">
                                            <div class="avatar"><niceimg width="100" height="100" :path="data.profile_pics"></niceimg></div>
                                        </div>
                                        <h2 class="title">{{data.email}}</h2>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-bold">Account Detail</h5>
                                    <hr />
                                    <table class="table table-hover table-borderless table-striped">
                                        <tbody>
                                            <tr>
                                                <th class="title"> Id :</th>
                                                <td class="value"> {{ data.id }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Email :</th>
                                                <td class="value"> {{ data.email }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Phoneno :</th>
                                                <td class="value"> {{ data.phoneno }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Role Id :</th>
                                                <td class="value"> {{ data.role_id }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Firstname :</th>
                                                <td class="value"> {{ data.firstname }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Lastname :</th>
                                                <td class="value"> {{ data.lastname }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Title :</th>
                                                <td class="value"> {{ data.title }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Sex :</th>
                                                <td class="value"> {{ data.sex }} </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Profile Pics :</th>
                                                <td class="value"><niceimg :path="data.profile_pics" width="400" height="400" ></niceimg> </td>
                                            </tr>
                                            <tr>
                                                <th class="title"> Created At :</th>
                                                <td class="value"> {{ data.created_at }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-if="editbutton || deletebutton || exportbutton" class="mt-2">
                                    <span >
                                        <router-link class="btn btn-sm btn-info has-tooltip" v-if="editbutton"  :to="'/user/edit/'  + data.id">
                                        <i class="fa fa-edit"></i> 
                                        </router-link>
                                        <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton" :to="'/user/delete/' + data.id">
                                        <i class="fa fa-times"></i> </button>
                                    </span>
                                </div>
                                <div v-show="loading" class="load-indicator static-center">
                                    <span class="animator">
                                        <clip-loader :loading="loading" color="gray" size="20px">
                                        </clip-loader>
                                    </span>
                                    <h4 style="color:gray" class="loading-text"></h4>
                                </div>
                                <div class="text-muted" v-if="!data && emptyrecordmsg != '' && !loading">
                                    <h4><i class="fa fa-ban"></i> No Record Found</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var UserViewComponent = Vue.component('userView', {
		template : '#userView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'user',
			},
			routename : {
				type : String,
				default : 'userview',
			},
			apipath: {
				type : String,
				default : 'user/view',
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',email: '',phoneno: '',role_id: '',firstname: '',lastname: '',title: '',sex: '',profile_pics: '',created_at: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  User';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',email: '',phoneno: '',role_id: '',firstname: '',lastname: '',title: '',sex: '',profile_pics: '',created_at: '',
				}
			},
		},
	});
	</script>
