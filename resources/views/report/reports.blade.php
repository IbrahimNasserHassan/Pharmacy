@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto"> المبيعات</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/تقرير المبيعات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
    <h2 class="mb-4">📊 تقارير المبيعات</h2>

    <form method="GET" action="{{ route('reports') }}" class="mb-3">
        <label for="from">📅 من:</label>
        <input type="date" name="from" id="from" value="{{ $from }}" class="form-control d-inline-block w-auto">

        <label for="to">📅 إلى:</label>
        <input type="date" name="to" id="to" value="{{ $to }}" class="form-control d-inline-block w-auto">

        <button type="submit" class="btn btn-primary">🔍 بحث</button>
    </form>

    <div class="card p-3">
        <canvas id="salesChart"></canvas>
    </div>


    <table id="salesTable" class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>📅 التاريخ</th>
                <th>💰 إجمالي المبيعات ( باليوم)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->date }}</td>
                    <td>${{ number_format($sale->total_sales, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ✅ تضمين المكتبات -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let salesData = @json($sales);

        let dates = salesData.map(s => s.date);
        let totals = salesData.map(s => s.total_sales);

        new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: '💰 المبيعات اليومية',
                    data: totals,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        
        $('#salesTable').DataTable();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection
@section('js')
@endsection
