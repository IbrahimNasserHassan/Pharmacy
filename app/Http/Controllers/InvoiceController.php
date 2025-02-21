<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Http\Controllers\AdminController;


class InvoiceController extends Controller
{
    // 
    use AuthorizesRequests;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->authorizeResource(Invoice::class, 'invoice');
    // }

    public function index()
    {
        $invoices = Invoice::select()->orderby('id','DESC')->paginate('50');
        return view('invoices.invoicesIndex', compact('invoices'));
    }
                    //End Method


    public function create()
    {
        $products = Product::all();
        return view('invoices.invoicesCreate', compact('products'));
    }
                //End Method


    public function store(Request $request)
    {
        $this->authorize('create', Invoice::class); 
        // dd($request->all());

        
        try {
            $validatedData = $request->validate([
                'products' => 'required|array',
                'products.*.id' => 'exists:products,id',
                'products.*.quantity' => 'required|integer|min:1'
            ]);
        
        $invoice = Invoice::create();

        // dd($invoice);

        $total = 0;
    
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
    
            // التحقق من توفر الكمية المطلوبة

            if ($product->quantity < $productData['quantity']) {
                return redirect()->back()->with('error', "الكمية المطلوبة من {$product->name} غير متوفرة!");
            }
    
            // خصم الكمية من المخزون

            $product->quantity -= $productData['quantity'];
            $product->save();
    
            // فحص إذا كانت الكمية بعد الخصم أقل من الحد الأدنى
            
            if ($product->quantity < 5) {
                session()->flash('warning', "⚠️ المنتج {$product->name} قارب على النفاد ({$product->quantity} قطع متبقية).");
            }
    
            $subtotal = $product->price * $productData['quantity'];
            $invoice->products()->attach($product->id, [
                'quantity' => $productData['quantity'],
                'price' => $product->price,
                'subtotal' => $subtotal,
                'total_amount' => $subtotal 

            ]);
    
            $total += $subtotal;
        }
    
        // تحديث إجمالي الفاتورة
        $invoice->total_amount = $total;
        $invoice->save();
        return redirect()->route('invoices.index')->with('success', 'تم إنشاء الفاتورة بنجاح وتم تحديث المخزون.');
    }
    catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors()); // إذا في خظأ 

    }
}
                //End Method



    public function show(Invoice $invoice)
    {
        return view('invoices.InvoicesShow', compact('invoice'));
    }
            //End Method



    public function edit($id)
    {
        
    
$invoice = Invoice::with('products')->findOrFail($id);  
$products = Product::all();

return view('invoices.invoicesEdit', compact('invoice', 'products'));

    }
            //End Method



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
    

        $invoice = Invoice::findOrFail($id);

        $invoice->products()->sync([]);

        // إضافة أو تحديث المنتجات الجديدة
        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['id']);
            $price = $product->price;
            $totalAmount = $price * $productData['quantity'];
    
            // تحديث أو إضافة المنتج للفاتورة
            $invoice->products()->updateExistingPivot($productData['id'], [
                'quantity' => $productData['quantity'],
                'price' => $price,
                'total_amount' => $totalAmount,
            ]);
        }
    
        return redirect()->route('invoices.index')->with('success', 'تم تحديث الفاتورة بنجاح');
    }
                     //End Method

    

    public function search(Request $request)
{
    try {
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
        ]);

        $query = Invoice::query();

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $invoices = $query->orderBy('created_at', 'desc')->get();

        if ($invoices->isEmpty()) {
            return response()->json([]); 
        }

        return response()->json($invoices);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
                //End Method

    


    public function destroy(Invoice $invoice)
    {
        // $this->authorize('delete', $invoice);
        
        $invoice->delete();
        
        return redirect()->route('invoices.index')->with('success', 'تم الحذف بنجاح!  .');
    }
            //End Method


}
