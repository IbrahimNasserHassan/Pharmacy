<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\InvoiceDetailController;



Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('users.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('update');




// Product Management Routes
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');



// Low Stock Products Route
Route::get('/low-stock', function () {
    $lowStockProducts = Product::where('quantity', '<', 5)->get();
    return view('products.low_stock', compact('lowStockProducts'));
})->name('products.low_stock');


// Report Management Routes
Route::get('/reports', [ReportController::class, 'showReports'])->name('reports');
Route::get('/sales/daily-report/data', [ReportController::class, 'getDailySalesData'])->name('daily-sales-data');
Route::get('/',[UserController::class, 'showChart']);




// Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
//     Route::resource('users', UserController::class);
// });

// Route::middleware(['auth', 'role:Pharmacist'])->group(function () {
//     Route::get('/pharmacy', function () {
//         return " الصيدلي!";
//     });
// });

// Route::middleware(['auth', 'role:Cashier'])->group(function () {
//     Route::get('/sales', function () {
//         return " الكاشير!";
//     });
// });
// php artisan make:controller ProductController --resource --model=Product;



// Invoice Management Routes
Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('invoices/create', [InvoiceController::class, 'create'])->middleware(['auth', 'verified'])->name('invoices.create');
Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
Route::get('/invoices/search', [InvoiceController::class, 'search'])->name('invoices.search');


// // search products
// Route::get('/products/search', function (Request $request) {
//     $search = $request->query('q');
//     $products = Product::where('name', 'like', "%{$search}%")->limit(10)->get(['id', 'name', 'price', 'quantity']);
//     return response()->json($products);
// });

Route::get('/home',[UserController::class, 'index'])->name('Home');
})->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';

