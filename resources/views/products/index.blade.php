@extends('layouts.master')
@section('title')
المنتجات
@endsection
@section('css')
@endsection
@section('page-header')
				
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto">المنتجات</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض المنتجات</span>
						</div>
					</div>
					
				</div>
				
@endsection
@section('content')
			
				
			<div class="container mt-5">
			
				@if(session('success'))
					<div class="alert alert-success">{{ session('success') }}</div>
				@endif
		
				<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">إضافة منتج جديد</a>
		
				
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
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	
		
				
				
@endsection
@section('js')
@endsection