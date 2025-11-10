<template id="userEdit">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">Edit User Profile</h1>
                        <p class="page-subtitle">Update the user's information below.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="background-color: #f7f9fc;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card p-4 p-md-5">
                            <form v-show="!loading" enctype="multipart/form-data" @submit.prevent="update()" class="form form-default" method="post">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name <span class="text-danger">*</span></label>
                                            <input v-model="data.firstname" v-validate="{required:true}" data-vv-as="Firstname" class="form-control" type="text" name="firstname" style="border-radius: 9999px;">
                                            <small v-show="errors.has('firstname')" class="form-text text-danger">{{ errors.first('firstname') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                            <input v-model="data.lastname" v-validate="{required:true}" data-vv-as="Lastname" class="form-control" type="text" name="lastname" style="border-radius: 9999px;">
                                            <small v-show="errors.has('lastname')" class="form-text text-danger">{{ errors.first('lastname') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phoneno">Phone Number <span class="text-danger">*</span></label>
                                            <input v-model="data.phoneno" v-validate="{required:true}" data-vv-as="Phoneno" class="form-control" type="tel" name="phoneno" style="border-radius: 9999px;">
                                            <small v-show="errors.has('phoneno')" class="form-text text-danger">{{ errors.first('phoneno') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role_id">User Role <span class="text-danger">*</span></label>
                                            <select v-model="data.role_id" v-validate="{required:true}" data-vv-as="Role Id" class="form-control" name="role_id" style="border-radius: 9999px;">
                                                <option value="" disabled>Select a role...</option>
                                                <option v-for="role in roleOptionList" :key="role.value" :value="role.value">{{ role.label }}</option>
                                            </select>
                                            <small v-show="errors.has('role_id')" class="form-text text-danger">{{ errors.first('role_id') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input v-model="data.title" v-validate="{required:true}" data-vv-as="Title" class="form-control" type="text" name="title" style="border-radius: 9999px;">
                                            <small v-show="errors.has('title')" class="form-text text-danger">{{ errors.first('title') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sex">Sex <span class="text-danger">*</span></label>
                                            <select v-model="data.sex" v-validate="{required:true}" data-vv-as="Sex" class="form-control" name="sex" style="border-radius: 9999px;">
                                                <option value="" disabled>Select...</option>
                                                <option v-for="option in sexOptionList" :key="option" :value="option">{{ option }}</option>
                                            </select>
                                            <small v-show="errors.has('sex')" class="form-text text-danger">{{ errors.first('sex') }}</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <niceupload
                                        fieldname="profile_pics"
                                        control-class="upload-control"
                                        dropmsg="Drop file here or click to upload"
                                        uploadpath="uploads/files/"
                                        filenameformat="random"
                                        extensions="jpg, png, gif, jpeg"
                                        :filesize="3"
                                        :maximum="1"
                                        name="profile_pics"
                                        v-model="data.profile_pics"
                                        v-validate="{required:false}"
                                        data-vv-as="Profile Pics">
                                    </niceupload>
                                    <small v-show="errors.has('profile_pics')" class="form-text text-danger">{{ errors.first('profile_pics') }}</small>
                                </div>

                                <div class="form-group text-center mt-4">
                                    <button :disabled="errors.any()" class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 9999px;">
                                        <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader></i>
                                        Update User
                                    </button>
                                </div>

                            </form>
                            <div v-show="loading" class="load-indicator static-center">
                                <span class="animator">
                                    <clip-loader :loading="loading" color="gray" size="20px"></clip-loader>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    var UserEditComponent = Vue.component('userEdit', {
        template: '#userEdit',
        mixins: [EditPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'user'
            },
            routename: {
                type: String,
                default: 'useredit'
            },
            apipath: {
                type: String,
                default: 'user/edit'
            },
        },
        data: function() {
            return {
                data: {
                    phoneno: '',
                    role_id: '',
                    firstname: '',
                    lastname: '',
                    title: '',
                    sex: '',
                    profile_pics: '',
                },
                roleOptionList: [{
                        value: 'admin',
                        label: 'Admin'
                    },
                    {
                        value: 'user',
                        label: 'User'
                    },
                    {
                        value: 'driver',
                        label: 'Driver'
                    },
                ],
                sexOptionList: ["Male", "Female"],
            }
        },
        computed: {
            pageTitle: function() {
                return 'Edit User';
            },
        },
        methods: {
            actionAfterUpdate: function(response) {
                this.$root.$emit('requestCompleted', this.msgafterupdate);
                if (!this.ismodal) {
                    this.$router.push('/user');
                }
            },
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
</style>