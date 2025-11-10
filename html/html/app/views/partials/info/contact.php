<div id="wrapper">

<header id="header-container">

<!-- Header -->
<div id="header">
   <div class="container">
	   
	   <!-- Left Side Content -->
	   <div class="left-side">
		   
		   <!-- Logo -->
		   <div id="logo">
			   <a href="#"><img src="../
			   libb/assets/images/logo.png" alt=""></a>
		   </div>

		   <!-- Mobile Navigation -->
		   <div class="mmenu-trigger">
			   <button class="hamburger hamburger--collapse" type="button">
				   <span class="hamburger-box">
					   <span class="hamburger-inner"></span>
				   </span>
			   </button>
		   </div>

		   <!-- Main Navigation -->
		   <nav id="navigation" class="style-1">
		   <ul id="responsive" >

						<li onclick="fhome()"><a>Home</a></li>
						<li onclick="fpropertysearch()"><a>More Homes</a></li>
						<li onclick="fmyreservation()"><a>My Reservation</a></li>
						<li><a class="current" href="info/contact">Contact</a></li>
						<li><a href="..#/account/edit">Profile</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
					<!-- User Menu -->
					<?php
					if(user_login_status() == true){
						?>
					<div class="user-menu">
						<div class="user-name"><span><img src=" <?php echo USER_PHOTO ?>" alt=""></span>Hi, <?php echo FIRST_NAME ?>!</div>
						<ul>
							<li onclick="fmyreservation()"><a><i class="sl sl-icon-book-open"></i> My Reservations</a></li>
							<li onclick="fmyfavourite()"><a><i class="sl sl-icon-star"></i> My Favourite</a></li>
							<li onclick="fmessages()"><a><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
							<li onclick="fpayment()"><a><i class="sl sl-icon-wallet"></i> My Payment</a></li>
							<li><a href="../#account/edit"><i class="sl sl-icon-user"></i>My Profile</a></li>
							<li><a href="<?php print_link('index/logout?csrf_token='.Csrf::$token) ?>"><i class="sl sl-icon-power"></i> Logout</a></li>
						</ul>
					</div>
					<?php

if(user_login_status() == true){
	if(ROLE_ID == 'administrator'){
	//echo 'hjj'.ROLE_ID;
	?>
	<a id="dashboard2"  onclick="fdashboard()" class="sign-in"><i class="sl sl-icon-screen-desktop"></i>Dashboard</a>
	<!--<li><a id="dashboard2" href="#/dashboard">Dashboard</a></li>-->
	<?php
	}
else{
	?>
	<a href="..#/owner/add"><i class="sl sl-icon-briefcase"></i>Own Property</a>
	<?php
}
}


					}
					else{
						?>
					<?php
					}
					?>
				</div>
			</div>
			<!-- Right Side Content / End -->


		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<br>
<!-- Container / Start -->
<div class="container">

	<div class="row">

		<!-- Contact Details -->
		<div class="col-md-4">

			<h4 class="headline margin-bottom-30">Find Us There</h4>

			<!-- Contact Details -->
			<div class="sidebar-textbox">
				<p>Collaboratively administrate channels whereas virtual. Objectively seize scalable metrics whereas proactive e-services.</p>

				<ul class="contact-details">
					<li><i class="im im-icon-Phone-2"></i> <strong>Phone:</strong> <span>(123) 123-456 </span></li>
					<li><i class="im im-icon-Fax"></i> <strong>Fax:</strong> <span>(123) 123-456 </span></li>
					<li><i class="im im-icon-Globe"></i> <strong>Web:</strong> <span><a href="#">www.example.com</a></span></li>
					<li><i class="im im-icon-Envelope"></i> <strong>E-Mail:</strong> <span><a href="#">office@example.com</a></span></li>
				</ul>
			</div>

		</div>

		<!-- Contact Form -->
		<div class="col-md-8">

			<section id="contact">
				<h4 class="headline margin-bottom-35">Contact Form</h4>

				<div id="contact-message"></div> 

					<form method="post" action="contact.php" name="contactform" id="contactform" autocomplete="on">

					<div class="row">
						<div class="col-md-6">
							<div>
								<input name="name" type="text" id="name" placeholder="Your Name" required="required" />
							</div>
						</div>

						<div class="col-md-6">
							<div>
								<input name="email" type="email" id="email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
							</div>
						</div>
					</div>

					<div>
						<input name="subject" type="text" id="subject" placeholder="Subject" required="required" />
					</div>

					<div>
						<textarea name="comments" cols="40" rows="3" id="comments" placeholder="Message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="submit" class="submit button" id="submit" value="Submit Message" />

					</form>
			</section>
		</div>
		<!-- Contact Form / End -->

	</div>

</div>
<!-- Container / End -->

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


</div>
<!-- Wrapper / End -->
