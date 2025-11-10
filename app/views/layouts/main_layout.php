<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="<?php echo PAGE_CHARSET ?>">
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
			//Html ::  page_css('bootstrap-vue.min.css');
			//Html ::  page_css('vue-form-wizard.css');
			
			

		?>
				<?php 
			//Html ::  page_css('bootstrap-theme-pulse-blue.css');
			//Html ::  page_css('custom-style.css');
		?>


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="libb/assets/css/style.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="libb/assets/css/main-color.css" id="colors">
<link rel="stylesheet" href="libb/assets/css/plugins/revolutionslider.css">
<link href="libb/assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/simple-line-icons.ttf?thkwh4" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/iconsmind.woff?-rdmvgc" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/fontello.woff" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="libb/assets/css/style_new.css">
<link rel="stylesheet" href="libb/assets/css/custom-frontend.min.css">
<link href="libb/assets/css/material-dashboard.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
	<style>
    .winners-section {
      padding: 20px;
      overflow: hidden;
      position: relative;
    }
    .winners-title {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
    }
    .winners-slider {
      display: flex;
      white-space: nowrap;
      animation: scroll 20s linear infinite;
    }
    .winner-card {
      display: inline-block;
      background-color: #1c1c1c;
      border-radius: 8px;
      padding: 15px;
      margin-right: 10px;
      width: 220px;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }
    .winner-card h4 {
      color: #00ff88;
      font-weight: bold;
      margin: 5px 0;
    }
    .winner-card small {
      color: #aaa;
    }
    @keyframes scroll {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

	
		.main1 {
            text-align: center;
        }

        .marq {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .geek1 {
            font-size: 20px;
            font-weight: bold;
            color: white;
            padding-bottom: 0px;
        }
  	.ui-autocomplete-loading {
    background: white url("libb/assets/img/loader.gif") right center no-repeat; background-size: 20px 20px;

        .content {
		position: fixed;
		height: 300px;
		top:50%;
		left:50%;
		transform: translate(-50%, -50%);
        }
        
        .close-btn {
            position: absolute;
            right: 20px;
            top: 15px;
            background-color: black;
            color: white;
            border-radius: 50%;
            padding: 4px;
        }
  	}
  	</style>

  <style>
    :root{
      --accent:#ff6b6b;
      --bg:#0f1724;
      --card:#0b1220;
      --text:#e6eef8;
      --muted:#a9b4c8;
    }

    .promo-card{
      background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-radius:14px;
      box-shadow: 0 10px 10px rgba(2,6,23,0.6);
      padding:24px;
      width:100%;
      text-align:center;
    }
    .badge{
      display:inline-block;
      background:var(--accent);
      color:#fff;
      padding:6px 10px;
      border-radius:999px;
      font-weight:600;
      margin-bottom:12px;
      font-size:14px;
    }
    h1{ margin:6px 0 8px; font-size:20px; }
    p.lead{ margin:0 0 16px; color:var(--muted);font-size:14px;}
    .ussd{
      display:inline-block;
      background:#081827;
      border:1px solid rgba(255,255,255,0.04);
      padding:12px 18px;
      border-radius:10px;
      font-weight:700;
      font-size:18px;
      letter-spacing:0.6px;
      margin-bottom:16px;
    }
    .cta{
      display:inline-block;
      text-decoration:none;
      padding:12px 18px;
      border-radius:10px;
      background:linear-gradient(90deg,var(--accent),#ff9a6b);
      color:white;
      font-weight:700;
	  font-size:14px;
      box-shadow: 0 6px 18px rgba(255,107,107,0.22);
    }
    .note{ margin-top:12px; font-size:13px; color:var(--muted); }
    @media (max-width:420px){
      .promo-card{ padding:18px; }
      .ussd{ font-size:16px; padding:10px 14px; }
    }
  </style>

	</head>
	
	<?php
		$page_id = "IndexPage";

		if(user_login_status() == true){
			$page_id = "HomePage";
		}
	?>

	<body id="<?php echo $page_id ?>" class="transparent-header">

		<div id="app" v-cloak>
		<appheader></appheader>
			<div id="main-content">
				<div class="container">
					
					<b-alert class="my-3 fixed-alert top-center animated bounce" variant="danger" :show="showPageError" @dismissed="showPageError=0" dismissible>
						<h4 class="bold"><i class="fa fa-exclamation"></i> {{ pageErrorStatus }}</h4>
						<div><span v-html="pageErrorMsg"></span></div>
					</b-alert>
					
					<b-alert class="fixed-alert bottom-left animated bounce" :show="showFlash" @dismissed="showFlash=0" variant="success" dismissible>
						<i class="fa fa-check-circle"></i> {{flashMsg}}
					</b-alert>
					
					<div class="page-modal">
						<b-modal v-model="showModalView" size="lg">
							<span slot="modal-header"></span>
							<component :is="modalComponentName" v-bind="modalComponentProps"></component>
							<div slot="modal-footer"></div>
						</b-modal>
					</div>
				</div>
				<div id="app-body">
					<keep-alive>
						<router-view></router-view>
					</keep-alive>
				</div>
				<input type="hidden" id="property_id2" name="property_id2"/>
				<?php $this->load_view("components/appfooter.php"); ?>
			</div>
			
			
			
			<!-- for Record Export -->
			<form method="post" action="<?php print_link('report') ?>" target="_blank" id="exportform">
				<input type="hidden" name="data" id="exportformdata" />
				<input type="hidden" name="title" id="exportformtitle" />
			</form>
			<!-- Image / Gallery Preview  -->
			<nicecarousel></nicecarousel>
		</div>
		
		<script>
			var ActiveUser = <?php echo json_encode(get_active_user()); ?>;
			var apiUrl = '<?php SITE_ADDR; ?>';
			var defaultPageLimit = <?php echo MAX_RECORD_COUNT; ?>;
			
			
			String.prototype.trimLeft = function(charlist) {
				if (charlist === undefined)
					charlist = "\s";

				  return this.replace(new RegExp("^[" + charlist + "]+"), "");
				};
				
			String.prototype.trimRight = function(charlist) {
			  if (charlist === undefined)
				charlist = "\s";

			  return this.replace(new RegExp("[" + charlist + "]+$"), "");
			};
			
			function valToArray(val) {
				if(val){
					if(Array.isArray(val)){
						return val;
					}
					else{
						return val.split(",");
					}
				}
				else{
					return [];
				}
			};
			
			function debounce(fn, delay) {
			  var timer = null;
			  return function () {
				var context = this, args = arguments;
				clearTimeout(timer);
				timer = setTimeout(function () {
				  fn.apply(context, args);
				}, delay);
			  };
			}
			
			function extend(obj, src) {
				for (var key in src) {
					if (src.hasOwnProperty(key)) obj[key] = src[key];
				}
				return obj;
			}
			
			function setApiUrl(path , queryObj){
				var url =   path.trimLeft('/');
				if(queryObj){
					var str = [];
					for(var k in queryObj){
						var v = queryObj[k]
						if (queryObj.hasOwnProperty(k) && v !== '') {
							str.push(encodeURIComponent(k) + "=" + encodeURIComponent(v));
						} 
					}
					var qs = str.join("&");
					if(path.indexOf('?') > 0){
						url = path + '&' + qs;  
					}
					else{
						url = path + '?' + qs;  
					}
				}
				
				return apiUrl + url;
			}
			
			function randomColor() {
				var letters = '0123456789ABCDEF';
				var color = '#';
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}
			function setInputForMap(val){
				//alert(val)
			document.getElementById("getListDate").value = val;
			}
		</script>
	
		<?php 
			Html ::  page_js('vue-2.5.17.js');
			Html ::  page_js('vue-pages.js');
			$this->load_view("components/appheader.php"); //include header component
			
			$this->load_view("home/index.php");
	
			// list of all page components
			$components = array(
				
				'propertylist/list.php',
				'propertylist/view.php',
				'propertylist/add.php',
				'propertylist/edit.php',
				'propertysearch/list.php',
				'bid/list.php',
				'bid/view.php',
				'trending/list.php',
				'openbid/list.php',
				'mybids/list.php',
				'login/list.php',
				'winnersbid/list.php',
				'mybidswon/list.php',
				'leaderboard/list.php',
				'leaderboardbid/list.php',
			);
			
			foreach($components as $comp){
				$this->load_view($comp);
			}
			$this->load_view("components/componentnotfound.php");
			$this->load_view("components/pagecomponents.php");
			

			
			Html ::  page_js('polyfill.min.js'); //load polyfill script to support older browser like IE 9 and old safari
			Html ::  page_js('bootstrap-vue.min.js');
			
			Html ::  page_js('vue-bundle.js'); //minified page  plugins used (vue-resource, vee-validate, vue-mugen-scroll,  vue-spinner, vue-upload-component, vue-form-wizard)
			Html ::  page_js('page-components.js');
			
			Html ::  page_js('locale/vee-validate/en.js');
			Html ::  page_js('vue-script.js');
		?>

 <!-- 

 <script type="text/javascript" src="libb/assets/js/jquery-2.2.1.min.js"></script>
  <-->
<script type="text/javascript" src="libb/assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<link href="libb/assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="libb/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="libb/assets/js/jquery-migrate-3.3.2.min.js"></script>
<script type="text/javascript" src="libb/assets/js/mmenu.min.js"></script>
<script type="text/javascript" src="libb/assets/js/magnific-popup.min.js"></script>
<script type="text/javascript" src="libb/assets/js/custom.js"></script>



<script>
    $(document).ready(function() {
      $().ready(function() {

	$("#testnice").click(function(){
		alert('ok')

    }); 
	  });});
	var base_url = "http://localhost/homly/";
	function fhome(){
		window.location.href = '#';
		location.reload();
    }

		function ftrendingitems(){
		window.location.href = '#/trending';
		location.reload();
    }

		function fopenbids(){
		window.location.href = '#/openbid';
		location.reload();
    }
		function fmybids(){
		window.location.href = '#/mybids';
		location.reload();
    }
		function fmybidswon(){
		window.location.href = '#/mybidswon';
		location.reload();
    }
		function fwinnersbids(){
		window.location.href = '#/winnersbid';
		location.reload();
    }
	function fleaderboardbids(){
		window.location.href = '#/leaderboard';
		location.reload();
    }
    $(document).ready(function() {
      //$().ready(function() {
	
$("#openBidbtn").click(function(){
//alert('djkdf')
//$('#myModal').modal('toggle');
$('#openBidModal').modal('show'); 
});

//  });
});

  </script>

<script>
// Calendar Init
$(function() {
    $.fn.myFunction = function() { 

	}
});
		</script>

					<script>

				function openForm() {
					document.getElementById("myForm").style.display = "block";
				}
				
				function closeForm() {
					document.getElementById("myForm").style.display = "none";
				}
				openForm()
  			</script>
	</body>
</html>