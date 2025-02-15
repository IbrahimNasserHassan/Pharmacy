<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Invoice;
use App\Policies\InvoicePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * السياسات (Policies) المستخدمة
     */
    protected $policies = [
        Invoice::class => InvoicePolicy::class, // تأكد من ربط السياسة بالـ Invoice
    ];

    /**
     * تسجيل أي صلاحيات أو Gate جديدة
     */
    public function boot()
    {
        $this->registerPolicies();

        // مثال لإضافة Gate لمستخدم له دور Admin فقط
        Gate::define('create-invoice', function ($user) {
            return $user->hasRole('admin');
        });
    }
}