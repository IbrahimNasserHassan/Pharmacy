@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex">
                            <h4 class="content-title mb-0 my-auto"> الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الفواتير</span>
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
            
                {{-- <div class="mt-3 card p-3">
                    <h5>🔍 البحث بالتاريخ:</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" id="from-date" class="form-control" placeholder="من تاريخ">
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="to-date" class="form-control" placeholder="إلى تاريخ">
                        </div>
                        <div class="col-md-4">
                            <button id="search-btn" class="btn btn-primary w-100">
                                <i class="fa fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </div> --}}
            
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
            
                {{-- <div class="d-flex justify-content-center mt-4">
                    {{ $invoices->links() }}
                </div> --}}
            </div>
            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#search-btn').on('click', function() {
                    let from = $('#from-date').val();
                    let to = $('#to-date').val();
            
                    if (!from || !to) {
                        alert("⚠️ الرجاء تحديد تاريخ البداية والنهاية!");
                        return;
                    }
            
                    $.ajax({
    url: '{{ route('invoices.search') }}',
    type: 'GET',
    data: { from: from, to: to },
    success: function(data) {
        console.log("✅ البيانات المسترجعة:", data);
        let tableBody = $('#invoice-results');
        tableBody.empty();

        if (data.length === 0) {
            tableBody.append('<tr><td colspan="4" class="text-center text-danger">❌ لا توجد فواتير في هذا التاريخ</td></tr>');
        } else {
            data.forEach((invoice, index) => {
                tableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${invoice.created_at}</td>
                        <td>${invoice.total_amount} $</td>
                        <td class="text-center">
                            <a href="/invoices/${invoice.id}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> تفاصيل
                            </a>
                            <form action="/invoices/${invoice.id}" method="POST" class="d-inline" onsubmit="return confirm('⚠️ هل أنت متأكد من الحذف؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                `);
            });
        }
    },
                        error: function(xhr) {
        console.error("❌ خطأ في البحث:", xhr.responseText);
        alert("❌ حدث خطأ أثناء البحث، تحقق من الـ Console لرؤية التفاصيل.");
    }
});
                });
            });


            </script>
            
            

    
{{--  --}}
			
		<!-- main-content closed -->
@endsection
@section('js')
@endsection