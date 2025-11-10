<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="shortcut icon" href="<?php print_link(SITE_FAVICON); ?>" />
		<?php 
			Html ::  page_title(SITE_NAME);
			Html ::  page_meta('theme-color',META_THEME_COLOR);
			Html ::  page_meta('author',META_AUTHOR); 
			Html ::  page_meta('keyword',META_KEYWORDS); 
			Html ::  page_meta('description',META_DESCRIPTION); 
			Html ::  page_meta('viewport',META_VIEWPORT);
			Html ::  page_css('font-awesome.min.css');
			Html ::  page_css('animate.css');
		?>
				<?php 
			Html ::  page_css('bootstrap-theme-pulse-blue.css');
			Html ::  page_css('custom-style.css');
		?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="../libb/assets/css/style.css">
<link rel="stylesheet" href="../libb/assets/css/main-color.css" id="colors">
<link rel="stylesheet" href="../libb/assets/css/plugins/revolutionslider.css">
<link href="../libb/assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">
<link href="../libb/assets/fonts/simple-line-icons.ttf?thkwh4" rel="stylesheet" type="text/css">
<link href="../libb/assets/fonts/iconsmind.woff?-rdmvgc" rel="stylesheet" type="text/css">
<link href="../libb/assets/fonts/fontello.woff" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="main-content">
			<?php $this->render_body();?>
		</div>
<script type="text/javascript" src="../libb/assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/jquery-migrate-3.3.2.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/mmenu.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/chosen.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/slick.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/rangeslider.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/magnific-popup.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/counterup.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/tooltips.min.js"></script>
<script type="text/javascript" src="../libb/assets/js/custom.js"></script>
<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->

<script>
	function fhome(){
		window.location.href = '..#/';
		//location.reload();
    } 
	function fpropertysearch(){
		window.location.href = '..#/propertysearch';
		//location.reload();
    }
	function fdashboard(){
		window.location.href = '..#/dashboard';
    }
	function fmyfavourite(){
		window.location.href = '..#/myfavourite';
		//location.reload();
    }
	function fmyreservation(){
		window.location.href = '..#/myreservation';
		//location.reload();
    }	
	function fmyreservation(){
		window.location.href = '..#/myreservation';
		//location.reload();
    }	
	function fmessages(){
		window.location.href = '..#/messages';
		//location.reload();
    }
	function fpayment(){
		window.location.href = '..#/payment';
		//location.reload();
    }
	
</script>
	</body>
</html>