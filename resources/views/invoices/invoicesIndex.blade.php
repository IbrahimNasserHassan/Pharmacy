@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h6 class="content-title mb-0 my-auto"> الفواتير</h6><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الفواتير</span>
                        </div>
                    </div>
                </div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>📜 قائمة الفواتير</h2>
                <div> <a href="{{ route('invoices.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> إضافة فاتورة جديدة
                    </a>
                </div>
                </div>
                <br>
            
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="invoice-table">
                        
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>📅 التاريخ</th>
                                <th>💰 الإجمالي</th>
                                <th class="text-center">⚙️ الإجراءات</th>
                            </tr>
                        </thead>

                        <tbody id="invoice-results">
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ optional($invoice->created_at)->format('Y-m-d') }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} $</td>
                                <td class="text-center">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-info-circle"></i> تفاصيل
                                    </a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ هل أنت متأكد من الحذف؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            
                <div class="d-flex justify-content-center mt-4">
                    {{ $invoices->links() }}
                </div>
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        
@endsection
@section('js')
@endsection