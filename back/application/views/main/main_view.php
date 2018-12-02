<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_line = '';
$active_bar = '';
$active_radar = '';
if ($type == 'line'){$active_line = 'active';}
if ($type == 'bar'){$active_bar = 'active';}
if ($type == 'radar'){$active_radar = 'active';}
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
					<a href="<?=base_url('main/add_report')?>" class="d-flex align-items-center text-muted btn btn-link" >
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
				<h1 class="h2">Graph</h1>
				<p class="text-center results"></p>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button class="btn btn-sm btn-outline-secondary line <?=$active_line?>" name="type_graph" value="line" onclick="change(this.value)" >Line</button>
						<button class="btn btn-sm btn-outline-secondary bar <?=$active_bar?>" name="type_graph" value="bar" onclick="change(this.value)">Bar</button>
						<button class="btn btn-sm btn-outline-secondary radar <?=$active_radar?>" name="type_graph" value="radar" onclick="change(this.value)">Radar</button>
					</div>
					<!--button class="btn btn-sm btn-outline-secondary">
						<span data-feather="save"></span>
						Save
					</button-->
				</div>
			</div>

			<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

			<h2>Table</h2>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm">
					<thead class="thead-dark">
					<tr>
						<th>#</th>
						<?
						foreach ($obj_json->Columns as $column){
							echo "<th>$column</th>";
						}
						?>
					</tr>
					</thead>
					<tbody>
					<?
					foreach ($obj_json->Rows as $k=>$v){
						echo "<tr><td>$k</td>";
						foreach ($v as $row){
							echo "<td>$row</td>";
						}
						echo "</tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		</main>


	</div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->


<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	feather.replace()
</script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>

var typee = '<?=$type?>';


	var rows = <?=$rows_json?>;
	var str = '';
	var newdatasers = [];
	var r = 10;
	var g = 200;
	var b = 255;

	for (var key in rows){
		var temp = {
			label: key,
			data: rows[key],
			lineTension: 0,
			backgroundColor: 'transparent',
			borderColor: 'rgb('+ r +', '+ g +', '+ b +')',
			borderWidth: 2,
			pointBackgroundColor: '#ffffff'
		};
		r += 40;
		g -= 25;
		b -= 20;
		newdatasers.push(temp);
	}


	var config = {
		type: typee,
		data: {
			labels: <?=$columns_json?>,
			datasets: newdatasers
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			},
			legend: {
				display: true
			}
		}
	};



	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, config);
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	var myChart;
	function change(newType) {
		var ctx = document.getElementById("myChart").getContext("2d");

		// Remove the old chart and all its event handles
		if (myChart) {
			myChart.destroy();
		}

		// Chart.js modifies the object you pass in. Pass a copy of the object so we can use the original object later
		var configg = jQuery.extend(true, {}, config);
		configg.type = newType;
		myChart = new Chart(ctx, configg);

		$.ajax({
			type: 'POST',
			url: '<?=base_url("main/update_type_chart")?>',
			data: 'type='+newType,
			success: function(data){
				$('.results').html(data);
			}
		});
		$('.line').removeClass('active');
		$('.bar').removeClass('active');
		$('.radar').removeClass('active');
		$('.'+newType).addClass('active');
	};

</script>
</body>
</html>

