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
        Schema::create('stokist_reports_product_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stokist_report_detail_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->date('date');
            $table->timestamps();
        
            $table->foreign('stokist_report_detail_id')
                  ->references('id')
                  ->on('stokist_reports_detail')
                  ->onDelete('cascade');
    
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
