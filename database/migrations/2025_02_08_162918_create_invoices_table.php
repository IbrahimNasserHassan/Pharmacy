<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->decimal('total_amount, 10, 2')->default(0);
            $table->timestamps();
        });
    
        
    Schema::table('invoices', function (Blueprint $table) {
        $table->decimal('total_amount', 10, 2)->default(0);
    });

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('invoices');
    // }

}

public function down()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn('total_amount, 10, 2');
    });
}
};
