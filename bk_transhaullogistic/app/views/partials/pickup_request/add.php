<template id="pickup_requestAdd">
    <div>
        <section class="section-sm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="mx-auto mt-5" style="max-width: 800px;">
                            <br><br><br>
                            <form enctype="multipart/form-data" @submit.prevent="save" class="form form-default" action="pickup_request/add" method="post">

                                <section v-if="firstpage">
                                    <div class="content mb-4">
                                        <h3>New Pickup Request</h3>
                                        <div class="text-muted small">Fields marked with <span class="text-danger">*</span> are required.</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Item Name <span class="text-danger">*</span></label>
                                                <input v-model="data.item_name" v-validate="{required:true}" data-vv-as="Item Name" class="form-control" type="text" name="item_name" placeholder="e.g., iPhone, Documents" style="border:1px solid #000;border-radius:9999px;" />
                                                <small v-show="errors.has('item_name')" class="form-text text-danger">{{ errors.first('item_name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category <span class="text-danger">*</span></label>
                                                <select v-model="data.category" v-validate="{required:true}" data-vv-as="Category" class="form-control" style="border:1px solid #000;border-radius:9999px;">
                                                    <option value="" disabled>Select a Category...</option>
                                                    <option v-for="cat in categoryOptionList" :key="cat.value" :value="cat.value">{{ cat.label }}</option>
                                                </select>
                                                <small v-show="errors.has('category')" class="form-text text-danger">{{ errors.first('category') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Notes (Optional)</label>
                                        <textarea class="form-control" name="notes" rows="3" v-model="data.notes" placeholder="e.g., fragile, handle with care" style="border:1px solid #000;border-radius:25px;"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="pickupIsChecked" v-model="pickupIsChecked" @change="handlePickupIsChecked()">
                                            <label class="custom-control-label" for="pickupIsChecked">The item will be picked up from me</label>
                                        </div>
                                    </div>

                                    <div v-if="showpickupPerson">
                                        <hr>
                                        <h5 class="mb-3 small text-muted text-center">Pickup Contact Details</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pickup Contact Name</label>
                                                    <input v-model="data.pickup_name" v-validate="{ required: showpickupPerson }" class="form-control" type="text" name="pickup_name" placeholder="Enter Contact Name" style="border:1px solid #000;border-radius:9999px;" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pickup Contact Phone</label>
                                                    <input v-model="data.pickup_phoneno" v-validate="{ required: showpickupPerson }" class="form-control" type="tel" name="pickup_phoneno" placeholder="Enter Contact Phone" style="border:1px solid #000;border-radius:9999px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Pickup Contact Email</label>
                                            <input v-model="data.pickup_email" v-validate="{required: showpickupPerson, email:true}" data-vv-as="Pickup Email" class="form-control" type="email" name="pickup_email" placeholder="Enter Contact Email" style="border:1px solid #000;border-radius:9999px;" />
                                            <small v-show="errors.has('pickup_email')" class="form-text text-danger">{{ errors.first('pickup_email') }}</small>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="form-group">
                                        <label>Pickup Address <span class="text-danger">*</span></label>
                                        <input v-model="data.pickup_address" v-validate="{required:true}" data-vv-as="Pickup Address" class="form-control" type="text" name="pickup_address" placeholder="Full Pickup Address" style="border:1px solid #000;border-radius:9999px;" />
                                        <small v-show="errors.has('pickup_address')" class="form-text text-danger">{{ errors.first('pickup_address') }}</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pickup City <span class="text-danger">*</span></label>
                                                <input v-model="data.pickup_city" v-validate="{required:true}" data-vv-as="Pickup City" class="form-control" type="text" name="pickup_city" placeholder="e.g., Jos" style="border:1px solid #000;border-radius:9999px;" />
                                                <small v-show="errors.has('pickup_city')" class="form-text text-danger">{{ errors.first('pickup_city') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pickup State <span class="text-danger">*</span></label>
                                                <select v-model="data.pickup_state" v-validate="{required:true}" data-vv-as="Pickup State" class="form-control" style="border:1px solid #000;border-radius:9999px;">
                                                    <option value="" disabled>Select a State...</option>
                                                    <option v-for="state in pickup_stateOptionList" :key="state" :value="state">{{ state }}</option>
                                                </select>
                                                <small v-show="errors.has('pickup_state')" class="form-text text-danger">{{ errors.first('pickup_state') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5 class="mb-3 small text-muted text-center">Receiver's Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receiver's Name <span class="text-danger">*</span></label>
                                                <input v-model="data.receiver_name" v-validate="{required:true}" data-vv-as="Receiver Name" class="form-control" type="text" name="receiver_name" placeholder="Enter Receiver's Name" style="border:1px solid #000;border-radius:9999px;" />
                                                <small v-show="errors.has('receiver_name')" class="form-text text-danger">{{ errors.first('receiver_name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receiver's Phone <span class="text-danger">*</span></label>
                                                <input v-model="data.receiver_phoneno" v-validate="{required:true}" data-vv-as="Receiver Phone" class="form-control" type="tel" name="receiver_phoneno" placeholder="Enter Receiver's Phone" style="border:1px solid #000;border-radius:9999px;" />
                                                <small v-show="errors.has('receiver_phoneno')" class="form-text text-danger">{{ errors.first('receiver_phoneno') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Receiver's Address <span class="text-danger">*</span></label>
                                        <input v-model="data.receiver_address" v-validate="{required:true}" data-vv-as="Receiver Address" class="form-control" type="text" name="receiver_address" placeholder="Full Delivery Address" style="border:1px solid #000;border-radius:9999px;" />
                                        <small v-show="errors.has('receiver_address')" class="form-text text-danger">{{ errors.first('receiver_address') }}</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receiver's City <span class="text-danger">*</span></label>
                                                <input v-model="data.receiver_city" v-validate="{required:true}" data-vv-as="Receiver City" class="form-control" type="text" name="receiver_city" placeholder="e.g., Abuja" style="border:1px solid #000;border-radius:9999px;" />
                                                <small v-show="errors.has('receiver_city')" class="form-text text-danger">{{ errors.first('receiver_city') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Receiver's State <span class="text-danger">*</span></label>
                                                <select v-model="data.receiver_state" v-validate="{required:true}" data-vv-as="Receiver State" class="form-control" style="border:1px solid #000;border-radius:9999px;">
                                                    <option value="" disabled>Select a State...</option>
                                                    <option v-for="state in receiver_stateOptionList" :key="state" :value="state">{{ state }}</option>
                                                </select>
                                                <small v-show="errors.has('receiver_state')" class="form-text text-danger">{{ errors.first('receiver_state') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <button @click="validateNext()" class="btn btn-primary btn-block" type="button">Next <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </section>

                                <section v-if="lastpage">
                                    <div class="content mb-4">
                                        <h3>Confirm & Complete</h3>
                                    </div>

                                    <div class="mb-4 p-3" style="background-color: #f8f9fa; border-radius: 15px; border: 1px solid #dee2e6;">
                                        <h5 class="small font-weight-bold">Trip Summary</h5>
                                        <div><small class="text-muted">From:</small>
                                            <div class="font-weight-bold"><i class="fa fa-map-marker" style="color:#077A07"></i> {{data.pickup_city}}, {{data.pickup_state}}</div>
                                        </div>
                                        <div class="my-2"><small class="text-muted">To:</small>
                                            <div class="font-weight-bold"><i class="fa fa-flag" style="color:#B50202"></i> {{data.receiver_city}}, {{data.receiver_state}}</div>
                                        </div>
                                        <div class="mt-2 pt-2 border-top"><span class="font-weight-bold"><i class="fa fa-road"></i> Distance:</span> {{data.distance}}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Item Picture (Optional)</label>
                                        <niceupload fieldname="picture" control-class="upload-control" dropmsg="Drop files here or click to upload" uploadpath="uploads/images/" filenameformat="random" :filesize="3" :maximum="3" v-model="data.picture"></niceupload>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Delivery Option <span class="text-danger">*</span></label>
                                                <select
                                                    v-model="data.delivery_option_id"
                                                    v-validate="{required:true}"
                                                    @change="onDeliveryOptionChange($event.target.value)"
                                                    data-vv-as="Delivery Option"
                                                    class="form-control"
                                                    style="border:1px solid #000;border-radius:9999px;"
                                                    >
                                                    <option value="" disabled>Select an Option...</option>
                                                    <option
                                                        v-for="option in deliveryOptions"
                                                        :key="option.value"
                                                        :value="option.value"
                                                    >
                                                        {{ option.label }}
                                                    </option>
                                                </select>

                                                    <!--<dataselect
                                                         @change="onDeliveryOptionChange"
                                                        v-model="data.delivery_option_id"
                                                        data-vv-value-path="data.delivery_option_id"
                                                        data-vv-as="Delivery Option"
                                                        v-validate="{required:true}"
                                                        placeholder="Select Delivery Option ... " name="delivery_option_id" :multiple="false" 
                                                        :datapath="'components/delivery_option_list/'"
                                                        >
                                                    </dataselect>-->


                                               <!-- <select v-model="data.delivery_option_id" v-validate="{required:true}" @change="onDeliveryOptionChange($event.target.value)" data-vv-as="Delivery Option" class="form-control" style="border:1px solid #000;border-radius:9999px;">
                                                    <option value="" disabled>Select an Option...</option>
                                                    <option value="Standard">Standard</option>
                                                    <option value="Express">Express</option>
                                                </select>-->

                                                <small v-show="errors.has('delivery_option_id')" class="form-text text-danger">{{ errors.first('delivery_option_id') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Total Amount (₦)</label>
                                                <input v-model="data.totalamount" class="form-control" type="text" name="totalamount" readonly style="border:1px solid #000;border-radius:9999px; background-color: #e9ecef;" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4 d-flex justify-content-between">
                                        <button @click="validatePrevious()" class="btn btn-secondary" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                                        <button class="btn btn-primary" :disabled="errors.any()" type="submit">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="15px"></clip-loader></i>
                                            Submit Request <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </section>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    var Pickup_RequestAddComponent = Vue.component('pickup_requestAdd', {
        template: '#pickup_requestAdd',
        mixins: [AddPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'pickup_request',
            },
            routename: {
                type: String,
                default: 'pickup_requestadd',
            },
            apipath: {
                type: String,
                default: 'pickup_request/add',
            },
        },
        data: function() {
            return {
                id: {
                    type: String,
                    default: '',
                },
                data: {
                    pickup_address: '',
                    receiver_address: '',
                    distance: '',
                    pickup_userid: '',
                    pickup_name: '',
                    pickup_phoneno: '',
                    pickup_email: '',
                    item_name: '',
                    notes: '',
                    category: '',
                    receiver_name: '',
                    receiver_phoneno: '',
                    receiver_email: '',
                    pickup_city: '',
                    pickup_state: '',
                    receiver_city: '',
                    receiver_state: '',
                    picture: '',
                    delivery_option_id: '',
                    totalamount: '',
                },
                pickup_stateOptionList: ["Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara", "Abuja"],
                categoryOptionList: [{
                    "label": "Gadgets",
                    "value": "Gadgets"
                }, {
                    "label": "Appliances",
                    "value": "Appliances"
                }, {
                    "label": "Clothes",
                    "value": "Clothes"
                }],
                receiver_stateOptionList: ["Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara", "Abuja"],
                pickupIsChecked: false,
                showpickupPerson: true,
                firstpage: true,
                lastpage: false,
                deliveryOptions: [] 
            }
        },
        computed: {
            pageTitle: function() {
                return 'Add New Pickup Request';
            },
        },
        methods: {
            validatePrevious() {
                this.firstpage = true;
                this.lastpage = false;

            },
            validateNext() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        console.log("All fields valid, calculating distance...");

                        const service = new google.maps.DistanceMatrixService();
                        const origin = `${this.data.pickup_address}, ${this.data.pickup_city}, ${this.data.pickup_state}, Nigeria`;
                        const destination = `${this.data.receiver_address}, ${this.data.receiver_city}, ${this.data.receiver_state}, Nigeria`;

                        service.getDistanceMatrix({
                            origins: [origin],
                            destinations: [destination],
                            travelMode: "DRIVING",
                        }, (response, status) => {
                            if (status === "OK") {
                                const apiResult = response.rows[0].elements[0];
                                this.data.distance = apiResult.distance.text;
                                this.firstpage = false;
                                this.lastpage = true;
                            } else {
                                alert("Unable to obtain delivery distance. Please check your addresses and try again.");
                                console.error("Error fetching distance:", status);
                            }
                        });
                    } else {
                        console.log("Validation failed. Please fix the errors shown on the form.");
                    }
                });
            },
            handlePickupIsChecked() {
                if (this.pickupIsChecked) {
                    this.data.pickup_userid = <?php echo get_session('user_data') ? get_session('user_data')['id'] : 0; ?>;
                    this.showpickupPerson = false;
                } else {
                    this.showpickupPerson = true
                    this.data.pickup_userid = 0;
                }
            },
                async fetchDeliveryOptions() {
                try {
                    const res = await fetch('/transhaullogistic/components/delivery_option_list');
                    this.deliveryOptions = await res.json();
                } catch (err) {
                    console.error('Failed to load delivery options:', err);
                }
                },
                onDeliveryOptionChange(value) {
                console.log('Selected value: ' + value);

                // If backend returns "2|10000|1000"
                    var id = value.split('|')[0];
                    var baseprice = value.split('|')[1];
                    var km_price = value.split('|')[2];
                    var distance = parseFloat(this.data.distance.replace(/[^\d.]/g, ''));
                    console.log("transformed baseprice "+baseprice+"transformed km_price "+km_price+"transformed distance"+distance)
                    this.data.totalamount = (parseInt(km_price) * distance)+parseInt(baseprice);
                    this.data.delivery_option_id = id;
                },
            /*onDeliveryOptionChange(value) {
                console.log("select delivery option"+value)
                    var id = value.split('|')[0];
                    var baseprice = value.split('|')[1];
                    var km_price = value.split('|')[2];
                    var distance = parseFloat(this.data.distance.replace(/[^\d.]/g, ''));
                    console.log("transformed baseprice "+baseprice+"transformed km_price "+km_price+"transformed distance"+distance)
                    this.data.totalamount = (km_price * distance)+baseprice;
                if (value == "Standard" && this.data.item_name == "iphone") {
                    this.data.totalamount = 14000;
                } else if (value == "Express" && this.data.item_name == "iphone") {
                    this.data.totalamount = 18000;
                } else if (value == "Standard" && this.data.item_name == "gold") {
                    this.data.totalamount = 10000;
                } else if (value == "Express" && this.data.item_name == "gold") {
                    this.data.totalamount = 20000;
                } else if (value == "Standard") {
                    this.data.totalamount = 8000;
                } else if (value == "Express") {
                    this.data.totalamount = 10000;
                }

            },*/
            actionAfterSave: function(response) {
                this.$root.$emit('requestCompleted', this.msgaftersave);
                this.$router.push('/home');
            },
            resetForm: function() {
                this.data = {
                    distance: '',
                    pickup_address: '',
                    receiver_address: '',
                    pickup_name: '',
                    pickup_phoneno: '',
                    pickup_email: '',
                    item_name: '',
                    notes: '',
                    category: '',
                    receiver_name: '',
                    receiver_phoneno: '',
                    receiver_email: '',
                    pickup_city: '',
                    pickup_state: '',
                    receiver_city: '',
                    receiver_state: '',
                    picture: '',
                    delivery_option_id: '',
                    totalamount: '',
                };
                this.$validator.reset();
            },
        },
        mounted() {
            this.fetchDeliveryOptions();
        },
    });
</script>