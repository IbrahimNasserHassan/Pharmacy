@extends('layouts.master')
@section('title')
إنشاء فاتورة جديدة
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h6 class="content-title mb-0 my-auto">الفواتير</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / إنشاء فاتورة جديدة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				
	
				
				<div class="row">
                    <div class="container mt-3">
                        <div class="container">
                            <h2 class="mb-4">إنشاء فاتورة جديدة</h2>
                        
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            {{-- <input type="text" id="product-search" placeholder="ابحث عن المنتج..." class="form-control"> --}}
                            <ul id="search-results" class="list-group"></ul>
                            <form action="{{ route('invoices.store') }}" method="POST">
                                @csrf
                        
                                <div class="mb-3">
                                    <label class="form-label">اختر المنتجات</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>المنتج</th>
                                                <th>السعر</th>
                                                <th>الكمية</th>
                                                <th>المجموع</th>
                                                <th>إلغاء</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-list">
                                            <tr>
                                                <td>
                                                    <select name="products[0][id]" class="form-select product-select">
                                                        <option value="">اختر منتج</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                                {{ $product->name }} - {{ $product->price }}$
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control price" readonly></td>
                                                <td><input type="number" name="products[0][quantity]" class="form-control quantity" min="1" value="1"></td>
                                                <td><input type="text" class="form-control subtotal" readonly></td>
                                                <td><button type="button" class="btn btn-danger remove-product">X</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary" id="add-product">إضافة منتج آخر</button>
                                </div>
                        

                                <div class="mb-3">
                                    <label for="total" class="form-label">إجمالي الفاتورة</label>
                                    <input type="text" id="total" class="form-control" readonly>
                                </div>
                        

                                <button type="submit" class="btn btn-success">حفظ الفاتورة</button>
                            </form>
                        </div>
                        


                        {{--   حساب الإجمالي    --}}

                        <script>

                        document.addEventListener("DOMContentLoaded", function() {
                            function calculateTotal() {
                                let total = 0;
                                document.querySelectorAll(".subtotal").forEach(function(subtotal) {
                                    total += parseFloat(subtotal.value) || 0;
                                });
                                document.getElementById("total").value = total.toFixed(2);
                            }
                        
                            function updateSubtotal(row) {
                                let price = parseFloat(row.querySelector(".product-select option:checked").dataset.price) || 0;
                                let quantity = parseInt(row.querySelector(".quantity").value) || 1;
                                let subtotal = price * quantity;
                                row.querySelector(".price").value = price.toFixed(2);
                                row.querySelector(".subtotal").value = subtotal.toFixed(2);
                                calculateTotal();
                            }
                        
                            document.getElementById("product-list").addEventListener("change", function(event) {
                                let row = event.target.closest("tr");
                                updateSubtotal(row);
                            });
                        
                            document.getElementById("add-product").addEventListener("click", function() {
                                let index = document.querySelectorAll("#product-list tr").length;
                                let newRow = document.querySelector("#product-list tr").cloneNode(true);
                                newRow.querySelectorAll("input, select").forEach(function(input) {
                                    let name = input.getAttribute("name");
                                    if (name) input.setAttribute("name", name.replace(/\d+/, index));
                                    if (input.classList.contains("quantity")) input.value = 1;
                                    if (input.classList.contains("price") || input.classList.contains("subtotal")) input.value = "";
                                });
                                document.getElementById("product-list").appendChild(newRow);
                            });
                        
                            document.getElementById("product-list").addEventListener("click", function(event) {
                                if (event.target.classList.contains("remove-product")) {
                                    event.target.closest("tr").remove();
                                    calculateTotal();
                                }
                            });
                        });

                        </script>
                            </div>
                        
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                        <!--Internal  Flot js-->
                        <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
                        <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
                        <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
                        <script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
                        <script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
                        <script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
                    
                        <!--Internal  index js -->
                        <script src="{{URL::asset('assets/js/index.js')}}"></script>
                        <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->




@endsection
@section('js')
@endsection