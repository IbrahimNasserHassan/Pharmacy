@extends('layouts.app')
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
    <div class="container">
        <h2>🔴 المنتجات قليلة المخزون</h2>

        @if($lowStockProducts->isEmpty())
            <p>🎉 لا يوجد منتجات منخفضة المخزون حالياً.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>المنتج</th>
                        <th>الكمية المتبقية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowStockProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td class="text-danger"><strong>{{ $product->quantity }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
@section('js')
@endsection