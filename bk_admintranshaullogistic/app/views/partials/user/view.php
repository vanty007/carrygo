<template id="userView">
    <div>
        <div class="page-container" style="padding-top: 100px;">
            <section class="section-sm">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">

                            <!-- =============================================================== -->
                            <!-- NEW PROFILE HEADER CARD                                         -->
                            <!-- =============================================================== -->
                            <div class="card profile-header-card mb-4">
                                <div class="card-body text-center">
                                    <div class="profile-pic-wrapper mb-3">
                                        <img :src="data.profile_pics || 'https://via.placeholder.com/150'" alt="Profile Picture" class="profile-pic">
                                    </div>
                                    <h2 class="card-title mb-1">{{ data.firstname }} {{ data.lastname }}</h2>
                                    <p class="text-muted text-capitalize"><span class="info-badge badge-primary">{{ data.role_id }}</span></p>

                                    <div class="mt-4">
                                        <router-link class="btn btn-primary" v-if="editbutton" :to="'/user/edit/' + data.id">
                                            <i class="ti-pencil-alt"></i> Edit Profile
                                        </router-link>
                                        <button @click="deleteRecord" class="btn btn-outline-danger ml-2" v-if="deletebutton">
                                            <i class="ti-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- =============================================================== -->
                            <!-- NEW DETAILS CARD                                                -->
                            <!-- =============================================================== -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">User Details</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th width="30%">Email Address</th>
                                                <td>{{ data.email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone Number</th>
                                                <td>{{ data.phoneno }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title</th>
                                                <td>{{ data.title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Sex</th>
                                                <td>{{ data.sex }}</td>
                                            </tr>
                                            <tr>
                                                <th>User ID</th>
                                                <td>{{ data.id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date Joined</th>
                                                <td>{{ data.created_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    var UserViewComponent = Vue.component('userView', {
        template: '#userView',
        mixins: [ViewPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'user',
            },
            routename: {
                type: String,
                default: 'userview',
            },
            apipath: {
                type: String,
                default: 'user/view',
            },
        },
        data: function() {
            return {
                data: {
                    id: '',
                    email: '',
                    phoneno: '',
                    role_id: '',
                    firstname: '',
                    lastname: '',
                    title: '',
                    sex: '',
                    profile_pics: '',
                    created_at: '',
                },
            }
        },
        computed: {
            pageTitle: function() {
                return 'View User';
            },
        },
        methods: {
            resetData: function() {
                this.data = {
                    id: '',
                    email: '',
                    phoneno: '',
                    role_id: '',
                    firstname: '',
                    lastname: '',
                    title: '',
                    sex: '',
                    profile_pics: '',
                    created_at: '',
                }
            },
        },
    });
</script>

<style scoped>
    .profile-header-card {
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .profile-pic-wrapper {
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .profile-pic {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .profile-header-card .card-title {
        font-weight: 700;
        font-size: 2rem;
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