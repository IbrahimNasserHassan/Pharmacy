@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة منتج جديد</span>
						</div>
						<br>
						<div>
							<a href="{{ route('products.index') }}" class="btn btn-success "><i class="fa fa-arrow-right"></i>  رجوع</a>
						</div>
					</div>
					

					{{-- <div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div> --}}
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
					<title>إضافة منتج جديد</title>
					<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
					<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
					<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
				</head>
				<body class="bg-light">
				
				<div class="container mt-5">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="card shadow-lg border-0 rounded-3">
								<div class="card-header bg-primary text-white text-center">
									<h4><i class="fas fa-box-open"></i> إضافة منتج جديد</h4>
								</div>
								<div class="card-body p-4">
									<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
										@csrf
				
										<!-- اسم المنتج -->
										<div class="mb-3">
											<label for="name" class="form-label"><i class="fas fa-tag"></i> اسم المنتج</label>
											<input type="text" class="form-control" id="name" name="name" required>
										</div>
				
										<!-- السعر -->
										<div class="mb-3">
											<label for="price" class="form-label"><i class="fas fa-dollar-sign"></i> السعر</label>
											<input type="number" class="form-control" id="price" name="price" step="0.01" required>
										</div>
				
										<!-- الكمية -->
										<div class="mb-3">
											<label for="quantity" class="form-label"><i class="fas fa-layer-group"></i> الكمية المتوفرة</label>
											<input type="number" class="form-control" id="quantity" name="quantity" required>
										</div>
				
										<!-- فئة المنتج -->
										<div class="mb-3">
											<label for="category" class="form-label"><i class="fas fa-list"></i> فئة المنتج</label>
											<select class="form-select" id="category" name="category" required>
												<option value="">اختر الفئة</option>
												<option value="أدوية">أدوية</option>
												<option value="مستلزمات طبية">معدات طبية</option>
												<option value="مكملات غذائية">مكملات غذائية</option>
												<option value="مستحضرات تجميل">مستحضرات تجميل</option>
												<option value="منتجات أخرى">منتجات أخرى</option>
											</select>
										</div>
				
										<!-- وصف المنتج -->
										<div class="mb-3">
											<label for="expiry_date" class="form-label"><i class="fas fa-file-alt"></i> وصف المنتج</label>
											<textarea class="form-control" id="description" name="description" rows="3"></textarea>
										</div>
				
							
										<!-- زر الإرسال -->
										<div class="d-grid">
											<button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ المنتج</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- إشعار الحفظ -->
				<div class="toast-container position-fixed bottom-0 end-0 p-3">
					<div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
						<div class="d-flex">
							<div class="toast-body">
								<i class="fas fa-check-circle"></i> تم حفظ المنتج بنجاح!
							</div>
							<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
						</div>
					</div>
				</div>
				
				<script>
					// عرض معاينة الصورة قبل رفعها
					function previewImage(event) {
						let imagePreview = document.getElementById('imagePreview');
						let file = event.target.files[0];
				
						if (file) {
							let reader = new FileReader();
							reader.onload = function(e) {
								imagePreview.src = e.target.result;
								imagePreview.classList.remove('d-none');
							};
							reader.readAsDataURL(file);
						} else {
							imagePreview.classList.add('d-none');
						}
					}
				
					// عرض إشعار الحفظ عند نجاح العملية
					@if(session('success'))
						let successToast = new bootstrap.Toast(document.getElementById('successToast'));
						successToast.show();
					@endif
				</script>
				
				</body>
				</html>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection