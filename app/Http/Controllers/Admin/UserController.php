<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ReportController;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Whoops\Exception\Formatter;
use Illuminate\Support\Facades\DB;


use function Laravel\Prompts\form;

class UserController extends Controller
{
    public function index()
    {

        $users = User::all();
    
        $totalProducts = Product::count();

        $todayDate = Carbon::now()->format('d-m-Y');

        $totalInvoices = Invoice::count();


        $salesData = Invoice::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(id) as invoice_count'))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    $labels = $salesData->pluck('date');
    $data = $salesData->pluck('invoice_count');
    $todaydata = $salesData->count();
    $todaydata = Invoice::whereDate('created_at',$todaydata)->count();



        return view('admin.users.index', compact('todaydata','data','labels','totalProducts','totalInvoices'))->with('success', 'مرحبا بك!');
    }

    // public function showChart(Request $request){

    //     $from = $request->input('from', now()->startOfMonth()->toDateString());
    //     $to = $request->input('to', now()->toDateString());

    //     $sales = DB::table('invoices')
    //         ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
    //         ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
    //         ->groupBy(DB::raw('DATE(created_at)'))
    //         ->orderBy('date', 'asc')
    //         ->get();
    //         return view('admin.users.index',compact('sales'));

    // }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }


    
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'تم تحديث صلاحيات المستخدم بنجاح!');
    }
}

