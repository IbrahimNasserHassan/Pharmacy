@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض المنتجات</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
			
				<!DOCTYPE html>
				<html lang="ar">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>عرض المنتجات</title>
					<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
				</head>
				<body>
					<div class="container mt-5">
						<h2 class="mb-4">قائمة المنتجات</h2>
						
						<!-- إشعارات النجاح -->
						@if(session('success'))
							<div class="alert alert-success">{{ session('success') }}</div>
						@endif
				
						<!-- زر إضافة منتج جديد -->
						<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">إضافة منتج جديد</a>
				
						<!-- جدول المنتجات -->
						<div class="table-responsive">
                    <table class="table table-hover table-striped" id="invoice-table">
                        <thead class="table">
                            <tr>
									<th>#</th>
									<th>اسم المنتج</th>
									<th class="">السعر</th>
									<th>الكمية</th>
									<th>التصنيف</th>
									<th>⚙️ الإجراءات</th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->price }} SD</td>
									<td>{{ $product->quantity }}</td>
									<td>{{ $product->category }}</td>
									<td>
										<a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"> عرض</i></a>
										<a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"> تعديل </i></a>
										<form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"> حذف</i></button> <br>

										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="d-flex justify-content-center mt-4">
								{{ $products->links() }}
							</div>
					</div>
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
				
				</body>
				</html>
				
				
		<!-- main-content closed -->
@endsection
@section('js')
@endsection