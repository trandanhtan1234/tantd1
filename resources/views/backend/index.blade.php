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
		<div class="col-xs-12 col-md-12 col-lg-4">
			<div class="panel panel-blue panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-4 widget-left">
						<span class="glyphicon glyphicon-signal icon-50" aria-hidden="true"></span>
					</div>
					<div class="col-sm-9 col-lg-8 widget-right">
						<div class="large">{{ number_format($monthRevenue,0,',','.') }} đ</div>
						<div class="text-muted">Month Revenue: {{ $monthN }}</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-md-12 col-lg-4">
			<div class="panel panel-orange panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-4 widget-left">
						<svg class="glyph stroked empty-message">
							<use xlink:href="#stroked-empty-message"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-8 widget-right">
						<div class="large">{{ number_format($dayRevenue,0,',','.') }} VNĐ</div>
						<div class="text-muted">Today Income</div>
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
						<div class="large">{{ $orders }}</div>
						<div class="text-muted">Orders This Month</div>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script> -->
<script>
	$('.overview').addClass('active');
	const xValues = [
		@foreach ($months as $month)
			{{ $month }},
		@endforeach
	];
	const yValues = [
		@foreach ($revenue as $val)
			{{ $val }},
		@endforeach	
	0];

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