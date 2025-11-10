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
			Html ::  page_css('bootstrap-vue.min.css');
			Html ::  page_css('vue-form-wizard.css');
			
			

		?>
				<?php 
			Html ::  page_css('bootstrap-theme-pulse-blue.css');
			Html ::  page_css('custom-style.css');
		?>


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="libb/assets/css/style.css">
<link rel="stylesheet" href="libb/assets/css/main-color.css" id="colors">
<link rel="stylesheet" href="libb/assets/css/plugins/revolutionslider.css">
<link href="libb/assets/fonts/fontawesome-webfont.woff2" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/simple-line-icons.ttf?thkwh4" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/iconsmind.woff?-rdmvgc" rel="stylesheet" type="text/css">
<link href="libb/assets/fonts/fontello.woff" rel="stylesheet" type="text/css">
<link href="libb/assets/css/material-dashboard.min.css" rel="stylesheet" type="text/css">
	<style>
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



	</head>
	
	<?php
		$page_id = "IndexPage";

		if(user_login_status() == true){
			$page_id = "HomePage";
		}
	?>

	<body id="<?php echo $page_id ?>" class="transparent-header">

		<div id="app" v-cloak>
		<!--<appheader></appheader>-->
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
				'index/index.php',
				'index/register.php',
				'auth/list.php',
				'auth/view.php',
				'account/edit.php',
				'account/view.php',
				'auth/add.php',
				'auth/edit.php',
				'chargetype/list.php',
				'chargetype/view.php',
				'chargetype/add.php',
				'chargetype/edit.php',
				'facilitytype/list.php',
				'facilitytype/view.php',
				'facilitytype/add.php',
				'facilitytype/edit.php',
				'propertyfacility/list.php',
				'propertyfacility/view.php',
				'propertyfacility/add.php',
				'propertyfacility/edit.php',
				'propertylist/list.php',
				'propertylist/view.php',
				'propertylist/add.php',
				'propertylist/edit.php',
				'propertylocations/list.php',
				'propertylocations/view.php',
				'propertylocations/add.php',
				'propertylocations/edit.php',
				'propertytype/list.php',
				'propertytype/view.php',
				'propertytype/add.php',
				'propertytype/edit.php',
				'rating/list.php',
				'rating/view.php',
				'rating/add.php',
				'rating/edit.php',
				'user/list.php',
				'user/view.php',
				'user/add.php',
				'user/edit.php',
				'propertygallery/list.php',
				'propertygallery/view.php',
				'propertygallery/add.php',
				'propertygallery/edit.php',
				'propertyavailability/list.php',
				'propertyavailability/view.php',
				'propertyavailability/add.php',
				'propertyavailability/edit.php',
				'propertypart/list.php',
				'propertypart/view.php',
				'propertypart/add.php',
				'propertypart/edit.php',
				'propertyreservation/list.php',
				'propertyreservation/view.php',
				'propertyreservation/add.php',
				'propertyreservation/edit.php',
				'myreservation/list.php',
				'myreservation/view.php',
				'propertysearch/list.php',
				'dashboard/list.php',
				'bookings/list.php',
				'payments/list.php',
				'payments/view.php',
				'payments/add.php',
				'payments/edit.php',
				'payment/list.php',
				'myfavourite/list.php',
				'owner/list.php',
				'owner/view.php',
				'owner/add.php',
				'owner/edit.php',
				'message/list.php',
				'message/view.php',
				'messages/list.php',
				'messages/view.php',
				'review/list.php',
				'login/list.php',
				'propertyreport/list.php',
				'propertyrevenue/list.php',
				'propertyoccupancy/list.php',
				'propertymaintenance/edit.php',
				'propertymaintenance/list.php',
				'propertysoa/list.php'


				
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
<link href="libb/assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="libb/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="libb/assets/js/jquery-migrate-3.3.2.min.js"></script>
<script type="text/javascript" src="libb/assets/js/mmenu.min.js"></script>
<script type="text/javascript" src="libb/assets/js/chosen.min.js"></script>
<script type="text/javascript" src="libb/assets/js/slick.min.js"></script>
<script type="text/javascript" src="libb/assets/js/rangeslider.min.js"></script>
<script type="text/javascript" src="libb/assets/js/magnific-popup.min.js"></script>
<script type="text/javascript" src="libb/assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="libb/assets/js/counterup.min.js"></script>
<script type="text/javascript" src="libb/assets/js/tooltips.min.js"></script>
<script type="text/javascript" src="libb/assets/js/custom.js"></script>
<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
<script src="libb/assets/js/moment.min.js"></script>
<script src="libb/assets/js/daterangepicker.js"></script>
<script src="libb/assets/js/quantityButtons.js"></script>
<script src="libb/assets/js/jsframe.js"></script>

