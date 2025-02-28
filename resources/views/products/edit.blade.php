@extends('layouts.master')
@section('title')
تعديل المنتج
@endsection
@section('css')
@endsection
@section('page-header')

            <div class="breadcrumb-header justify-content-between">
				<div class="my-auto">
					<div class="d-flex">
						<h6 class="content-title mb-0 my-auto">المنتجات</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل المنتج</span>
					</div>
				</div>
				
			</div>

@endsection
@section('content')
				<!-- row -->


        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-header bg-primary text-white text-center">

                    <h4>تعديل المنتج</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="price" class="form-label">السعر</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="quantity" class="form-label">الكمية</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="category" class="form-label">الفئة</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="أدوية" {{ $product->category == 'أدوية' ? 'selected' : '' }}>أدوية</option>
                                <option value="مستلزمات طبية" {{ $product->category == 'مستلزمات طبية' ? 'selected' : '' }}>مستلزمات طبية</option>
                                <option value="مكملات غذائية" {{ $product->category == 'مكملات غذائية' ? 'selected' : '' }}>مكملات غذائية</option>
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>
        
    

		<!-- main-content closed -->
@endsection
@section('js')
@endsection