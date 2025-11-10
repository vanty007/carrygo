    <template id="session_logAdd">
        <section class="page-component">
            <div v-if="showheader" class="bg-light p-3 mb-3">
                <div class="container">
                    <div class="row ">
                        <div  class="col-12 comp-grid" :class="setGridSize">
                            <h3 class="record-title">Add New Session Log</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="pb-2 mb-3 border-bottom">
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="session_log/add" method="post">
                                    <div class="form-group " :class="{'has-error' : errors.has('session_id')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="session_id">Session Id <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.session_id"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Session Id"
                                                    class="form-control "
                                                    type="text"
                                                    name="session_id"
                                                    placeholder="Enter Session Id"
                                                    />
                                                    <small v-show="errors.has('session_id')" class="form-text text-danger">
                                                        {{ errors.first('session_id') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('msisdn')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="msisdn">Msisdn <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.msisdn"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Msisdn"
                                                    class="form-control "
                                                    type="text"
                                                    name="msisdn"
                                                    placeholder="Enter Msisdn"
                                                    />
                                                    <small v-show="errors.has('msisdn')" class="form-text text-danger">
                                                        {{ errors.first('msisdn') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('last_command')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="last_command">Last Command <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.last_command"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Last Command"
                                                    class="form-control "
                                                    type="text"
                                                    name="last_command"
                                                    placeholder="Enter Last Command"
                                                    />
                                                    <small v-show="errors.has('last_command')" class="form-text text-danger">
                                                        {{ errors.first('last_command') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('session_date')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="session_date">Session Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.session_date"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Session Date"
                                                    name="session_date"
                                                    placeholder="Enter Session Date"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('session_date')" class="form-text text-danger">{{ errors.first('session_date') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
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
                                    <div class="form-group " :class="{'has-error' : errors.has('session_duration_millis')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="session_duration_millis">Session Duration Millis <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.session_duration_millis"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Session Duration Millis"
                                                    class="form-control "
                                                    type="number"
                                                    name="session_duration_millis"
                                                    placeholder="Enter Session Duration Millis"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('session_duration_millis')" class="form-text text-danger">
                                                        {{ errors.first('session_duration_millis') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('message')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="message">Message <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.message"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Message"
                                                    class="form-control "
                                                    type="text"
                                                    name="message"
                                                    placeholder="Enter Message"
                                                    />
                                                    <small v-show="errors.has('message')" class="form-text text-danger">
                                                        {{ errors.first('message') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('last_session_date')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="last_session_date">Last Session Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <flat-pickr
                                                    v-model="data.last_session_date"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Last Session Date"
                                                    name="last_session_date"
                                                    placeholder="Enter Last Session Date"
                                                    :config="{
                                                    enableTime: true, 
                                                    dateFormat: 'Y-m-d H:i:S',
                                                    altFormat: 'F j, Y - H:i',
                                                    altInput: true, allowInput:true
                                                    }"
                                                    >
                                                    </flat-pickr>
                                                    <small  v-show="errors.has('last_session_date')" class="form-text text-danger">{{ errors.first('last_session_date') }}</small>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('network')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="network">Network <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.network"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Network"
                                                    class="form-control "
                                                    type="text"
                                                    name="network"
                                                    placeholder="Enter Network"
                                                    />
                                                    <small v-show="errors.has('network')" class="form-text text-danger">
                                                        {{ errors.first('network') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('doiflag')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="doiflag">Doiflag <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.doiflag"
                                                    v-validate="{required:true,  numeric:true}"
                                                    data-vv-as="Doiflag"
                                                    class="form-control "
                                                    type="number"
                                                    name="doiflag"
                                                    placeholder="Enter Doiflag"
                                                    step="1" 
                                                    />
                                                    <small v-show="errors.has('doiflag')" class="form-text text-danger">
                                                        {{ errors.first('doiflag') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group " :class="{'has-error' : errors.has('channel')}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="channel">Channel <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input v-model="data.channel"
                                                    v-validate="{required:true}"
                                                    data-vv-as="Channel"
                                                    class="form-control "
                                                    type="text"
                                                    name="channel"
                                                    placeholder="Enter Channel"
                                                    />
                                                    <small v-show="errors.has('channel')" class="form-text text-danger">
                                                        {{ errors.first('channel') }}
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
	var Session_LogAddComponent = Vue.component('session_logAdd', {
		template : '#session_logAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'session_log',
			},
			routename : {
				type : String,
				default : 'session_logadd',
			},
			apipath : {
				type : String,
				default : 'session_log/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					session_id: '',msisdn: '',last_command: '',session_date: '',status: '',session_duration_millis: '',message: '',last_session_date: '',network: '',doiflag: '0',channel: '',
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Session Log';
			},
		},
		methods: {
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/session_log');
			},
			resetForm : function(){
				this.data = {session_id: '',msisdn: '',last_command: '',session_date: '',status: '',session_duration_millis: '',message: '',last_session_date: '',network: '',doiflag: '0',channel: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {
		},
	});
	</script>