<!-- Google Autocomplete -->



<!-- Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxOdfaqK_RWJzzBKAGPCEXg6l7L6Bz848"></script>
<script type="text/javascript" src="libb/assets/js/infobox.min.js"></script>
<script type="text/javascript" src="libb/assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="libb/assets/js/maps.js"></script>
<!--<script type="text/javascript" src="libb/assets/js/mapsloc.js"></script>-->


<script>
/*var geocoder = new google.maps.Geocoder();
var address = "lekki, lagos";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    console.log(latitude+" | "+longitude)
  } 
});*/
	var sliderPrice = 0;
	var property_what = "";
	var property_where = "";
	var property_id = "";
	var sorted_date ="";
	var dateRanges_arr_search = [];
	var base_url = "http://localhost/homly/";

	const jsFrame = new JSFrame();
    /*jsFrame.showToast({
        html: 'This is a simple toast', align: 'bottom', duration: 2000
    });*/

	function fhome(){
		window.location.href = '#';
		location.reload();
    } 
	function fpropertysearch(){
		window.location.href = '#/propertysearch';
		location.reload();
    }
	function fmyfavourite(){
		window.location.href = '#/myfavourite';
		location.reload();
    }
	function fmyreservation(){
		window.location.href = '#/myreservation';
		location.reload();
    }
	function fmessages(){
		window.location.href = '#/messages';
		location.reload();
    }
	function fmessages(){
		window.location.href = '#/messages';
		location.reload();
    }
	function fpayment(){
		window.location.href = '#/payment';
		location.reload();
    }
	function fownproperty(){
		window.location.href = '#/owner/add';
		location.reload();
    }
	function fdashboard(){
		window.location.href = '#/dashboard';
		location.reload();
    }
	function fmessage(){
		window.location.href = '#/message';
		location.reload();
    }
	function fbookings(){
		window.location.href = '#/bookings';
		location.reload();
    }
	function fpropertyavailabilityadd(){
		window.location.href = '#/propertyavailability/add';
		location.reload();
    }
	function fpropertyavailabilitylist(){
		window.location.href = '#/propertyavailability/list';
		location.reload();
    }
	function freview(){
		window.location.href = '#/review';
		location.reload();
    }
	function fpayments(){
		window.location.href = '#/payments';
		location.reload();
    }
	function fowner(){
		window.location.href = '#/owner/list';
		location.reload();
    }
	function fowneredit(){
		window.location.href = '#/owner/edit/1';
		location.reload();
    }
	function floginpage(){
		window.location.href = '#/login';
		location.reload();
    }
	function fpropertyreport(){
		window.location.href = '#/propertyreport';
		location.reload();
    }
	function fpropertyrevenue(){
		window.location.href = '#/propertyrevenue';
		location.reload();
    }
	function fpropertyoccupancy(){
		window.location.href = '#/propertyoccupancy';
		location.reload();
    }
	function fpropertymaintenance(){
		window.location.href = '#/propertymaintenance';
		location.reload();
    }

	function fpropertysoa(){
		window.location.href = '#/propertysoa';
		location.reload();
    }
    $(document).ready(function() {
      $().ready(function() {
		
		$("#btnCheckFacility").click(function(){
			var checkedVals = $('.theCheckFacilityClass:checkbox:checked').map(function() {
			return this.value;
		}).get();
		if(checkedVals==''){
		$('#theCheckFacility').val(' ')
		}
		else{
		console.log(checkedVals.join(","));
		$('#theCheckFacility').val(checkedVals.join(","))
		}

		});
		$("#makeReview").click(function(){
		var rate = $("input[name=rate]").val();
		var idreview = $('#idreview').val();
		var idproperty_id = $('#idproperty_id').val();

		if(( (rate=="" || rate=="undefined") && idreview=="" || idreview=="undefined") && (idproperty_id=="" || idproperty_id=="undefined")){
			alert("Please fill up all booking information")
		}

		else{
		$.ajax({
            type: "POST",
            url: base_url+"components/makeReview",
            //headers: '{ "transactionId": '+Math.floor(100000000 + Math.random() * 900000000)+',"API-TOKEN": "90991111222335234246"}',
            dataType:"json",
            crossDomain: true,
            contentType: 'application/json',
            //async: true,
            data: '{"rate": "'+rate+'","idreview": "'+idreview+'","property_id": "'+idproperty_id+'"}',
            success: function(response){
                    //console.log(response['datasets'][0].map(function(str) {return parseInt(str); }));
                    console.log(response);
					window.location.href = '#/propertylist/view/'+idproperty_id;
					location.reload();
            },
            error: function(response){
				if(response.responseText=="LoginNo"){
					alert("Please you need to login or create an account!");
					$("#sign-in-dialog").dialog({
    				autoOpen : false, modal : true, show : "blind", hide : "blind",position: ['center', 'center'],  minWidth: 440,
        			minHeight: 220,//open: function(event, ui) {
            //$(".ui-dialog-titlebar-close", ui.dialog | ui).show();}
  					});

					$('#sign-in-dialog').dialog("open");
					$("#sign-in-dialog").removeClass('zoom-anim-dialog mfp-hide');
				}
				else{
					console.log(response.responseText);
                    alert(response.responseText);
				}
            }
          });
		}
    }); 

	$("#makeBook").click(function(){
		var idvaliddate = $('#idvaliddate').val();
		var idproperty_id = $('#idproperty_id').val();
		var idprice = parseFloat($('#idtotalprice').val().replace(/,/g, ""));
		var iddays = $('#iddays').val();
		
		if((idvaliddate=="" || idvaliddate=="undefined") || (idproperty_id=="" || idproperty_id=="undefined") || (idprice=="" || idprice=="undefined")
		|| (iddays=="" || iddays=="undefined")){
			
			jsFrame.showToast({html: 'Please fill up all booking information', align: 'bottom', duration: 2500});
		}

		else{
		$.ajax({
            type: "POST",
            url: base_url+"components/makeBooking",
            //headers: '{ "transactionId": '+Math.floor(100000000 + Math.random() * 900000000)+',"API-TOKEN": "90991111222335234246"}',
            dataType:"json",
            crossDomain: true,
            contentType: 'application/json',
            //async: true,"rooms": "'+idrooms+'","idtotalrooms": "'+idtotalrooms+'",
            data: '{"validdate": "'+idvaliddate+'","property_id": "'+idproperty_id+'","propertyavailability_id": "'+idproperty_id+'","price": "'+idprice+'","rooms": "'+iddays+'"}',
            success: function(response){
                    //console.log(response['datasets'][0].map(function(str) {return parseInt(str); }));
                    console.log(response);
					//window.location.href = '#/myreservation';
					//location.reload();
				
            },
            error: function(response){
				if(response.responseText=="LoginNo"){
					jsFrame.showToast({html: 'Please you need to login or create an account!', align: 'bottom', duration: 2500});
					window.location.href = '#/login';
				}
				else if(response.responseText=="invaliddate"){
					jsFrame.showToast({html: 'This date is not available', align: 'bottom', duration: 2500});
				}
				else{
					jsFrame.showToast({html: response.responseText, align: 'bottom', duration: 2500});	
				}
            }
          });
		}
    }); 
	$(".tagss").autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "http://localhost/homly/components/getFacilities/"+request.term.trim(),
          dataType: "json",
          success: function( data ) {
			console.log(data)
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
		property_what = ui.item.id;
      }
    });

	$(".tags_location").autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url: "http://localhost/homly/components/getLocation/"+request.term.trim(),
          dataType: "json",
          success: function( data ) {
			//console.log(request.term)
            response( data );
          }
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
		property_where = ui.item.id;
      }
    });

	$(".btnsearch").click(function(){
        //alert("button");
		if ($.trim($(".tags_location").val()) && $.trim($(".tagss").val())) {
			//alert('here0');
			window.location.href = 'http://localhost/homly/#/propertysearch/index/landmark/'+$(".tags_location").val()+","+$(".tagss").val();
		}

		else if (!$.trim($(".tags_location").val()) && $.trim($(".tagss").val())) {
			//alert('here');
			window.location.href = 'http://localhost/homly/#/propertysearch/index/landmark/'+$(".tagss").val();
		}
		else if ($.trim($(".tags_location").val()) && !$.trim($(".tagss").val())) {
			//alert('here1');
			window.location.href = 'http://localhost/homly/#/propertysearch/index/landmark/'+$(".tags_location").val();
		}
		else{

		}
		
    }); 
	$("#home").click(function(){
		window.location.href = '#/';
		location.reload();
    }); 
	$("#propertysearch").click(function(){
		window.location.href = '#/propertysearch';
		location.reload();
    }); 
	$("#myfavourite").click(function(){
		window.location.href = '#/myfavourite';
		location.reload();
    }); 
	$("#myreservation").click(function(){
		window.location.href = '#/myreservation';
		location.reload();
    }); 
	$("#btnClearAvailabilityDate").click(function(){
		$("#idAvailability").val('');
		sorted_date = "";
		$("#idinvalidfrom").val('')
		$("#idinvalidto").val('')
	}); 
	$("#btnAddAvailabilityDate").click(function(){
		var ordered_startdate = [];
		var ordered_enddate = [];
		const input = $("input[name='idinvalidfrom']");
		const input1 = $("input[name='idinvalidto']");
		
		if (!$.trim($("#idAvailability").val())) {
			$("#idAvailability").val($('.date-picker2').val());
			var txtAvailability_newval = moment($("#idAvailability").val().split(",")[0].split("-")[0]).subtract(100, "years").format("MM/DD/YYYY")
			+" - "+moment($("#idAvailability").val().split(",")[0].split("-")[0]).subtract(1, "days").format("MM/DD/YYYY")+","+
			moment($("#idAvailability").val().split(",")[0].split("-")[1]).add(1, "days").format("MM/DD/YYYY")
			+"-"+
			moment($("#idAvailability").val().split(",")[0].split("-")[1])
				.add(100, "years").format("MM/DD/YYYY"); 
			$("#idinvalidfrom").val(txtAvailability_newval)
			$("#idinvalidto").val($('.date-picker2').val());
			console.log("idinvalidfrom: "+txtAvailability_newval+" idinvalidto: "+$('.date-picker2').val())
		}
		else{
		var splitDates = $('#idAvailability').val().split(",");
		for(var i=0; i<splitDates.length; i++){
		var splitDate = splitDates[i].split("-");
		//var splitStartDate = splitDate[0];

		var start = Date.parse(splitDate[0]);
		var end = Date.parse(splitDate[1]);
		var diff_start = Date.parse($('.date-picker2').val().split("-")[0]);
		var diff_end= Date.parse($('.date-picker2').val().split("-")[1]);
		
		if((diff_start.valueOf() <= end.valueOf()) && (diff_start.valueOf() >= start.valueOf()) ){
			alert("Date range already added")
			break;
		}
		else{
			if((i+1)==splitDates.length){
		$("#idAvailability").val($("#idAvailability").val()+","+$('.date-picker2').val());
				}
			}
		}
		var splitDates_2 = $('#idAvailability').val().split(",");
		$("#idAvailability").val('');
		for(var i=0; i<splitDates_2.length; i++){
		var splitDate = splitDates_2[i].split("-");
		var start = Date.parse(splitDate[0]);
		var end = Date.parse(splitDate[1]);
		ordered_startdate[i] =  new Date(start);
		ordered_enddate[i] =  new Date(end);
	

		}
		ordered_startdate.sort((a, b) => a - b);
		ordered_enddate.sort((c, d) => c - d);
		for(var i=0; i<ordered_startdate.length; i++){
		console.log("ordered_date = "+ordered_startdate[i])
		$("#idAvailability").val($("#idAvailability").val()+(new Date(ordered_startdate[i]).getMonth()+1)+"/"+new Date(ordered_startdate[i]).getDate()+"/"+new Date(ordered_startdate[i]).getFullYear()+" - "+(new Date(ordered_enddate[i]).getMonth()+1)+"/"+new Date(ordered_enddate[i]).getDate()+"/"+new Date(ordered_enddate[i]).getFullYear()+",");
		}
		$("#idAvailability").val($("#idAvailability").val().substring(0, $("#idAvailability").val().length - 1));

		sorted_date = moment($("#idAvailability").val().split(",")[0].split("-")[0]).subtract(100, "years").format("MM/DD/YYYY");
		sorted_date = sorted_date+" - "+moment($("#idAvailability").val().split(",")[0].split("-")[0]).subtract(1, "days").format("MM/DD/YYYY")
		
		for(var k=0;k<$("#idAvailability").val().split(",").length;k++){

			if(k+1 == $("#idAvailability").val().split(",").length){
				sorted_date = sorted_date+","+
				moment($("#idAvailability").val().split(",")[k].split("-")[1]).add(1, "days").format("MM/DD/YYYY")
				+"-"+
				moment($("#idAvailability").val().split(",")[k].split("-")[0])
				.add(100, "years").format("MM/DD/YYYY")
			}
			else{
				sorted_date = sorted_date+","+
				moment($("#idAvailability").val().split(",")[k].split("-")[1]).add(1, "days").format("MM/DD/YYYY")
				+"-"+
				moment($("#idAvailability").val().split(",")[k+1].split("-")[0])
				.subtract(1, "days").format("MM/DD/YYYY")
				/*.subtract(moment.duration(moment($("#idAvailability").val().split(",")[k].split("-")[1])
				.diff(moment($("#idAvailability").val().split(",")[k+1].split("-")[0]))).asDays(), "days").format("MM/DD/YYYY")*/
				
			}
		}
		console.log("sorted_date:: "+sorted_date)
		$("#idinvalidfrom").val(sorted_date)
		$("#idinvalidto").val($("#idAvailability").val())
		
		}
		const event = new Event('input', { bubbles: true });
		input.get(0).dispatchEvent(event);
		input1.get(0).dispatchEvent(event);
		//console.log(input);
		
    }); 

	$("#testt").click(function(){
		//window.location.href = '#sign-in-dialog';
		//$('.content').toggle();
		
		$("#sign-in-dialog").dialog({
    	autoOpen : false, modal : true, show : "blind", hide : "blind",position: ['center', 'center'],  minWidth: 440,
        minHeight: 220,//open: function(event, ui) {
            //$(".ui-dialog-titlebar-close", ui.dialog | ui).show();}
  		});

		$('#sign-in-dialog').dialog("open");
		$("#sign-in-dialog").removeClass('zoom-anim-dialog mfp-hide');
		//$("#sign-in-dialog").addClass('content');
		
    }); 

  });});


