<template id="pickup_requestAdd">
   <div>
      <section class="section-sm">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                     </br></br></br>
                <div class="container">
                    <div class="row ">
                        <div  class="col-md-7 comp-grid" :class="setGridSize">
                            <div  class=" animated fadeIn">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" action="pickup_request/add" method="post">
                                    <section v-if="firstpage">
                                        <div class="content mb-5">
                                            <h3 id="we-would-love-to-hear-from-you">New Pickup Request</h3>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('item_name')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="item_name">Item Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.item_name"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Item Name"
                                                        class="form-control "
                                                        type="text"
                                                        name="item_name"
                                                        placeholder="Enter Item Name"
                                                        />
                                                        <small v-show="errors.has('item_name')" class="form-text text-danger">
                                                            {{ errors.first('item_name') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('category')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="category">Category <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <dataselect
                                                            v-model="data.category"
                                                            data-vv-value-path="data.category"
                                                            data-vv-as="Category"
                                                            v-validate="{required:true}"
                                                            placeholder="Select A Category ... " name="category" :multiple="false" 
                                                            :datasource="categoryOptionList"
                                                            >
                                                        </dataselect>
                                                        <small v-show="errors.has('category')" class="form-text text-danger">{{ errors.first('category') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('notes')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="notes">Notes</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <textarea  name="notes" cols="40" rows="3" v-model="data.notes" v-validate="{required:false}" data-vv-as="notes" type="text"></textarea>
                                                        <small v-show="errors.has('notes')" class="form-text text-danger">
                                                            {{ errors.first('notes') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="checkboxes margin-top-10">
                                            <input name="pickupIsChecked" type="checkbox" id="pickupIsChecked" value="false" v-model="pickupIsChecked" @change="handlePickupIsChecked()"/>
                                            <label for="pickupIsChecked">Pick Up from Me</label>
                                        </div>
                                        <div v-if="showpickupPerson" class="form-group " :class="{'has-error' : errors.has('pickup_name')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_name">Pickup Contact Name</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.pickup_name"
                                                        v-validate="{required:false}"
                                                        data-vv-as="Pick Contact Name"
                                                        class="form-control "
                                                        type="text"
                                                        name="pickup_name"
                                                        placeholder="Pickup Contact Name"
                                                        />
                                                        <small v-show="errors.has('pickup_name')" class="form-text text-danger">
                                                            {{ errors.first('pickup_name') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="showpickupPerson" class="form-group " :class="{'has-error' : errors.has('pickup_phoneno')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_phoneno">Pickup Contact No</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.pickup_phoneno"
                                                        v-validate="{required:false}"
                                                        data-vv-as="Receiver Phone Number"
                                                        class="form-control "
                                                        type="text"
                                                        name="pickup_phoneno"
                                                        placeholder="Enter Pickup Contact No"
                                                        />
                                                        <small v-show="errors.has('pickup_phoneno')" class="form-text text-danger">
                                                            {{ errors.first('pickup_phoneno') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="showpickupPerson" class="form-group " :class="{'has-error' : errors.has('pickup_email')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_email">Pick Up Email</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.pickup_email"
                                                        v-validate="{required:false,  email:true}"
                                                        data-vv-as="Receiver Email"
                                                        class="form-control "
                                                        type="email"
                                                        name="pickup_email"
                                                        placeholder="Enter Pick Up Email"
                                                        />
                                                        <small v-show="errors.has('pickup_email')" class="form-text text-danger">
                                                            {{ errors.first('pickup_email') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_name')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_name">Receiver Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.receiver_name"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Receiver Name"
                                                        class="form-control "
                                                        type="text"
                                                        name="receiver_name"
                                                        placeholder="Enter Receiver Name"
                                                        />
                                                        <small v-show="errors.has('receiver_name')" class="form-text text-danger">
                                                            {{ errors.first('receiver_name') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_phoneno')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_phoneno">Receiver Phoneno <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.receiver_phoneno"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Receiver Phone Number"
                                                        class="form-control "
                                                        type="text"
                                                        name="receiver_phoneno"
                                                        placeholder="Enter Receiver Phone Number"
                                                        />
                                                        <small v-show="errors.has('receiver_phoneno')" class="form-text text-danger">
                                                            {{ errors.first('receiver_phoneno') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_email')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_email">Receiver Email</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.receiver_email"
                                                        v-validate="{required:false,  email:true}"
                                                        data-vv-as="Receiver Email"
                                                        class="form-control "
                                                        type="email"
                                                        name="receiver_email"
                                                        placeholder="Enter Receiver Email"
                                                        />
                                                        <small v-show="errors.has('receiver_email')" class="form-text text-danger">
                                                            {{ errors.first('receiver_email') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('pickup_address')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_address">Pickup Address <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.pickup_address"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Pickup Address"
                                                        class="form-control "
                                                        type="text"
                                                        name="pickup_address"
                                                        placeholder="Enter Pickup Address"
                                                        />
                                                        <small v-show="errors.has('pickup_address')" class="form-text text-danger">
                                                            {{ errors.first('pickup_address') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('pickup_city')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_city">Pickup City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.pickup_city"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Pickup City"
                                                        class="form-control "
                                                        type="text"
                                                        name="pickup_city"
                                                        placeholder="Enter Pickup City"
                                                        />
                                                        <small v-show="errors.has('pickup_city')" class="form-text text-danger">
                                                            {{ errors.first('pickup_city') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('pickup_state')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="pickup_state">Pickup State <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <dataselect
                                                            v-model="data.pickup_state"
                                                            data-vv-value-path="data.pickup_state"
                                                            data-vv-as="Pickup State"
                                                            v-validate="{required:true}"
                                                            placeholder="Select PicK Up State ... " name="pickup_state" :multiple="false" 
                                                            :datasource="pickup_stateOptionList"
                                                            >
                                                        </dataselect>
                                                        <small v-show="errors.has('pickup_state')" class="form-text text-danger">{{ errors.first('pickup_state') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_address')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_address">Receiver's Address <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.receiver_address"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Receiver Address"
                                                        class="form-control "
                                                        type="text"
                                                        name="receiver_address"
                                                        placeholder="Enter Receiver's Address"
                                                        />
                                                        <small v-show="errors.has('receiver_address')" class="form-text text-danger">
                                                            {{ errors.first('receiver_address') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_city')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_city">Receiver's City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.receiver_city"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Receiver City"
                                                        class="form-control "
                                                        type="text"
                                                        name="receiver_city"
                                                        placeholder="Enter Receiver's City"
                                                        />
                                                        <small v-show="errors.has('receiver_city')" class="form-text text-danger">
                                                            {{ errors.first('receiver_city') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('receiver_state')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="receiver_state">Receiver's State <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <dataselect
                                                            v-model="data.receiver_state"
                                                            data-vv-value-path="data.receiver_state"
                                                            data-vv-as="Receiver State"
                                                            v-validate="{required:true}"
                                                            placeholder="Select Receiver's State ... " name="receiver_state" :multiple="false" 
                                                            :datasource="receiver_stateOptionList"
                                                            >
                                                        </dataselect>
                                                        <small v-show="errors.has('receiver_state')" class="form-text text-danger">{{ errors.first('receiver_state') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button @click="validateNext()" class="btn btn-primary"type="button">Next<i class="fa fa-arrow-right"></i></button>
                                    </section>
                                    <section v-if="lastpage">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <button @click="validatePrevious()" class="btn btn-danger"type="button"><i class="fa fa-arrow-left"></i>Back</button>
                                                </div>
                                                <!--<div class="col-sm-8">
                                                    <div class="content mb-5">
                                                        <h3 id="we-would-love-to-hear-from-you">Distance: {{data.distance}}</h3>
                                                    </div>
                                                    </div>-->
                                            </div>
                                            <div>
                                                <!--<h5>{{data.item_name}}</h5>-->
                                                </br>
                                                <i class="fa fa-solid fa-map-marker" style="color:#077A07"></i>{{data.pickup_city}}, {{data.pickup_state}}
                                                <div>|</div>
                                                <i class="fa fa-flag" style="color:#B50202"></i>{{data.receiver_city}}, {{data.receiver_state}}
                                                <ul class="card-meta list-inline">
                                                    <li class="list-inline-item">
                                                        <a class="card-meta-author">
                                                        <span><i class="fa fa-user"></i> Rider Pending</span>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <i class="fa fa-road"></i>{{data.distance}}
                                                    </li>
                                                </ul>
                                            </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('picture')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="picture">Picture</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <niceupload
                                                            fieldname="picture"
                                                            control-class="upload-control"
                                                            dropmsg="Drop files here to upload"
                                                            uploadpath="uploads/images/"
                                                            filenameformat="random" 
                                                            :filesize="3" 
                                                            :maximum="3" 
                                                            :multiple="false"
                                                            name="picture"
                                                            v-model="data.picture"
                                                            v-validate="{required:false}"
                                                            data-vv-as="Picture"
                                                            >
                                                        </niceupload>
                                                        <small v-show="errors.has('picture')" class="form-text text-danger">{{ errors.first('picture') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('delivery_option_id')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="delivery_option_id">Delivery Option <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <dataselect
                                                            v-model="data.delivery_option_id"
                                                            data-vv-value-path="data.delivery_option_id"
                                                            data-vv-as="Delivery Option Id"
                                                            v-validate="{required:true}"
                                                            placeholder="Select A Delivery Option ... " name="delivery_option_id" :multiple="false" 
                                                            :datapath="'components/pickup_request_delivery_option_id_option_list/'"
                                                            @input="onDeliveryOptionChange"
                                                            >
                                                        </dataselect>
                                                        <small v-show="errors.has('delivery_option_id')" class="form-text text-danger">{{ errors.first('delivery_option_id') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group " :class="{'has-error' : errors.has('totalamount')}">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="totalamount">Total Amount <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input v-model="data.totalamount"
                                                        v-validate="{required:true}"
                                                        data-vv-as="Totalamount"
                                                        class="form-control "
                                                        type="text"
                                                        name="totalamount"
                                                        placeholder="Enter Total Amount"
                                                        />
                                                        <small v-show="errors.has('totalamount')" class="form-text text-danger">
                                                            {{ errors.first('totalamount') }}
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
                                                        Submit
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </div>
                                    </section>
                                </form>
                            </div>
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
	var Pickup_RequestAddComponent = Vue.component('pickup_requestAdd', {
		template : '#pickup_requestAdd',
		mixins: [AddPageMixin],
		props:{
			pagename : {
				type : String,
				default : 'pickup_request',
			},
			routename : {
				type : String,
				default : 'pickup_requestadd',
			},
			apipath : {
				type : String,
				default : 'pickup_request/add',
			},
		},
		data : function() {
			return {
				id : {
					type : String,
					default : '',
				},
				data : {
					pickup_address:'', receiver_address:'', distance:'', pickup_userid:'',pickup_name: '',pickup_phoneno: '',pickup_email: '',item_name:'',notes:'',category:'', receiver_name: '',receiver_phoneno: '',receiver_email: '',pickup_city: '',pickup_state: '',receiver_city: '',receiver_state: '',picture: '',delivery_option_id: '',totalamount: '',
				},
				pickup_stateOptionList: ["Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue","Borno","Cross River","Delta","Ebonyi","Edo","Ekiti","Enugu","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina","Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo","Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara","Abuja"],
                categoryOptionList: [{"label":"Gadgets","value":"Gadgets"},{"label":"Appliances","value":"Appliances"},{"label":"Clothes","value":"Clothes"}],
				receiver_stateOptionList: ["Abia","Adamawa","Akwa Ibom","Anambra","Bauchi","Bayelsa","Benue","Borno","Cross River","Delta","Ebonyi","Edo","Ekiti","Enugu","Gombe","Imo","Jigawa","Kaduna","Kano","Katsina","Kebbi","Kogi","Kwara","Lagos","Nasarawa","Niger","Ogun","Ondo","Osun","Oyo","Plateau","Rivers","Sokoto","Taraba","Yobe","Zamfara","Abuja"],
                pickupIsChecked: false,
                showpickupPerson: true,
                firstpage: true,
                lastpage: false,
			}
		},
		computed: {
			pageTitle: function(){
				return 'Add New Pickup Request';
			},
		},
		methods: {
            validatePrevious(){
            this.firstpage = true;
            this.lastpage = false;

            },
            validateNext(){
            if(!this.data.item_name ||!this.data.category || !this.data.receiver_name || !this.data.receiver_phoneno || 
            !this.data.pickup_city || !this.data.pickup_state || !this.data.receiver_city || !this.data.receiver_state ||
       !(this.data.pickup_userid==0 && !this.data.pickup_name && !this.data.pickup_phoneno) ){
        alert("Some important fields are missing, please check")
       }
       else{
                    const service = new google.maps.DistanceMatrixService();
                    var origin = this.pickup_address+", "+this.data.pickup_city+", "+this.data.pickup_state+", Nigeria";
                    var destination = this.receiver_address+", "+this.data.receiver_city+", "+this.data.receiver_state+", Nigeria";
                    console.log(" origin: "+ origin+" destination: "+ destination);
                    service.getDistanceMatrix(
                    {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: "DRIVING", // You can also use WALKING, BICYCLING, TRANSIT
                    },
                    (response, status) => {
                    if (status === "OK") {
                        const result = response.rows[0].elements[0];
                        this.distance = result.distance.text;
                        this.duration = result.duration.text;
                        console.log(" fetching distance:", result);
                        this.data.distance = this.distance;
                        this.firstpage = false;
                        this.lastpage = true;
                    } else {
                        alert("unable to obtain delivery distance, please try again")
                        console.error("Error fetching distance:", status);
                    }
                    }
                );
       }
            },
            handlePickupIsChecked(){
                if(this.pickupIsChecked){
                    this.showpickupPerson = false;
                }
                else{
                    this.showpickupPerson = true
                    this.data.pickup_userid = 0;
                }
            },
            onDeliveryOptionChange(value) {
            if(value == "Standard" && this.data.item_name == "iphone"){
              this.data.totalamount = 14000;
            }
            else if(value == "Express" && this.data.item_name == "iphone"){
              this.data.totalamount = 18000;
            }
            else if(value == "Standard" && this.data.item_name == "gold"){
              this.data.totalamount = 10000;
            }
            else if(value == "Express" && this.data.item_name == "gold"){
              this.data.totalamount = 20000;
            }
            else if(value == "Standard"){
              this.data.totalamount = 8000;
            }
            else if(value == "Express"){
              this.data.totalamount = 10000;
            }
            
            },
			actionAfterSave : function(response){
				this.$root.$emit('requestCompleted' , this.msgaftersave);
				this.$router.push('/home');
			},
			resetForm : function(){
				this.data = {distance:'',pickup_address:'', receiver_address:'', pickup_name: '',pickup_phoneno: '',pickup_email: '',item_name:'',notes:'',category:'', receiver_name: '',receiver_phoneno: '',receiver_email: '',pickup_city: '',pickup_state: '',receiver_city: '',receiver_state: '',picture: '',delivery_option_id: '',totalamount: '',};
				this.$validator.reset();
			},
		},
		mounted : function() {

		},
	});
	</script>
