@extends('backend.master.master')
@section('title', 'Index')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Overview</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Overview</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-12 col-lg-6">
			<div class="panel panel-blue panel-widget ">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-4 widget-left">
						<span class="glyphicon glyphicon-signal icon-50" aria-hidden="true"></span>
					</div>
					<div class="col-sm-9 col-lg-8 widget-right">
						<div class="large">8.000.000 đ</div>
						<div class="text-muted">Monthly Revenue: July</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-orange panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked empty-message">
							<use xlink:href="#stroked-empty-message"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">52</div>
						<div class="text-muted">Interact</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked male-user">
							<use xlink:href="#stroked-male-user"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large">24</div>
						<div class="text-muted">Orders</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Income Statements</div>
				<div class="panel-body">
					<div class="canvas-wrapper">
						<canvas class="main-chart" id="myChart" height="200" width="600"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->

</div>
<!--end main-->
@endsection
@section('active')
<script>
	$('.overview').addClass('active');
	const xValues = [1,2,3,4,5,6,7,8,9,10,11,12];
	const yValues = [7,8,8,9,9,9,10,11,14,14,15,3,0];
	const barColors = ["red", "green", "blue", "orange", "brown", "black", "gray", "purple", "yellow", "brown", "mustard", "silver"];

	const myChart = new Chart("myChart", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: "gray",
				borderColor: 'green',
				data: yValues
			}]
		},
		options: {
			legend: {display: false},
			animation: {
				
			}
		}
	});
</script>
@endsection