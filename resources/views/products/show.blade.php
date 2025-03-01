@extends('layouts.master')
@section('title')
تفاصيل المنتج
@endsection
@section('css')
@endsection
@section('page-header')
				
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto">المنتجات</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل المنتج</span>
						</div>
					</div>
					
				</div>

@endsection
@section('content')
				
				
				<div class="container mt-5">
					<div class="card shadow-lg">
						<div class="card-header bg-primary text-white">
							<h3 class="mb-0">تفاصيل المنتج</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<h4><strong>اسم المنتج:</strong> {{ $product->name }}</h4>
									<h5><strong>السعر:</strong> ${{ number_format($product->price, 2) }}</h5>
									<h5><strong>الكمية المتاحة:</strong> {{ $product->quantity }}</h5>
									<h5><strong>التصنيف:</strong> {{ $product->category }}</h5>
									<h5><strong>تاريخ الإضافة:</strong> {{ $product->created_at->format('Y-m-d H:i') }}</h5>
								</div>
							</div>
						</div>
						<div class="card-footer text-end">
							<a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع إلى المنتجات</a>
						</div>
					</div>
				</div>
				<br>
				
				
				
				
@endsection
@section('js')
@endsection