function mySearch() {
	window.location.href = '#/propertysearch/';
	location.reload();
}
  </script>

<script>
// Calendar Init
$(function() {
    $.fn.myFunction = function() { 
        //alert('You have successfully defined your function!'); 
		setTimeout(function() {
			var exceptDate_array = $("#txtCheckAvailabilitySearch").val().split(",");
			for(var i=0;i<exceptDate_array.length;i++){
				dateRanges_arr_search.push({"start": moment(exceptDate_array[i].split("-")[0]), "end": moment(exceptDate_array[i].split("-")[1])});
			}
			$('.btnCheckAvailabilitySearch').click();
		}, 300);
		
		//$('.call-btn').addClass('btnCheckAvailabilitySearch');
		
    }

	$(".call-btn").click(function(){
        $.fn.myFunction();
    });
 

	$('.btnCheckAvailabilitySearch').daterangepicker({
			"opens": "left",
			singleDatePicker: false,
			isInvalidDate: function(date) {
			//console.log("---"+date)
            dateRanges = dateRanges_arr_search;
			console.log("---"+dateRanges)
			dateRanges_arr_search = [];
            return dateRanges.reduce(function(bool, range) {
                return bool || (date >= range.start && date <= range.end);
            }, false);
		
        }
	});
	
	var dateRanges_arr = [];
	$('.date-picker2').daterangepicker({
		"opens": "left",
		singleDatePicker: false,
	});
	//function datePicker() {
		const currentUrl = window.location.href;
		var sort_startdate=[];
		var sort_strsortdate='';
		var sorted_date='';
		var sort_enddate=[];
		if(currentUrl.includes('propertylist/view'))
	  {
		setTimeout(function() {
			//console.log($('#invalidfrom').val())
			console.log($('#invalidto').val())


		var splitDates_invalidto = $('#invalidto').val().split(",");
		for(var i=0; i<splitDates_invalidto.length; i++){
		var val_splitDates_invalidto = splitDates_invalidto[i].split("-");
		var start = Date.parse(val_splitDates_invalidto[0]);
		var end = Date.parse(val_splitDates_invalidto[1]);
		sort_startdate[i] =  new Date(start);
		sort_enddate[i] =  new Date(end);
		}
		//console.log('ok2 '+sort_startdate)
		
		sort_startdate.sort((a, b) => a - b);
		sort_enddate.sort((c, d) => c - d);
		
		for(var i=0; i<sort_startdate.length; i++){
		//console.log("ordered_date = "+sort_startdate[i])
		sort_strsortdate = sort_strsortdate + (new Date(sort_startdate[i]).getMonth()+1)+"/"+new Date(sort_startdate[i]).getDate()+"/"+new Date(sort_startdate[i]).getFullYear()+" - "+(new Date(sort_enddate[i]).getMonth()+1)+"/"+new Date(sort_enddate[i]).getDate()+"/"+new Date(sort_enddate[i]).getFullYear()+",";
		}
		
		sort_strsortdate = sort_strsortdate.substring(0, sort_strsortdate.length - 1);
		console.log('sort '+sort_strsortdate)
		sorted_date = moment(sort_strsortdate.split(",")[0].split("-")[0]).subtract(100, "years").format("MM/DD/YYYY");
		sorted_date = sorted_date+" - "+moment(sort_strsortdate.split(",")[0].split("-")[0]).subtract(1, "days").format("MM/DD/YYYY");

		//sorted_date = sorted_date+','+moment(sort_strsortdate.split(",")[0].split("-")[0]).add(1, "days").format("MM/DD/YYYY")+'-'+
		//moment(sort_strsortdate.split(",")[0].split("-")[1]).subtract(1, "days").format("MM/DD/YYYY");

		for(var k=0;k<sort_strsortdate.split(",").length;k++){
			if(k+1 == sort_strsortdate.split(",").length){
				sorted_date = sorted_date+","+ moment(sort_strsortdate.split(",")[k].split("-")[1]).add(1, "days").format("MM/DD/YYYY")+"-"+
				moment(sort_strsortdate.split(",")[k].split("-")[0]).add(100, "years").format("MM/DD/YYYY")
			}
			else{
		sorted_date = sorted_date+','+moment(sort_strsortdate.split(",")[k].split("-")[1]).add(1, "days").format("MM/DD/YYYY")+'-'+
		moment(sort_strsortdate.split(",")[k+1].split("-")[0]).subtract(1, "days").format("MM/DD/YYYY");
			}
		}
		console.log('ok '+sorted_date)

			var exceptDate_array = sorted_date.split(",");
			for(var i=0;i<exceptDate_array.length;i++){
				dateRanges_arr.push({"start": moment(exceptDate_array[i].split("-")[0]), "end": moment(exceptDate_array[i].split("-")[1])});
			}
			 console.log("dateRanges_arr : "+dateRanges_arr )
	$('.date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: false,
		isInvalidDate: function(date) {
			//console.log("---"+date)
		
            dateRanges = dateRanges_arr;
            return dateRanges.reduce(function(bool, range) {
                return bool || (date >= range.start && date <= range.end);
            }, false);
        }
	});
		}, 2000);
	}
//}
});

