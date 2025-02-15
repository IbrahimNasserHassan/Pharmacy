<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{

    use HasFactory;


    public function invoiceDetails(){

        return $this->hasMany(InvoiceDetail::class);
    }
    //End 


    protected $fillable = ['name', 'total_amount, 10, 2', 'created_at', 'updated_at']; 



    public function products(){

    return $this->belongsToMany(Product::class, 'invoice_product')
    ->withPivot(['quantity', 'subtotal']) // ✅ فقط الحقول الموجودة في جدول invoice_product
    ->withTimestamps();

    }
    
}

