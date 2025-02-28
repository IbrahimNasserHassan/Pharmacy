<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function showReports(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());
    
        $sales = DB::table('invoices')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();
                
        return view('report.reports', compact('sales', 'from', 'to'));
    }
    

    public function getDailySalesData(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());


        if (!$from || !$to) {
            return response()->json(['error' => 'يرجى تحديد فترة صالحة'], 400);
        }


        $sales = DB::table('invoices')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        return response()->json($sales);
    }
}
