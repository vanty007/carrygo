<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="shortcut icon" href="<?php print_link(SITE_FAVICON); ?>" />
	<?php
	Html::page_title(SITE_NAME);
	Html::page_meta('theme-color', META_THEME_COLOR);
	Html::page_meta('author', META_AUTHOR);
	Html::page_meta('keyword', META_KEYWORDS);
	Html::page_meta('description', META_DESCRIPTION);
	Html::page_meta('viewport', META_VIEWPORT);
	Html::page_css('font-awesome.min.css');
	Html::page_css('animate.css');
	?>
	<?php
	Html::page_css('bootstrap-theme-pulse-blue.css');
	Html::page_css('custom-style.css');
	?>

	<style>
		#main-content {
			padding: 0;
			min-height: 500px;
		}
	</style>
	<link rel="stylesheet" href="../lib/plugins/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="https://demo.themefisher.com/reader-bootstrap/plugins/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="../lib/plugins/slick/slick.css">
	<link rel="stylesheet" href="../lib/css/style.css" media="screen">

	<!--Favicon-->
	<link rel="shortcut icon" href="../lib/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="../lib/images/favicon.png" type="image/x-icon">
</head>

<body>
	<div>
		<header class="navigation fixed-top">
			<div class="container">
				<nav class="navbar navbar-expand-lg navbar-white">
					<a class="navbar-brand" href="/">
						<img class="img-fluid" width="100px" src="../lib/images/logo.png"
							alt="Reader | Hugo Personal Blog Template">
					</a>

					<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navigation">
						<i class="ti-menu"></i>
					</button>

					<div class="collapse navbar-collapse" id="navigation">
						<?php
						if (user_login_status() == true) {
						?>
							<ul class="navbar-nav mx-auto">
								<li class="nav-item">
									<a class="nav-link" href="../">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="../#trackitems">Track Delivery Items</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="../#payments">Payments History</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="info/contact">Contact Us</a>
								</li>
							</ul>

							<div class="d-flex align-items-center">
								<div class="nav-item nav-logout">
									<a class="nav-link" href="<?php print_link('index/logout?csrf_token=' . Csrf::$token) ?>"><i class="fa fa-sign-out"></i> Logout</a>
								</div>
							</div>
						<?php } else { ?>
							<ul class="navbar-nav ml-auto">
									<li class="nav-item">
										<a href="../" class="nav-link">Home</a>
									</li>
									<li class="nav-item">
										<a href="contact" class="nav-link">Contact Us</a>
									</li>
									<li class="nav-item">
										<a href="../" class="nav-link">Login</a>
									</li>
									<li class="nav-item">
										<router-link to="../#register" class="nav-link">Register</router-link>
									</li>
							</ul>
						<?php } ?>
					</div>
				</nav>
			</div>
		</header>
	</div>
	<div style="height:70px;"></div>

	<div id="main-content">
		<?php $this->render_body(); ?>
	</div>

	<?php $this->load_view("components/appfooter.php"); ?>

	<script src="../lib/plugins/jQuery/jquery.min.js"></script>
	<script src="../lib/plugins/bootstrap/bootstrap.min.js"></script>
	<script src="../lib/plugins/slick/slick.min.js"></script>
	<script src="../lib/plugins/instafeed/instafeed.min.js"></script>
	<script src="../lib/js/script.js"></script>
</body>

</html>