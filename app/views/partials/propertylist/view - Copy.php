<template id="propertylistView">
       
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

                <div class="container">
                    <div class="row">
                        <!--============ Listing Detail =============================================================-->
                        <div class="col-md-9">
                            <!--Gallery Carousel-->
                            <section class="block">
                <div class="container" v-if="data.pictures.length">
                    <h2>Gallery</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">
                                <div class="item" style="height: fit-content;padding-left: 0rem;padding-right: 0rem;width: 100%;">
                                        <div class="image">
                                            <h3>
                                                <a href="#" class="tag category">{{ data.records.name }}</a>
                                                <!--<a href="single-listing-1.html" class="title">Furniture for sale</a>-->
                                                <span class="tag">Offer</span>
                                            </h3>
                                            
                                            <a class="image-wrapper background-image" v-bind:style="{ 'background-image': 'url(' + data.records.thumbnail + ')' }">
                                            </a>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4" v-for="(datas,index) in data.pictures">
                                    <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">
                                        <div class="item" style="height: fit-content;padding-left: 0rem;padding-right: 0rem;width: 100%;">
                                                <div class="image">
                                                    
                                                    <a class="image-wrapper background-image" v-bind:style="{ 'background-image': 'url(' + datas + ')' }">
                                                    <!--<niceimg :path="data.pictures" width="300" height="200" ></niceimg>-->
                                                    </a>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>

    
                    </div>
                </div>
            </section>
                            <!--end Gallery Carousel-->
                            <!--Description-->
                            <section>
                                <h2>Description</h2>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit
                                    amet fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                                    per inceptos himenaeos. Vestibulum tincidunt, sapien sagittis sollicitudin dapibus,
                                    risus mi euismod elit, in dictum justo lacus sit amet dui. Sed faucibus vitae nisl
                                    at dignissim.
                                </p>
                            </section>
                            <!--end Description-->
                            <!--Details & Location-->
                            <section>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h2>Details</h2>
                                        <dl>
                                            <dt>Date Added</dt>
                                            <dd>05.04.2017</dd>
                                            <dt>Type</dt>
                                            <dd>Offer</dd>
                                            <dt>Status</dt>
                                            <dd>Used</dd>
                                            <dt>First Owner</dt>
                                            <dd>Yes</dd>
                                            <dt>Material</dt>
                                            <dd>Wood, Leather</dd>
                                            <dt>Color</dt>
                                            <dd>White, Grey</dd>
                                            <dt>Height</dt>
                                            <dd>47cm</dd>
                                            <dt>Width</dt>
                                            <dd>203cm</dd>
                                            <dt>Length</dt>
                                            <dd>54cm</dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-8">
                                        <h2>Location</h2>
                                        <div class="map height-300px" id="map-small"></div>
                                    </div>
                                </div>
                            </section>
                            <!--end Details and Locations-->
                            <!--Features-->
                            <section>
                                <h2>Features</h2>
                                <ul class="features-checkboxes columns-3">
                                    <li>Quality Wood</li>
                                    <li>Brushed Alluminium Handles</li>
                                    <li>Foam mattress</li>
                                    <li>Detachable chaise section</li>
                                    <li>3 fold pull out mechanism</li>
                                </ul>
                            </section>
                            <!--end Features-->
                            <!--Author-->
                            <section>
                                <h2>Author</h2>
                                <div class="box">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="author">
                                                <div class="author-image">
                                                    <div class="background-image">
                                                        <img src="libb/assets/img/author-01.jpg" alt="">
                                                    </div>
                                                </div>
                                                <!--end author-image-->
                                                <div class="author-description">
                                                    <h3>Jane Doe</h3>
                                                    <div class="rating" data-rating="4"></div>
                                                    <a href="seller-detail-1.html" class="text-uppercase">Show My Listings
                                                        <span class="appendix">(12)</span>
                                                    </a>
                                                </div>
                                                <!--end author-description-->
                                            </div>
                                            <hr>
                                            <dl>
                                                <dt>Phone</dt>
                                                <dd>830-247-0930</dd>
                                                <dt>Email</dt>
                                                <dd>hijane@example.com</dd>
                                            </dl>
                                            <!--end author-->
                                        </div>
                                        <!--end col-md-5-->
                                        <div class="col-md-7">
                                            <form class="form email">
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Name</label>
                                                    <input name="name" type="text" class="form-control" id="name" placeholder="Your Name">
                                                </div>
                                                <!--end form-group-->
                                                <div class="form-group">
                                                    <label for="email" class="col-form-label">Email</label>
                                                    <input name="email" type="email" class="form-control" id="email" placeholder="Your Email">
                                                </div>
                                                <!--end form-group-->
                                                <div class="form-group">
                                                    <label for="message" class="col-form-label">Message</label>
                                                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Hi there! I am interested in your offer ID 53951. Please give me more details."></textarea>
                                                </div>
                                                <!--end form-group-->
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </form>
                                        </div>
                                        <!--end col-md-7-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end box-->
                            </section>
                            <!--End Author-->
                        </div>
                        <!--============ End Listing Detail =========================================================-->
                        <!--============ Sidebar ====================================================================-->
                        <div class="col-md-3">
                            <aside class="sidebar">
                                <section>
                                    <h2>Similar Ads</h2>
                                    <div class="items compact">
                                        <div class="item">
                                            <div class="ribbon-featured">Featured</div>
                                            <!--end ribbon-->
                                            <div class="wrapper">
                                                <div class="image">
                                                    <h3>
                                                        <a href="#" class="tag category">Home & Decor</a>
                                                        <a href="single-listing-1.html" class="title">Furniture for sale</a>
                                                        <span class="tag">Offer</span>
                                                    </h3>
                                                    <a href="single-listing-1.html" class="image-wrapper background-image">
                                                        <img src="libb/assets/img/image-01.jpg" alt="">
                                                    </a>
                                                </div>
                                                <!--end image-->
                                                <h4 class="location">
                                                    <a href="#">Manhattan, NY</a>
                                                </h4>
                                                <div class="price">$80</div>
                                                <div class="meta">
                                                    <figure>
                                                        <i class="fa fa-calendar-o"></i>02.05.2017
                                                    </figure>
                                                    <figure>
                                                        <a href="#">
                                                            <i class="fa fa-user"></i>Jane Doe
                                                        </a>
                                                    </figure>
                                                </div>
                                                <!--end meta-->
                                            </div>
                                            <!--end wrapper-->
                                        </div>
                                        <!--end item-->

                                        <div class="item">
                                            <div class="wrapper">
                                                <div class="image">
                                                    <h3>
                                                        <a href="#" class="tag category">Education</a>
                                                        <a href="single-listing-1.html" class="title">Creative Course</a>
                                                        <span class="tag">Offer</span>
                                                    </h3>
                                                    <a href="single-listing-1.html" class="image-wrapper background-image">
                                                        <img src="libb/assets/img/image-02.jpg" alt="">
                                                    </a>
                                                </div>
                                                <!--end image-->
                                                <h4 class="location">
                                                    <a href="#">Nashville, TN</a>
                                                </h4>
                                                <div class="price">$125</div>
                                                <div class="meta">
                                                    <figure>
                                                        <i class="fa fa-calendar-o"></i>28.04.2017
                                                    </figure>
                                                    <figure>
                                                        <a href="#">
                                                            <i class="fa fa-user"></i>Peter Browner
                                                        </a>
                                                    </figure>
                                                </div>
                                                <!--end meta-->
                                            </div>
                                            <!--end wrapper-->
                                        </div>
                                        <!--end item-->

                                        <div class="item">
                                            <div class="wrapper">
                                                <div class="image">
                                                    <h3>
                                                        <a href="#" class="tag category">Adventure</a>
                                                        <a href="single-listing-1.html" class="title">Into The Wild</a>
                                                        <span class="tag">Ad</span>
                                                    </h3>
                                                    <a href="single-listing-1.html" class="image-wrapper background-image">
                                                        <img src="libb/assets/img/image-03.jpg" alt="">
                                                    </a>
                                                </div>
                                                <!--end image-->
                                                <h4 class="location">
                                                    <a href="#">Seattle, WA</a>
                                                </h4>
                                                <div class="price">$1,560</div>
                                                <div class="meta">
                                                    <figure>
                                                        <i class="fa fa-calendar-o"></i>21.04.2017
                                                    </figure>
                                                    <figure>
                                                        <a href="#">
                                                            <i class="fa fa-user"></i>Peak Agency
                                                        </a>
                                                    </figure>
                                                </div>
                                                <!--end meta-->
                                            </div>
                                        </div>
                                        <!--end item-->
                                    </div>

                                </section>
                                <section>
                                    <h2>Search Ads</h2>
                                    <!--============ Side Bar Search Form ===========================================-->
                                    <form class="sidebar-form form">
                                        <div class="form-group">
                                            <label for="what" class="col-form-label">What?</label>
                                            <input name="keyword" type="text" class="form-control" id="what" placeholder="What are you looking for?">
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group">
                                            <label for="input-location" class="col-form-label">Where?</label>
                                            <input name="location" type="text" class="form-control" id="input-location" placeholder="Enter Location">
                                            <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top" title="Find My Position"><i class="fa fa-map-marker"></i></span>
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group">
                                            <label for="category" class="col-form-label">Category?</label>
                                            <select name="category" id="category" data-placeholder="Select Category">
                                                <option value="">Select Category</option>
                                                <option value="1">Computers</option>
                                                <option value="2">Real Estate</option>
                                                <option value="3">Cars & Motorcycles</option>
                                                <option value="4">Furniture</option>
                                                <option value="5">Pets & Animals</option>
                                            </select>
                                        </div>
                                        <!--end form-group-->
                                        <button type="submit" class="btn btn-primary width-100">Search</button>

                                        <!--Alternative Form-->
                                        <div class="alternative-search-form">
                                            <a href="#collapseAlternativeSearchForm" class="icon" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseAlternativeSearchForm"><i class="fa fa-plus"></i>More Options</a>
                                            <div class="collapse" id="collapseAlternativeSearchForm">
                                                <div class="wrapper">
                                                    <label>
                                                        <input type="checkbox" name="new">
                                                        New
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" name="used">
                                                        Used
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" name="with_photo">
                                                        With Photo
                                                    </label>
                                                    <label>
                                                        <input type="checkbox" name="featured">
                                                        Featured
                                                    </label>
                                                    <div class="form-group">
                                                        <input name="min_price" type="text" class="form-control small" id="min-price" placeholder="Minimal Price">
                                                        <span class="input-group-addon small">$</span>
                                                    </div>
                                                    <!--end form-group-->
                                                    <div class="form-group">
                                                        <input name="max_price" type="text" class="form-control small" id="max-price" placeholder="Maximal Price">
                                                        <span class="input-group-addon small">$</span>
                                                    </div>
                                                    <!--end form-group-->
                                                    <div class="form-group">
                                                        <select name="distance" id="distance" class="small" data-placeholder="Distance" >
                                                            <option value="">Distance</option>
                                                            <option value="1">1km</option>
                                                            <option value="2">5km</option>
                                                            <option value="3">10km</option>
                                                            <option value="4">50km</option>
                                                            <option value="5">100km</option>
                                                        </select>
                                                    </div>
                                                    <!--end form-group-->
                                                </div>
                                                <!--end wrapper-->
                                            </div>
                                            <!--end collapse-->
                                        </div>
                                        <!--end alternative-search-form-->
                                    </form>
                                    <!--============ End Side Bar Search Form =======================================-->
                                </section>
                            </aside>
                        </div>
                        <!--============ End Sidebar ================================================================-->
                    </div>
                </div>
                <!--end container-->
        </section>
        <!--end content-->

        <!--*********************************************************************************************************-->
        <!--************ FOOTER *************************************************************************************-->
        <!--*********************************************************************************************************-->
        <section class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="#" class="brand">
                            <img src="libb/assets/img/logo.png" alt="">
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
                    <img src="libb/assets/img/footer-background-icons.jpg" alt="">
                </div>
                <!--end background-image-->
            </div>
            <!--end background-->
        </section>
        <!--end footer-->
    </div>
    <!--end page-->

