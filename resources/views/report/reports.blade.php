@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"> المبيعات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/تقرير المبيعات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
    <h2 class="mb-4">📊 تقارير المبيعات</h2>

    <!-- ✅ فلترة التواريخ -->
    <form method="GET" action="{{ route('reports') }}" class="mb-3">
        <label for="from">📅 من:</label>
        <input type="date" name="from" id="from" value="{{ $from }}" class="form-control d-inline-block w-auto">

        <label for="to">📅 إلى:</label>
        <input type="date" name="to" id="to" value="{{ $to }}" class="form-control d-inline-block w-auto">

        <button type="submit" class="btn btn-primary">🔍 بحث</button>
    </form>

    <!-- ✅ المخطط البياني -->
    <div class="card p-3">
        <canvas id="salesChart"></canvas>
    </div>

    <!-- ✅ جدول المبيعات -->
    <table id="salesTable" class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>📅 التاريخ</th>
                <th>💰 المبيعات (بالجنيه السوداني)</th>
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

        // 💡 إعداد البيانات للمخطط
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

        // 💡 تحسين الجدول
        $('#salesTable').DataTable();
    });
</script>
@endsection
@section('js')
@endsection
