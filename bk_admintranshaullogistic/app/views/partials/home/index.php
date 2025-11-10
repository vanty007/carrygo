<template id="Home">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">Pickup Requests</h1>
                        <p class="page-subtitle">Manage and view all customer pickup requests from this dashboard.</p>
                        <div class="mt-4">
                            <div class="search-bar-container mx-auto" style="max-width: 500px;">
                                <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control search-input" type="text" name="search" placeholder="Search by Tracking ID, Name, Location..." />
                                <button @click="dosearch()" class="btn search-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="background-color: #f7f9fc;">
            <div class="container-fluid">


                <div class="container">
                <div class="d-flex justify-content-end mb-4">
                    <div>
                        <button @click="exportRecord" class="btn btn-sm btn-primary">
                            <i class="ti-download"></i> Generate Report
                        </button>
                    </div>
                </div>
                <div class="widget">
                    <h4 class="widget-title">Pending Requests</h4>
                    <div v-if="records.length">
                    <div v-for="(data,index) in records">
                        <article class="card request-card mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="ti-package mr-2"></i> {{data.item_name}} </h5>
                            <span class="badge badge-light p-2">#{{data.tracking_id}}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-5">
                                <div class="location-group">
                                <div class="location-icon from"><i class="ti-location-pin"></i></div>
                                <div>
                                    <small class="text-muted">FROM</small>
                                    <p class="font-weight-bold mb-0">{{data.pickup_city}}, {{data.pickup_state}}</p>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center my-3 my-md-0">
                                <i class="ti-arrow-right text-muted" style="font-size: 1.5rem;">&#8358;{{data.totalamount}}</i>
                            </div>
                            <div class="col-md-5">
                                <div class="location-group">
                                <div class="location-icon to"><i class="ti-flag-alt"></i></div>
                                <div>
                                    <small class="text-muted">TO</small>
                                    <p class="font-weight-bold mb-0">{{data.receiver_city}}, {{data.receiver_state}}</p>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="status-group">
                            <strong class="mr-2">Status:</strong>
                            <span :class="getPickupStatusClass(data.pickup_status)">{{ statusPickUpText(data.pickup_status, data.driver_id) }}</span>
                            </br>
                            <span>{{ data.created_at }}</span>
                            </div>
                            <div class="action-group" style="white-space: nowrap;">
                                        <router-link v-if="viewbutton" class="btn btn-sm btn-outline-primary" :to="'/pickup_request/view/' + data.id">
                                            <i class="ti-eye"></i>
                                        </router-link>
                                        <router-link class="btn btn-sm btn-outline-success" :to="'/pickup_request/edit/' + data.id">
                                            <i class="ti-pencil-alt">Assign Pickup Riders</i>
                                        </router-link>
                            </div>
                        </div>
                        </article>
                    </div>
                    <div v-if="paginate" class="mt-4">
                        <pagination @changepage="changepage" v-model="currentpage" :total-items="totalrecords" :items-per-page="pagelimit" :show-page-count="true" :show-page-limit="true" @limit-changed="limitChanged"></pagination>
                    </div>
                    </div>
                    <div class="row justify-content-center" v-else>
                    <div class="col-sm-12 text-center py-5">
                        <div class="empty-state-card">
                        <div class="icon-circle mb-3" style="background-color: #f0f0f0;"><i class="ti-dropbox" style="color: #aaa;"></i></div>
                        <h3 class="mt-3">No Active Requests Found</h3>
                        <p class="text-muted">Ready to send something? Click the button in the banner above!</p>
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
    var HomeComponent = Vue.component('HomeComponent', {
        template: '#Home',
        mixins: [ListPageMixin],
        props: {
            limit: {
                type: Number,
                default: 10
            },
            pagename: {
                type: String,
                default: 'home'
            },
            routename: {
                type: String,
                default: 'home'
            },
            apipath: {
                type: String,
                default: 'home/index'
            },
            exportbutton: {
                type: Boolean,
                default: false
            },
            importbutton: {
                type: Boolean,
                default: false
            },
            tablestyle: {
                type: String,
                default: ' table-striped table-sm'
            },
        },
        data: function() {
            return {
                pagelimit: this.limit,
                loading: false,
                ready: false,
                currentpage: 1,
                user: {
                    request_id: '',
                    payer: '',
                    picture: '',
                    payment_method: ''
                },
                payment_methodOptionList: ["Cash", "Transfer", "POS", "ATM", "QRCODE"],
                driver_status: 1,
                paymentsinfo: '',
            }
        },
        computed: {
            pageTitle: function() {
                return 'Pickup Requests';
            },
        },
        methods: {
            load: function() {
                this.records = [];
                if (this.loading == false) {
                    this.ready = false;
                    this.loading = true;
                    var url = this.apiUrl;
                    this.$http.get(url).then(function(response) {
                            var data = response.body;
                            if (data && data.records) {
                                this.totalrecords = data.total_records;
                                if (this.pagelimit > data.records.length) {
                                    this.loadcompleted = true;
                                }
                                this.records = data.records;
                            } else {
                                this.$root.$emit('requestError', response);
                            }
                            this.loading = false
                            this.ready = true
                        },
                        function(response) {
                            this.loading = false;
                            this.$root.$emit('requestError', response);
                        });
                }
            },
            statusPickUpText(status, driver_id) {
                switch (String(status)) {
                    case '0':
                        if (driver_id == null || driver_id === '' || driver_id === 0) {
                            return 'Pending Assignment';
                        } else {
                            return 'Pending Rider Pickup';
                        }
                    case '1':
                        return 'Rider Pickup Accepted';
                    case '2':
                        return 'In Transit';
                    case '3':
                        return 'Delivered';
                    default:
                        return 'Unknown';
                }
            },
            getPickupStatusClass(status) {
                switch (String(status)) {
                    case '0':
                        return 'badge-warning';
                    case '1':
                        return 'badge-primary';
                    case '2':
                        return 'badge-info';
                    case '3':
                        return 'badge-success';
                    default:
                        return 'badge-secondary';
                }
            },
            statusPaymentText(status) {
                switch (Number(status)) {
                    case 0:
                        return 'Not Confirmed';
                    case 1:
                        return 'Confirmed';
                    default:
                        return 'Unknown';
                }
            },
            getPaymentStatusClass(status) {
                switch (Number(status)) {
                    case 0:
                        return 'badge-danger';
                    case 1:
                        return 'badge-success';
                    default:
                        return 'badge-secondary';
                }
            }
        },
        mounted: function() {
            this.ready = true;
        },
    });
</script>

<style scoped>
    .page-header {
        padding: 80px 0;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        background-color: #fff;
    }

    .page-title {
        font-weight: 800;
        font-size: 4rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-bar-container {
        display: flex;
        background-color: #fff;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .search-input {
        border: none;
        padding: 10px 20px;
        flex-grow: 1;
        border-radius: 50px;
        outline: none;
    }

    .search-button {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
    }

    .empty-state-card {
        background-color: #fff;
        border: 1px dashed #ced4da;
        border-radius: 15px;
        padding: 40px;
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-state-card .icon-circle {
        width: 90px;
        height: 90px;
        font-size: 3rem;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
    }

    .td-checkbox {
        width: 1%;
    }

    .info-badge {
        white-space: nowrap;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
</style>