</div>
</template>
    <script>
	var PropertylistViewComponent = Vue.component('propertylistView', {
		template : '#propertylistView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type : String,
				default : 'propertylist',
			},
			routename : {
				type : String,
				default : 'propertylistview',
			},
			apipath: {
				type : String,
				default : 'propertylist/view',
			},
			editbutton: {
				type: Boolean,
				default: false,
			},
			deletebutton: {
				type: Boolean,
				default: false,
			},
			exportbutton: {
				type: Boolean,
				default: false,
			},
		},
		data: function() {
			return {
				data : {
					default :{
						id: '',name: '',address: '',landmark: '',longitude: '',latitude: '',status: '',pictures: '',description: '',frequency: '',rate: '',price: '',discount: '',location_name: '',area: '',city: '',state: '',country: '',propertytype_name: '',type: '',rating_rate: '',review: '',auth_id: '',profile_pics: '',
					},
				},
			}
		},
		computed: {
			pageTitle: function(){
				return 'View  Propertylist';
			},
		},
		methods :{
			resetData : function(){
				this.data = {
					id: '',name: '',address: '',landmark: '',longitude: '',latitude: '',status: '',pictures: '',description: '',frequency: '',rate: '',price: '',discount: '',location_name: '',area: '',city: '',state: '',country: '',propertytype_name: '',type: '',rating_rate: '',review: '',auth_id: '',profile_pics: '',
				}
			},
		},
	});
	</script>
