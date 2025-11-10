<template id="paymentsView">
    <section class="page-component">
        <div class="page-container" style="padding-top: 100px;">
            <section class="page-header">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <h1 class="page-title">Payment Details</h1>
                            <p v-if="data.request_id" class="page-subtitle">For Request ID: #{{ data.request_id }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-sm" style="background-color: #f7f9fc;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div v-show="!loading">
                                <!-- Main Card for Payment Proof Image -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="mb-0">Proof of Payment</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <a :href="data.picture" target="_blank" title="View Full Image">
                                            <img :src="data.picture" class="img-fluid rounded" style="max-height: 500px; object-fit: contain;" alt="Proof of payment">
                                        </a>
                                    </div>
                                </div>

                                <!-- Card for Payment Details -->
                                <div class="card request-card">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th class="title" width="30%">Payer:</th>
                                                    <td class="value">{{ data.payer }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="title">Payment Method:</th>
                                                    <td class="value">{{ data.payment_method }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="title">Date Submitted:</th>
                                                    <td class="value">{{ data.created_at }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <div class="status-group">
                                            <strong class="mr-2">Status:</strong>
                                            <span v-if="data.status == 0">Confirmation Pending</span>
                                            <span v-if="data.status == 1">Payment Confirmed</span>
                                        </div>
                                        <div v-if="editbutton || deletebutton" class="action-group">
                                            <router-link class="btn btn-sm btn-info" v-if="editbutton" :to="'/payments/edit/' + data.id">
                                                <i class="ti-pencil"></i> Edit
                                            </router-link>
                                            <button @click="deleteRecord" class="btn btn-sm btn-danger" v-if="deletebutton">
                                                <i class="ti-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-show="loading" class="load-indicator static-center">
                                <span class="animator">
                                    <clip-loader :loading="loading" color="gray" size="20px"></clip-loader>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</template>

<script>
    var PaymentsViewComponent = Vue.component('paymentsView', {
        template: '#paymentsView',
        mixins: [ViewPageMixin],
        props: {
            pagename: {
                type: String,
                default: 'payments',
            },
            routename: {
                type: String,
                default: 'paymentsview',
            },
            apipath: {
                type: String,
                default: 'payments/view',
            },
        },
        data: function() {
            return {
                data: {
                    default: {
                        id: '',
                        request_id: '',
                        payer: '',
                        picture: '',
                        status: '',
                        created_at: '',
                        payment_method: '',
                    },
                },
            }
        },
        computed: {
            pageTitle: function() {
                return 'View  Payments';
            },
        },
        methods: {
            resetData: function() {
                this.data = {
                    id: '',
                    request_id: '',
                    payer: '',
                    picture: '',
                    status: '',
                    created_at: '',
                    payment_method: '',
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
        background-color: #FFFFFF;
        background-image: radial-gradient(#28a745 1.1px, transparent 1.1px), radial-gradient(#28a745 1.1px, #FFFFFF 1.1px);
        background-size: 44px 44px;
        background-position: 0 0, 22px 22px;
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

    .request-card {
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .card-header h5 {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .card-footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }

    .table th.title {
        font-weight: 600;
        color: #6c757d;
    }
</style>