<template id="Register">
    <div class="main-container">
        <section class="section-sm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="mx-auto mt-5" style="max-width: 420px;">
                            <div class="content mb-5">
                                </br><br><br>
                                <h2 id="we-would-love-to-hear-from-you">Create your account</h2>
                            </div>

                            <form enctype="multipart/form-data" @submit="save" class="form form-default" action="" method="post">
                                <div class="text-muted small mb-3">
                                    Fields marked with <span class="text-danger">*</span> are required.
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('firstname')}">
                                    <label for="firstname">First Name <span class="text-danger">*</span></label>
                                    <input v-model="data.firstname" v-validate="{required:true}" data-vv-as="Firstname" class="form-control" type="text" name="firstname" placeholder="Enter Firstname" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('firstname')" class="form-text text-danger">{{ errors.first('firstname') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('lastname')}">
                                    <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                    <input v-model="data.lastname" v-validate="{required:true}" data-vv-as="Lastname" class="form-control" type="text" name="lastname" placeholder="Enter Lastname" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('lastname')" class="form-text text-danger">{{ errors.first('lastname') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('email')}">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input v-model="data.email" v-validate="{required:true, email:true}" data-vv-as="Email" class="form-control" type="email" name="email" placeholder="Enter Email" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('email')" class="form-text text-danger">{{ errors.first('email') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('phoneno')}">
                                    <label for="phoneno">Phone Number <span class="text-danger">*</span></label>
                                    <input v-model="data.phoneno" v-validate="{required:true, numeric:true, max:11, min:11}" data-vv-as="Phoneno" class="form-control" type="text" name="phoneno" placeholder="Enter Phone Number" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('phoneno')" class="form-text text-danger">{{ errors.first('phoneno') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('role_id')}">
                                    <label for="role_id">Register as <span class="text-danger">*</span></label>
                                    <select v-model="data.role_id" v-validate="{required:true}" data-vv-as="Role" name="role_id" class="form-control" style="border:1px solid #000;border-radius:9999px;">
                                        <option v-for="role in roleOptionList" :key="role.value" :value="role.value">
                                            {{ role.label }}
                                        </option>
                                    </select>
                                    <small v-show="errors.has('role_id')" class="form-text text-danger">{{ errors.first('role_id') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('password')}">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input v-model="data.password" v-validate="{required:true}" ref="password" data-vv-as="Password" class="form-control" type="password" name="password" placeholder="•••••••••••••" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('password')" class="form-text text-danger">{{ errors.first('password') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('confirm_password')}">
                                    <label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                    <input v-model="data.confirm_password" v-validate="{ required:true, confirmed:'password' }" data-vv-as="Confirm Password" class="form-control" type="password" name="confirm_password" placeholder="•••••••••••••" style="border:1px solid #000;border-radius:9999px;">
                                    <small v-show="errors.has('confirm_password')" class="form-text text-danger">{{ errors.first('confirm_password') }}</small>
                                </div>

                                <div class="form-group" :class="{'has-error' : errors.has('profile_pics')}">
                                    <label for="profile_pics">Profile Picture (Optional)</label>
                                    <niceupload fieldname="profile_pics" control-class="upload-control" dropmsg="Drop files here or click to upload" uploadpath="uploads/files/" filenameformat="random" extensions="jpg, png, jpeg" :filesize="3" :maximum="1" name="profile_pics" v-model="data.profile_pics" v-validate="{required:false}" data-vv-as="Profile Pics"></niceupload>
                                    <small v-show="errors.has('profile_pics')" class="form-text text-danger">{{ errors.first('profile_pics') }}</small>
                                </div>

                                <div class="form-row mt-4">
                                    <button class="btn btn-primary btn-block" type="submit">
                                        <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader></i>
                                        Register
                                        <i class="fa fa-send"></i>
                                    </button>
                                </div>

                                <div style="margin-top: 12px; text-align: center;">
                                    Already have an account?
                                    <router-link to="/login">Login</router-link>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
    var RegisterComponent = Vue.component('Register', {
        template: '#Register',
        mixins: [AddPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'user',
            },
            routename: {
                type: String,
                default: 'useruserregister',
            },
            apipath: {
                type: String,
                default: 'index/register',
            },
        },
        data: function() {
            return {
                id: {
                    type: String,
                    default: '',
                },
                data: {
                    email: '',
                    phoneno: '',
                    password: '',
                    confirm_password: '',
                    role_id: 'user',
                    firstname: '',
                    lastname: '',
                    profile_pics: '',
                },
                roleOptionList: [{
                    "label": "User",
                    "value": "user"
                }, {
                    "label": "Rider",
                    "value": "driver"
                }],
                sexOptionList: ["Male", "Female"],
            }
        },
        computed: {
            pageTitle: function() {
                return 'Add New User';
            },
        },
        methods: {
            actionAfterSave: function(response) {
                this.$root.$emit('requestCompleted', this.msgaftersave);
                window.location = response.body;
            },
            resetForm: function() {
                this.data = {
                    email: '',
                    phoneno: '',
                    password: '',
                    confirm_password: '',
                    role_id: 'user',
                    firstname: '',
                    lastname: '',
                    title: '',
                    sex: '',
                    profile_pics: '',
                };
                this.$validator.reset();
            },
        },
        mounted: function() {},
    });
</script>
<style scoped>
    .main-container {
        background-color: #FFFFFF;
        background-image: radial-gradient(#28a745 1.1px, transparent 1.1px), radial-gradient(#28a745 1.1px, #FFFFFF 1.1px);
        background-size: 44px 44px;
        background-position: 0 0, 22px 22px;
        padding-bottom: 100px;
    }
</style>