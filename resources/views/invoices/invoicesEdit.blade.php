@extends('layouts.master')

@section('css')
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل الفاتورة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="container mt-3">
            <div class="container">
                <h2 class="mb-4">تعديل الفاتورة</h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- قائمة المنتجات -->
                    <div class="mb-3">
                        <label class="form-label">اختر المنتجات</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>المجموع</th>
                                    <th>إزالة</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @foreach($invoice->products as $index => $product)
                                    <tr>
                                        <td>
                                            <select name="products[{{ $index }}][id]" class="form-select product-select">
                                                <option value="">اختر منتج</option>
                                                @foreach($products as $p)
                                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}" 
                                                        {{ $product->id == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }} - {{ $p->price }}$
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control price" value="{{ $product->pivot->price }}" readonly></td>
                                        <td><input type="number" name="products[{{ $index }}][quantity]" class="form-control quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                        <td><input type="text" class="form-control subtotal" value="{{ $product->pivot->quantity * $product->pivot->price }}" readonly></td>
                                        <td><button type="button" class="btn btn-danger remove-product">X</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" id="add-product">إضافة منتج آخر</button>
                    </div>

                    <!-- إجمالي الفاتورة -->
                    <div class="mb-3">
                        <label for="total" class="form-label">إجمالي الفاتورة</label>
                        <input type="text" id="total" class="form-control" value="{{ $invoice->total_amount }}" readonly>
                    </div>

                    <!-- زر الحفظ -->
                    <button type="submit" class="btn btn-success">تحديث الفاتورة</button>
                </form>
            </div>
        </div>

        <!-- حساب الإجمالي -->
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
    <!-- row closed -->
@endsection

@section('js')
@endsection
