<template id="userList">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">User Management</h1>
                        <p class="page-subtitle">View and manage all registered users and riders on the platform.</p>
                        <div class="mt-4">
                            <div class="search-bar-container mx-auto" style="max-width: 500px;">
                                <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control search-input" type="text" name="search" placeholder="Search by name, email, or phone..." />
                                <button @click="dosearch()" class="btn search-button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="background-color: #f7f9fc;">
            <div class="container-fluid">
                <div class="d-flex justify-content-end mb-4">
                    <div>
                        <button @click="exportRecord" class="btn btn-sm btn-primary">
                            <i class="ti-download"></i> Export Report
                        </button>
                    </div>
                </div>

                <div v-if="records.length">
                    <div ref="datatable" class="table-responsive card">
                        <table class="table table-bordered table-striped table-hover bg-white mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th class="td-btn"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data,index) in records">
                                    <th>{{index + 1}}</th>
                                    <td>{{ data.firstname }} {{ data.lastname }}</td>
                                    <td>
                                        <div class="small">{{ data.email }}</div>
                                        <div class="small text-muted">{{ data.phoneno }}</div>
                                    </td>
                                    <td><span class="info-badge badge-info text-capitalize" v-if="data.role_id == 'driver'">Rider</span>
                                    <span class="info-badge badge-info text-capitalize" v-if="data.role_id == 'user'">User</span></td>
                                    <td>{{ data.created_at }}</td>
                                    <th class="td-btn">
                                        <router-link v-if="viewbutton" class="btn btn-sm btn-outline-primary" :to="'/user/view/' + data.id">
                                            <i class="ti-eye"></i>
                                        </router-link>
                                        <router-link v-if="editbutton" class="btn btn-sm btn-outline-success" :to="'/user/edit/' + data.id">
                                            <i class="ti-pencil-alt"></i>
                                        </router-link>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div v-if="paginate" class="mt-4">
                        <pagination @changepage="changepage" v-model="currentpage" :total-items="totalrecords" :items-per-page="pagelimit" :show-page-count="true" :show-page-limit="true" @limit-changed="limitChanged"></pagination>
                    </div>
                </div>
                <div class="row justify-content-center" v-else>
                    <div class="col-sm-12 text-center py-5">
                        <div class="empty-state-card">
                            <div class="icon-circle mb-3" style="background-color: #f0f0f0;"><i class="ti-user" style="color: #aaa;"></i></div>
                            <h3 class="mt-3">No Users Found</h3>
                            <p class="text-muted">When users register, they will appear here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    var UserListComponent = Vue.component('userList', {
        template: '#userList',
        mixins: [ListPageMixin],
        props: {
            limit: {
                type: Number,
                default: 10,
            },
            pagename: {
                type: String,
                default: 'user',
            },
            routename: {
                type: String,
                default: 'userlist',
            },
            apipath: {
                type: String,
                default: 'user/list',
            },
            tablestyle: {
                type: String,
                default: ' table-striped table-sm',
            },
            viewbutton: {
                type: Boolean,
                default: true
            },
            editbutton: {
                type: Boolean,
                default: true
            },
            multicheckbox: {
                type: Boolean,
                default: true
            },
        },
        data: function() {
            return {
                pagelimit: this.limit,
                searchtext: '',
                selected: [],
                currentpage: 1,
            }
        },
        computed: {
            pageTitle: function() {
                return 'User';
            },
            allSelected: {
                get: function() {
                    return this.records.length > 0 && this.records.every(rec => this.selected.includes(rec.id));
                },
                set: function(value) {
                    var selected = [];
                    if (value) {
                        this.records.forEach(function(rec) {
                            selected.push(rec.id);
                        });
                    }
                    this.selected = selected;
                }
            }
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