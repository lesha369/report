<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" href="http://bootstrap-4.ru/docs/4.1/examples/dashboard/dashboard.css">
	<style>
		/* Chart.js */
		@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
	</style>
	<title>*</title>
</head>
<body>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?=base_url('main')?>">Company name</a>
</nav>

<div class="container-fluid">
	<div class="row">
		<nav class="col-md-2 d-none d-md-block bg-light sidebar">
			<div class="sidebar-sticky">


				<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
					<span>Recept reports</span>
					<a href="<?=base_url('main/add_report')?>" class="d-flex align-items-center text-muted btn btn-link">
						<span data-feather="plus-circle"></span>
					</a>
				</h6>


				<ul class="nav flex-column mb-2">
					<?
					foreach ($reports_latest as $report){
						echo '<li class="nav-item">
						<a class="nav-link" href="'.base_url('main/show/').$report->id.'">
							<span data-feather="file-text"></span>
							'.$report->json.' ('.date("d.m.Y H:i:s", $report->date_upload).')
						</a>
					</li>';
					}
					?>
				</ul>
			</div>
		</nav>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Add report</h1>
				<div class="btn-toolbar mb-2 mb-md-0"></div>
			</div>

			<div class="">
				<?php echo $error;?>

				<?php echo form_open_multipart('main/add_report');?>
				<div class="form-group">
					<input type="file" name="userfile" class="form-control-file" multiple accept="application/json" >
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-success" value="upload" />
				</div>



				</form>
			</div>


		</main>


	</div>
</div>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	feather.replace()
</script>

</body>
</html>

