<template id="pickup_requestEdit">
    <div>
    </br></br></br></br>
    <section class="section-sm">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Assign Delivery Riders</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form  v-show="!loading" enctype="multipart/form-data" @submit="update()" class="form form-default" :action="'pickup_request/edit/' + data.id" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('driver_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="driver_id">Select Riders <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <dataselect
                                                        v-model="data.driver_id"
                                                        data-vv-value-path="data.driver_id"
                                                        data-vv-as="Driver Id"
                                                        v-validate="{required:true}"
                                                        placeholder="Available drivers ... " name="driver_id" :multiple="false" 
                                                        :datapath="'components/pickup_request_driver_id_option_list/'"
                                                        >
                                                    </dataselect>
                                                    <small v-show="errors.has('driver_id')" class="form-text text-danger">{{ errors.first('driver_id') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="form-group " :class="{'has-error' : errors.has('totalamount')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="totalamount">Totalamount <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.totalamount"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Totalamount"
                                                    class="form-control "
                                                    type="text"
                                                    name="totalamount"
                                                    placeholder="Enter Totalamount"
                                                    />
                                                    <small v-show="errors.has('totalamount')" class="form-text text-danger">
                                                        {{ errors.first('totalamount') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="form-group text-center">
                                        <button @click="update()" :disabled="errors.any()" class="btn btn-primary" type="button">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader> </i>
                                            {{submitbuttontext}}
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
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
        </div>
</template>
    <script>
	var Pickup_RequestEditComponent = Vue.component('pickup_requestEdit', {
		template : '#pickup_requestEdit',
		mixins: [EditPageMixin],
		props: {
			pagename : {
				type : String,
				default : 'pickup_request',
			},
			routename : {
				type : String,
				default : 'pickup_requestedit',
			},
			apipath : {
				type : String,
				default : 'pickup_request/edit',
			},
		},
		data: function() {
			return {
				data : { driver_id: '',pickup_address: '',pickup_city: '',pickup_state: '',receiver_address: '',receiver_city: '',receiver_state: '',distance: '',totalamount: '', },
			}
		},
		computed: {
			pageTitle: function(){
				return 'Edit  Pickup Request';
			},
		},
		methods: {
			actionAfterUpdate : function(response){
				this.$root.$emit('requestCompleted' , this.msgafterupdate);
				if(!this.ismodal){
					this.$router.push('/home');
				}
			},
		},
		watch: {
			id: function(newVal, oldVal) {
				if(this.id){
					this.load();
				}
			},
			modelBind: function(){
				var binds = this.modelBind;
				for(key in binds){
					this.data[key]= binds[key];
				}
			},
			pageTitle: function(){
				this.SetPageTitle( this.pageTitle );
			},
		},
		created: function(){
			this.SetPageTitle(this.pageTitle);
		},
		mounted: function() {
			//this.load();
		},
	});
	</script>