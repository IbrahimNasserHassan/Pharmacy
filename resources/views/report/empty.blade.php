@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
<!-- resources/views/reports.blade.php -->

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقارير المبيعات</title>

    <!-- إضافة Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- إضافة بعض التنسيقات الأساسية -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .report-container {
            margin-top: 30px;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form label, .filter-form input {
            font-size: 16px;
            margin-right: 10px;
        }
        canvas {
            width: 100% !important;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>تقارير المبيعات اليومية</h1>

    <!-- نموذج الفلترة لتحديد التاريخ -->
    <div class="filter-form">
        <form method="GET" action="{{ route('reports') }}">
            <label for="from">من:</label>
            <input type="date" id="from" name="from" value="{{ old('from', now()->startOfMonth()->toDateString()) }}">

            <label for="to">إلى:</label>
            <input type="date" id="to" name="to" value="{{ old('to', now()->toDateString()) }}">

            <button type="submit">عرض التقرير</button>
        </form>
    </div>

    <!-- تقرير المبيعات اليومية -->
    <div class="report-container">
        <h2>مبيعات الفترة من {{ $from }} إلى {{ $to }}</h2>
        <canvas id="daily-sales-chart"></canvas>
    </div>

    <script>
        // الحصول على بيانات المبيعات
        fetch('{{ route("daily-sales-data", ["from" => $from, "to" => $to]) }}')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.date); // تواريخ المبيعات
                const salesData = data.map(item => item.total_sales); // إجمالي المبيعات

                // إنشاء الرسم البياني
                new Chart(document.getElementById("daily-sales-chart"), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'المبيعات اليومية',
                            data: salesData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1,
                            fill: true,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'التاريخ',
                                },
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'إجمالي المبيعات',
                                },
                            },
                        },
                    },
                });
            });
    </script>
</body>
</html>

                
{{--  --}}
			
		<!-- main-content closed -->
@endsection
@section('js')
@endsection