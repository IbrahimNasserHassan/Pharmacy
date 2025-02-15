@extends('layouts.master')
@section('css')
@endsection
@section('page-header')

<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
						</div>
					</div>
					
				</div>

                @endsection
@section('content')
				<!-- row -->

                <div class="container mt-4">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h4> # تفاصيل الفاتورة رقم : {{ $invoice->id }}</h4>
                        </div>
                        <div class="card-body">
                        
                            @if($invoice->products->isEmpty())
                                <p class="alert alert-danger mt-3">لا توجد بيانات في هذه الفاتورة.</p>
                            @endif

                        
                            {{-- <h2>رقم الفاتورة #{{ $invoice->id }}</h2> --}}
                            <div class="row row-sm">
                                <div class="col-md-12 col-xl-12">
                                    <div class=" main-content-body-invoice">
                                        <div class="card card-invoice">
                                            <div class="card-body">
                                                <div class="invoice-header">
                                                    <h1 class="invoice-title">فاتورة رقم : {{ $invoice->id }}</h1>
                                                    <div class="billed-from">
                                                    </div><!-- billed-from -->
                                                </div><!-- invoice-header -->
                                                <div class="row mg-t-20">
                                                    <div class="col-md">
                                                        <label class="tx-gray-600">اسم المستخدم:</label>
                                                        <div class="billed-to">
                                                            <h6>{{ Auth::user()->name }}</h6>
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <label class="tx-gray-600">معلومات الفاتورة </label>
                                                        <p class="invoice-info-row"><span>رقم الفاتورة</span> <span>{{ $invoice->id }}</span></p>
                                                        <p class="invoice-info-row"><span>تاريخ استخراج الفاتورة:</span> <span>{{ $invoice->created_at }}</span></p>
                                                    </div>
                                                </div>
                                                <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="wd-20p">إسم المنتج</th>
                                            <th class="tx-right">الكمية </th>                                           
                                            <th class="tx-right"> السعر</th>
                                            <th class="tx-right"> المجموع الفرعي</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice->products as $product)
                                    <tr>
                                        
                                            <td class="center">{{ $product->name }}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->pivot->subtotal }}</td>                                        
                                            <td>{{ $product->price }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <h3><strong>إجمالي الفاتورة:</strong><h4 class="tx-danger tx-bold"> {{ number_format($invoice->total_amount, 2) }} جنيه </h4></h3>

                        {{-- <button onclick="window.print()"  class="btn btn-info float-left mt-3 mr-2">
										<i class="mdi mdi- ml-1"></i>🖨️ طباعة
									</a>
                        </button> --}}

                        </div>
                    </div>
                </div>

{{--  --}}
			
		<!-- main-content closed -->
@endsection
@section('js')
@endsection