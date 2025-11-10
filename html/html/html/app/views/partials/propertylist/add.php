    <template id="propertylistAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Propertylist</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="propertylist/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('propertytype_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="propertytype_id">Propertytype Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.propertytype_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Propertytype Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="propertytype_id"
                                                    placeholder="Enter Propertytype Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('propertytype_id')" class="form-text text-danger">
                                                        {{ errors.first('propertytype_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('name')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.name"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Name"
                                                    class="form-control "
                                                    type="text"
                                                    name="name"
                                                    placeholder="Enter Name"
                                                    />
                                                    <small v-show="errors.has('name')" class="form-text text-danger">
                                                        {{ errors.first('name') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('chargetype_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="chargetype_id">Chargetype Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.chargetype_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Chargetype Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="chargetype_id"
                                                    placeholder="Enter Chargetype Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('chargetype_id')" class="form-text text-danger">
                                                        {{ errors.first('chargetype_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('rating_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="rating_id">Rating Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.rating_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Rating Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="rating_id"
                                                    placeholder="Enter Rating Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('rating_id')" class="form-text text-danger">
                                                        {{ errors.first('rating_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('address')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="address">Address <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.address"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Address"
                                                    class="form-control "
                                                    type="text"
                                                    name="address"
                                                    placeholder="Enter Address"
                                                    />
                                                    <small v-show="errors.has('address')" class="form-text text-danger">
                                                        {{ errors.first('address') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('location_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="location_id">Location Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.location_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Location Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="location_id"
                                                    placeholder="Enter Location Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('location_id')" class="form-text text-danger">
                                                        {{ errors.first('location_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('landmark')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="landmark">Landmark <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.landmark"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Landmark"
                                                    class="form-control "
                                                    type="text"
                                                    name="landmark"
                                                    placeholder="Enter Landmark"
                                                    />
                                                    <small v-show="errors.has('landmark')" class="form-text text-danger">
                                                        {{ errors.first('landmark') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('longitude')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="longitude">Longitude <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.longitude"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Longitude"
                                                    class="form-control "
                                                    type="text"
                                                    name="longitude"
                                                    placeholder="Enter Longitude"
                                                    />
                                                    <small v-show="errors.has('longitude')" class="form-text text-danger">
                                                        {{ errors.first('longitude') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('latitude')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="latitude">Latitude <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.latitude"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Latitude"
                                                    class="form-control "
                                                    type="text"
                                                    name="latitude"
                                                    placeholder="Enter Latitude"
                                                    />
                                                    <small v-show="errors.has('latitude')" class="form-text text-danger">
                                                        {{ errors.first('latitude') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('status')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.status"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Status"
                                                    class="form-control "
                                                    type="text"
                                                    name="status"
                                                    placeholder="Enter Status"
                                                    />
                                                    <small v-show="errors.has('status')" class="form-text text-danger">
                                                        {{ errors.first('status') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('user_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_id">User Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.user_id"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="User Id"
                                                    class="form-control "
                                                    type="number"
                                                    name="user_id"
                                                    placeholder="Enter User Id"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('user_id')" class="form-text text-danger">
                                                        {{ errors.first('user_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contactphone')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contactphone">Contactphone <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.contactphone"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Contactphone"
                                                    class="form-control "
                                                    type="text"
                                                    name="contactphone"
                                                    placeholder="Enter Contactphone"
                                                    />
                                                    <small v-show="errors.has('contactphone')" class="form-text text-danger">
                                                        {{ errors.first('contactphone') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contactemail')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contactemail">Contactemail <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.contactemail"
                                                    v-validate="{required:true,  email:true}"
                                                    data-vv-as="Contactemail"
                                                    class="form-control "
                                                    type="email"
                                                    name="contactemail"
                                                    placeholder="Enter Contactemail"
                                                    />
                                                    <small v-show="errors.has('contactemail')" class="form-text text-danger">
                                                        {{ errors.first('contactemail') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('contactname')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="contactname">Contactname <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.contactname"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Contactname"
                                                    class="form-control "
                                                    type="number"
                                                    name="contactname"
                                                    placeholder="Enter Contactname"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('contactname')" class="form-text text-danger">
                                                        {{ errors.first('contactname') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('checkin')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="checkin">Checkin <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.checkin"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Checkin"
                                                    class="form-control "
                                                    type="text"
                                                    name="checkin"
                                                    placeholder="Enter Checkin"
                                                    />
                                                    <small v-show="errors.has('checkin')" class="form-text text-danger">
                                                        {{ errors.first('checkin') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('checkout')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="checkout">Checkout <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.checkout"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Checkout"
                                                    class="form-control "
                                                    type="text"
                                                    name="checkout"
                                                    placeholder="Enter Checkout"
                                                    />
                                                    <small v-show="errors.has('checkout')" class="form-text text-danger">
                                                        {{ errors.first('checkout') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('cancellation')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cancellation">Cancellation <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.cancellation"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Cancellation"
                                                    class="form-control "
                                                    type="text"
                                                    name="cancellation"
                                                    placeholder="Enter Cancellation"
                                                    />
                                                    <small v-show="errors.has('cancellation')" class="form-text text-danger">
                                                        {{ errors.first('cancellation') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('pets')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="pets">Pets <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.pets"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Pets"
                                                    class="form-control "
                                                    type="text"
                                                    name="pets"
                                                    placeholder="Enter Pets"
                                                    />
                                                    <small v-show="errors.has('pets')" class="form-text text-danger">
                                                        {{ errors.first('pets') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('views')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="views">Views <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.views"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Views"
                                                    class="form-control "
                                                    type="number"
                                                    name="views"
                                                    placeholder="Enter Views"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('views')" class="form-text text-danger">
                                                        {{ errors.first('views') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary"  :disabled="errors.any()" type="submit">
                                            <i class="load-indicator">
                                                <clip-loader :loading="saving" color="#fff" size="15px"></clip-loader>
                                            </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
	var PropertylistAddComponent = Vue.component('propertylistAdd', {
		template : '#propertylistAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'propertylist',
			},
			routename : {
				type : String,
				default : 'propertylistadd',
			},
			apipath : {
				type : String,
				default : 'propertylist/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					propertytype_id: '',name: '',chargetype_id: '',rating_id: '',address: '',location_id: '',landmark: '',longitude: '',latitude: '',status: '',user_id: '',contactphone: '',contactemail: '',contactname: '',checkin: '',checkout: '',cancellation: '',pets: '',views: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Propertylist';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/propertylist');
			},
			resetForm : function(){
				this.data = {propertytype_id: '',name: '',chargetype_id: '',rating_id: '',address: '',location_id: '',landmark: '',longitude: '',latitude: '',status: '',user_id: '',contactphone: '',contactemail: '',contactname: '',checkin: '',checkout: '',cancellation: '',pets: '',views: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
