<template id="delivery_optionEdit">
    <div>
        <section class="page-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="page-title">Edit Delivery Option</h1>
                        <p class="page-subtitle">Update the details for this delivery option and its pricing.</p>
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
                                <form enctype="multipart/form-data" @submit.prevent="update()" class="form form-default" method="post">

                                    <div class="form-group">
                                        <label for="delivery_option">Delivery Option Name <span class="text-danger">*</span></label>
                                        <input v-model="data.delivery_option" v-validate="{required:true}" data-vv-as="Delivery Option" class="form-control" type="text" name="delivery_option" placeholder="e.g., Standard, Express" style="border-radius: 9999px;">
                                        <small v-show="errors.has('delivery_option')" class="form-text text-danger">{{ errors.first('delivery_option') }}</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="items">Applicable Items <span class="text-danger">*</span></label>
                                                <input v-model="data.items" v-validate="{required:true}" data-vv-as="Items" class="form-control" type="text" name="items" placeholder="e.g., Documents, Small Parcels" style="border-radius: 9999px;">
                                                <small v-show="errors.has('items')" class="form-text text-danger">{{ errors.first('items') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input v-model="data.category" class="form-control" type="text" name="category" placeholder="e.g., General, Fragile" style="border-radius: 9999px;">
                                                <small v-show="errors.has('category')" class="form-text text-danger">{{ errors.first('category') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5 class="mb-3">Pricing Details</h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pricing_per_km">Pricing Per Km (₦) <span class="text-danger">*</span></label>
                                                <input v-model="data.pricing_per_km" v-validate="{required:true}" data-vv-as="Pricing Per Km" class="form-control" type="number" name="pricing_per_km" step="0.01" style="border-radius: 9999px;">
                                                <small v-show="errors.has('pricing_per_km')" class="form-text text-danger">{{ errors.first('pricing_per_km') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pricing_higher_km">Pricing for Higher Km (₦) <span class="text-danger">*</span></label>
                                                <input v-model="data.pricing_higher_km" v-validate="{required:true}" data-vv-as="Pricing Higher Km" class="form-control" type="number" name="pricing_higher_km" step="0.01" style="border-radius: 9999px;">
                                                <small v-show="errors.has('pricing_higher_km')" class="form-text text-danger">{{ errors.first('pricing_higher_km') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="totalamount">Base Amount (₦) <span class="text-danger">*</span></label>
                                        <input v-model="data.totalamount" v-validate="{required:true}" data-vv-as="Total Amount" class="form-control" type="number" name="totalamount" step="0.01" style="border-radius: 9999px;">
                                        <small v-show="errors.has('totalamount')" class="form-text text-danger">{{ errors.first('totalamount') }}</small>
                                    </div>

                                    <div class="form-group text-center mt-4">
                                        <button :disabled="errors.any()" class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 9999px;">
                                            <i class="load-indicator"><clip-loader :loading="saving" color="#fff" size="14px"></clip-loader></i>
                                            Update Delivery Option
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
    var Delivery_OptionEditComponent = Vue.component('delivery_optionEdit', {
        template: '#delivery_optionEdit',
        mixins: [EditPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'delivery_option',
            },
            routename: {
                type: String,
                default: 'delivery_optionedit',
            },
            apipath: {
                type: String,
                default: 'delivery_option/edit',
            },
        },
        data: function() {
            return {
                data: {
                    items: '',
                    category: '',
                    delivery_option: '',
                    pricing_per_km: '',
                    pricing_higher_km: '',
                    totalamount: '',
                },
            }
        },
        computed: {
            pageTitle: function() {
                return 'Edit Delivery Option';
            },
        },
        methods: {
            actionAfterUpdate: function(response) {
                this.$root.$emit('requestCompleted', this.msgafterupdate);
                if (!this.ismodal) {
                    this.$router.push('/delivery_option');
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