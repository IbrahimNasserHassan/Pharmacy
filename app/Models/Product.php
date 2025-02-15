<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'category',
        'price',  
        'quantity',    
        'expiry_date'
    ];


    public function invoiceDetails(){

         // إضافة العلاقات بين الموديلز
    return $this->hasMany(InvoiceDetail::class);

    }

    public function invoices()
    {
        
    return $this->belongsToMany(Invoice::class, 'invoice_product')
    ->withPivot(['quantity', 'subtotal'])
    ->withTimestamps();

    }

}
