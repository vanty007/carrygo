<template id="LandingPage">
    <div class="landing-page-container">

        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-content order-2 order-lg-1 text-center text-lg-left">
                        <h1 class="hero-headline">
                            Fast Deliveries &<br>Earning Opportunities in <span class="highlight-text">Canada</span>
                        </h1>
                        <p class="hero-subheadline">
                            Whether you're sending a package across town or looking to earn on your own schedule, we've got you covered. Choose your path below to get started.
                        </p>
                    </div>
                    <div class="col-lg-6 hero-image-container order-1 order-lg-2 mb-5 mb-lg-0">
                        <img src="assets/images/hero-driver1.png" alt="Delivery Rider in Canada" class="img-fluid rounded-lg">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm" style="padding-top: 0; margin-top: -60px; position: relative; z-index: 2;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="choice-card h-100">
                            <div class="icon-circle mb-3"><i class="ti-package"></i></div>
                            <h3>Are you a Customer?</h3>
                            <p class="text-muted">Send packages quickly and track them every step of the way. Reliable, fast, and secure delivery for your personal or business needs.</p>
                            <div class="mt-auto pt-3">
                                <a :href="links.userLogin" class="btn btn-primary btn-block mb-2">Login as Customer</a>
                                <a :href="links.userRegister" class="btn btn-outline-primary btn-block">Register as Customer</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="choice-card h-100">
                            <div class="icon-circle mb-3"><i class="ti-truck"></i></div>
                            <h3>Want to be a Rider?</h3>
                            <p class="text-muted">Join our team of riders and earn money on your own schedule. Get access to a steady stream of delivery jobs right from your phone.</p>
                            <div class="mt-auto pt-3">
                                <a :href="links.driverLogin" class="btn btn-success btn-block mb-2">Rider Login</a>
                                <a :href="links.driverRegister" class="btn btn-outline-success btn-block">Become a Rider</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm">
            <div class="container">
                <h2 class="text-center mb-5">Why Choose Us?</h2>
                <div class="row text-center">
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="feature-item">
                            <div class="icon-circle mb-3"><i class="ti-map-alt"></i></div>
                            <h4>Real-Time Tracking</h4>
                            <p class="text-muted">Both customers and riders can track every delivery from pickup to drop-off, ensuring peace of mind.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="feature-item">
                            <div class="icon-circle mb-3"><i class="ti-lock"></i></div>
                            <h4>Secure & Reliable</h4>
                            <p class="text-muted">Our platform ensures secure payments and our riders are vetted for safe and dependable service.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="feature-item">
                            <div class="icon-circle mb-3"><i class="ti-headphone-alt"></i></div>
                            <h4>Local Support</h4>
                            <p class="text-muted">Need help? Our support team is based right here in Canada, ready to assist you with any questions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-sm">
            <div class="container">
                <h2 class="text-center mb-5">Frequently Asked Questions</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div id="faq-accordion">
                            <div class="card mb-3">
                                <div class="card-header" id="faq-heading-1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#faq-collapse-1" aria-expanded="true">
                                            What kind of items can I send?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faq-collapse-1" class="collapse show" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        You can send almost anything, from documents and small parcels to larger items like electronics and appliances. However, we do not transport illegal, hazardous, or perishable items.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header" id="faq-heading-2">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#faq-collapse-2">
                                            How is the delivery price calculated?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faq-collapse-2" class="collapse" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        Our pricing is based on the distance between the pickup and delivery locations, the size and weight of your item, and the delivery option you choose (Standard or Express).
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header" id="faq-heading-3">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#faq-collapse-3">
                                            How do I become a rider?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faq-collapse-3" class="collapse" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        We're always looking for reliable riders! To join our team, you'll need a valid rider's license, a road-worthy motorcycle, and a smartphone. Click the "Become a Rider" button to start your application process.
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header" id="faq-heading-4">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#faq-collapse-4">
                                            How can I track my package?
                                        </button>
                                    </h5>
                                </div>
                                <div id="faq-collapse-4" class="collapse" data-parent="#faq-accordion">
                                    <div class="card-body">
                                        Once your pickup is confirmed, you will receive a unique tracking ID. You can enter this ID on our "Track Delivery" page to see the real-time status and location of your package.
                                    </div>
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
    var LandingPageComponent = Vue.component('LandingPageComponent', {
        template: '#LandingPage',
        data: function() {
            return {
                links: {
                    userLogin: '#/login',

                    userRegister: '#/register',

                    driverLogin: '#/login',

                    driverRegister: '#/register'
                }
            };
        }
    });
</script>

<style scoped>
    .landing-page-container {
        padding-top: 50px;
        background-color: #fff;
    }

    .hero-section {
        padding: 80px 0;
        background-color: #fff;
        position: relative;
    }

    .hero-headline {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .hero-headline .highlight-text {
        color: #28a745;
    }

    .hero-subheadline {
        font-size: 1.2rem;
        color: #6c757d;
        max-width: 700px;
        margin: 20px auto 0;
        margin-left: 0;
    }

    .choice-card {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .choice-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
    }

    .choice-card h3 {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .choice-card .btn {
        border-radius: 50px;
        padding: 12px 20px;
        font-weight: 600;
    }

    .choice-card .icon-circle {
        width: 70px;
        height: 70px;
        font-size: 2rem;
        background-color: #e8f5e9;
        color: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .feature-item .icon-circle {
        width: 80px;
        height: 80px;
        font-size: 2.5rem;
        background-color: #e8f5e9;
        color: #28a745;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .feature-item h4 {
        font-weight: 600;
    }

    #faq-accordion .card {
        /* border: 1px solid #e9ecef; */
        /* border-radius: 10px !important; */
        box-shadow: none;
    }

    #faq-accordion .card-header {
        background-color: #fff;
        border-bottom: none;
        padding: 0;
    }

    #faq-accordion .btn-link {
        width: 100%;
        text-align: left;
        padding: 1.25rem;
        color: #212529;
        font-weight: 600;
        text-decoration: none;
        position: relative;
    }

    #faq-accordion .btn-link:after {
        content: '\e64b';
        font-family: 'themify';
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        transition: transform 0.3s ease;
    }

    #faq-accordion .btn-link[aria-expanded="true"]:after {
        transform: translateY(-50%) rotate(180deg);
    }

    #faq-accordion .card-body {
        color: #6c757d;
    }

    @media (max-width: 991.98px) {
        .hero-headline {
            font-size: 2.5rem;
        }

        .hero-section {
            text-align: center;
        }

        .hero-subheadline {
            margin: 20px auto 0;
        }
    }
</style>