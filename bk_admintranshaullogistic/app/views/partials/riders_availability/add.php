<template id="riders_availabilityAdd">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">Add New Rider Availability</h1>
                        <p class="page-subtitle">Set the initial location and status for a new rider entry.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="background-color: #f7f9fc;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card p-4 p-md-5">
                            <div v-if="!loading">
                                <form enctype="multipart/form-data" @submit="save" class="form form-default" method="post">

                                    <div class="form-group">
                                        <label for="rider_id">Rider <span class="text-danger">*</span></label>
                                        <input
                                            v-model="data.rider_id"
                                            v-validate="{required:true}"
                                            data-vv-as="Rider"
                                            name="rider_id"
                                            type="number"
                                            placeholder="Enter Rider Id"
                                            class="form-control">
                                        </input>
                                        <small v-show="errors.has('rider_id')" class="form-text text-danger">
                                            {{ errors.first('rider_id') }}
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input v-model="data.location"
                                            class="form-control"
                                            type="text"
                                            name="location"
                                            placeholder="Enter Location"
                                            style="border-radius: 9999px;" />
                                        <small v-show="errors.has('location')" class="form-text text-danger">
                                            {{ errors.first('location') }}
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select v-model="data.status"
                                            v-validate="{required:true}"
                                            data-vv-as="Status"
                                            class="form-control"
                                            name="status"
                                            style="border-radius: 9999px;">
                                            <option value="" disabled>Select a status...</option>
                                            <option v-for="option in statusOptionList" :key="option.value" :value="option.value">
                                                {{ option.label }}
                                            </option>
                                        </select>
                                        <small v-show="errors.has('status')" class="form-text text-danger">
                                            {{ errors.first('status') }}
                                        </small>
                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <button :disabled="errors.any()" class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 9999px;">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader></i>
                                            Add Rider Availability
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>

                                </form>
                            </div>
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
    var Riders_AvailabilityAddComponent = Vue.component('riders_availabilityAdd', {
        template: '#riders_availabilityAdd',
        mixins: [AddPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'riders_availability',
            },
            routename: {
                type: String,
                default: 'riders_availabilityadd',
            },
            apipath: {
                type: String,
                default: 'riders_availability/add',
            },
        },
        data: function() {
            return {
                data: {
                    rider_id: '',
                    location: '',
                    status: '',
                },
                statusOptionList: [{
                        value: 0,
                        label: 'Online'
                    },
                    {
                        value: 1,
                        label: 'Offline'
                    },
                ]
            }
        },
        computed: {
            pageTitle: function() {
                return 'Add New Rider Availability';
            },
        },
        methods: {
            actionAfterSave: function(response) {
                this.$root.$emit('requestCompleted', this.msgaftersave);
                this.$router.push('/riders_availability');
            },
            resetForm: function() {
                this.data = {
                    rider_id: '',
                    location: '',
                    status: '',
                };
                this.$validator.reset();
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
</style>