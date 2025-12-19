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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->foreignId('supplier_id');
            $table->string('purchase_no');
            $table->date('purchase_date');
            $table->decimal('sub_total');
            $table->decimal('discount');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('status');
            $table->string('note');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
