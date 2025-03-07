<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        //
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }
    //End Method





    public function create()
    {
        //
        return view('products.create');
    }
    //End Method




    
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',  
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'تم إضافة المنتج!');
    }
    //End Method



    
    public function show(string $id)
    {
        //
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));

    }
    //End Method



    
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));

    }
    //End Method

    
    

    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);
        
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج');
    }
    //End Method




    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج !');
    }
    //End Method

    
}
