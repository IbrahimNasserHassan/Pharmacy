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
    //End Method



    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    //End Method

    
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('users.index')->with('success', 'تم تحديث صلاحيات المستخدم بنجاح!');
    }
    //End Method
    
}

