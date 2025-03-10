@extends('layouts.master')
@section('title')
الصفحة الرئيسية 
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						<h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 text-primary">{{ Auth::user()->name }} مرحبا بك ! </h2>
						<p class="mg-b-0 text-success">Sales monitoring dashboard .</p>
						</div>
					</div>
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<br>
				<div class="row row-larg">
					{{-- <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h4 class="mb-3 tx-12 text-white">مبـيــعات اليوم</h4>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $todaydata }}</h4>
											<p class="mb-0 tx-12 text-white op-7">إجمالي مبيعات اليوم</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-left text-white"></i>
											<span class="text-white op-7">{{$todaydata }}</span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div> --}}
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">البــضـاعـة</h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h2 class="tx-20 font-weight-bold mb-1 text-white">{{ $totalProducts }}</h2>
											<p class="mb-0 tx-12 text-white op-7">عدد البضاعة الموجودة داخل الصيدلية من ادوية و مستلزمات طبية و غيرها...</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-right text-white"></i>
											<span class="text-white op-7"> </span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" >
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white"> إجمالي الفــواتـيـر </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h2 class="tx-20 font-weight-bold mb-1 text-white">{{ $totalInvoices }}</h2>
											<p class="mb-0 tx-12 text-white op-7"> إجمالي الفواتــيـــر التي تم حفظها في نظام الصيدلية</p>
										</div>
										<span class="float-right my-auto mr-auto">
											<i class="fas fa-arrow-circle-right text-white"></i>
											<span class="text-white op-7"></span>
										</span>
									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					
				</div>

				<div class="card p-3">
				<div class="bg-gray-100 p-6">
					<h2 class="text-center text-2xl font-bold text-gray-700 mb-6">معـدل الفواتـيـر </h2>
			
					<canvas id="salesChart" width="400" height="200"></canvas>

					<script>
						document.addEventListener("DOMContentLoaded", function() {
							const ctx = document.getElementById('salesChart').getContext('2d');
					
							const salesChart = new Chart(ctx, {
								type: 'line',
								data: {
									labels: {!! json_encode($labels) !!},
									datasets: [{
										label: 'عدد الفواتير',
										data: {!! json_encode($data) !!},
										borderColor: 'rgba(54, 162, 235, 1)',
										backgroundColor: 'rgba(54, 162, 235, 0.2)',
										borderWidth: 2
									}]
								},
								options: {
									responsive: true,
									scales: {
										y: { beginAtZero: true }
									}
								}
							});
						});
					</script>
				</div>
				</div>
				



		<!-- Container closed -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ URL::asset('assets/js/my.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>	
@endsection