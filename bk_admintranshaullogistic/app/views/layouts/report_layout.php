<?php
$page_title = null;
if (!empty($_POST['title'])) {
	$page_title = $_POST['title'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $this->get_page_title($page_title); ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<?php
	Html::page_css('bootstrap-default.css');
	Html::page_css('custom-style.css');
	Html::page_js('jquery-2.1.4.min.js');
	Html::page_js('export-plugin/FileSaver.min.js');
	Html::page_js('export-plugin/tableExport.js?id=15');
	Html::page_js('export-plugin/jquery.base64.js');
	Html::page_js('export-plugin/html2canvas.js');
	?>
	<!-- Themify Icons for a consistent look -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/themfisher/themify-icons/css/themify-icons.css">
	<style>
		body {
			background-color: #f7f9fc;
			padding-top: 70px;
			/* Space for the fixed action bar */
		}

		#page-actionbar {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			background: #fff;
			border-bottom: 1px solid #dee2e6;
			padding: 10px 20px;
			z-index: 1000;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
		}

		.report-container {
			background-color: #fff;
			padding: 2.5cm;
			margin: 20px auto;
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
			width: 21cm;
			/* A4 default width */
			min-height: 29.7cm;
			/* A4 default height */
		}

		#company-header {
			padding: 20px;
			border-bottom: 2px solid #f0f0f0;
			margin-bottom: 20px;
		}

		#company-header img {
			max-height: 60px;
			width: auto;
			margin-right: 15px;
		}

		#page-title {
			border: none;
			font-size: 2rem;
			font-weight: bold;
			padding: 10px 0;
			margin-bottom: 20px;
			width: 100%;
			background-color: transparent;
		}

		.control-panel .card-body {
			padding: 1.25rem;
		}

		.control-panel .form-group label {
			font-weight: 600;
		}

		.header-list label {
			display: block;
			padding: 5px 10px;
			border-bottom: 1px solid #eee;
			background-color: #fff;
		}

		.header-list label:last-child {
			border-bottom: none;
		}

		.header-list label.false {
			background: rgba(249, 20, 20, 0.1);
			color: #dc3545;
			text-decoration: line-through;
		}

		@media print {
			body {
				padding-top: 0;
			}

			#page-actionbar,
			.control-panel-col {
				display: none !important;
			}

			.report-col {
				max-width: 100%;
				flex: 0 0 100%;
			}

			.report-container {
				margin: 0;
				box-shadow: none;
				border: none;
				padding: 1cm;
			}
		}
	</style>
</head>

