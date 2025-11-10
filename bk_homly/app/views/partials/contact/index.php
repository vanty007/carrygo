<template id="contact">
<div>
 <div class="page sub-page">
        <!--*********************************************************************************************************-->
        <!--************ HERO ***************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="hero">
            <div class="hero-wrapper">
                <!--============ Secondary Navigation ===============================================================-->
				<?php
				  if(user_login_status() != true){
					?>
                <div class="secondary-navigation">
                    <div class="container">
                        <!--<ul class="left">
                            <li>
                            <span>
                                <i class="fa fa-phone"></i> +1 123 456 789
                            </span>
                            </li>
                        </ul>
                        end left-->
                        <ul class="right">
                            <li>
                                <a href="sign-in.html">
                                    <i class="fa fa-sign-in"></i>Sign In
                                </a>
                            </li>
                            <li>
                                <a href="register.html">
                                    <i class="fa fa-pencil-square-o"></i>Register
                                </a>
                            </li>
                        </ul>
                        <!--end right-->
                    </div>
                    <!--end container-->
                </div>
				<?php
               }
                  ?>
                <!--============ End Secondary Navigation ===========================================================-->
                <!--============ Main Navigation ====================================================================-->
                <div class="main-navigation">
                <div class="container">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                            <a class="navbar-brand" href="">
                                <!--<img src="libb/assets/img/logo.jpg" alt="">--> Homly
                            </a>
                            <button style="color:#fff;background-color:#fff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon" style="color:#fff;background-color:#fff;"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbar">
                                <!--Main navigation list-->
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#propertysearch">More Homes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#myreservation">My Reservations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li>
                                </ul>
                                <!--Main navigation list-->
                            </div>
                            <!--end navbar-collapse-->
                        </nav>
                        <!--end navbar-->
                    </div>
                    <!--end container-->
                </div>
                <!--============ End Main Navigation ================================================================-->
            </div>
            <!--end hero-wrapper-->
        </section>
        <!--end hero-->

        <!--*********************************************************************************************************-->
        <!--************ CONTENT ************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="content">
            <section class="block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h2>Get In Touch</h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit
                                amet fermentum sem. Class aptent taciti sociosqu ad litora
                            </p>
                            <br>
                            <figure class="with-icon">
                                <i class="fa fa-map-marker"></i>
                                <span>2519 Stanley Avenue<br>Huntington, NY 11743 </span>
                            </figure>
                            <br>
                            <figure class="with-icon">
                                <i class="fa fa-phone"></i>
                                <span>+1 516-480-4273</span>
                            </figure>
                            <figure class="with-icon">
                                <i class="fa fa-envelope"></i>
                                <a href="#">hello@example.com</a>
                            </figure>
                            <figure class="with-icon">
                                <i class="fa fa-envelope"></i>
                                <a href="#">support@example.com</a>
                            </figure>
                        </div>
                        <!--end col-md-4-->
                        <div class="col-md-8">
                            <h2>Contact Form</h2>
                            <form class="form email">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label required">Your Name</label>
                                            <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" required>
                                        </div>
                                        <!--end form-group-->
                                    </div>
                                    <!--end col-md-6-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label required">Your Email</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" required>
                                        </div>
                                        <!--end form-group-->
                                    </div>
                                    <!--end col-md-6-->
                                </div>
                                <!--end row-->
                                <div class="form-group">
                                    <label for="subject" class="col-form-label">Subject</label>
                                    <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
                                </div>
                                <!--end form-group-->
                                <div class="form-group">
                                    <label for="message" class="col-form-label required">Your Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
                                </div>
                                <!--end form-group-->
                                <button type="submit" class="btn btn-primary float-right">Send Message</button>
                            </form>
                            <!--end form-->
                        </div>
                        <!--end col-md-8 -->
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            <!--end block-->
        </section>
        <!--end content-->

        <!--*********************************************************************************************************-->
        <!--************ FOOTER *************************************************************************************-->
        <!--*********************************************************************************************************-->
        <footer class="footer">
            <div class="wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <a href="#" class="brand">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet
                                fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra.
                            </p>
                        </div>
                        <!--end col-md-5-->
                        <div class="col-md-3">
                            <h2>Navigation</h2>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <nav>
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="#">Home</a>
                                            </li>
                                            <li>
                                                <a href="#">Listing</a>
                                            </li>
                                            <li>
                                                <a href="#">Pages</a>
                                            </li>
                                            <li>
                                                <a href="#">Extras</a>
                                            </li>
                                            <li>
                                                <a href="#">Contact</a>
                                            </li>
                                            <li>
                                                <a href="#">Submit Ad</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <nav>
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="#">My Ads</a>
                                            </li>
                                            <li>
                                                <a href="#">Sign In</a>
                                            </li>
                                            <li>
                                                <a href="#">Register</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!--end col-md-3-->
                        <div class="col-md-4">
                            <h2>Contact</h2>
                            <address>
                                <figure>
                                    124 Abia Martin Drive<br>
                                    New York, NY 10011
                                </figure>
                                <br>
                                <strong>Email:</strong> <a href="#">hello@example.com</a>
                                <br>
                                <strong>Skype: </strong> Craigs
                                <br>
                                <br>
                                <a href="contact.html" class="btn btn-primary text-caps btn-framed">Contact Us</a>
                            </address>
                        </div>
                        <!--end col-md-4-->
                    </div>
                    <!--end row-->
                </div>
                <div class="background">
                    <div class="background-image original-size">
                        <img src="assets/img/footer-background-icons.jpg" alt="">
                    </div>
                    <!--end background-image-->
                </div>
                <!--end background-->
            </div>
        </footer>
        <!--end footer-->
    </div>
    <!--end page-->
</div>
</template>

<script>
			var ContactComponent = Vue.component('ContactComponent', {
				template : '#Contact',
				props: {
					resetgrid : {
						type : Boolean,
						default : false,
					},
				},
				data : function() {
					return {
						loading : false,
						ready: false,
					}
				},
				computed: {
					setGridSize: function(){
						if(this.resetgrid){
							return 'col-sm-12 col-md-12 col-lg-12';
						}
					}
				},
				methods : {

				},
				mounted : function() {
					this.ready = true;
				},
			});
	</script>
