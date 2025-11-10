<template id="delivery_optionList">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">Delivery Options & Pricing</h1>
                        <p class="page-subtitle">Manage the different types of delivery services and their associated costs.</p>
                        <div class="mt-4 d-flex justify-content-center align-items-center">
                            <div class="search-bar-container" style="max-width: 500px;">
                                <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control search-input" type="text" name="search" placeholder="Search by option, category..." />
                                <button @click="dosearch()" class="btn search-button">Search</button>
                            </div>
                            <router-link v-if="addbutton" class="btn btn-primary ml-3" :to="'/delivery_option/add'">
                                <i class="ti-plus"></i> Add New
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="background-color: #f7f9fc;">
            <div class="container">
                <div v-if="records.length">
                    <div class="row">
                        <div class="col-lg-6 mb-4" v-for="(data,index) in records">
                            <div class="card request-card h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0 text-capitalize"><i class="ti-truck mr-2"></i> {{ data.delivery_option }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Applicable Items:</strong> {{ data.items }}</p>
                                    <p><strong>Category:</strong> {{ data.category }}</p>
                                    <hr>
                                    <h6>Pricing Details</h6>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Pricing per KM:</span>
                                            <strong class="text-success">₦{{ data.pricing_per_km }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Pricing for Higher KM:</span>
                                            <strong class="text-success">₦{{ data.pricing_higher_km }}</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Base Amount:</span>
                                            <strong class="text-success">₦{{ data.totalamount }}</strong>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer text-right">
                                    <router-link v-if="editbutton" class="btn btn-sm btn-outline-success" :to="'/delivery_option/edit/' + data.id">
                                        <i class="ti-pencil-alt"></i> Edit
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="paginate" class="mt-4">
                        <pagination @changepage="changepage" v-model="currentpage" :total-items="totalrecords" :items-per-page="pagelimit" :show-page-count="true" :show-page-limit="true" @limit-changed="limitChanged"></pagination>
                    </div>
                </div>
                <div class="row justify-content-center" v-else>
                    <div class="col-sm-12 text-center py-5">
                        <div class="empty-state-card">
                            <div class="icon-circle mb-3" style="background-color: #f0f0f0;"><i class="ti-package" style="color: #aaa;"></i></div>
                            <h3 class="mt-3">No Delivery Options Found</h3>
                            <p class="text-muted">Click "Add New" to create your first delivery option.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    var Delivery_OptionListComponent = Vue.component('delivery_optionList', {
        template: '#delivery_optionList',
        mixins: [ListPageMixin],
        props: {
            limit: {
                type: Number,
                default: 6
            }, // Good for a 2-column grid
            pagename: {
                type: String,
                default: 'delivery_option'
            },
            routename: {
                type: String,
                default: 'delivery_optionlist'
            },
            apipath: {
                type: String,
                default: 'delivery_option/list'
            },
            tablestyle: {
                type: String,
                default: ' table-striped table-sm'
            },
            addbutton: {
                type: Boolean,
                default: true
            },
            editbutton: {
                type: Boolean,
                default: true
            },
            searchfield: {
                type: Boolean,
                default: true
            },
        },
        data: function() {
            return {
                pagelimit: this.limit,
                searchtext: '',
                currentpage: 1,
            }
        },
        computed: {
            pageTitle: function() {
                return 'Delivery Option';
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
        }
    });
</script>

<style scoped>
    .page-header {
        padding: 80px 0;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        background-color: #fff;
        margin-top: 50px;
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
        flex-grow: 1;
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

    .request-card {
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
    }

    .request-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transform: translateY(-5px);
    }

    .request-card .card-header h5 {
        font-weight: 600;
        font-size: 1.2rem;
    }

    .request-card .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
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
</style>