// Calendar animation
$('.date-picker').on('change.datepicker', function(ev){
  var picker = $(ev.target).data('daterangepicker');
  if (picker === undefined) {
  
}
else{
  // contains the selected end date 
  var Difference_In_Time = new Date(picker.endDate._d).getTime() - new Date(picker.startDate._d).getTime();
  console.log(Math.ceil(Difference_In_Time/ (1000 * 3600 * 24)));
  $('#iddays').val(Math.ceil(Difference_In_Time/ (1000 * 3600 * 24)))
  $('#idtotalprice').val((Math.ceil(Difference_In_Time/ (1000 * 3600 * 24))*(parseInt($('#idprice').val())+parseInt($('#idservice_charge').val()))).toLocaleString())
}

  // ... here you can compare the dates and call your callback.
});

$('.date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('.date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});
$('.date-picker').on('hide.daterangepicker', function(ev, picker) {
	$('.daterangepicker').removeClass('calendar-visible');
	$('.daterangepicker').addClass('calendar-hidden');
});

$('.date-picker2, .btnCheckAvailabilitySearch').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('.date-picker2, .btnCheckAvailabilitySearch').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});



</script>


<!-- Replacing dropdown placeholder with selected time slot -->
<script>
$(".time-slot").each(function() {
	var timeSlot = $(this);
	$(this).find('input').on('change',function() {
		var timeSlotVal = timeSlot.find('strong').text();

		$('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
		$('.panel-dropdown').removeClass('active');
	});
});
</script>
<style>
	
	</style>
	</body>
</html>