<body>
	<div id="page-actionbar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-sm-4">
					<a class="btn btn-light btn-sm" href="<?php print_link('') ?>">
						<i class="ti-arrow-left"></i> Back
					</a>
				</div>
				<div class="col-sm-8 text-right">
					<button class="btn btn-secondary btn-sm" onclick="printPage()"><i class="ti-printer"></i> Print / PDF</button>
					<div class="btn-group btn-group-sm">
						<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="ti-download"></i> Export
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#" onclick="exportWord()">Word</a>
							<a class="dropdown-item" href="#" onclick="exportExcel()">Excel</a>
							<a class="dropdown-item" href="#" onclick="exportCsv()">CSV</a>
							<a class="dropdown-item" href="#" onclick="exportPng()">PNG</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-lg-3 control-panel-col">
				<div class="card my-4 control-panel">
					<div class="card-header">
						<h5 class="mb-0"><i class="ti-settings"></i> Report Settings</h5>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="pageSize">Paper Size</label>
							<select id="pageSize" onchange="changePageSize(this.value)" class="form-control form-control-sm">
								<option>A4</option>
								<option>A3</option>
								<option>Letter</option>
								<option>Legal</option>
								<option>None</option>
							</select>
						</div>
						<div class="form-group">
							<label class="custom-control custom-checkbox">
								<input onclick="toggleCompanyHeader()" checked="checked" type="checkbox" class="custom-control-input" />
								<span class="custom-control-label">Show Header</span>
							</label>
						</div>
						<div class="form-group">
							<button onclick="removePageLinks()" class="btn btn-warning btn-sm btn-block"><i class="ti-na"></i> Remove Page Links</button>
						</div>

						<h6 class="mt-4">Visible Columns</h6>
						<div id="visible-columns" class="border rounded" style="max-height: 250px; overflow-y: auto;">
							<div class="header-list" id="include_columns_container">
								<!-- Columns will be dynamically inserted here by JS -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9 report-col">
				<div size="A4" id="reportcontainer" class="report-container">
					<div id="company-header" class="d-flex align-items-center">
						<img src="<?php print_link(SITE_LOGO); ?>" alt="Logo" />
						<h3><?php echo SITE_NAME ?></h3>
					</div>
					<div class="report-body">
						<input value="<?php echo $page_title; ?>" id="page-title" class="form-control" />
						<?php
						if (!empty($_POST['data'])) {
							echo $_POST['data'];
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('.table thead th, .table thead td').each(function(index) {
				var t = $(this).text().trim();
				if (t) {
					var newIndex = index + 1; // Adjust for 1-based nth-child selector
					$('#include_columns_container').append('<label class="include true"><input onclick="removeTableColumn(this,' + newIndex + ')" checked="checked" type="checkbox" /> ' + t + '</label>');
				}
			});
			$('.card-footer,.page-footer,.jumbotron,.page-list-action,.td-checkbox,.td-btn,.export-container,.page-header').remove();
		});

		function removeTableColumn(elem, index) {
			var isChecked = $(elem).is(":checked");
			var col = $('td:nth-child(' + index + '),th:nth-child(' + index + ')');
			col.toggle(isChecked);
			$(elem).parent().toggleClass('true false', isChecked);
		}

		function removePageLinks() {
			$('.report-body a, .report-body .btn, .report-body button').each(function() {
				$(this).contents().unwrap();
			});
		}

		function toggleCompanyHeader() {
			$('#company-header').toggle();
		}

		function changePageSize(value) {
			if (value !== '') {
				$('.report-container').css({
					'width': '',
					'min-height': ''
				});
				if (value === 'A4') {
					$('.report-container').css({
						'width': '21cm',
						'min-height': '29.7cm'
					});
				} else if (value === 'A3') {
					$('.report-container').css({
						'width': '29.7cm',
						'min-height': '42cm'
					});
				} else if (value === 'Letter') {
					$('.report-container').css({
						'width': '21.6cm',
						'min-height': '27.9cm'
					});
				} else if (value === 'Legal') {
					$('.report-container').css({
						'width': '21.6cm',
						'min-height': '35.6cm'
					});
				}
			}
		}

		function printPage() {
			window.print();
		}

		function exportWord() {
			var pageTitle = $('#page-title').val();
			$('.report-body table').tableExport({
				type: 'word',
				escape: 'false',
				fileName: pageTitle + "-" + formatDate(new Date()) + ".doc"
			});
		}

		function exportCsv() {
			var pageTitle = $('#page-title').val();
			$('.report-body table').tableExport({
				type: 'csv',
				escape: 'false',
				fileName: pageTitle + "-" + formatDate(new Date()) + ".csv"
			});
		}

		function exportExcel() {
			var pageTitle = $('#page-title').val();
			$('.report-body table').tableExport({
				type: 'excel',
				escape: 'false',
				fileName: pageTitle + "-" + formatDate(new Date()) + ".xls"
			});
		}

		function exportPng() {
			var pageTitle = $('#page-title').val();
			$('.report-body table').tableExport({
				type: 'image',
				fileName: pageTitle + "-" + formatDate(new Date()) + ".png"
			});
		}

		function formatDate(date) {
			var d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();
			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;
			return [year, month, day].join('-');
		}

		// Manual Dropdown Logic
		$(document).ready(function() {
			$('.dropdown-toggle').on('click', function(e) {
				e.stopPropagation(); // prevent click from closing it immediately
				$(this).next('.dropdown-menu').toggle();
			});
			$(document).on('click', function(e) {
				// close dropdown if click is outside
				if (!$(e.target).closest('.btn-group').length) {
					$('.dropdown-menu').hide();
				}
			});
		});
	</script>
</body>

</html>